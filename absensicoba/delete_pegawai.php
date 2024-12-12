<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'dinas_perhubungan');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' is passed in the URL
if (isset($_GET['id'])) {
    // Sanitize the input
    $id = $_GET['id'];

    // Prepare an SQL statement to delete the record
    $sql = "DELETE FROM pegawai WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the data_pegawai.php page after successful deletion
        header("Location: data_pegawai.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
} else {
    echo "ID not provided.";
}

$conn->close();
?>
