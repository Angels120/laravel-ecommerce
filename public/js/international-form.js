
jQuery( document ).ready(function( $ ) {
    $( function() {
        $( ".mydatepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
        });
    } );
});

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
            // console.log("get data")  
            // console.log(datapair)
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


        // change signature font

        function changeFontStyle1() {
            var selectFont1 = document.getElementById("selectFont1");
            var textFont1 = document.getElementById("textFont1");

            if (selectFont1.value == "Fasthand") {
                textFont1.style.fontFamily = 'Fasthand';
            } else if (selectFont1.value == "Allura") {
                textFont1.style.fontFamily = 'Allura';
            } else if (selectFont1.value == "Pinyon Script") {
                textFont1.style.fontFamily = 'Pinyon Script';
            } else if (selectFont1.value == "Great Vibes") {
                textFont1.style.fontFamily = 'Great Vibes';
            } else if (selectFont1.value == "Sacramento") {
                textFont1.style.fontFamily = 'Sacramento';
            }
            var selectSignaturethird = document.getElementById("selectFont1")

        }


        function changeFontStyle2() {
            var selectFont2 = document.getElementById("selectFont2");
            var textFont2 = document.getElementById("textFont2");

            if (selectFont2.value == "Fasthand") {
                textFont2.style.fontFamily = 'Fasthand';
            } else if (selectFont2.value == "Allura") {
                textFont2.style.fontFamily = 'Allura';
            } else if (selectFont2.value == "Pinyon Script") {
                textFont2.style.fontFamily = 'Pinyon Script';
            } else if (selectFont2.value == "Great Vibes") {
                textFont2.style.fontFamily = 'Great Vibes';
            } else if (selectFont2.value == "Sacramento") {
                textFont2.style.fontFamily = 'Sacramento';
            }
            var selectSignaturethird = document.getElementById("selectFont2")

        }



        function changeFontStyle3() {
            var selectFont3 = document.getElementById("selectFont3");
            var textFont3 = document.getElementById("textFont3");

            if (selectFont3.value == "Fasthand") {
                textFont3.style.fontFamily = 'Fasthand';
            } else if (selectFont3.value == "Allura") {
                textFont3.style.fontFamily = 'Allura';
            } else if (selectFont3.value == "Pinyon Script") {
                textFont3.style.fontFamily = 'Pinyon Script';
            } else if (selectFont3.value == "Great Vibes") {
                textFont3.style.fontFamily = 'Great Vibes';
            } else if (selectFont3.value == "Sacramento") {
                textFont3.style.fontFamily = 'Sacramento';
            }
            var selectSignaturethird = document.getElementById("selectFont3")

        }


var internationalForm = document.getElementById("internationalForm");

internationalForm.addEventListener('submit', (event) => {
  
        event.preventDefault()

        
        var csrfToken = $('input[name=_token')[0]
        

        var frm = $('#internationalForm');
        var formData = new FormData(frm[0]);
        
        var frmvar = frm[0]

        $.ajax({
            type: 'post',
            cache:false,
            contentType: false,
            processData: false,

            url: "international-form-submit",
            enctype: 'multipart/form-data',
            
            data:formData,
            success: function(response){
                console.log("success");
                $("#successModal").modal('show');
                internationalForm.reset();
            }
        })


        
    // });
})