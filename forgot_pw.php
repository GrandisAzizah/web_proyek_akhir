<?php
require 'functions.php';
if (isset($_POST["reset"])) {
    $result = mysqli_query($conn, "SELECT email FROM 
    user WHERE email = '$email'");

    // cek email ada di database apa enggak
    if (!mysqli_fetch_assoc($result)) {
        return false; // agar insert tidak terjadi
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_login.css">
    <title>Lupa password</title>
</head>

<body>
    <div class="col-md-6 no-gutters">
        <div class="rightside d-flex justify-content-center align-items-center">
            <!-- form -->
            <form action="" method="POST">
                <div>
                    <h1>Ganti Password</h1>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email yang teregistrasi">
                </div>
                <div class="form-group">
                    <button type="submit" name="reset" class="btn btn-primary w-100">Kirim link reset</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>