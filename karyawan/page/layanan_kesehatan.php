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

$query = "SELECT * FROM layanan_kesehatan WHERE karyawan_id = '{$karyawan['id']}'";
$result = mysqli_query($conn, $query);
$layanan = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Layanan Kesehatan</title>

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
   <h2>Layanan Kesehatan</h2>
   <div>
    <a href="tambah_pengajuan.php" class="btn-primary">+ Tambah Pengajuan</a>
    <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
   </div>
  </div>

  <!-- CONTENT WRAPPER -->
  <div class="content">

   <div class="card">
    <h3>Daftar Pengajuan</h3>

    <table class="data-table">
     <thead>
      <tr>
       <th>No</th>
       <th>No Layanan</th>
       <th>Tanggal Berobat</th>
       <th>Umur</th>
       <th>Alamat</th>
       <th>Jenis Layanan</th>
       <th>Keterangan</th>
       <th>Status</th>
       <th>Aksi</th>
      </tr>
     </thead>

     <tbody>
      <?php foreach ($layanan as $index => $item) { ?>
      <tr :key="$index">
       <td><?= $index + 1 ?></td>
       <td><?= $item['no_layanan'] ?></td>
       <td><?= $item['tanggal_berobat'] ?></td>
       <td><?= $item['umur'] ?></td>
       <td><?= $item['alamat'] ?></td>
       <td><?= $item['jenis_layanan'] ?></td>
       <td><?= $item['deskripsi'] ?></td>
       <td>
        <span class="status 
    <?= $item['status'] == 'diajukan' ? 'status-pending' : ($item['status'] == 'disetujui' ? 'status-approved' : 'status-rejected') ?>
  ">
         <?= $item['status'] ?>
        </span>
       </td>
       <td>
        <?php if ($item['status'] == 'disetujui') { ?>
        <a href="cetak.php?id=<?= $item['id'] ?>" class="btn-small">Cetak</a>
        <?php } ?>

        <a href="proses_hapus_pengajuan.php?id=<?= $item['id'] ?>" class="btn-small">Delete</a>
       </td>
      </tr>
      <?php } ?>

     </tbody>

    </table>
   </div>
  </div>
 </div>
 </div>
</body>

</html>