<?php
$conn = new mysqli("localhost","root","","blood_bank");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$conn_PDO = new PDO('mysql:host=localhost;dbname=blood_bank', 'root', '');

$conn_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// var_dump($conn_PDO); 


?>