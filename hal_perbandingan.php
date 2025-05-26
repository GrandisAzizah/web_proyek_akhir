<?php

include "functions.php";
$koneksi=$conn;

$laptop1 = $_GET['laptop1'];
$laptop2 = $_GET['laptop2'];

$stmt1 = $conn->prepare("SELECT * FROM laptop WHERE merk LIKE ? LIMIT 1");
// mencegah sql injection dan menormalisasikan input
$search1 = "%" . $laptop1 . "%";
$stmt1->bind_param("s", $search1);
$stmt1->execute();
$result1 = $stmt1->get_result();
$row1 = $result1->fetch_assoc();

$stmt2 = $conn->prepare("SELECT * FROM laptop WHERE merk LIKE ? LIMIT 1");
$search2 = "%" . $laptop2 . "%";
$stmt2->bind_param("s", $search2);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();

// mengubah angka 
function extractMaxNumber($str) {
    preg_match_all('/\d+/', $str, $matches);
    return isset($matches[0]) ? max($matches[0]) : 0;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .highlight { background-color: #cfc; }
        table { border-collapse: collapse; margin-top: 10px; width: 100%; }
        th, td { border: 1px solid #999; padding: 6px 12px; text-align: center; }
        img { width: 150px; }
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
    </style>
    <title>Document</title>
</head>
<body style="background-color: whitesmoke;">
<!-- "background: linear-gradient(90deg, #46176E 0%, #692B9C 50%, #A043E7 100%);" -->
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
  
<div class="container" style="background:whitesmoke">
<?php if ($row1 && $row2): ?>
<h2 class="container d-flex justify-content-center"><?= $row1['merk'] ?> vs <?= $row2['merk'] ?></h2>
<table>
    <tr><th><?= $row1['merk'] ?></th><th><?= $row2['merk'] ?></th></tr>
    <tr><td><img src="/appwd/<?= $row1['gambar'] ?>" width="200"></td><td><img src="/appwd/<?= $row2['gambar'] ?>" width="200"></td></tr>

    <tr>
    <?php
    $score1 = get_cpu_score($row1['CPU']);
    $score2 = get_cpu_score($row2['CPU']);
    echo $score1 > $score2
        ? "<td class='highlight'>{$row1['CPU']}</td><td>{$row2['CPU']}</td>"
        : ($score2 > $score1
            ? "<td>{$row1['CPU']}</td><td class='highlight'>{$row2['CPU']}</td>"
            : "<td>{$row1['CPU']}</td><td>{$row2['CPU']}</td>");
    ?>
    </tr>

    <tr>
    <?php
    $g1 = get_gpu_score($row1['GPU']);
    $g2 = get_gpu_score($row2['GPU']);
    echo $g1 > $g2
        ? "<td class='highlight'>{$row1['GPU']}</td><td>{$row2['GPU']}</td>"
        : ($g2 > $g1
            ? "<td>{$row1['GPU']}</td><td class='highlight'>{$row2['GPU']}</td>"
            : "<td>{$row1['GPU']}</td><td>{$row2['GPU']}</td>");
    ?>
    </tr>

    <?php
    $fitur = ['RAM', 'battery', 'harga'];
    foreach ($fitur as $f) {
        $versus1 = extractMaxNumber($row1[$f]);
        $versus2 = extractMaxNumber($row2[$f]);
       
        if ($f == 'harga') {
            if ($versus1 < $versus2) {
                echo "<td class='highlight'>{$row1[$f]}</td><td>{$row2[$f]}</td>";
            } elseif ($versus1 > $versus2) {
                echo "<td>{$row1[$f]}</td><td class='highlight'>{$row2[$f]}</td>";
            } else {
                echo "<td>{$row1[$f]}</td><td>{$row2[$f]}</td>";
            }
        } else {
            if ($versus1 > $versus2) {
                echo "<td class='highlight'>{$row1[$f]}</td><td>{$row2[$f]}</td>";
            } elseif ($versus1 < $versus2) {
                echo "<td>{$row1[$f]}</td><td class='highlight'>{$row2[$f]}</td>";
            } else {
                echo "<td>{$row1[$f]}</td><td>{$row2[$f]}</td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
<?php else: ?>
    <p style="color:red;">Salah satu atau kedua laptop tidak ditemukan.</p>
<?php endif; ?>


</div>
    
</body>
</html> 
