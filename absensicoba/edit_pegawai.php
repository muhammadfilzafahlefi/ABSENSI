<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'dinas_perhubungan');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ID not found');

// Fetch employee data from database
$sql = "SELECT * FROM pegawai WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die('Employee not found');
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to update the time dynamically every second
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours().toString().padStart(2, '0');
            var minutes = currentTime.getMinutes().toString().padStart(2, '0');
            var seconds = currentTime.getSeconds().toString().padStart(2, '0');
            var day = currentTime.toLocaleString('en-US', { weekday: 'long' });
            var date = currentTime.getDate().toString().padStart(2, '0');
            var month = currentTime.toLocaleString('en-US', { month: 'long' });
            var year = currentTime.getFullYear();

            // Update the time element with the formatted time
            document.getElementById('current-time').innerText = hours + ':' + minutes + ':' + seconds + ' ' + day + ', ' + date + ' ' + month + ' ' + year;
        }

        // Update time every second
        setInterval(updateTime, 1000);

        // Initialize time when page loads
        window.onload = updateTime;
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Dinas Perhubungan</h2>
        <p>Administrator</p>
        <ul>
            <li><a href="absensi.php">Home</a></li>
            <li><a href="data_pegawai.php">Data Pegawai</a></li>
            <li><a href="setting_absensi.php">Setting Absensi</a></li>
            <li><a href="laporan_absensi.php">Laporan Absensi</a></li>
           
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1>Edit Pegawai</h1>
            <p id="current-time">Loading time...</p>
        </div>

        <p>Edit data pegawai yang terdaftar di bawah ini.</p>

        <div class="main-menu">
            <form action="update_pegawai.php" method="POST" class="form-pegawai">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="nomor">Nomor:</label>
                <input type="number" id="nomor" name="nomor" value="<?php echo $row['nomor']; ?>" required><br>

                <label for="nip">NIP:</label>
                <input type="text" id="nip" name="nip" value="<?php echo $row['nip']; ?>" required><br>

                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br>

                <label for="golongan">Golongan:</label>
                <select id="golongan" name="golongan" required>
                    <option value="THL" <?php if ($row['golongan'] == 'THL') echo 'selected'; ?>>THL</option>
                    <option value="II/C" <?php if ($row['golongan'] == 'II/C') echo 'selected'; ?>>II/C</option>
                    <option value="II/D" <?php if ($row['golongan'] == 'II/D') echo 'selected'; ?>>II/D</option>
                    <option value="III/A" <?php if ($row['golongan'] == 'III/A') echo 'selected'; ?>>III/A</option>
                    <option value="III/B" <?php if ($row['golongan'] == 'III/B') echo 'selected'; ?>>III/B</option>
                    <option value="III/C" <?php if ($row['golongan'] == 'III/C') echo 'selected'; ?>>III/C</option>
                    <option value="III/D" <?php if ($row['golongan'] == 'III/D') echo 'selected'; ?>>III/D</option>
                    <option value="IV/A" <?php if ($row['golongan'] == 'IV/A') echo 'selected'; ?>>IV/A</option>
                    <option value="IV/B" <?php if ($row['golongan'] == 'IV/B') echo 'selected'; ?>>IV/B</option>
                </select><br>

                <label for="jabatan">Jabatan:</label>
                <select id="jabatan" name="jabatan" required>
                    <option value="kasubbag Umum" <?php if ($row['jabatan'] == 'kasubbag Umum') echo 'selected'; ?>>Kasubbag Umum</option>
                    <option value="Sekretaris" <?php if ($row['jabatan'] == 'Sekretaris') echo 'selected'; ?>>Sekretaris</option>
                    <option value="Staff" <?php if ($row['jabatan'] == 'Staff') echo 'selected'; ?>>Staff</option>
                </select><br>

                <button type="submit" class="submit-btn">Update Pegawai</button>
            </form>
        </div>
    </div>
</body>
</html>
