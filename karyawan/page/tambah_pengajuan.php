<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Pengajuan Baru</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Karyawan Panel</div>

  <ul class="menu">
   <li onclick="location.href='dashboard.php'">Dashboard</li>
   <li class="active">Layanan Kesehatan</li>
  </ul>
 </div>

 <!-- MAIN CONTENT -->
 <div class="main">
  <div class="header">
   Pengajuan Baru
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="content">

   <h2 class="form-title">Silakan Isi Form</h2>

   <form action="proses_tambah_pengajuan.php" method="POST" class="full-form">
    <div class="input-group">
     <label for="jenis_layanan">Jenis Layanan</label>
     <select id="jenis_layanan" name="jenis_layanan" required class="input-control">
      <option value="" selected disabled>— Pilih Layanan —</option>
      <option value="Rawat Jalan">Rawat Jalan</option>
      <option value="Rawat Inap">Rawat Inap</option>
      <option value="Persalinan">Persalinan</option>
      <option value="Kacamata">Kacamata</option>
      <option value="MCU">MCU</option>
      <option value="Klaim Obat">Klaim Obat</option>
     </select>
    </div>

    <div class="input-group">
     <label for="deskripsi">Deskripsi</label>
     <textarea id="deskripsi" name="deskripsi" rows="4" class="input-control" placeholder="Tuliskan keluhan..."
      required></textarea>
    </div>

    <div class="btn-area">
     <button type="submit" class="btn-primary">Kirim Pengajuan</button>
     <a href="layanan_kesehatan.php" class="btn-cancel">Batal</a>
    </div>

   </form>
  </div>
 </div>


</body>

</html>