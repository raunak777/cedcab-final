<?php
include 'config.php';
extract($_POST);
if($data =='del'){
	$id= $_POST['currentid'];
	$delete= "DELETE FROM `tbl_location` WHERE id='{$id}'";
	$del= $conn->query($delete);
	if ($del) {
		echo 1;
	}
	else {
		echo 0;
	}
}
else if($data == 'block'){
	$id= $_POST['currentid'];
	$block="UPDATE registration SET status=0 WHERE user_id='{$id}'";
	$blc= $conn->query($block);
	if ($blc) {
		echo 1;
	}
	else {
		echo 0;
	}
}

else if($data == 'unblock')
{
	$id= $_POST['currentid'];
	$unblock="UPDATE registration SET status=1 WHERE user_id='{$id}'";
	$unblc= $conn->query($unblock);
	if ($unblc) {
		echo 1;
	}
	else {
		echo 0;
	}
}

?>