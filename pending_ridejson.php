<?php
session_start();
include 'config.php';
extract($_POST);

if($data == 'pending'){
	$sql= "SELECT * FROM tbl_ride WHERE status=0 and cuser_id='{$_SESSION['userid']}'";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else if($data == 'completed'){
	$sql= "SELECT * FROM tbl_ride WHERE status=1 and cuser_id='{$_SESSION['userid']}'";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
elseif($data =='allrides'){
$sql= "SELECT * FROM tbl_ride WHERE cuser_id='{$_SESSION['userid']}'";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else{}
?>