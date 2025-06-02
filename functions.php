<?php
// ini dibuat biar nanti di setiap menu gak perlu buat koneksi lagi dan tinggal panggil saja function nya
// koneksi ke database ("namahost", "username", "password", "nama_database")
$conn = mysqli_connect("localhost", "root", "", "paweb");

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
    $CPU = htmlspecialchars($data["CPU"]);
    $GPU = htmlspecialchars($data["GPU"]);
    $RAM = htmlspecialchars($data["RAM"]);
    $battery = htmlspecialchars($data["battery"]);
    $harga = htmlspecialchars($data["harga"]);
    $link = htmlspecialchars($data["link"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false; // insert tidak dijalankan
    }

    $query = "INSERT INTO laptop VALUES
            ('', '$merk', '$gambar', '$CPU', 
            '$GPU','$RAM','$battery','$harga','$link')
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
        return false;
    }

    // cek apakah yang diunggah gambar atau bukan agar user hanya unggah gambar
    // yang bisa diunggah cuma bentuk jpg dll
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'webp'];
    // explode = memecah string menjadi array
    // explode->contoh nama gambar saat upload adalah gambar.jpg nanti diubah jadi ['gambar', 'jpg']
    $ekstensiGambar = explode('.', $namaFile);
    // buat ambil format gambar saja seperti jpg, jpeg dll
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // cek apakah format yang diunggah termasuk yang diperbolehkan di ekstensiGambarValid
    // in_array = apakah ada sebuah string dalam array
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Silakan unggah gambar dengan format png, jpg, webp atau jpeg')</script>";
        return false;
    }
    // cek ukuran gambar
    if ($ukuranFile > 5000000) {
        echo "<script>alert('Ukuran gambar terlalu besar. Ukuran maksimal adalah 5 MB')</script>";
        return false;
    }

    // generate nama file baru untuk file yang diunggah agar tidak ada duplikasi
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;

    // masukkan ke direktori
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return 'img/' . $namaFileBaru;
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
    $CPU = htmlspecialchars($data["CPU"]);
    $GPU = htmlspecialchars($data["GPU"]);
    $RAM = htmlspecialchars($data["RAM"]);
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
            CPU = '$CPU',
            GPU = '$GPU',
            RAM = '$RAM',
            battery = '$battery',
            harga = '$harga',
            link = '$link'
            WHERE ID = $id
    ";

    mysqli_query($conn, $query);

    // jika gagal -1, jika berhasil 1
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM laptop WHERE merk LIKE '%$keyword%' 
    OR CPU LIKE '%$keyword%' 
    OR GPU LIKE '%$keyword%'
    OR RAM LIKE '%$keyword%'
    OR battery LIKE '%$keyword%'
    OR harga LIKE '%$keyword%'
    OR ID LIKE '%$keyword%'
    ";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    // stripslashes untuk backslash dll biar ga masuk ke database
    // strtolower agar input jadi huruf kecil karena biasanya username ga case sensitive
    // htmlspecialchar untuk mastiin user ga input yang aneh2
    $username = htmlspecialchars(strtolower(stripslashes($data["username"])));
    // mysqli_real_escape_string memungkinkan user input password dengan tanda kutip
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = htmlspecialchars($data["email"]);

    // cek apakah username udah ada
    $result = mysqli_query($conn, "SELECT username FROM 
    user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar.')
        </script>";
        return false; // agar insert tidak terjadi
    }

    if ($password != $password2) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai!')
        </script>";
        return false;
    }

    // enkripsi password
    // PASSWORD DEFAULT dipilih oleh php dan akan terus update jika ada cara yang baru
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$email')");

    return mysqli_affected_rows($conn);
}

function request($req)
{
    global $conn;
    $username = htmlspecialchars($req["username"]);
    $request_data = htmlspecialchars($req["request_data"]);

    $result = mysqli_query($conn, "SELECT username FROM 
    user WHERE username = '$username'");

    // cek username ada di database apa enggak
    if (!mysqli_fetch_assoc($result)) {
        return false; // agar insert tidak terjadi
    }

    $query = "INSERT INTO request (username, request_data) VALUES ('$username', '$request_data')";

    if (!mysqli_query($conn, $query)) {
        die("Query error: " . mysqli_error($conn));
    }

    // jika gagal -1, jika berhasil 1
    return mysqli_affected_rows($conn);
}

function hapus_req($id_req)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM request WHERE id_req = $id_req");
    return mysqli_affected_rows($conn);
}

function ganti_pw($data)
{
    global $conn;

    $email = htmlspecialchars($data['email']);
    $passwordNew = password_hash($data['passwordNew'], PASSWORD_DEFAULT);

    $query = "UPDATE user SET password = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $passwordNew, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // jika gagal -1, jika berhasil 1
    return mysqli_stmt_affected_rows($stmt);
}

// fungsi untuk menginiliasisasi nilai dari CPU atau GPU dari hasil benchmark secara umum, memungkinkan nilai maana yang dapat diunggulkan jika keduanya dibandingkan.
function get_cpu_score($cpu) {
    $benchmarks = [
        'Intel Core i9 14900HX' => 950,
        'AMD Ryzen 5 7430U' => 550,
        'Intel Core i5-12450H' => 600,
        'Intel Core i3 1315U CPU' => 400,
        'Apple M2 Chip' => 900
    ];
    return $benchmarks[$cpu] ?? 0;
}

function get_gpu_score($gpu) {
    $benchmarks = [
        'NVIDIA GeForce RTX 4060' => 900,
        'Intel UHD Graphics' => 300,
        'AMD Radeon™ Graphics' => 450,
        'Intel UHD 64EU' => 320,
        'Intel® UHD Graphics 600' => 250
    ];
    return $benchmarks[$gpu] ?? 0;
}
