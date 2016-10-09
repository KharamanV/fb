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