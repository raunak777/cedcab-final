<?php
include 'phpclass.php';
extract($_POST);
$dbase = new database();

if ($_POST['password'] === $_POST['cnfpassword']) {
		unset($_POST['cnfpassword']);
		$_POST['password']= trim(password_hash($_POST['password'], PASSWORD_BCRYPT));
		//print_r($_POST);
		$dbase->insertdata($_POST);
		echo "Insert result is: ";
		print_r($dbase->getResult());
	}
	else{
		echo "Password and Confirm password not match";
	}
?>