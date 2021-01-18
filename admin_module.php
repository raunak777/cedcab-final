<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: login.php');
}
else if($_SESSION['isadmin']==1){
}
else{
  header('location: login.php');
}
include 'phpclass.php';
?>
<html>
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'boot.php'; ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="anotherstyle.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <style type="text/css">
    .footer{
      margin-top: 15%;
    }
    #dataload,#pendingdata, #completeddata, #allrides, #cancelrides, #allusers, #alllocation,#pend,#comp,#aride,#cride,#auser,#aloc{
      display: none;
    }

  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark" >
    <a class="navbar-brand" href="admin_module.php"><label class="logo" style="color: #D7DF23; cursor: pointer;"> Ced<i class="fa fa-car" style="color: white ;" aria-hidden="true"></i>Cab</label></a>
    <button class="navbar-toggler align-center" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse bg-dark " id="navbarNavDropdown">
      <ul class="navbar-nav ">
        <li class="nav-item active">
          <a class="nav-link text-white" href="admin_module.php"><span class="txt">Home</span></a>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="txt">Rides</span>
          </a>
          <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item pending" href="#">Ride Requests</a>
            <a class="dropdown-item completed" href="#">Complete Rides</a>
            <a class="dropdown-item canceled" href="#">Canceled Rides</a>
            <a class="dropdown-item allrides" href="#">All Rides</a>
          </div>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="txt">Users</span>
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item allusers" href="#">All Users</a>
            </div>

            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="txt">Location</span>
              </a>
              <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item alllocation" href="#">Location List</a>
                <a class="dropdown-item" href="addlocation.php">Add New Location</a>
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
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <?php 
    $dbase = new database();
    $dbase->pending_ride_admin(0);
    $pending =($dbase->getResult());
    $dbase->pending_ride_admin(1);
    $complete =($dbase->getResult());
    $dbase->pending_ride_admin(2);
    $cancel =($dbase->getResult());
    $dbase->total_ride_admin();
    $totalride =($dbase->getResult());
    $dbase->all_user();
    $alluser =($dbase->getResult());
    $dbase->service_location();
    $location =($dbase->getResult());
    ?>
    <section class= "mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="card text-center">
            <p class="pt-2">Ride Requests</p>
            <p><?php echo $pending['count(status)'] ?></p>
            <a href="#" class="btn btn-outline-primary pending">Ride Requests</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">Compeleted Rides</p>
            <p><?php echo $complete['count(status)']; ?></p>
            <a href="#" class="btn btn-outline-primary completed">Compeleted Rides</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">Canceled Rides</p>
            <p><?php echo $cancel['count(status)']; ?></p>
            <a href="#" class="btn btn-outline-primary canceled">Canceled Rides</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">All Rides</p>
            <p><?php echo $totalride['count(*)']; ?></p>
            <a href="#" class="btn btn-outline-primary allrides">All Rides</a>
          </div>
          
          <div class="card text-center">
            <p class="pt-2">All Users</p>
            <p><?php echo $alluser['count(*)']; ?></p>
            <a href="#" class="btn btn-outline-primary allusers">All Users</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">Serviceable Locations</p>
            <p><?php echo $location['count(*)']; ?></p>
            <a href="#" class="btn btn-outline-primary alllocation">Serviceable Locations</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">Upcomming</p>
            <p>0</p>
            <a href="#" class="btn btn-outline-primary">Upcomming</a>
          </div>
          <div class="card text-center">
            <p class="pt-2">Upcomming</p>
            <p>0</p>
            <a href="#" class="btn btn-outline-primary">Upcomming</a>
          </div>
        </div>
      </div>
    </section>
    <section class="container-fluid mt-5" id="data" >
      <h2>Pending Ride</h2>
      <table id="dataload" border="2px" cellpadding="10px" width="100%">
        <thead>
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
        </thead>
      </table>
    </section>
    <section class="container-fluid mt-5" id="pend">
     <h2>Pending Ride</h2>
     <table id="pendingdata" border="2px" cellpadding="10px" width="100%">
      <thead>
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
      </thead>
    </table>
  </section>
  <section class="container-fluid mt-5" id="comp">
   <h2>Complete Ride</h2>
   <table id="completeddata" border="2px" cellpadding="10px" width="100%">
    <thead>
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
    </thead>
  </table>
</section>
<section class="container-fluid mt-5" id="aride">
  <h2>All Ride</h2>
  <table id="allrides" border="2px" cellpadding="10px" width="100%">
    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
      </tr>
    </thead>
  </table>
</section>
<section class="container-fluid mt-5" id="cride">
  <h2>Cancel Ride</h2>
  <table id="cancelrides" border="2px" cellpadding="10px" width="100%">
    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CabType</th>
        <th>Ride Date</th>
        <th>Total Distance(KM)</th>
        <th>Luggage(KG)</th>
        <th>Total Fare(₹)</th>
      </tr>
    </thead>
  </table>
</section>
<section class="container-fluid mt-5" id="auser">
  <h2>All users</h2>
  <table id="allusers" border="2px" cellpadding="10px" width="100%">
    <thead>
      <tr>
        <th>Username</th>
        <th>Name</th>
        <th>Date of signup</th>
        <th>Mobile</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</section>
<section class="container-fluid mt-5" id="aloc">
  <h2>All Location</h2>
  <table id="alllocation" border="2px" cellpadding="10px" width="100%">
    <thead>
      <tr>
        <th>Location Name</th>
        <th>Distance</th>
        <th>Availability</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</section>
<script type="text/javascript">
  $(function(){
    $.ajax({
      type: "POST",
      url: "pending_adminjson.php",
      dataType: "JSON",
      data: {data: 'pending'},
      success: function(data)
      {
        $("#dataload").show();
        $.each(data, function(key, value) {
          if (value.status==0) {
            value.status="pending";
          }
          $("#dataload").append("<tbody><tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td><td><button class='can-btn btn btn-outline-danger' data-cid="+ value.ride_id +">Reject</button> <button class='ac-btn btn btn-outline-success' data-aid="+ value.ride_id +">Accept</button></td></tr></tbody>");
          $("#dataload").dataTable();
        });
      }
    });
    $(".pending").on("click",function(){
      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data: {data: 'pending'},
        success: function(data)
        {
          $("#allusers,#data,#comp,#aride,#cride,#auser,#aloc").hide();
          $("#allrides").hide();
          $("#dataload").hide();
          $("#cancelrides").hide();
          $("#pendingdata,#pend").show();
          $("#completeddata").hide();
          $.each(data, function(key, value) {


            if (value.status==0) {
              value.status="pending";
            }
            $("#pendingdata").append("<tbody><tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td><td><button class='can-btn btn btn-outline-danger' data-cid="+ value.ride_id +">Reject</button> <button class='ac-btn btn btn-outline-success' data-aid="+ value.ride_id +">Accept</button></td></tr></tbody>");
            $("#pendingdata").dataTable();
          });
        }
      });
    });

    $(".completed").one("click", function(){

      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data:{data : 'completed'},
        success: function(data)
        {
          $("#allusers,#data,#pend,#aride,#cride,#auser,#aloc").hide();
          $("#cancelrides").hide();
          $("#allrides").hide();
          $("#dataload").hide();
          $("#pendingdata").hide();
          $("#completeddata,#comp").show();
          $.each(data, function(key, value) {
            if (value.status==1) {
              value.status="Ride completed";
            }

            $("#completeddata").append("<tbody><tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td><td>"+ value.status +"</td></tr></tbody>");
            $("#completeddata").dataTable();
          });
        }
      });
    });
    $(".allrides").one("click", function(){

      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data: {data : 'allrides'},
        success: function(data)
        {
          $("#allusers,#pend,#data,#comp,#cride,#auser,#aloc").hide();
          $("#allrides,#aride").show();
          $("#cancelrides").hide();
          $("#dataload").hide();
          $("#pendingdata").hide();
          $("#completeddata").hide();
          $.each(data, function(key, value) {
            $("#allrides").append("<tbody><tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td></tr></tbody>");
            $("#allrides").dataTable();

          });
        }
      });
    });
    $(".canceled").one("click", function(){
      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data: {data : 'canceled'},
        success: function(data)
        {
          $("#allusers,#pend,#data,#comp,#aride,#auser,#aloc").hide();
          $("#cancelrides,#cride").show();
          $("#allrides").hide();
          $("#dataload").hide();
          $("#pendingdata").hide();
          $("#completeddata").hide();
          $.each(data, function(key, value) {
            $("#cancelrides").append("<tbody><tr><td>"+value.pickup+"</td><td>"+value.todrop+"</td><td>"+ value.cab_type +"</td><td>"+value.ride_date+"</td><td>"+ value.total_distance+"</td><td>"+ value.luggage +"</td><td>"+ value.total_fare + "</td></tr></tbody>");


          });
        }
      });
    });

    $(".allusers").on("click", function(){
      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data: {data : 'allusers'},
        success: function(data)
        {

          $("#allusers,#auser").show();
          $("#cancelrides,#pend,#data,#comp,#aride,#cride,#aloc").hide();
          $("#allrides").hide();
          $("#dataload").hide();
          $("#pendingdata").hide();
          $("#completeddata").hide();
          $.each(data, function(key, value) {
            $("#allusers").append("<tbody><tr><td>"+value.email+"</td><td>"+value.name+"</td><td>"+ value.date +"</td><td>"+value.mobile+"</td><td><button class='block btn btn-danger' data-blid="+ value.user_id+">Block</button> <button class='unblock btn btn-success' data-ublid="+ value.user_id+">Unblock</button></td></tr></tbody>");

          });
        }
      });
    });

    $(".alllocation").on("click", function(){
      $.ajax({
        type: "POST",
        url: "pending_adminjson.php",
        dataType: "JSON",
        data: {data : 'location'},
        success: function(data)
        {
          $("#alllocation,#aloc").show();
          $("#allusers, #pend,#data,#comp,#aride,#cride,#auser").hide();
          $("#cancelrides").hide();
          $("#allrides").hide();
          $("#dataload").hide();
          $("#pendingdata").hide();
          $("#completeddata").hide();
          $.each(data, function(key, value) {
            if (value.is_available==1) {
              value.is_available='Available';
            }
            else{
              value.is_available='Not Available';
            }
            $("#alllocation").append("<tbody><tr><td>"+value.name+"</td><td>"+value.distance+"</td><td>"+ value.is_available +"</td><td><button class='lc-ebtn btn btn-danger' data-edid="+ value.id+">Edit</button> <button class='btn btn-success lc-del' data-delid="+ value.id+">Delete</button></td></tr></tbody>");

          });
        }
      });
    });
        //action button on pending rides
        $(document).on("click","#dataload .can-btn", function(){
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

        $(document).on("click", "#dataload .ac-btn", function(){
          var currentid= $(this).data("aid");
          alert(currentid);
          $.ajax({
            type: "POST",
            url: "handle_button.php",
            data:{data : "accept", currentid : currentid },
            success: function(data){
              if (data==1) {
                alert("Ride Confirm");
                location.reload();
              }
              else{
                alert("Ride not confirm!");
              }
            }
          });
        });
        //block button
        $(document).on("click","#allusers .block",function(){
          var currentid= $(this).data("blid");
          alert(currentid);
          $.ajax({
            type:"POST",
            url: "delete.php",
            data: { data: 'block', currentid : currentid},
            success: function(data){
              if (data == 1) {
                alert("User Block");
              }
              else{
                alert("User not block");
              }
            }
          });
        });
        //unblock button
        $(document).on("click","#allusers .unblock",function(){
          var currentid= $(this).data("ublid");
          alert(currentid);
          $.ajax({
            type:"POST",
            url: "delete.php",
            data: { data: 'unblock', currentid : currentid},
            success: function(data){
              if (data == 1) {
                alert("User Unblock");
              }
              else{
                alert("User not unblock");
              }
            }
          });
        });
        //location edit btn
        $(document).on("click","#alllocation .lc-ebtn",function(){
          var currentid= $(this).data("edid");
          alert(currentid);
          location.replace("editlocation.php?id="+currentid);
        });
         //location delete btn
         $(document).on("click","#alllocation .lc-del",function(){
          var currentid= $(this).data("delid");
          alert(currentid);
          $.ajax({
            type:"POST",
            url: "delete.php",
            data: { data: 'del', currentid : currentid},
            success: function(data){
              if (data == 1) {
                alert("Data deleted");
              }
              else{
                alert("Data not deleted");
              }
            }
          });
        });
       });
     </script>
     <!--  <?php include 'footer.php'; ?> -->
   </body>
   </html>