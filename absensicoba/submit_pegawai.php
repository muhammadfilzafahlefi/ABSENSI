<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'dinas_perhubungan');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor = $_POST['nomor'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $golongan = $_POST['golongan'];
    $jabatan = $_POST['jabatan'];

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO pegawai (nomor, nip, nama, golongan, jabatan) VALUES ('$nomor', '$nip', '$nama', '$golongan', '$jabatan')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman data pegawai
        header("Location: data_pegawai.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
