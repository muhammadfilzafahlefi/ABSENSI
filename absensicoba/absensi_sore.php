<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Sore</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        /* Container */
        .container {
            display: flex;
            flex: 1;
        }

        /* Sidebar */
        .sidebar {
            background-color: #2c3e50;
            color: white;
            width: 250px;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 18px;
            color: #7f8c8d;
        }

        /* Form */
        .form {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }

        .form input,
        .form select,
        .form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 14px;
        }

        .form button {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .form button:hover {
            background-color: #2980b9;
        }
    </style>
    <script>
        // Function to show a success notification
        function showNotification(event) {
            event.preventDefault();
            alert('Data berhasil disimpan!');
            document.getElementById('absensiForm').submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Dinas Perhubungan</h2>
            <p>User</p>
            <ul>
                <li><a href="user.php">HOME</a></li>
                <li><a href="absensi_pagi.php">Absensi Pagi</a></li>
                <li><a href="absensi_sore.php">Absensi Sore</a></li>
                
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h1>Absensi Sore</h1>
                <p>Isi data absensi pagi Anda di bawah ini:</p>
            </div>

            <!-- Form -->
            <form id="absensiForm" action="proses_absensi_sore.php" method="post" class="form">
                <label for="nip">NIP:</label>
                <input type="text" id="nip" name="nip" required>

                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>

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
                </select>

                <label for="jabatan">Jabatan:</label>
                <select id="jabatan" name="jabatan" required>
                    <option value="Kasubbag Umum">Kasubbag Umum</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Staff">Staff</option>
                </select>

                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>

                <label for="waktu">Waktu:</label>
                <input type="time" id="waktu" name="waktu" required>

                <input type="hidden" name="jenis_absensi" value="Sore">
                <button type="submit" class="btn-submit" onclick="showNotification(event)">Absensi Sore</button>
            </form>
        </div>
    </div>
</body>
</html>
