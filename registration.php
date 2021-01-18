<!DOCTYPE html>
<html>
<head>
	<title>Registartion</title>
	<?php include 'boot.php'; ?>
	<link rel="stylesheet" type="text/css" href="anotherstyle.css">
</head>
<style>

	#otpfield,#mobileotp, #verifybtn, 
	#emailotpbtn, #allform, #otpbtn, #mobileotpbtn
	{
		display: none;
	}

</style>
<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
</script>
<body>
	<?php include 'header.php'; ?>
	<div class="div1 mt-2 mb-2 " >
    <h1>Registartion</h1><hr>
    <input type="text" hidden name="date" id="date" value="<?php echo date("d-m-Y"); ?>">
    <input type="text" hidden name="status" id="status" value="1">
    <input type="text" hidden name="is_admin" id="is_admin" value="0">
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"><br>
      <input class="btn btn-danger" name="otpbtn" id="otpbtn" type="button" value="Get OTP">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="otpfield" onkeypress="return isNumber(event)" maxlength="6" name="otpfield"  placeholder="Enter otp..">
      <input class="btn btn-danger" name="emailotpbtn" id="emailotpbtn" type="button" value="Verify">
    </div>
    <div class="form-group">
      <label for="Mobile">Mobile</label>
      <input type="text" disabled class="form-control" maxlength="10" id="mobile" name="mobile" placeholder="Enter mobile(don't use country code)"><br>
      <input class="btn btn-danger" name="mobileotpbtn" id="mobileotpbtn" type="button" value="Get OTP" >
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="mobileotp" onkeypress="return isNumber(event)" maxlength="6" name="mobileotp" placeholder="enter otp" >
      <input class="btn btn-danger" name="verifybtn" id="verifybtn" type="button" value="Verify OTP">
    </div>
    <div class="form-group">
      <label for="exampleInputName">Name</label>
      <input type="text" disabled class="form-control" id="name" name="name" placeholder="Enter name">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" disabled class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirm Password</label>
      <input type="password" disabled class="form-control" id="cnfpassword" name="cnfpassword" placeholder="Password">
    </div>
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" disabled id="register" name="register" class="btn btn-warning btn-block">Register</button>
  </div>
  <div id="error_msg"></div>
  <div id="success_msg"></div>
  <?php include 'footer.php'; ?>
</body>

<script type="text/javascript">
	$(function(){
    $('ul li:last-child').remove();

    $("#email").focusin(function(){
     $("#otpbtn").show();
   });

    $("#mobile").focusin(function(){
     $("#mobileotpbtn").show();
   });

    //Email send otp
    $("#otpbtn").on("click",function(){
    	var email = $("#email").val();
    	var name= $("#name").val();
    	if (email == '') {
        $("#error_msg").text("Pls! Enter email").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else{
        $("#otpfield,#emailotpbtn").show();
        $("#otpbtn").hide();
        $.ajax({
         type: "POST",
         url: "mailer.php",
         data: {data: "get", email : email, name : name},
         success: function(data){
          if (data == 1) {
           $("#success_msg").text("Email send successfully").slideDown();
           $("#success_msg").delay(1000).slideUp(1000);
         }
         else if(data == 0) {
          $("#error_msg").text("Email not send, pls try again").slideDown();
          $("#error_msg").delay(1000).slideUp(500);
        }
      }
    });
      }
    });
    //Email verification
    $("#emailotpbtn").on("click", function(){
    	var emailotpfield = $("#otpfield").val();
    	if(emailotpfield == '')
    	{
    		$("#error_msg").text("Pls! Enter otp").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else{
        $.ajax({
         type: "POST",
         url: "mailer.php",
         data: {data:"verify" ,emailotpfield : emailotpfield},
         success: function(data)
         {
          if(data == 1)
          {
            $("#success_msg").text("Otp verified successfully").slideDown();
            $("#success_msg").delay(1000).slideUp(1000);
            $("#mobile").removeAttr("disabled");
            $("#email").css("border-color", "green");
            $("#otpfield,#emailotpbtn ").hide();
            $("#email").attr("disabled","disabled");
          }
          else{
           $("#error_msg").text("Otp incorrect, pls enter correct otp").slideDown();
           $("#error_msg").delay(1000).slideUp(500);
         }
       }
     });
      }
    });

    //mobile otp ajax
    $("#mobileotpbtn").on("click",function(){
    	var number = $("#mobile").val();
    	if(number == '')
    	{
    		$("#error_msg").text("Pls! Enter mobile number").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else{
        $("#mobileotp, #verifybtn").show();
        $.ajax({
         type: "POST",
         url: "mobilever.php",
         data: {data:"get" ,number : number},
         success: function(data)
         {
          if (data == 1) {
           $("#success_msg").text("Otp send successfully").slideDown();
           $("#success_msg").delay(1000).slideUp(1000);
           $("#mobileotpbtn").hide();
         }
         else{
           $("#error_msg").html(data).slideDown();
           $("#error_msg").delay(1000).slideUp(500);
         }
       }
     });
      }
    });


    $("#verifybtn").on("click",function(){
    	var mobileotpfield= $('#mobileotp').val();
      if(mobileotpfield == '')
      {
        $("#error_msg").text("Pls! Enter otp").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else{
       $.ajax({
        type: "POST",
        url: "mobilever.php",
        data: {data:"verify" ,mobileotpfield : mobileotpfield},
        success: function(data)
        {
         if(data == 1)
         {
          $("#success_msg").text("Otp verified successfully").slideDown();
          $("#success_msg").delay(1000).slideUp(1000);
          $("#name, #password, #cnfpassword, #register").removeAttr("disabled");
          $("#mobile").css("border-color", "green");
          $("#mobileotp,#verifybtn").hide();
          $("#allform").show();
          $("#mobile").attr("disabled","disabled");
        }
        else{
          $("#error_msg").text("Otp incorrect, pls enter correct otp").slideDown();
          $("#error_msg").delay(1000).slideUp(500);
        }
      }
    });
     }
   });

    $("#register").on("click", function(){
      var email = $("#email").val();
      var name = $("#name").val();
      var mobile = $("#mobile").val();
      var password= $("#password").val();
      var cnfpassword= $("#cnfpassword").val();
      var date= $("#date").val();
      var status= $("#status").val();
      var is_admin= $("#is_admin").val();

      if (name == '') {
        $("#error_msg").text("Pls enter name!").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else if(password == '')
      {
        $("#error_msg").text("Pls enter password").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else if(cnfpassword == '')
      {
        $("#error_msg").text("Otp incorrect, pls enter correct otp").slideDown();
        $("#error_msg").delay(1000).slideUp(500);
      }
      else{
        $.ajax({
          type: "POST",
          url: "registrationform.php",
          data: {email : email, name : name, mobile : mobile, password : password, date : date, status : status, is_admin : is_admin, cnfpassword : cnfpassword},
          success: function(data)
          {
            $("#success_msg").html(data).slideDown();
            $("#success_msg").delay(1000).slideUp(1000);
          }
        });
      }
    });
  });
</script>
</html>