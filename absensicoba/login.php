<?php
session_start();
include('koneksi.php');

if (isset($_POST['login'])) {
    $nip = trim($_POST['nip']);
    $password = trim($_POST['password']);

    // Gunakan prepared statements untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE nip = ?");
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['nip'] = $row['nip'];
            $_SESSION['role'] = $row['role'];

            // Arahkan ke halaman sesuai peran
            if ($row['role'] == 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: user.php');
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "NIP tidak ditemukan!";
    }

    // Tutup statement
    $stmt->close();
}

if (isset($_POST['register'])) {
    $nip = trim($_POST['nip']);
    $password = trim($_POST['password']);
    $role = 'user'; // Default role untuk pengguna baru

    // Periksa apakah NIP sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE nip = ?");
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "NIP sudah terdaftar!";
    } else {
        // Hash password dan masukkan data ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (nip, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nip, $hashed_password, $role);

        if ($stmt->execute()) {
            $success = "Pengguna berhasil didaftarkan. Silakan login.";
        } else {
            $error = "Terjadi kesalahan saat mendaftarkan pengguna.";
        }
    }

    // Tutup statement
    $stmt->close();
}

// Pastikan koneksi menggunakan charset yang sesuai
$conn->set_charset("utf8mb4");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <h2>Registrasi</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" name="register" class="btn-login">Register</button>
        </form>
    </div>
</body>
</html>
