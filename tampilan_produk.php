<?php include 'functions.php'; 
$query = "SELECT * FROM laptop";
$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style> .nav-tengah {
      
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
    }</style>
</head>
<body>
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
        <a class="nav-link text-white"  href="login.php">Login</a>
      </div>
    </div>
  </nav>
  <div class="container d-flex justify-content: center" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
   <h2> Daftar Laptop Yang Tersedia</h2>
</div>
<!-- 
     $result = $conn->query("SELECT * FROM laptop ORDER BY ID DESC");
     while ($row = $result->fetch_assoc()) {
        echo "<div style='margin: 10px; display: inline-block;'>";
        echo "<strong>" . htmlspecialchars($row['merk']) . "</strong><br>";
     echo "<img src='/appwd/" . htmlspecialchars($row['gambar']) . "' width='200'><br>";
     echo "</div>";
    } -->

   <div class="container my-5">
   <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-5 g-4">

     <?php while ($laptop = mysqli_fetch_assoc($result)) : ?>
       <div class="col">
         <div class="card h-100 text-center border-0 shadow-sm">
           <img src="/appwd/<?= $laptop['gambar']; ?>" class="card-img-top img-fluid rounded" style="height: 200px; object-fit: cover;" alt="<?= $laptop['merk']; ?>">
           <div class="card-body">
             <h6 class="card-title mb-1 fw-semibold"><?= $laptop['merk']; ?></h6>
             <p class="text-muted mb-2">Rp <?= number_format($laptop['harga'], 0, ',', '.'); ?></p>
             <a href="<?= $laptop['link']; ?>" class="btn btn-outline-dark btn-sm" target="_blank">Lihat Produk</a>
           </div>
         </div>
       </div>
     <?php endwhile; ?>
  
     
    
</body>
</html>
