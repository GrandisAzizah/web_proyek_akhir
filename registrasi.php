<!-- REGISTRASI ATAU SIGN UP -->
<?php
require 'functions.php';
// kondisi apakah tombol register sudah ditekan
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru berhasil ditambahkan')
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>

<style>
    label,
    button {
        display: block;
    }

    button {
        padding: 4px;
        margin-top: 10px;
    }
</style>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="password2">Konformasi Password</label>
        <input type="password" name="password2" id="password2" required>


        <button type="submit" name="register">Register</button>
    </form>
</body>

</html>