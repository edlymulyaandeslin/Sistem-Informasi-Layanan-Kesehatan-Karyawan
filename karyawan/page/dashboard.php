<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/page/login.php");
    exit();
}

$query = "SELECT * from karyawan WHERE user_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($conn, $query);
$karyawan = mysqli_fetch_assoc($result);

$query_jlh_pengajuan = "
    SELECT COUNT(*) AS total_pengajuan 
    FROM layanan_kesehatan 
    WHERE karyawan_id = '{$karyawan['id']}'";

$result = mysqli_query($conn, $query_jlh_pengajuan);
$total_pengajuan = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Dashboard Karyawan</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Karyawan Panel</div>

  <ul class="menu">
   <li class="active">Dashboard</li>
   <li onclick="location.href='layanan_kesehatan.php'">Layanan Kesehatan</li>
  </ul>
 </div>

 <!-- MAIN CONTENT -->
 <div class="main">
  <div class="header">
   Dashboard
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>
  <div class="cards">
   <div class="card">
    <h3>Pengajuan</h3>
    <p><?= $total_pengajuan['total_pengajuan'] ?></p>
   </div>
  </div>
 </div>

</body>

</html>