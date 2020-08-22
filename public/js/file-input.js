// Code By Webdevtrick ( https://webdevtrick.com )
console.log("Helooo");
$(document).ready(function(){
    $("#inputGroupFile01").change(function(){
        // alert("A file has been selected.");
    });
});
$("#inputGroupFile01").change(function(event) {
    console.log("Helooo");
    readURL(this);
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#inputGroupFile01").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            $('#preview').hide();
            $('#preview').fadeIn(500);
            $('.custom-file-label').text(filename);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
