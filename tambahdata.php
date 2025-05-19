<?php

session_start();
// user belum login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';
// cek apakah tombol sudah dipencet
if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "Data berhasil ditambahkan";
        header("location:berandaAdmin.php");
    } else {
        echo "Data gagal ditambahkan";
        // menampilkan kenapa gagal
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- INPUT MEREK -->
        <label for="merk">Merek: <br></label>
        <input type="text" name="merk" id="merk" required><br><br>


        <!-- INPUT GAMBAR -->
        <label for="gambar">Gambar:<br></label>
        <input type="file" name="gambar" id="gambar"><br><br>


        <!-- INPUT CPU -->
        <label for="CPU">CPU:<br></label>
        <input type="text" name="CPU" id="CPU"><br><br>


        <!-- INPUT GPU -->
        <label for="GPU">GPU:<br></label>
        <input type="text" name="GPU" id="GPU"><br><br>


        <!-- INPUT RAM -->
        <label for="RAM">RAM:<br></label>
        <input type="text" name="RAM" id="RAM"><br><br>


        <!-- INPUT BATTERY -->
        <label for="battery">Battery:<br></label>
        <input type="text" name="battery" id="battery"><br><br>


        <!-- INPUT HARGA -->
        <label for="harga">Harga:<br></label>
        <input type="text" name="harga" id="harga"><br><br>


        <!-- INPUT LINK -->
        <label for="link">Link Produk:<br></label>
        <input type="text" name="link" id="link"><br><br>


        <!-- SUBMIT BUTTON -->
        <button type="submit" value="Kirim" name="submit">Kirim</button>

    </form>
</body>

</html>
