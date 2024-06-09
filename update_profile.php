<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$nim = $_SESSION['nim'];
$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$prodi = $_POST['prodi'];
$phone = $_POST['phone'];

$sql = "UPDATE profil SET nama='$nama', tgl_lahir='$tgl_lahir', alamat='$alamat', prodi='$prodi', phone='$phone' WHERE nim='$nim'";

if ($conn->query($sql) === TRUE) {
    header("Location: profil.php");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
