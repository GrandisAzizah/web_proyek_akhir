<?php
var_dump($_GET);
require 'functions.php';

// ambil data di url
if (!isset($_GET["ID"]) || !is_numeric(($_GET["ID"]))) { //is_numeric mencegah injection
    die("ID tidak ditemukan"); //die untuk menghentikan eksekusi
}
$id = (int)$_GET["ID"];
$tm = query("SELECT * FROM laptop WHERE ID = $id")[0];
// // query data berdasarkan id dari ID
// $laptop = query("SELECT * FROM laptop WHERE ID = $id");
// if (count($laptop) == 0) {
//     die("Data dengan ID $id tidak ditemukan.");
// }

// $tm = $laptop[0];

// cek apakah tombol sudah dipencet
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di update
    if (update($_POST) > 0) {
        header("location:berandaAdmin.php");
    } else {
        echo "Data gagal di update";
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
    <h1>Update Data</h1>
    <form action="" method="POST">
        <!-- id atau ID -->
        <input type="hidden" name="ID" value="<?= ($tm["ID"]); ?>">

        <!-- INPUT MEREK -->
        <label for="merk">merk:<br>
            <input type="text" name="merk" placeholder="merk" required value="<?= ($tm["merk"]); ?>"><br><br>
        </label>

        <!-- INPUT GAMBAR -->
        <label for="gambar">Gambar:<br>
            <input type="text" name="gambar" placeholder="gambar" value="<?= ($tm["gambar"]); ?>"><br><br>
        </label>

        <!-- INPUT CPU -->
        <label for="cpu">CPU:<br>
            <input type="text" name="cpu" value="<?= ($tm["CPU"]); ?>"><br><br>
        </label>

        <!-- INPUT GPU -->
        <label for="gpu">GPU:<br>
            <input type="text" name="gpu" value="<?= ($tm["GPU"]); ?>"><br><br>
        </label>

        <!-- INPUT RAM -->
        <label for="ram">RAM:<br>
            <input type="text" name="ram" value="<?= ($tm["RAM"]); ?>"><br><br>
        </label>

        <!-- INPUT BATTERY -->
        <label for="battery">Battery:<br>
            <input type="text" name="battery" value="<?= ($tm["battery"]); ?>"><br><br>
        </label>

        <!-- INPUT HARGA -->
        <label for="harga">Harga:<br>
            <input type="text" name="harga" value="<?= ($tm["harga"]); ?>"><br><br>
        </label>

        <!-- INPUT LINK -->
        <label for="link">Link Barang:<br>
            <input type="text" name="link" value="<?= ($tm["link"]); ?>"><br><br>
        </label>

        <!-- SUBMIT BUTTON -->
        <button type="submit" value="Update" name="submit">Update</button>

    </form>
</body>

</html>