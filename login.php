<?php
session_start();

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database berdasarkan username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if ($password == $row['password']) { // Perhatikan bahwa password tidak di-hash dalam database
            // Jika password cocok, buat sesi pengguna dan arahkan ke halaman dashboard
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Jika password tidak cocok, tampilkan pesan kesalahan
            $error_message = "Password salah";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan kesalahan
        $error_message = "Username tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css"></link>
</head>
    
<body>
    
    <?php if(isset($error_message)) echo '<p style="color: red;">' . $error_message . '</p>'; ?>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Login</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
