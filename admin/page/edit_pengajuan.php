<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM layanan_kesehatan WHERE id = $id";
$result = mysqli_query($conn, $query);
$layanan = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Edit Pengajuan</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Admin Panel</div>

  <ul class="menu">
   <li onclick="location.href='dashboard.php'">Dashboard</li>
   <li class="active">Layanan Kesehatan</li>
   <li onclick="location.href='karyawan.php'">Data Karyawan</li>
   <li onclick="location.href='users.php'">Users</li>
  </ul>
 </div>

 <!-- MAIN CONTENT -->
 <div class="main">
  <div class="header">
   Edit Pengajuan
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="content">

   <h2 class="form-title">Update Form</h2>

   <form action="proses_update_pengajuan.php?id=<?= $layanan['id'] ?>" method="POST" class="full-form">
    <div class="input-group">
     <label for="tanggal_berobat">Tanggal Berobat</label>
     <input id="tanggal_berobat" type="date" name="tanggal_berobat" class="input-control" required
      value="<?= $layanan['tanggal_berobat'] ?>" />
    </div>

    <div class="input-group">
     <label for="umur">Umur</label>
     <input id="umur" type="number" name="umur" class="input-control" placeholder="Umur..." required
      value="<?= $layanan['umur'] ?>" />
    </div>

    <div class="input-group">
     <label for="alamat">Alamat</label>
     <textarea id="alamat" name="alamat" rows="4" class="input-control" placeholder="Alamat..."
      required><?= $layanan['alamat'] ?></textarea>
    </div>

    <div class="input-group">
     <label for="jenis_layanan">Jenis Layanan</label>
     <select id="jenis_layanan" name="jenis_layanan" required class="input-control">
      <option value="" disabled <?= empty($layanan['jenis_layanan']) ? 'selected' : '' ?>>— Pilih Layanan —</option>
      <option value="general check-up" <?= ($layanan['jenis_layanan'] == 'general check-up') ? 'selected' : '' ?>>
       Pemeriksaan Dasar / General Check-Up</option>
      <option value="pemeriksaan gigi" <?= ($layanan['jenis_layanan'] == 'pemeriksaan gigi') ? 'selected' : '' ?>>
       Pemeriksaan Gigi</option>
      <option value="pemeriksaan tht" <?= ($layanan['jenis_layanan'] == 'pemeriksaan tht') ? 'selected' : '' ?>>
       Pemeriksaan THT</option>
      <option value="pemeriksaan kesehatan kerja"
       <?= ($layanan['jenis_layanan'] == 'pemeriksaan kesehatan kerja') ? 'selected' : '' ?>>Pemeriksaan Kesehatan Kerja
       (MCU)</option>
     </select>
    </div>

    <div class="input-group">
     <label for="deskripsi">Deskripsi</label>
     <textarea id="deskripsi" name="deskripsi" rows="4" class="input-control" placeholder="Tuliskan keluhan..."
      required><?= $layanan['deskripsi'] ?></textarea>
    </div>

    <div class="input-group">
     <label for="status">Status</label>
     <select id="status" name="status" required class="input-control">
      <option value="" disabled <?= empty($layanan['status']) ? 'selected' : '' ?>>— Pilih Layanan —</option>
      <option value="diajukan" <?= ($layanan['status'] == 'diajukan') ? 'selected' : '' ?>>Diajukan
      </option>
      <option value="disetujui" <?= ($layanan['status'] == 'disetujui') ? 'selected' : '' ?>>Disetujui
      </option>
      <option value="ditolak" <?= ($layanan['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak
      </option>
     </select>
    </div>

    <div class="btn-area">
     <button type="submit" class="btn-primary">Update Pengajuan</button>
     <a href="layanan_kesehatan.php" class="btn-cancel">Batal</a>
    </div>

   </form>
  </div>
 </div>


</body>

</html>