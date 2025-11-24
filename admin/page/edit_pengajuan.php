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
     <label for="jenis_layanan">Jenis Layanan</label>
     <select id="jenis_layanan" name="jenis_layanan" required class="input-control">
      <option value="" disabled <?= empty($layanan['jenis_layanan']) ? 'selected' : '' ?>>— Pilih Layanan —</option>

      <option value="Rawat Jalan" <?= ($layanan['jenis_layanan'] == 'Rawat Jalan') ? 'selected' : '' ?>>Rawat Jalan
      </option>
      <option value="Rawat Inap" <?= ($layanan['jenis_layanan'] == 'Rawat Inap') ? 'selected' : '' ?>>Rawat Inap
      </option>
      <option value="Persalinan" <?= ($layanan['jenis_layanan'] == 'Persalinan') ? 'selected' : '' ?>>Persalinan
      </option>
      <option value="Kacamata" <?= ($layanan['jenis_layanan'] == 'Kacamata') ? 'selected' : '' ?>>Kacamata</option>
      <option value="MCU" <?= ($layanan['jenis_layanan'] == 'MCU') ? 'selected' : '' ?>>MCU</option>
      <option value="Klaim Obat" <?= ($layanan['jenis_layanan'] == 'Klaim Obat') ? 'selected' : '' ?>>Klaim Obat
      </option>
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