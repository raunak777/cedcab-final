<?php
include 'phpclass.php';
session_start();
if(!isset($_SESSION['username']))
{
  header('location: login.php');
}
else if($_SESSION['isadmin']==0){
}
else{
  header('location: login.php');
}
?>
<html>
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'boot.php'; ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" type="text/css" href="anotherstyle.css">
  <style type="text/css">
    .footer{
      margin-top: 12%;
    }
    #loaddata,#pendingdata, #completeddata, #allrides, #cancelrides,
    #data,#pend,#comp,#aride,#cride{
      display: none;
    }

  </style>
</head>
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="txt">Rides</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item pending"  href="#">Pending Rides</a>
            <a class="dropdown-item completed" href="#">Completed Rides</a>
            <a class="dropdown-item canceled" href="#">Canceled Rides</a>
            <a class="dropdown-item allrides" href="#">All Rides</a>
          </div>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="txt">Account</span>
          </a>
          <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="changepassword.php">Change Password</a>
            <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
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
  $dbase = new database();
  $dbase->pending_ride_users(0,$_SESSION['userid']);
  $pending =($dbase->getResult());

  $dbase->pending_ride_users(1,$_SESSION['userid']);
  $complete =($dbase->getResult());

  $dbase->all_ride_fare_users($_SESSION['userid']);
  $allride_fare= ($dbase->getResult());
  ?>
  <section class= "mt-3">
    <div class="container-fluid">
      <div class="row">
        
        <div class="card text-center">
          <p class="pt-2">Completed Rides</p>
          <p><?php echo $complete['count(status)']; ?></p>
          <a href="#"  class="btn btn-outline-primary completed">Compeleted Rides</a>
        </div>
        <div class="card text-center">
          <p class="pt-2">Pending Rides</p>
          <p><?php echo $pending['count(status)']; ?></p>
          <a href="#"  class="btn btn-outline-primary pending">Pending Rides</a>
        </div>
        <div class="card text-center">
          <p class="pt-2">All Rides</p>
          <p><?php echo $allride_fare['count(status)']; ?></p>
          <a href="#" class="btn btn-outline-primary allrides">All Rides</a>
        </div>
        <div class="card text-center">
          <p class="pt-2">Total Expenses</p>
          <p><?php echo $allride_fare['sum(total_fare)']; ?></p>
          <a href="#" class="btn btn-outline-primary allexpenses">All Expenses</a>
        </div>

      </div>
    </div>
  </section>
  <section class="container-fluid mt-5"id="data" >
      <h2>Pending Ride</h2>
    <table id="dataload" border="2px" cellpadding="10px" width="100%">
      
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </table>
  </section>
<section class="container-fluid mt-5"id="pend" >
      <h2>Pending Ride</h2>
    <table id="pendingdata" border="2px" cellpadding="10px" width="100%">
      
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </table>
  </section>
  <section class="container-fluid mt-5"id="comp">
       <h2>Complete Ride</h2>
    <table id="completeddata" border="2px" cellpadding="10px" width="100%">
      
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
        <th>Status</th>
      </tr>
    </table>
  </section>
  <section class="container-fluid mt-5"id="aride">
      <h2>All Ride</h2>
    <table id="allrides" border="2px" cellpadding="10px" width="100%">
     
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
      </tr>
    </table>
  </section>
  <section class="container-fluid mt-5"id="cride">
      <h2>Cancel Ride</h2>
    <table id="cancelrides" border="2px" cellpadding="10px" width="100%">
       
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
      </tr>
    </table>
  </section>
  <section class="footer">
    <div class="container-fluid">
      <div class="row" style="text-align: center; background-color:#474645; padding:0px;">
        <div class="col-sm" style="font-size: 30px;color:white;">
          <i class="fa fa-facebook" aria-hidden="true"></i>
          <i class="fa fa-google-plus" aria-hidden="true"></i>
          <i class="fa fa-youtube-play" aria-hidden="true"></i>
          <i class="fa fa-twitter" aria-hidden="true"></i>
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </div>

        <div class="col-sm">
          <h2 style="color: #D7DF23 ;font-weight:700;">Ced<i class="fa fa-car" style="color: white ;" aria-hidden="true"></i>Cab</span></h2><br>
        </div>

        <div class="col-sm ">
          <div class="container">
            <div class="row">
              <div class="col-sm fo">
                <a href="#" style="color: white;"> About Us</a>
              </div>
              <div class="col-sm fo">
                <a href="#" style="color: white;"> Contact Us</a>
              </div>
              <div class="col-sm fo">
                <a href="#" style="color: white;">Disclaimer</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  
  if (isset($_COOKIE['pickup'])) {

    $sql = "INSERT INTO tbl_ride(ride_date, pickup, todrop, total_distance, luggage, total_fare, status, cuser_id, cab_type) VALUES (CURDATE(),'{$_COOKIE['pickup']}' ,'{$_COOKIE['drop']}','{$_COOKIE['distance']}', '{$_COOKIE['weight']}','{$_COOKIE['fare']}',0,'{$_COOKIE['userid']}', '{$_COOKIE['cabtype']}')";
    $dbase->datainsert($sql);
  }
  else{}
    ?>
  <script type="text/javascript">
    var count=0;
    $(function(){
      $.ajax({
        type: "POST",
        url: "pending_ridejson.php",
        dataType: "JSON",
        data:{data : 'pending'},
        success: function(data)
        {
          $("#dataload,#data").show();
          $.each(data, function(key, value) {
            if (value.status==0) {
              value.status="pending";
            }
            $("#dataload").append("<tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td><td><button class='can-btn btn btn-danger' data-cid="+ value.ride_id +">Cancel</button></td>");
          });
        }
      });

      $(".pending").one("click", function(){
        $.ajax({
          type: "POST",
          url: "pending_ridejson.php",
          dataType: "JSON",
          data:{data : 'pending'},
          success: function(data)
          {
            $("#allrides,#data,#comp,#aride,#cride").hide();
            $("#dataload").hide();
            $("#cancelrides").hide();
            $("#pendingdata,#pend").show();
            $("#completeddata").hide();
            $.each(data, function(key, value) {
              if (value.status==0) {
                value.status="pending";
              }
              
              $("#pendingdata").append("<tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td><td><button class='can-btn btn btn-danger' data-cid="+ value.ride_id +">Cancel</button></td></tr>");
            });
          }
        });
      });

      $(".completed").one("click", function(){
        
        $.ajax({
          type: "POST",
          url: "pending_ridejson.php",
          dataType: "JSON",
          data:{data : 'completed'},
          success: function(data)
          {
            $("#cancelrides,#data,#pend,#aride,#cride").hide();
            $("#allrides").hide();
            $("#dataload").hide();
            $("#pendingdata").hide();
            $("#completeddata,#comp").show();
            $.each(data, function(key, value) {
              if (value.status==1) {
                value.status="Ride completed";
              }
              
              $("#completeddata").append("<tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td></tr>");
            });
          }
        });
      });

      $(".allrides").one("click", function(){
       
        $.ajax({
          type: "POST",
          url: "allrides.php",
          dataType: "JSON",
          data: {data : 'allrides'},
          success: function(data)
          {
            $("#allrides,#aride").show();
            $("#cancelrides,#data,#pend,#comp,#cride").hide();
            $("#dataload").hide();
            $("#pendingdata").hide();
            $("#completeddata").hide();
            $.each(data, function(key, value) {
              $("#allrides").append("<tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td>");
            });
          }
        });
      });

      $(".canceled").one("click", function(){
        $.ajax({
          type: "POST",
          url: "allrides.php",
          dataType: "JSON",
          data: {data : 'canceled'},
          success: function(data)
          {
            $("#cancelrides,#cride").show();
            $("#allrides,#data,#pend,#comp,#aride").hide();
            $("#dataload").hide();
            $("#pendingdata").hide();
            $("#completeddata").hide();
            $.each(data, function(key, value) {
              $("#cancelrides").append("<tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td>");
            });
          }
        });
      });
      $(".allexpenses").click(function(){
        location.reload();
      });
        
      
      $(document).on("click","#dataload button", function(){
        if (confirm("Do you really want to cancel ride?")) {
          var currentid= $(this).data("cid");
          alert(currentid);
          $.ajax({
            type: "POST",
            url: "handle_button.php",
            data:{data : "cancel", currentid : currentid },
            success: function(data){
              if (data==1) {
                alert("Ride Cancel successfully");
                location.reload();
              }
              else{
                alert("Ride not cancel!");
              }
            }
          });
        }
      });

    });
  </script>
</body>
</html>