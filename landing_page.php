<?php
include "functions.php";

$query = "SELECT * FROM laptop LIMIT 5";
$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <title>Compare</title>
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
    }

    .nav-tengah {
      
      border-radius: 12px;
      padding: 5px 10px;
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .nav-tengah .nav-link {
      color: white !important;
      padding: 5px 10px;
      border-radius: 8px;
      transition: 0.3s;
      border: 1px solid #ccc;
    }

    .nav-brand {

      font-weight: bold;
      font-size: 1.5rem;
      color: white !important;
      
    }

    .nav-tengah .nav-link:hover {
      background-color: #f0f0f0;
      color: #46176E !important;
    }

    .search-bar {
      max-width: 500px;
      margin: auto;
    }

    .compare-btn {
      max-width: 200px;
    }

    .main-heading {
      margin-top: 60px;
    }
    .form-control:focus,
    .form-control:hover {
    border-color: #692B9C;
    box-shadow: 0 0 0 0.25rem rgba(160, 67, 231, 0.25);
    }
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #46176E 0%, #692B9C 50%, #A043E7 100%);">
    <div class="container">
      <a class="nav-brand" href="landingpage.php">COMPARE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <!-- Menu navbar bagian tengah dengan background -->
        <div class="nav-tengah">
          
          <a class="nav-link" href="request.php">Request</a>
          <a class="nav-link" href="produk.php">Produk</a>
          <a class="nav-link" href="#">Konsultasi</a>
        </div>
      </div>
      <!-- Icon dan link login -->
      <div class="d-flex align-items-center">
        <i class="bi bi-person-circle text-white me-2"></i>
        <a class="nav-link text-white" style="font-weight: bold;" href="login.php">Login</a>
      </div>
    </div>
  </nav>

  <!-- konten utama -->
  <div class="content">
    <div class="container text-center main-heading">
      <h1>COMPARE NOW...</h1>
      <p>Tempat membandingkan peforma laptop dari segala aspek </p>

      <form method="get" class="d-flex search-bar mt-3" role="search" action="halperbandingan.php">
        <input class="form-control me-2" type="text" name="laptop1" placeholder=" Klik untuk bandingkan"><br><br>
        <input class="form-control me-2" type="text" name="laptop2" placeholder=" Isi disini juga"><br><br>
        <div class="mt-3">
          <button class="btn btn-outline-success compare-btn" type="submit" >Bandingkan</button>
        </div>
    </div>

    </form>
    <!-- Tombol Bandingkan -->

    <!-- Card yang menampilkan produk2-->
    <div class="container my-5">
      <h4 class="fw-bold">Lihat Produk</h4>
      <p class="text-muted">Klik untuk melihat produk di e-market resmi</p>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">

        <?php while ($laptop = mysqli_fetch_assoc($result)) : ?>
          <div class="col">
            <div class="card h-100 text-center border-0 shadow-sm">
              <img src="/appwd/<?= $laptop['gambar']; ?>" class="card-img-top img-fluid rounded" alt="<?= $laptop['merk']; ?>">
              <div class="card-body">
                <h6 class="card-title mb-1 fw-semibold"><?= $laptop['merk']; ?></h6>
                <p class="text-muted mb-2">Rp <?= number_format($laptop['harga'], 0, ',', '.'); ?></p>
                <a href="<?= $laptop['link']; ?>" class="btn btn-outline-dark btn-sm" target="_blank">Lihat Produk</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

      </div>
    </div>


    <!-- footer -->
    <footer class="bg-light text-center text-lg-start mt-auto">
      <div class="text-center p-3" style="background-color: #f1f1f1;">
        © 2025 Copyright:
        <a class="text-dark" href="#">compare.com</a>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
