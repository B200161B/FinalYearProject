
$("#profile-img2").click(function(){

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img2").change(function(){
        readURL(this);
    });
});

$("#profile-img").click(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });

});
$("#product-img").click(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#product-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#product-img").change(function(){
        readURL(this);
    });

});
$('.fa-user').click(function(){
    window.location.href=('profile.php');
});

$('.fa-plus-circle').click(function(){
    window.location.href=('addProduct.php');
});
$('.fa-vuejs').click(function(){
    window.location.href=('mainPage.php');
});

  