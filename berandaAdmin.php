<?php
require 'functions.php';
$laptop = query("SELECT * FROM laptop");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <a href="tambahdata.php">Tambah Data</a><br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Merek</th>
            <th>Gambar</th>
            <th>CPU</th>
            <th>GPU</th>
            <th>RAM</th>
            <th>Battery</th>
            <th>Harga</th>
            <th>Link Barang</th>
            <th>Action</th>
        </tr>

        <!-- i untuk penomoran -->
        <?php $i = 1 ?>
        <!-- titik dua mengganti kurung kurawal -->
        <?php foreach ($laptop as $row) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['ID'] ?></td>
                <td><?= $row['merk'] ?></td>
                <td><img src="<?= $row['gambar'] ?>" width="50"></td>
                <td><?= $row['CPU'] ?></td>
                <td><?= $row['GPU'] ?></td>
                <td><?= $row['RAM'] ?></td>
                <td><?= $row['battery'] ?></td>
                <td>Rp<?= $row['harga'] ?></td>
                <td><a href=<?= $row['link'] ?>>Link Barang</a></td>
                <td>
                    <a href="update.php?ID=<?= $row["ID"]; ?>">Update</a>
                    <a href="hapus.php?ID=<?= $row["ID"]; ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach ?>
    </table>
</body>

</html>
