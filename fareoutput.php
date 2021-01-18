
<?php
session_start();
extract($_POST);
include 'phpclass.php';
include 'config.php';
$address = array("Charbagh"=> 0, "IndiraNagar" => 10, "BBD"=> 30, "Barabanki"=> 60, "Faizabad" => 100, "Basti"=> 150, "Gorakhpur"=>210);

// $query= "select name, distance from tbl_location";
// $res= $conn->query($query) or die("Unsuccessfull Query");
// print_r($res);
	// $farecal-> selectsql($query);
	// // echo "<pre>";
		// // print_r($farecal->getResult());
	// // echo "</pre>";
	// $address= $farecal->getSelect();
	// print_r($address);

$farecal = new database();
$distt= abs($address[$pickup] - $address[$drop]);
$totalfare = 0;
if($cabtype == "CedMicro")
{
	$totalfare = $farecal->cedmicro($distt);
}
elseif ($cabtype == "CedMini") {
	$totalfare = $farecal->cedmini($distt, $weight);
}
elseif ($cabtype == "CedRoyal") {
	$totalfare = $farecal->cedroyal($distt, $weight);
}
elseif ($cabtype == "CedSUV") {
	$totalfare = $farecal->cedsuv($distt, $weight);
}
$weight = (int)$weight;
echo "Distance: " . $distt ." KM, Total Fare: " . $totalfare. " Rs.";
setcookie("fare",$totalfare, time()+10);
setcookie("pickup",$pickup, time()+10);
setcookie("drop",$drop, time()+10);
setcookie("distance",$distt, time()+10);
setcookie("weight",$weight, time()+10);
setcookie("cabtype",$cabtype, time()+10);
?>