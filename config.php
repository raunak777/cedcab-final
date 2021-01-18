<?php
$servername= "localhost";
  $username= "root";
  $dbname= "cedcab";
  $conn= new mysqli($servername, $username,'', $dbname);
  if ($conn) {
  }
  else
  {
    echo "<script>Connection Failed</script>";
  }
?>