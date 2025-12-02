<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Data Users</title>

 <link rel="stylesheet" href="styles.css">
</head>

<body>

 <!-- SIDEBAR -->
 <div class="sidebar">
  <div class="brand">Admin Panel</div>

  <ul class="menu">
   <li onclick="location.href='dashboard.php'">Dashboard</li>
   <li onclick="location.href='layanan_kesehatan.php'">Layanan Kesehatan</li>
   <li onclick="location.href='karyawan.php'">Data Karyawan</li>
   <li class="active">Users</li>
  </ul>
 </div>

 <!-- MAIN CONTENT -->
 <div class="main">
  <div class="header">
   <h2>Data Users</h2>
   <div>
    <a href="tambah_users.php" class="btn-primary">+ Tambah User</a>
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
       <th>Nama</th>
       <th>Email</th>
       <th>Role</th>
       <th>Aksi</th>
      </tr>
     </thead>

     <tbody>
      <?php foreach ($users as $index => $user) { ?>
      <tr :key="$index">
       <td><?= $index + 1 ?></td>
       <td><?= $user['nama'] ?></td>
       <td><?= $user['email'] ?></td>
       <td><?= $user['role'] ?></td>
       <td>
        <a href="edit_users.php?id=<?= $user['id'] ?>" class="btn-small">Edit</a>
        <a href="proses_hapus_users.php?id=<?= $user['id'] ?>" class="btn-small">Delete</a>
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