<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'dinas_perhubungan');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $id = isset($_POST['id']) ? $_POST['id'] : die('ID not found');
    $nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';
    $nip = isset($_POST['nip']) ? $_POST['nip'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $golongan = isset($_POST['golongan']) ? $_POST['golongan'] : '';
    $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : '';

    // Validate the form data (simple validation)
    if (empty($nomor) || empty($nip) || empty($nama) || empty($golongan) || empty($jabatan)) {
        die('All fields are required!');
    }

    // Prepare an SQL statement to update the employee data
    $sql = "UPDATE pegawai SET nomor = ?, nip = ?, nama = ?, golongan = ?, jabatan = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $nomor, $nip, $nama, $golongan, $jabatan, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the data_pegawai.php page after successful update
        header("Location: data_pegawai.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
