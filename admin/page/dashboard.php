<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
 header("Location: ../../auth/page/login.php");
 exit();
}

$query_jlh_karyawan = "SELECT COUNT(*) AS total_karyawan FROM users WHERE role='karyawan'";
$result = mysqli_query($conn, $query_jlh_karyawan);
$total_karyawan = mysqli_fetch_assoc($result);

$query_jlh_pengajuan = "SELECT COUNT(*) AS total_pengajuan FROM layanan_kesehatan WHERE status = 'diajukan'";
$result = mysqli_query($conn, $query_jlh_pengajuan);
$total_pengajuan = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Dashboard Admin</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Admin Panel</div>

  <ul class="menu">
   <li class="active">Dashboard</li>
   <li onclick="location.href='layanan_kesehatan.php'">Layanan Kesehatan</li>
   <li onclick="location.href='karyawan.php'">Data Karyawan</li>
   <li onclick="location.href='users.php'">Users</li>
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
    <h3>Karyawan</h3>
    <p><?= $total_karyawan['total_karyawan'] ?> terdaftar</p>
   </div>

   <div class="card">
    <h3>Pengajuan</h3>
    <p><?= $total_pengajuan['total_pengajuan'] ?> pending</p>
   </div>
  </div>
 </div>

</body>

</html>