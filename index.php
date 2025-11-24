<?php
session_start();

include 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    $route_name = '';
    if ($user['role'] == 'admin') {
        $route_name = '/admin/page/dashboard.php';
    } else {
        $route_name = '/karyawan/page/dashboard.php';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Sistem Informasi Layanan Kesehatan Karyawan</title>
 <link rel="stylesheet" href="index.css">
</head>

<body>
 <!-- NAVBAR -->
 <nav>
  <div class="logo">SILKK</div>

  <ul>
   <li>Beranda</li>
   <li>Layanan</li>
   <li>Kontak</li>
   <li>Tentang</li>
  </ul>

  <!-- TOMBOL LOGIN -->
  <?php if (isset($_SESSION['user_id'])) { ?>
  <a href="<?= $route_name ?>" class="login-btn">Dashboard</a>
  <?php } else { ?>
  <a href="/auth/page/login.php" class="login-btn">Login</a>
  <?php } ?>
 </nav>

 <!-- HERO -->
 <section class="hero">
  <h1>Sistem Informasi Layanan Kesehatan Karyawan</h1>
  <p>Mengelola data kesehatan karyawan secara cepat, aman, dan profesional.</p>
 </section>

 <!-- MENU -->
 <div class="container">

  <div class="card" onclick="location.href='data_karyawan.php'">
   <div class="icon">👨‍💼</div>
   <h3>Data Karyawan</h3>
   <p>Kelola data karyawan perusahaan dengan mudah.</p>
  </div>

  <div class="card" onclick="location.href='laporan.php'">
   <div class="icon">📊</div>
   <h3>Laporan & Statistik</h3>
   <p>Pantau tren kesehatan karyawan secara berkala.</p>
  </div>


  <div class="card" onclick="location.href='layanan.php'">
   <div class="icon">📋</div>
   <h3>Layanan Kesehatan</h3>
   <p>Pengajuan, verifikasi, dan monitoring layanan.</p>
  </div>

 </div>

 <footer>
  © <?= date('Y') ?> Sistem Informasi Layanan Kesehatan Karyawan • All Rights Reserved
 </footer>

</body>

</html>