<?php
include 'phpclass.php';
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registartion</title>
  <?php include 'boot.php'; ?>
  <link rel="stylesheet" type="text/css" href="anotherstyle.css">
</head>
<style>

 #mobileotp, #verifybtn, 
 #mobileotpbtn
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
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" >
    <a class="navbar-brand" href="user_module.php"><label class="logo" style="color: #D7DF23; cursor: pointer;"> Ced<i class="fa fa-car" style="color: white ;" aria-hidden="true"></i>Cab</label></a>
    <button class="navbar-toggler align-center" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse bg-dark " id="navbarNavDropdown">
      <ul class="navbar-nav ">
        <li class="nav-item active">
          <a class="nav-link text-white" href="user_module.php"><span class="txt">Home</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="bookride.php"><span class="txt">Book New Rides</span></a>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="txt">Account</span>
          </a>
          <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Change Password</a>
            <a class="dropdown-item" href="#">Edit Profile</a>
          </div>
        </li>
      </div>
      <div>
        <li class="nav-item dropdown user">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="txt">Hello <?php echo $_SESSION['username'] ?>!</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item " href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <?php
  $select_data= new database();
  $select_data->get_update_user($_SESSION['userid']);
  $data= $select_data->getResult();

  ?>
  <div class="div1 mt-2 mb-2 " >
    <h1>Update</h1><hr>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" disabled class="form-control" id="email" name="email" value="<?php echo $data['email'] ?>" aria-describedby="emailHelp" placeholder="Enter email"><br>
    </div>
    <div class="form-group">
      <label for="Mobile">Mobile</label>
      <input type="text" class="form-control" maxlength="10" id="mobile" value="<?php echo $data['mobile'] ?>" name="mobile" placeholder="Enter mobile(don't use country code)"><br>
      <input class="btn btn-danger" name="mobileotpbtn" id="mobileotpbtn" type="button" value="Get OTP" >
    </div>
    <div class="form-group">
      <input type="text" class="form-control" id="mobileotp" onkeypress="return isNumber(event)" maxlength="6" name="mobileotp" placeholder="enter otp" >
      <input class="btn btn-danger" name="verifybtn" id="verifybtn" type="button" value="Verify OTP">
    </div>
    <div class="form-group">
      <label for="exampleInputName">Name</label>
      <input type="text" class="form-control" value="<?php echo $data['name']; ?>"  id="name" name="name" placeholder="Enter name">
    </div>

    <button type="submit" disabled id="update" name="register" class="btn btn-warning btn-block">Update</button>
  </div>
  <div id="error_msg"></div>
  <div id="success_msg"></div>
  <?php include 'footer.php'; ?>
</body>

<script type="text/javascript">
  $(function(){

    $("#mobile").focusin(function(){
     $("#mobileotpbtn").show();
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
            $("#mobileotpbtn").hide();
            $("#success_msg").text("Otp send successfully").slideDown();
            $("#success_msg").delay(1000).slideUp(1000);
            
          }
          else{
           $("#error_msg").html(data).slideDown();
           $("#error_msg").delay(1000).slideUp(500);
         }
       }
     });
      }
    });

//mobile otp verify
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
      $("#mobile").css("border-color", "green");
      $("#mobileotp,#verifybtn").hide();
      $("#mobile").attr("disabled","disabled");
      $("#update").removeAttr("disabled");
    }
    else{
      $("#error_msg").text("Otp incorrect, pls enter correct otp").slideDown();
      $("#error_msg").delay(1000).slideUp(500);
    }
  }
});
 }
});

$("#update").on("click", function(){
  var email = $("#email").val();
  var name = $("#name").val();
  var mobile = $("#mobile").val();
  if (name == '') {
    $("#error_msg").text("Pls enter name!").slideDown();
    $("#error_msg").delay(1000).slideUp(500);
  }
  else{
    $.ajax({
      type: "POST",
      url: "updateuser.php",
      data: {name : name, mobile : mobile},
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