<?php
$servername = "localhost";
$username = "root"; // ganti dengan username MySQL anda
$password = ""; // ganti dengan password MySQL anda
$dbname = "login_system";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
