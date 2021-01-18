<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
    <?php include 'header.php'; ?>
    <div class="div1" style="margin-top: 5%;">
        <h1>Login</h1><hr>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="register">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="Email" class="form-control" name="username"  placeholder="username.." required>

            </div>

            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" class="form-control" name="txtpassword"  placeholder="password" required>

            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-primary">
        </form>
    </div>
    <script type="text/javascript">
        $(function(){
            $('ul li:nth-child(2)').remove();
        });
    </script>
    <?php
    if(isset($_POST['submit'])){
        $email = $_POST['username'];
        $password = $_POST['txtpassword'];
        $query_email="select * from registration where email='$email'";
        $res= $conn->query($query_email);
        if($res->num_rows>0){
            $data= $res->fetch_assoc();
            $dbpass = $data['password'];
            $is_admin = $data['is_admin'];
            $status = $data['status'];
            $user_id = $data['user_id'];
            setcookie("userid", $user_id);
            $_SESSION['username']= $data['name'];
            $_SESSION['isadmin']=$is_admin;
            $_SESSION['userid']= $data['user_id'];
            $pass_check = password_verify($password, $dbpass);
            if ($pass_check) {
                if ($is_admin == '1') {
                    echo "<script> alert('Login successful') 
                    location.replace('admin_module.php');
                    </script>";
                }
                elseif ($is_admin == '0') {
                    if ($status == '1') {
                        echo "<script> alert('Login successful') 
                        location.replace('user_module.php');
                        </script>";
                    }
                    else{
                        echo "<script> alert('Your account is blocked!'); </script>";
                    }

                }

            }
            else{
                echo "<script> alert('Password wrong!') </script>";
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