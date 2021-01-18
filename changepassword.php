<?php
include 'phpclass.php';
session_start();
if(!isset($_SESSION['username']))
{
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="anotherstyle.css">
    <?php include 'boot.php'; ?>
    <?php include 'config.php'; ?>
    <style type="text/css">
        .footer{
            margin-top: 3%;
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
    $data= new database();
    $data->get_update_user($_SESSION['userid']);
    $newd =$data->getResult();
    ?>
    <div class="div1" style="margin-top: 5%;">
        <h1>Change Password</h1><hr>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="register">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="Email" class="form-control" name="username" readonly value="<?php echo $newd['email']; ?>"  placeholder="username.." required>

            </div>
            <div class="form-group">
                <label for="name">Old Password</label>
                <input type="password" class="form-control" name="txtpassword"  placeholder="password" required>
            </div>
            <div class="form-group">
                <label for="name">New Password</label>
                <input type="password" class="form-control" name="newpassword"  placeholder="New password" required>
            </div>
            <div class="form-group">
                <label for="name">Confirm Password</label>
                <input type="password" class="form-control" name="cnfpassword"  placeholder="Confirm password" required>
            </div>
            <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
        $email = $_POST['username'];
        $oldpassword = $_POST['txtpassword'];
        $newpassword = $_POST['newpassword'];
        $cnfpassword = $_POST['cnfpassword'];

        $encryptpass=password_hash($newpassword, PASSWORD_BCRYPT);
        $query_email="select * from registration where email='$email'";
        $res= $conn->query($query_email);
        if($res->num_rows>0){
            $data= $res->fetch_assoc();
            $dbpass = $data['password'];
            $pass_check = password_verify($oldpassword, $dbpass);
            if ($pass_check) {
                echo "<script> alert('Password true!') </script>";
                if($newpassword == $cnfpassword)
                {
                    $sql="UPDATE registration SET password='$encryptpass' where email='$email'";
                    $out= $conn->query($sql);
                    if ($out) {
                       echo "<script> alert('New Password Update!') </script>";
                   }
                   else{
                    echo "<script> alert('New Password not Update!') </script>";
                }
            }
            else{
                echo "<script> alert('New Password and Confirm Password not matched!') </script>";
            }
        }
        else{
            echo "<script> alert('Old Password wrong!') </script>";
        }
    }
    else{
        echo "<script> alert('Email not registered!');</script>";
    }

}
?>
<?php include 'footer.php'; ?>
</body>
</html>