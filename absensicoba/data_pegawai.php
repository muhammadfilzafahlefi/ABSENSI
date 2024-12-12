<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
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
            <li><a href="admin.php">Home</a></li>
            <li><a href="data_pegawai.php">Data Pegawai</a></li>
            <li><a href="setting_absensi.php">Setting Absensi</a></li>
            <li><a href="#">Laporan Absensi</a></li>
            
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1>Data Pegawai</h1>
            <p id="current-time">Loading time...</p>
        </div>

        <p>Kelola data pegawai secara efektif. Gunakan form di bawah untuk menambahkan pegawai baru.</p>

        <div class="main-menu">
            <form action="submit_pegawai.php" method="POST" class="form-pegawai">
                <label for="nomor">Nomor:</label>
                <input type="number" id="nomor" name="nomor" required><br>

                <label for="nip">NIP:</label>
                <input type="text" id="nip" name="nip" required><br>

                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required><br>

                <label for="golongan">Golongan:</label>
                <select id="golongan" name="golongan" required>
                    <option value="THL">THL</option>
                    <option value="II/C">II/C</option>
                    <option value="II/D">II/D</option>
                    <option value="III/A">III/A</option>
                    <option value="III/B">III/B</option>
                    <option value="III/C">III/C</option>
                    <option value="III/D">III/D</option>
                    <option value="IV/A">IV/A</option>
                    <option value="IV/B">IV/B</option>
                </select><br>

                <label for="jabatan">Jabatan:</label>
                <select id="jabatan" name="jabatan" required>
                    <option value="kasubbag Umum">Kasubbag Umum</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Staff">Staff</option>
                </select><br>

                <button type="submit" class="submit-btn">Tambah Pegawai</button>
            </form>
        </div>

        <div class="data-table">
            <h2>Daftar Pegawai</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Golongan</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Database connection
                        $conn = new mysqli('localhost', 'root', '', 'dinas_perhubungan');

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch data from database
                        $sql = "SELECT * FROM pegawai";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['nomor'] . "</td>
                                    <td>" . $row['nip'] . "</td>
                                    <td>" . $row['nama'] . "</td>
                                    <td>" . $row['golongan'] . "</td>
                                    <td>" . $row['jabatan'] . "</td>
                                    <td>
                                        <a href='edit_pegawai.php?id=" . $row['id'] . "'>Edit</a> |
                                        <a href='delete_pegawai.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data available</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>