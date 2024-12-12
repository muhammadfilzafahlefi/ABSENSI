<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Dinas Perhubungan</h2>
        <p>Administrator</p>
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="data_pegawai.php">Data Pegawai</a></li>
            <li><a href="setting_absensi.php" class="active">Setting Absensi</a></li>
            <li><a href="laporan_absensi.php">Laporan Absensi</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1>laporan Absensi</h1>
            
        </div>

        <div class="main-content">
            <h2>Data Absensi</h2>

            <!-- Buttons for selecting Absensi Pagi or Absensi Sore -->
            <div>
                <a href="laporan_absensi_pagi.php?absensi_type=pagi" class="button">Absensi Pagi</a>
                <a href="laporan_absensi_sore.php?absensi_type=sore" class="button">Absensi Sore</a>
            </div>

            <!-- Only show the table if the absensi_type is selected -->
            <?php
            if (isset($_GET['absensi_type'])) {
                $absensi_type = $_GET['absensi_type'];

                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dinas_perhubungan";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Set the table based on the selected absensi type
                if ($absensi_type == 'pagi') {
                    $table = 'absensi_pagi';
                } elseif ($absensi_type == 'sore') {
                    $table = 'absensi_sore';
                } else {
                    $table = '';
                }

                // If a valid absensi type is selected, fetch data from the corresponding table
                if ($table) {
                    $sql = "SELECT id, nip, nama, golongan, jabatan, waktu FROM $table";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table border='1' cellspacing='0' cellpadding='10' style='margin-top: 20px;'>
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Golongan</th>
                                        <th>Jabatan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        // Output data of each row
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $no++ . "</td>
                                    <td>" . htmlspecialchars($row["nip"]) . "</td>
                                    <td>" . htmlspecialchars($row["nama"]) . "</td>
                                    <td>" . htmlspecialchars($row["golongan"]) . "</td>
                                    <td>" . htmlspecialchars($row["jabatan"]) . "</td>
                                    <td>" . htmlspecialchars($row["waktu"]) . "</td>
                                  </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<p>No data available for the selected absensi type.</p>";
                    }
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100%;
            padding: 20px;
        }
        .sidebar h2 {
            margin: 0 0 20px 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: white;
        }
        .sidebar ul li a.active {
            font-weight: bold;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button:hover {
            background-color: #d32f2f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>
