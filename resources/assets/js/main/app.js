tinymce.init({
    selector: '#editor',
    plugins: 'code image'
});


//Slug
var slug = function(str) {
    var string = transliterate(str);
    var $slug = '';
    var trimmed = $.trim(string);
    $slug = trimmed.replace(/[^a-zа-я0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

$('#title-field').focusout(function() {
    $('#slug-field').val(slug($(this).val()));
});

//Image preview
function readURL(input) {
if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#image-upload").change(function(){
    readURL(this);
});

//Tags selectbox
$(".js-example-basic-multiple").select2();

$("#owl-demo").owlCarousel({
    items: 4,
    itemsDesktop: [1199, 3],
    itemsTablet: [767, 2],
    itemsTabletSmall: [543, 1],
    autoPlay: 3000,
    navigation: true,
    pagination: false,
    navigationText: false
});

$("#owl-demo2").owlCarousel({
    items: 1,
    itemsDesktop: [1199, 3],
    itemsTablet: [767, 2],
    itemsTabletSmall: [543, 1],
    autoPlay: 5000,
    navigationText: false
});

/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});*/


$('.rate-post-btn').click(function(e){
    e.preventDefault();
    var self = $(this);
    var form = $(this).parent();
    var url = form.attr('action');
    var ajax = $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: form.serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.done(function(data){
        //var elem = '<div class="alert alert-success">' + data.message + '</div>';
        //$(elem).hide().appendTo('.alerts').fadeIn(750);
        $('#post-rating-counter').html(data.rating);
        $('.rate-post-btn').prop('disabled', true);
        var ratingBlock = self.closest('.rating');
        if (self.hasClass('rate-down-btn')) {
            ratingBlock.addClass('down-voted');
        } else if (self.hasClass('rate-up-btn')) {
            ratingBlock.addClass('up-voted');
        }

    });
});

$('.rate-comment-btn').click(function(e){
    e.preventDefault();
    var form = $(this).parent();
    var url = form.attr('action');
    var comment = $(this).closest('.comment');
    var ajax = $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: form.serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.done(function(data){
        //var elem = '<div class="alert alert-success">' + data.message + '</div>';
        //$(elem).hide().appendTo('.alerts').fadeIn(750);
        comment.find('.comment-rating-counter').html(data.rating);
        $('.rating-comment-form').remove();
    });
});

$('#add-comment-form').submit(function(e) {
    e.preventDefault();
    var val = $.trim($('#text-field').val());
    if (val.length < 3) {
        $('#add-comment-group').addClass('has-danger');
        $('#status-notify').text('Введите текст комментария больше чем 2 символа');
        return;
    }
    var ajax = $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.done(function(comment) {
        var comment = '<div class="comment">\
                            <div class="rating pull-right">\
                                <strong class="comment-rating-counter">0</strong>\
                            </div>\
                            <div class="comment-avatar" style="background-image: url(' + comment.avatar + ');"></div>\
                            <div class="comment-content">\
                                <h4 class="comment-author"><a href="/user/' + comment.username + '">' + comment.fullName + '</a></h4>\
                                <ul class="post-info">\
                                    <li>\
                                        <i class="fa fa-clock-o"></i>\
                                        ' + comment.date + '\
                                    </li>\
                                </ul>\
                                <p class="comment-text">' + comment.text + '</p>\
                                <button class="btn-edit" type="button" data-target="' + comment.id + '"><i class="fa fa-pencil" aria-hidden="true"></i>Редактировать</button>\
                                <form action="/comment/' + comment.id + '" method="post" class="delete-comment-form">\
                                    <input type="hidden" name="_token" value="' + comment.csrfToken + '">\
                                    <input type="hidden" name="_method" value="DELETE">\
                                    <button class="btn-delete" type="submit"><i class="fa fa-times" aria-hidden="true"></i>Удалить</button>\
                                </form>\
                            </div>\
                        </div>';
        if ($('#no-comments')) {
            $('#no-comments').remove();
        }
        $('#comments').append(comment);
    });
});

var commentText = '';

$('.btn-edit').click(function() {
    $('#cancel-comment-edit-btn').click();
    $(this).prop('disabled', true);

    var comment = $(this).parent(),
        commentItem = comment.find('.comment-text');

    commentText = commentItem.text();

    var form = '\
        <form action="/comment/' + $(this).data('target') + '" method="post" id="update-comment-form">\
            <input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">\
            <div class="form-group" id="inline-edit-wrapper">\
                <textarea name="text" class="form-control">' + commentText + '</textarea>\
                <div class="form-control-feedback" id="inline-notify"></div>\
            </div>\
            <button type="button" id="cancel-comment-edit-btn">Cancel</button>\
            <button type="submit">OK</button>\
        </form>\
    ';
    commentItem.replaceWith(form);

    $('#cancel-comment-edit-btn').click(function() {
        var form = $(this).parent('form');
        comment.find('.btn-edit').prop('disabled', false);
        form.replaceWith(commentItem);
        $(this).off('click');
        $('#update-comment-form').off('submit');
    });

    $('#update-comment-form').submit(function(e) {
        e.preventDefault();
        var val = $.trim($(this).find('textarea').val());
        if (val.length < 3) {
            $('#inline-edit-wrapper').addClass('has-danger');
            $('#inline-notify').text('Введите текст комментария больше чем 2 символа');
            return;
        }
        var ajax = $.ajax({
            url: $(this).attr('action'),
            method: 'PATCH',
            dataType: 'json',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        ajax.done(function(data) {
            commentItem.html(data.text);
            $('#update-comment-form').replaceWith(commentItem);
            comment.find('.btn-edit').prop('disabled', false);
        });
    });
});

$('.delete-comment-form').submit(function(e) {
    e.preventDefault();
    var comment = $(this).closest('.comment');
    var ajax = $.ajax({
        url: $(this).attr('action'),
        method: 'DELETE',
        dataType: 'json',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.done(function(data) {
        if (data.status == 'ok') {
            comment.remove();
        }
    });
});

$('#login-form').submit(function(e) {
    e.preventDefault();


    var ajax = $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.fail(function(response) {
        var data = $.parseJSON(response.responseText);
        var loginField = $('#login-field');

        loginField.closest('.form-group').addClass('has-danger');
        loginField.addClass('form-control-danger');
        loginField.next('.form-control-feedback').html(data.error);
    });

    ajax.done(function(response) {
        if (response.status == 'ok') {
            window.location.href = '/';
        }
    });
});


$('#register-form').submit(function(e) {
    e.preventDefault();
    var form = this;

    var ajax = $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ajax.fail(function(response) {
        var data = $.parseJSON(response.responseText);
        for (var prop in data) {
            var failedInput = $("[name=" + prop + "]");
            failedInput.addClass('form-control-danger')
                        .closest('.form-group').addClass('has-danger')
                        .find('.form-control-feedback').html(data[prop]);
        }
    });

    ajax.done(function(data) {
        $('.has-danger').removeClass('has-danger');
        $('.form-control-danger').removeClass('form-control-danger');
        $('.form-control-feedback').html('');

        if (data.status == 'ok') {
            var messageItem = '<div class="alert alert-success">' + data.message + '</div>';
            $(form).before(messageItem);
        }
    });
});