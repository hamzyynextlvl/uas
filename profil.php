<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Deklarasikan dan inisialisasi variabel $update_success
$update_success = false;

// Ambil data profil pengguna dari database
$sql = "SELECT * FROM profil INNER JOIN users ON profil.nim = users.nim WHERE users.username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Profil tidak ditemukan.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi = $_POST['prodi'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? $_POST['password'] : $row['password'];

    $sql_update_profil = "UPDATE profil SET nama='$nama', tgl_lahir='$tgl_lahir', alamat='$alamat', prodi='$prodi', phone='$phone' WHERE nim='".$row['nim']."'";
    $sql_update_user = "UPDATE users SET username='$username', email='$email', password='$password' WHERE nim='".$row['nim']."'";

    if ($conn->query($sql_update_profil) === TRUE && $conn->query($sql_update_user) === TRUE) {
        // Update sesi
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $update_success = true;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <!-- Tambahkan CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h5 class="sidebar-heading">Profil</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Selamat datang, <?php echo $_SESSION['username']; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Email: <?php echo $_SESSION['email']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Edit Profil</h2>
                </div>
                <?php if ($update_success): ?>
                    <div class="alert alert-success" role="alert" id="updateSuccessAlert">
                        Profil berhasil diperbarui!
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('updateSuccessAlert').style.display = 'none';
                            window.location.href = 'list_mahasiswa.php'; // Ganti dengan halaman tujuan setelah update
                        }, 2000); // Popup akan hilang setelah 2 detik dan akan diarahkan ke halaman lain
                    </script>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="text" id="nim" name="nim" class="form-control" value="<?php echo $row['nim']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo $row['tgl_lahir']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi:</label>
                        <input type="text" id="prodi" name="prodi" class="form-control" value="<?php echo $row['prodi']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (leave blank to keep current password):</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </main>
        </div>
    </div>

    <!-- Tambahkan JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
