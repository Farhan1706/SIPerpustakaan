<?php
$host       = "localhost";
$username   = "root";
$password   = "";
$database   = "sipus";

$koneksi = new mysqli($host,$username,$password,$database);

// Check connection
if ($koneksi -> connect_errno) {
  echo "Gagal Terhubung Ke DatabaseL: " . $koneksi -> connect_error;
  exit();
}
?>