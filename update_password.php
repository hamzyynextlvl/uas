<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$nim = $_SESSION['nim'];
$old_password = $_POST['old_password'];
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

$sql = "SELECT password FROM users WHERE nim = '$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (password_verify($old_password, $row['password'])) {
    $sql_update = "UPDATE users SET password='$new_password' WHERE nim='$nim'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Password berhasil diperbarui";
        header("Location: profil.php");
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Password lama salah!";
}

$conn->close();
?>
