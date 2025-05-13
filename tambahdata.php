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
    <form action="" method="POST">
        <!-- INPUT MEREK -->
        <label for="merk">Merek: <br>
            <input type="text" name="merk" placeholder="Merek Laptop" required><br><br>
        </label>

        <!-- INPUT GAMBAR -->
        <label for="gambar">Gambar:<br>
            <input type="url" name="gambar"><br><br>
        </label>

        <!-- INPUT CPU -->
        <label for="cpu">CPU:<br>
            <input type="text" name="cpu"><br><br>
        </label>

        <!-- INPUT GPU -->
        <label for="gpu">GPU:<br>
            <input type="text" name="gpu"><br><br>
        </label>

        <!-- INPUT RAM -->
        <label for="ram">RAM:<br>
            <input type="text" name="ram"><br><br>
        </label>

        <!-- INPUT BATTERY -->
        <label for="battery">Battery:<br>
            <input type="text" name="battery"><br><br>
        </label>

        <!-- INPUT HARGA -->
        <label for="harga">Harga:<br>
            <input type="text" name="harga"><br><br>
        </label>

        <!-- INPUT LINK -->
        <label for="link">Link Produk:<br>
            <input type="text" name="link"><br><br>
        </label>

        <!-- SUBMIT BUTTON -->
        <button type="submit" value="Kirim" name="submit">Kirim</button>

    </form>
</body>

</html>