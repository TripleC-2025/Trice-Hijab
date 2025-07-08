<?php

$host = "localhost";
$user = "u458337714_trice_hijab";
$pass = "Sisfo396";
$dbname = "u458337714_localhost";

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
