<?php
include 'config.php';

// Admin Account
$admin_username = 'admin';
$admin_email = 'admin@example.com';
$admin_password = 'admin123'; // Tanpa hash

$sql_admin_user = "INSERT INTO users (username, email, password, role) VALUES ('$admin_username', '$admin_email', '$admin_password', 'admin')";
$conn->query($sql_admin_user);

// Mahasiswa 1
$mahasiswa1_username = 'mhs1';
$mahasiswa1_email = 'mhs1@example.com';
$mahasiswa1_password = 'mahasiswa123'; // Tanpa hash

$sql_mahasiswa1_user = "INSERT INTO users (username, email, password, role) VALUES ('$mahasiswa1_username', '$mahasiswa1_email', '$mahasiswa1_password', 'mahasiswa')";
$conn->query($sql_mahasiswa1_user);

// Tambahkan akun mahasiswa lainnya di sini sesuai kebutuhan

$conn->close();
?>
