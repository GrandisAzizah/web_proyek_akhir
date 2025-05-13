<?php
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
        <input type="text" name="merk" id="merek" required><br><br>


        <!-- INPUT GAMBAR -->
        <label for="gambar">Gambar:<br></label>
        <input type="file" name="gambar" id="gambar"><br><br>


        <!-- INPUT CPU -->
        <label for="cpu">CPU:<br></label>
        <input type="text" name="cpu" id="cpu"><br><br>


        <!-- INPUT GPU -->
        <label for="gpu">GPU:<br></label>
        <input type="text" name="gpu" id="gpu"><br><br>


        <!-- INPUT RAM -->
        <label for="ram">RAM:<br></label>
        <input type="text" name="ram" id="ram"><br><br>


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
