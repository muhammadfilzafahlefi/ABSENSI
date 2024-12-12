<?php
include('koneksi.php');

// Data akun admin
$nip = '197103121998032003';
$password = 'admindishub'; // Password dalam teks biasa
$role = 'admin';

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Masukkan data ke tabel
$stmt = $conn->prepare("INSERT INTO users (nip, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nip, $hashed_password, $role);

if ($stmt->execute()) {
    echo "Akun admin berhasil ditambahkan.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
