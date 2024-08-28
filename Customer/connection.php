<?php
$servername = "185.224.138.37";
$username = "u505822356_usrMTSDev";
$password = "MTSDev@13579$";
$dbname = "u505822356_dbMTSDev";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//   echo "Connected successfully";

?>