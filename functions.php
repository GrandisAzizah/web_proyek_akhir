<?php
// ini dibuat biar nanti di setiap menu gak perlu buat koneksi lagi dan tinggal panggil saja function nya
// koneksi ke database ("namahost", "username", "password", "nama_database")
$conn = mysqli_connect("localhost", "root", "", "laptop");

// function query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    // ambil data dari setiap elemen dalam form
    // disimpan ke dalam variabel biar nanti di query gampang
    // diubah jadi $data["..."] karena elemen form di 'post' dan ditangkap oleh parameter $data
    $merk = htmlspecialchars($data["merk"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $cpu = htmlspecialchars($data["cpu"]);
    $gpu = htmlspecialchars($data["gpu"]);
    $ram = htmlspecialchars($data["ram"]);
    $battery = htmlspecialchars($data["battery"]);
    $harga = htmlspecialchars($data["harga"]);
    $link = htmlspecialchars($data["link"]);

    $query = "INSERT INTO laptop VALUES
            ('', '$merk', '$gambar', '$cpu', 
            '$gpu','$ram','$battery','$harga','$link')
    ";

    mysqli_query($conn, $query);

    // jika gagal -1, jika berhasil 1
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM laptop WHERE ID = $id");
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["ID"];
    $merk = htmlspecialchars($data["merk"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $cpu = htmlspecialchars($data["cpu"]);
    $gpu = htmlspecialchars($data["gpu"]);
    $ram = htmlspecialchars($data["ram"]);
    $battery = htmlspecialchars($data["battery"]);
    $harga = htmlspecialchars($data["harga"]);
    $link = htmlspecialchars($data["link"]);

    $query = "UPDATE laptop SET
            merk = '$merk',
            gambar = '$gambar',
            cpu = '$cpu',
            gpu = '$gpu',
            ram = '$ram',
            battery = '$battery',
            harga = '$harga',
            link = '$link'
            WHERE ID = $id
    ";

    mysqli_query($conn, $query);

    // jika gagal -1, jika berhasil 1
    return mysqli_affected_rows($conn);
}
