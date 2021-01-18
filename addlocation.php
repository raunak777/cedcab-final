<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Location</title>
	<link rel="stylesheet" type="text/css" href="anotherstyle.css">
	<?php include 'boot.php'; ?>
	<?php include 'config.php'; ?>
</head>
<style type="text/css">
	.footer{
		margin-top: 7%;
	}
</style>
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
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
	<div class="div1" style="margin-top: 5%;">
		<h1>Location Add</h1><hr>
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="register">
			<div class="form-group">
				<label for="location">Location Name</label>
				<input type="text" class="form-control" name="location"  placeholder="location name.." required>
			</div>
			<div class="form-group">
				<label for="name">Distance</label>
				<input type="text" class="form-control" name="distance"  placeholder="distance" required>

			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
	<?php
	if (isset($_POST['submit'])) {
		$locationname= $_POST['location'];
		$distance = $_POST['distance'];

		$sql="INSERT INTO tbl_location (name, distance, is_available) VALUES ('$locationname','$distance',1)";
		$res= $conn->query($sql);
		if ($res) {
			echo "<script>alert('Data inserted');</script>";
		}
		else{
			echo "<script>alert('Data not inserted');</script>";
		}
	}
	?>
	<?php include 'footer.php'; ?>
</body>
</html>