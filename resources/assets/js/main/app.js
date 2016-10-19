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
        $('.rating-post-form').remove();
    });
});

$('.rate-comment-btn').click(function(e){
    e.preventDefault();
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
        $('#comment-rating-counter').html(data.rating);
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
        var comment = '<div class="comment" style="border: 1px solid #000; margin-bottom: 20px">\
                            <div class="rating pull-right">\
                                <strong style="font-size: 20px;" id="comment-rating-counter">0</strong>\
                            </div>\
                            <h4><a href="/user/' + comment.username + '">' + comment.fullName + '</a></h4>\
                            <hr>\
                            <p>' + comment.text + '</p>\
                            <p>' + comment.date + '</p>\
                            <a href="/comment/' + comment.id + '/edit">Редактировать</a>\
                            <form action="/comment/' + comment.id + '" method="post">\
                                <input type="hidden" name="_token" value="' + comment.csrfToken + '">\
                                <input type="hidden" name="_method" value="DELETE">\
                                <button type="submit">Удалить</button>\
                            </form>\
                        </div>';
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

$('#delete-comment-form').submit(function(e) {
    e.preventDefault();
    var comment = $(this).parent('.comment');
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
            
        }
    });
});
