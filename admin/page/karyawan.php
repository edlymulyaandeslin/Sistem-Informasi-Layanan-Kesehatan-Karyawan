<?php
session_start();
include '../../koneksi.php';

// Cek apakah kary sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}

$query = "SELECT * FROM karyawan";
$result = mysqli_query($conn, $query);
$karyawan = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Data Karyawan</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Admin Panel</div>

  <ul class="menu">
   <li onclick="location.href='dashboard.php'">Dashboard</li>
   <li onclick="location.href='layanan_kesehatan.php'">Layanan Kesehatan</li>
   <li class="active">Data Karyawan</li>
   <li onclick="location.href='users.php'">Users</li>
  </ul>
 </div>

 <!-- MAIN CONTENT -->
 <div class="main">
  <div class="header">
   <h2>Data Karyawan</h2>
   <div>
    <a href="tambah_karyawan.php" class="btn-primary">+ Tambah Karyawan</a>
    <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
   </div>
  </div>

  <!-- CONTENT WRAPPER -->
  <div class="content">
   <div class="card">
    <table class="data-table">
     <thead>
      <tr>
       <th>No</th>
       <th>No ERP</th>
       <th>Nama Karyawan</th>
       <th>Jabatan</th>
       <th>Agama</th>
       <th>Tanggal Lahir</th>
       <th>Pendidikan</th>
       <th>Aksi</th>
      </tr>
     </thead>

     <tbody>
      <?php foreach ($karyawan as $index => $kary) { ?>
      <tr :key="$index">
       <td><?= $index + 1 ?></td>
       <td><?= $kary['no_erp'] ?></td>
       <td><?= $kary['nama_karyawan'] ?></td>
       <td><?= $kary['jabatan'] ?></td>
       <td><?= $kary['agama'] ?></td>
       <td><?= $kary['tanggal_lahir'] ?></td>
       <td><?= $kary['pendidikan'] ?></td>
       <td>
        <a href="edit_karyawan.php?id=<?= $kary['id'] ?>" class="btn-small">Edit</a>
        <a href="proses_hapus_karyawan.php?id=<?= $kary['id'] ?>" class="btn-small">Delete</a>
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