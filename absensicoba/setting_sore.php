<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Absensi</title>
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
            <li><a href="#">Laporan Absensi</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1>Setting Absensi</h1>
            
        </div>

        <div class="main-content">
            <h2>Data Absensi Pagi</h2>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Golongan</th>
                        <th>Jabatan</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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

                    // Update waktu if form is submitted
                    if (isset($_POST['update_waktu'])) {
                        $id = $_POST['id'];
                        $waktu = $_POST['waktu'];

                        $update_sql = "UPDATE absensi_sore SET waktu='$waktu' WHERE id='$id'";
                        if ($conn->query($update_sql) === TRUE) {
                            echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }

                    // Query to fetch data from `absensi_pagi`
                    $sql = "SELECT id, nip, nama, golongan, jabatan, waktu FROM absensi_sore";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
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
                                    <td><a href='?edit_id=" . $row["id"] . "'>Edit</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No data available</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>

            <?php
            // Show the edit form if an edit request is made
            if (isset($_GET['edit_id'])) {
                $edit_id = $_GET['edit_id'];

                // Reconnect to the database to fetch the record for editing
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch the record for the given ID
                $sql = "SELECT * FROM absensi_sore WHERE id = '$edit_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>

                <h3>Edit Waktu</h3>
                <form method="POST" action="setting_sore.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="waktu">Waktu:</label>
                    <input type="text" name="waktu" value="<?php echo htmlspecialchars($row['waktu']); ?>" required>
                    <button type="submit" name="update_waktu">Update</button>
                </form>

                <?php
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
        form {
            margin-top: 20px;
        }
        form input {
            padding: 8px;
            margin-bottom: 10px;
            width: 200px;
        }
        form button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>
