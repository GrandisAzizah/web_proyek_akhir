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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_login.css">
    <title>Halaman Registrasi</title>
</head>

<!-- <style>
    label,
    button {
        display: block;
    }

    button {
        padding: 4px;
        margin-top: 10px;
    }
</style> -->

<body>

    <div class="row no-gutters">

        <!-- bagian kiri -->
        <div class="col-md-6 no-gutters">
            <div class="leftside d-flex justify-content-center align-items-center"></div>
        </div>

        <!-- bagian kanan -->
        <div class="col-md-6 no-gutters">
            <div class="rightside d-flex justify-content-center align-items-center">
                <form action="" method="POST">
                    <div>
                        <h1>Registrasi</h1>
                    </div>

                    <div class="form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" minlength="8" maxlength="20" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" minlength="8" maxlength="12" required>
                    </div>

                    <div class="form-group">
                        <label for="password2" class="form-label">Konformasi Password</label>
                        <input type="password" name="password2" id="password2" class="form-control" minlength="8" maxlength="12" required>
                    </div>
                    <div>
                        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                    </div>
                </form>
</body>

</html>
