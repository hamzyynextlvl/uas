<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Tanpa hash
    $role = 'mahasiswa';

    $sql_user = "INSERT INTO users (username, email, password, role, nim) VALUES ('$username', '$email', '$password', '$role', '$nim')";
    if ($conn->query($sql_user) === TRUE) {
        $sql_profil = "INSERT INTO profil (nim, nama, tgl_lahir, alamat, prodi, phone) VALUES ('$nim', '$nama', '$tgl_lahir', '$alamat', '$prodi', '$phone')";
        if ($conn->query($sql_profil) === TRUE) {
            header("Location: list_mahasiswa.php");
        } else {
            echo "Error: " . $sql_profil . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_user . "<br>" . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
    <title>Tambah Mahasiswa</title>
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
    <a href="list_mahasiswa.php">List Mahasiswa</a>
    <a href="profil.php">Profil</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>Tambah Mahasiswa</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="nim">NIM:</label>
            <input type="text" class="form-control" id="nim" name="nim" required>
        </div>
        <div class="form-group">
            <label
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="prodi">Prodi:</label>
            <input type="text" class="form-control" id="prodi" name="prodi" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
</body>
</html>
