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
    $cpu = htmlspecialchars($data["cpu"]);
    $gpu = htmlspecialchars($data["gpu"]);
    $ram = htmlspecialchars($data["ram"]);
    $battery = htmlspecialchars($data["battery"]);
    $harga = htmlspecialchars($data["harga"]);
    $link = htmlspecialchars($data["link"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false; // insert tidak dijalankan
    }

    $query = "INSERT INTO laptop VALUES
            ('', '$merk', '$gambar', '$cpu', 
            '$gpu','$ram','$battery','$harga','$link')
    ";

    mysqli_query($conn, $query);

    // jika gagal -1, jika berhasil 1
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error == 4) { // 4: tidak ada file yang diunggah
        echo "<script>alert('Silakan unggah gambar')</script>";
    }

    // cek apakah yang diunggah gambar atau bukan agar user hanya unggah gambar
    // yang bisa diunggah cuma bentuk jpg dll
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    // explode = memecah string menjadi array
    // explode->contoh nama gambar saat upload adalah gambar.jpg nanti diubah jadi ['gambar', 'jpg']
    $ekstensiGambar = explode('.', $namaFile);
    // buat ambil format gambar saja seperti jpg, jpeg dll
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // cek apakah format yang diunggah termasuk yang diperbolehkan di ekstensiGambarValid
    // in_array = apakah ada sebuah string dalam array
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Silakan unggah gambar')</script>";
    }
    // cek ukuran gambar
    if ($ukuranFile > 5000000) {
        echo "<script>alert('Ukuran gambar terlalu besar. Ukuran maksimal adalah 5 MB')</script>";
    }

    // generate nama file baru untuk file yang diunggah agar tidak ada duplikasi
    $namaFileBaru = uniqid();
    $namaFileBaru = '.';
    $namaFileBaru = $ekstensiGambar;
    // masukkan ke direktori
    move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

    return $namaFileBaru;
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
    $cpu = htmlspecialchars($data["cpu"]);
    $gpu = htmlspecialchars($data["gpu"]);
    $ram = htmlspecialchars($data["ram"]);
    $battery = htmlspecialchars($data["battery"]);
    $harga = htmlspecialchars($data["harga"]);
    $link = htmlspecialchars($data["link"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user memilih gambar user
    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

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
