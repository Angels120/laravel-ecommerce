Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(function(e){Array.from(e.querySelectorAll(".password-addon")).forEach(function(r){r.addEventListener("click",function(r){var o=e.querySelector(".password-input");"password"===o.type?o.type="text":o.type="password"})})});



// validate username


var continueBtn = document.getElementById('userNameRetrive');
var backBtn = document.getElementById("go-back");

continueBtn.addEventListener('click',(event)=>{
event.preventDefault();
var username= document.getElementById('username')
$("#loaderBtn").removeClass("d-none")
$("#userNameRetrive").addClass("d-none")
  $.ajax({
  method : 'POST',
  url : 'find-username',
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  data: {
        "username": username.value,
      },
    success: function(data){
    
      if(data.username){
        $("#username").removeClass("is-invalid")
        $(".username-input").attr("readonly", true)
        $(".password-content").removeClass("d-none")
        $(".policy-content").removeClass("d-none")
        $("#userNameRetrive").hide()
        $(".login-action-content").removeClass("d-none")
        $(".forgot-username-div").hide()
      }else{
        $("#username").addClass("is-invalid")
        $(".forgot-username-div").show()
        if(username.value == ""){
          $(".username-invalid-feedback").text("Username is required.")
        }else{
          $(".username-invalid-feedback").text("Invalid username.")
        }
      }
    }
  }).done(function(){
    $("#loaderBtn").addClass("d-none")
    $("#userNameRetrive").removeClass("d-none")
  })
})



backBtn.addEventListener('click',(event)=>{
  document.getElementById("loginForm").reset();
  $(".password-content").addClass("d-none")
  $(".policy-content").addClass("d-none")
  $(".forgot-username-div").show()
  $("#userNameRetrive").show()
  $(".login-action-content").addClass("d-none")
  $(".username-input").attr("readonly", false)

})





