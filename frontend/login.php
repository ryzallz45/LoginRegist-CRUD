<?php
session_start();
if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require '../backend/function.php';

// jika tombol yang bernama login diklik
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    // password menggunakan md5

    // mengambil data dari user dimana username yg diambil
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    $cek = mysqli_num_rows($result);

    // jika $cek lebih dari 0, maka berhasil login dan masuk ke index.php
    if ($cek > 0) {
        $_SESSION['login'] = true;

        // cek remember me
        if (isset($_POST['remember'])) {
            // buat cookie dan acak cookie

            setcookie('id', $row['id'], time() + 60);

            // mengacak $row dengan algoritma 'sha256'
            setcookie('key', hash('sha256', $row['username']), time() + 60);
        }

        header('location:index.php');
        exit;
    }
    // jika $cek adalah 0 maka tampilkan error
    $error = true;  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css?v=1">

    <title>Form Login</title>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h4 class="text-center">Silahkan Login Terlebih Dahulu</h4>
            <?php if (isset($error)) : ?>
                <p class="alert alert-danger text-center">Username atau Password Salah!</p>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Masukkan Username" name="username" autocomplete="off" required>
                </div>
                <div class="form-group mb-4">
                    <input type="password" class="form-control" placeholder="Masukkan Password" name="password" autocomplete="off" required>
                </div>
                <div class="form-check text-start mb-4">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button class="btn btn-primary w-100 mb-3" type="submit" name="login">Login</button>
                <a href="registrasi.php" class="btn btn-danger w-100">Sign Up</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
