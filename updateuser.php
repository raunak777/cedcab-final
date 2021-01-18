<?php
session_start();
extract($_POST);
include 'phpclass.php';
$db= new database();
$db->update_user($_POST, $_SESSION['userid']);
?>