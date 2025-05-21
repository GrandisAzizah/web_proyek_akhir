<?php
session_start();

require 'functions.php';

// cek apakah ada cookie
if (isset($_COOKIE['k']) && isset($_COOKIE['x'])) {
    $a = $_COOKIE['k'];
    $x = $_COOKIE['x'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE a = $a");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($x === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

// cek apakah sudah login ga usah balik ke login
if (isset($_SESSION["login"])) {
    header("location: berandaAdmin.php");
    exit;
}

// cek apakah tombol login sudah diklik
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $result = mysqli_query($conn, "SELECT * FROM user 
    WHERE username = '$username'");

    // cek apakah username ada di database
    // menghitung ada berapa baris dari fungsi select
    // jika ada maka bernilai 1, jika tidak ada maka 0
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result); // dalam row akan sudah ada datanya
        if ($email === $row["email"]) {
            // cek string sama atau tidak dengan hash nya
            if (password_verify($password, $row["password"])) {
                // set session
                $_SESSION["login"] = true;

                // cek cookies remember me
                if (isset($_POST['remember'])) {
                    // buat cookie
                    // k itu id 
                    // x itu username, username akan di enkripsi
                    // enkripsi hash (parameter 1, parameter 2, parameter 3 - opsional)
                    // parameter 1 -> pake algoritma apa
                    // parameter 2 -> string mana yang mau di enkripsi
                    setcookie('k', $row['a'], time() + 60 * 60);
                    setcookie('x', hash('sha256', $row['username']), time() + 60 * 60);
                }

                header("location:berandaAdmin.php");
                exit;
            }
        }
    }
    // jika salah maka dia error
    $error = true;
}
?>

<!-- <style>
    label,
    button
    {
    display: block;
    margin-top: 10px;
    }
</style> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_login.css">
    <title>Halaman Login</title>
</head>

<body>
    <!-- tampilkan pesan error -->
    <?php if (isset($error)): ?>
        <!-- pesan error -->
        <p>Username atau password salah.</p>
    <?php endif; ?>

    <div class="row no-gutters">

        <!-- bagian kiri -->
        <div class="col-md-6 no-gutters">
            <div class="leftside d-flex justify-content-center align-items-center"></div>
        </div>

        <!-- bagian kanan -->
        <div class="col-md-6 no-gutters">
            <div class="rightside d-flex justify-content-center align-items-center">
                <!-- form -->
                <form action="" method="POST">
                    <div>
                        <h1>Login</h1>
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" minlength="8" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="8" maxlength="12" required>
                        <p><a href="forgot_pw.php">Lupa password?</a></p>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat Pengguna</label>
                        <p>Belum punya akun? <a href="registrasi.php">Registrasi di sini</a></p>
                    </div>
                    <div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</body>

</html>
