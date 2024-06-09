<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

$sql = "SELECT * FROM profil";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
    <title>List Mahasiswa</title>
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
    <h1>List Mahasiswa</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>Phone</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["nim"]."</td>";
                    echo "<td>".$row["nama"]."</td>";
                    echo "<td>".$row["tgl_lahir"]."</td>";
                    echo "<td>".$row["alamat"]."</td>";
                    echo "<td>".$row["prodi"]."</td>";
                    echo "<td>".$row["phone"]."</td>";
                    echo "<td><a href='edit_mahasiswa.php?nim=".$row["nim"]."' class='btn btn-warning btn-sm'>Edit</a> <a href='delete_mahasiswa.php?nim=".$row["nim"]."' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data mahasiswa</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="add_mahasiswa.php" class="btn btn-primary">Tambah Mahasiswa</a>
</div>
</body>
</html>
<?php
$conn->close();
?>
