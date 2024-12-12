<?php
// Mengatur zona waktu ke Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

// Koneksi ke database
$servername = "localhost"; // Host database
$username = "root"; // Username database
$password = ""; // Password database
$dbname = "dinas_perhubungan"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari formulir
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$golongan = $_POST['golongan'];
$jabatan = $_POST['jabatan'];
$waktu = $_POST['waktu']; // Menggunakan waktu saat ini
$jenis_absensi = $_POST['jenis_absensi'];

// Konversi waktu ke format yang sesuai dengan database jika perlu
$datetime = date('Y-m-d H:i:s', strtotime($waktu)); // Mengubah waktu ke format 'Y-m-d H:i:s'

// Menyiapkan query untuk menyimpan data
$stmt = $conn->prepare("INSERT INTO absensi_pagi (nip, nama, golongan, jabatan, waktu, jenis_absensi) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nip, $nama, $golongan, $jabatan, $datetime, $jenis_absensi); // Gunakan $datetime

// Menjalankan query
if ($stmt->execute()) {
    echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href = 'absensi_pagi.php';
              </script>";
} else {
    echo "<script>
                alert('Gagal menyimpan data: " . $conn->error . "');
                window.history.back();
  </script>";
}
?>
