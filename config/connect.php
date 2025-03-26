<?php

$host = "localhost";
$username = "root";
$password = "0000";
$database = "absensi";


$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>