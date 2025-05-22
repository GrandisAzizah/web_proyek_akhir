<?php
require 'functions.php';

if (isset($_POST["submit"])) {
    if (request($_POST) > 0) {
        echo "Request berhasil dikirim!";
    } else {
        echo "Request gagal dikirim.";
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
    <title>Halaman Request</title>
</head>

<body>
    <div class="col-md-6 no-gutters">
        <div class="rightside d-flex justify-content-center align-items-center">
            <div class="form-group">
                <form action="" method="POST">
                    <div>
                        <h1>Kirimkan Request</h1>
                    </div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control mb-3">
                    <label for="request_data" class="form-label">Request</label>
                    <input type="text" name="request_data" id="request_data" class="form-control" placeholder="Masukkan nama merk laptop.">
                    <div class="form-group mt-3">
                        <button type="submit" value="submit" name="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>