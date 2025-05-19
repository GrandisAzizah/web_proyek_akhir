<?php
session_start();

require 'functions.php';

// cek cookie, kalau ada berarti masih login
// if (isset($_COOKIE['login'])) {
//     if ($_COOKIE['login'] == true) {
//         $_SESSION['login'] = true;
//     }
// }

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
                    // k itu id ish
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
    <title>Halaman Login</title>
</head>

<body>
    <h1>Halaman Login</h1>

    <!-- tampilkan pesan error -->
    <?php if (isset($error)): ?>
        <!-- pesan error -->
        <p>Username atau password salah.</p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Ingat Pengguna</label><br><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>