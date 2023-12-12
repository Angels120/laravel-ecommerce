


var bkEmailCode=document.getElementById("bkEmailCode");
bkEmailCode.addEventListener('click',(event)=>{
    event.preventDefault();
var currUsername = localStorage.getItem("currUsername");


    $.ajax({
        method: 'POST',
        url: 'sent-recovery-code',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            // "_token": "{{ csrf_token() }}",
            'method': 'backup_mail',
            'username': currUsername
        },
        success: function(data) {
            localStorage.removeItem("currUsername");
            if(data.message){
                window.location.replace(`${BASE_URL}/two-factor-recovery`);

            }
            else{
                window.location.replace(`${BASE_URL}/login`);


            }
        }

    }
)

});

