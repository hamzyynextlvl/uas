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

    $sql = "UPDATE profil SET nama='$nama', tgl_lahir='$tgl_lahir', alamat='$alamat', prodi='$prodi', phone='$phone' WHERE nim='$nim'";
    if ($conn->query($sql) === TRUE) {
        header("Location: list_mahasiswa.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$nim = $_GET['nim'];
$sql = "SELECT * FROM profil WHERE nim = '$nim'";
$result = $conn->query($sql);
$profile = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
    <title>Edit Mahasiswa</title>
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
    <h1>Edit Mahasiswa</h1>
    <form method="post" action="">
        <input type="hidden" name="nim" value="<?php echo $profile['nim']; ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $profile['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $profile['tgl_lahir']; ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $profile['alamat']; ?>" required>
        </div>
        <div class="form-group">
            <label for="prodi">Prodi:</label>
            <input type="text" class="form-control" id="prodi" name="prodi" value="<?php echo $profile['prodi']; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $profile['phone']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
