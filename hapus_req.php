<?php

require 'functions.php';
// ambil id yang dikirim ketika tombol dipencet
// id dikirim lewat url

$id_req = intval($_GET["id_req"]);

if (hapus_req($id_req) > 0) {
    // echo "<script>alert('Request berhasil dihapus')</script>";
    header("location: read_req.php");
    exit;
} else {
    echo mysqli_error($conn);
}
