<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

$nim = $_GET['nim'];

$sql_profil = "DELETE FROM profil WHERE nim='$nim'";
$sql_user = "DELETE FROM users WHERE nim='$nim'";

if ($conn->query($sql_profil) === TRUE && $conn->query($sql_user) === TRUE) {
    header("Location: list_mahasiswa.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
