<?php

session_start();
// user belum login
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';
// ambil id yang dikirim ketika tombol dipencet
// id dikirim lewat url
$id = $_GET["ID"];

if (hapus($id) > 0) {
    header("location:berandaAdmin.php");
} else {
    echo "Data gagal dihapus";
    // menampilkan kenapa gagal
    echo mysqli_error($conn);
}
