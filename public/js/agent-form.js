


jQuery( document ).ready(function( $ ) {
    $( function() {
        $( ".mydatepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
        });
    } );
});


// Agent Signature

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

}



var agentForm = document.getElementById("agentForm");

agentForm.addEventListener('submit', (event) => {
  

        event.preventDefault()

        
        var csrfToken = $('input[name=_token')[0]
        

        var frm = $('#agentForm');
        var formData = new FormData(frm[0]);
        
        var frmvar = frm[0]

        $.ajax({
            type: 'post',
            cache:false,
            contentType: false,
            processData: false,

            url: "store-agent-form",
            enctype: 'multipart/form-data',
            
            data:formData,
            success: function(response){
                // console.log("success")
                $("#successModal").modal('show');
                agentForm.reset();
            }
        })


        
    // });
})