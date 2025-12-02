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
    <input type="hidden" name="karyawan_id" value="<?= $karyawan['id'] ?>">
    <div class="input-group">
     <label for="tanggal_berobat">Tanggal Berobat</label>
     <input id="tanggal_berobat" type="date" name="tanggal_berobat" class="input-control" required />
    </div>

    <div class="input-group">
     <label for="umur">Umur</label>
     <input id="umur" type="number" name="umur" class="input-control" placeholder="Umur..." required />
    </div>

    <div class="input-group">
     <label for="alamat">Alamat</label>
     <textarea id="alamat" name="alamat" rows="4" class="input-control" placeholder="Alamat..." required></textarea>
    </div>

    <div class="input-group">
     <label for="jenis_layanan">Jenis Layanan</label>
     <select id="jenis_layanan" name="jenis_layanan" required class="input-control">
      <option value="" selected disabled>— Pilih Layanan —</option>
      <option value="general check-up">Pemeriksaan Dasar / General Check-Up</option>
      <option value="pemeriksaan gigi">Pemeriksaan Gigi</option>
      <option value="pemeriksaan tht">Pemeriksaan THT</option>
      <option value="pemeriksaan kesehatan kerja">Pemeriksaan Kesehatan Kerja (MCU)</option>
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