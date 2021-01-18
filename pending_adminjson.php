<?php
include 'config.php';
extract($_POST);
if($data=='pending'){
$sql= "SELECT * FROM tbl_ride WHERE status=0";
$res = $conn->query($sql) or die("Query failed");
$output = $res->fetch_all(MYSQLI_ASSOC);
echo json_encode($output);
}
else if($data == 'completed'){
	$sql= "SELECT * FROM tbl_ride WHERE status=1";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else if($data == 'canceled'){
	$sql= "SELECT * FROM tbl_ride WHERE status=2";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else if ($data=='allrides') {
	$sql= "SELECT * FROM tbl_ride";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else if ($data=='allusers') {
	$sql= "SELECT * FROM registration WHERE is_admin=0";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
else if ($data=='location') {
	$sql= "SELECT * FROM tbl_location WHERE is_available=1";
	$res = $conn->query($sql) or die("Query failed");
	$output = $res->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}
?>