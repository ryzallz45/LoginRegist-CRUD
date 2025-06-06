<?php

require '../backend/function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo " <script>
            alert('user baru berhasil ditambahkan');
        </script> ";
    } else {
        echo mysqli_error($koneksi);
    }
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
    <title>Form Register</title>
</head>

<body>
    <div class="container">
        <div class="register-box">
            <h4 class="text-center">Register</h4>
            <?php if (isset($error)) : ?>
                <p class="alert alert-danger text-center">Registration failed!</p>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group mb-4">
                    <label for="username" class="form-label text-light">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label text-light">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password2" class="form-label text-light">Confirm Password:</label>
                    <input type="password" class="form-control" name="password2" id="password2" autocomplete="off" required>
                </div>
                <button class="btn btn-primary w-100 mb-3" type="submit" name="register">Register</button>
                <a href="login.php" class="btn btn-secondary w-100">Login</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>
</html>
