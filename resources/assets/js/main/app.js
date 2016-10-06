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