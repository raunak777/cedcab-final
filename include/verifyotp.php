<?php

session_start();

extract($_POST);

$otpfield= $_POST['otpfield'];

if ($otpfield != $_SESSION['otp']) {
	echo "Otp incorrect";
}
else{
	echo "Otp correct";
}
?>