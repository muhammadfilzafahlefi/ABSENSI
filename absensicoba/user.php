<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi - User</title>
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
        <p>User</p>
        <ul>
            <li><a href="absensi_pagi.php">Absensi Pagi</a></li>
            <li><a href="absensi_sore.php">Absensi Sore</a></li>
            
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1>Halaman User</h1>
            <!-- Updated time display -->
            <p id="current-time">Loading time...</p>
            <!-- Logout menu -->
            <a href="login.php" class="logout-button">Logout</a>
        </div>

        <div class="welcome-message">
            <h2>Selamat Datang!</h2>
            <p>Anda saat ini login sebagai <strong>User</strong>. Anda memiliki akses terbatas terhadap sistem <span class="highlight">DINAS PERHUBUNGAN KOTA MEDAN</span>.</p>
        </div>

        <div class="main-menu">
            <a href="absensi_pagi.php">
                <div class="menu-item red">ABSENSI PAGI</div>
            </a>
            <a href="absensi_sore.php">
                <div class="menu-item green">ABSENSI SORE</div>
            </a>
            
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button:hover {
            background-color: #d32f2f;
        }
        .menu-item {
            margin: 10px;
            padding: 20px;
            color: white;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }
        .menu-item.red {
            background-color: #f44336;
        }
        .menu-item.green {
            background-color: #4caf50;
        }
        .menu-item.yellow {
            background-color: #ffc107;
        }
        .menu-item:hover {
            opacity: 0.8;
        }
    </style>
</body>
</html>
