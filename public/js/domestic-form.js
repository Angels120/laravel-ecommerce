


jQuery( document ).ready(function( $ ) {
    $( function() {
        $( ".mydatepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        maxDate: new Date()
        });
    } );
});


$('#domesticForm').submit(function() {
    var $fields = $(this).find('input[name="course_id[]"]:checked');

    // Validation for course checkbox
    if (!$fields.length) {
        chk_option_error.style.display = 'block';
        $('html, body').animate({
            scrollTop: $("#courseDiv").offset().top
        }, 500);
        return false; // The form will *not* submit
    }

    // validation for signature
    if($("#signature_capture1").val() == "" && $("#textFont1").val() == "" && $('#signatureImage1').get(0).files.length === 0){
        toastr.error('Please add signature for ANE College Commitment!')
        $('html, body').animate({
            scrollTop: $("#aneCollegeCommitment").offset().top
        }, 500);
        return false;
    }

    if(($("#signature_capture2").val() == "" && $("#textFont2").val() == "" && $('#signatureImage2').get(0).files.length === 0) && ($("#signature_capture3").val() == "" && $("#textFont3").val() == "" && $('#signatureImage3').get(0).files.length === 0)){
        toastr.error('Please add signature for creating USI!')
        $('html, body').animate({
            scrollTop: $("#usiSignatureDiv").offset().top
        }, 500);
        return false;
    }

});


// College Commitmemt Signature

$('#signature1').jSignature();
var $sigdiv1 = $('#signature1');
var datapair1 = $sigdiv1.jSignature('getData', 'svgbase64');

$('#signature1').bind('change', function(e) {
    var datapair1 = $sigdiv1.jSignature("getData")
    $("#signature_capture1").val(datapair1);
});

$('#reset1').click(function(e) {
    $sigdiv1.jSignature('clear');
    $("#signature_capture1").val('');
});


// Section A Signature

$('#signature2').jSignature();
var $sigdiv2 = $('#signature2');
var datapair2 = $sigdiv2.jSignature('getData', 'svgbase64');

$('#signature2').bind('change', function(e) {
    var datapair2 = $sigdiv2.jSignature("getData")
    $("#signature_capture2").val(datapair2);

});

$('#reset2').click(function(e) {
    $sigdiv2.jSignature('clear');
    $("#signature_capture2").val('');
});


// Section B Signature

$('#signature3').jSignature();
var $sigdiv3 = $('#signature3');
var datapair3 = $sigdiv3.jSignature('getData', 'svgbase64');

$('#signature3').bind('change', function(e) {
    var datapair = $sigdiv3.jSignature("getData")
    $("#signature_capture3").val(datapair);
});

$('#reset3').click(function(e) {
    $sigdiv3.jSignature('clear');
    $("#signature_capture3").val('');
});




function changeFontStyle(selectFont, textFont) {
    var selectFont = document.getElementById(`${selectFont}`);
    var textFont = document.getElementById(`${textFont}`);

    if (selectFont.value == "Fasthand") {
        textFont.style.fontFamily = 'Fasthand';
    } else if (selectFont.value == "Allura") {
        textFont.style.fontFamily = 'Allura';
    } else if (selectFont.value == "Pinyon Script") {
        textFont.style.fontFamily = 'Pinyon Script';
    } else if (selectFont.value == "Great Vibes") {
        textFont.style.fontFamily = 'Great Vibes';
    } else if (selectFont.value == "Sacramento") {
        textFont.style.fontFamily = 'Sacramento';
    }

}




var domesticForm = document.getElementById("domesticForm");

domesticForm.addEventListener('submit', (event) => {

        event.preventDefault()

        var csrfToken = $('input[name=_token')[0]


        var frm = $('#domesticForm');
        var formData = new FormData(frm[0]);

        var frmvar = frm[0]


            $.ajax({
                type: 'post',
                cache:false,
                contentType: false,
                processData: false,

                url: "domestic-form",
                enctype: 'multipart/form-data',

                data:formData,
                success: function(response){
                    console.log("success")
                    $("#formFillSuccess").trigger("click")

                }
            })

})



