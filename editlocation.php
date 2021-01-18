<?php
session_start();
if(!isset($_SESSION['username']))
{
	header('location: index.php');
}
include 'phpclass.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Location</title>
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
<?php
$db= new database();
$db->get_location_data($_GET['id']);
$data=$db->getResult();
?>
<div class="div1" style="margin-top: 5%;">
	<h1>Location Add</h1><hr>
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="register">
		<input type="text" name="id"  value="<?php echo $data['id']?>" />
		<div class="form-group">
			<label for="location">Location Name</label>
			<input type="text" class="form-control" value="<?php echo $data['name']; ?>" name="location"  placeholder="location name.." required>
		</div>
		<div class="form-group">
			<label for="name">Distance</label>
			<input type="text" class="form-control" value="<?php echo $data['distance']; ?>" name="distance"  placeholder="distance" required>
		</div>
		<div class="form-group">
			<label class="radio-inline"><input type="radio" name="optradio" value="1" <?php if($data['is_available'] == '1') {echo "checked";}?> > Servicable</label>
			<label class="radio-inline"><input type="radio" name="optradio" value="0" <?php if($data['is_available'] == '0') {echo "checked";}?> > Not Servicable</label>
		</div>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	</form>
</div>
</body>
</html>
<?php 
if (isset($_POST['submit'])) {
	extract($_POST);

	$update="UPDATE tbl_location SET name='{$location}', distance='{$distance}', is_available='{$optradio}'  WHERE id= '{$id}'";
	$qu = $conn->query($update);
	if ($qu) {
		echo "<script>alert('Data update successfull');</script>";
		echo "<script> location.replace('admin_module.php'); </script>";
	}
	else{
		echo "<script>alert('Data not update');</script>";
	}

}
?>