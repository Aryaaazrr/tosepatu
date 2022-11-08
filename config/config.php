<?php
// Aktifkan Semua Laporan
// mysqli_report(MYSQLI_REPORT_ALL);
// /* untuk menekan peringatan */
// $conn = @new mysqli('localhost', 'root', '', 'db_tosepatu');
// if ($conn->connect_error) {
//     /* metode kesalahan */
//     error_log('Connection error: ' . $conn->connect_error);
// }

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=db_tosepatu", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
