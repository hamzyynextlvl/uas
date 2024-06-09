<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
    <title>Dashboard</title>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px;
            text-align: center;
            display: block;
            color: black;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h4 class="text-center">Selamat datang, <?php echo $_SESSION['username']; ?></h4>
    <p class="text-center"><?php echo $_SESSION['email']; ?></p>
    <a href="dashboard.php">Dashboard</a>
    <?php if ($_SESSION['role'] === 'admin') : ?>
        <a href="list_mahasiswa.php">List Mahasiswa</a>
    <?php endif; ?>
    <a href="profil.php">Profil</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Dashboard</h1>
    <p>Ini adalah halaman utama Anda. Selamat datang!</p>
</div>
</body>
</html>
