<?php

include 'phpclass.php';
extract($_POST);
$btncls= new database();

if($data=='cancel')
{
	$btncls->cancel_status($_POST['currentid']);
}
else if($data =='accept'){
	$btncls->accept_status($_POST['currentid']);
}

?>