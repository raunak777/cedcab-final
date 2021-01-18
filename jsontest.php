<?php
include 'config.php';
$sql= "SELECT * FROM tbl_ride WHERE status=0";
$res = $conn->query($sql) or die("Query failed");
$output = $res->fetch_all(MYSQLI_ASSOC);
echo json_encode($output);
?>