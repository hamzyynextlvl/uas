<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($koneksi)) {
    include 'koneksi.php';
}

$username = $_SESSION['username'];
$result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <h2>Menu</h2>
            <ul class="list-group">
                <li class="list-group-item">Nama: <?php echo $user['username']; ?></li>
                <li class="list-group-item">Email: <?php echo isset($user['email']) ? $user['email'] : 'Email not set'; ?></li>
                <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
                <?php if ($user['role'] == 'admin') { ?>
                    <li class="list-group-item"><a href="list_mahasiswa.php">List Mahasiswa</a></li>
                <?php } ?>
                <li class="list-group-item"><a href="profil.php">Profil</a></li>
                <li class="list-group-item"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-10">
