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
 <title>User Baru</title>

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
   User Baru
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="content">
   <h2 class="form-title">Silakan Isi Form</h2>
   <form action="proses_tambah_users.php" method="POST" class="full-form">
    <div class="input-group">
     <label for="nama">Nama</label>
     <input id="nama" name="nama" class="input-control" placeholder="Nama..." required />
    </div>

    <div class="input-group">
     <label for="email">Email</label>
     <input id="email" type="email" name="email" class="input-control" placeholder="Email..." required />
    </div>

    <div class="input-group">
     <label for="role">Role</label>
     <select id="role" name="role" required class="input-control">
      <option value="" selected disabled>— Pilih Role —</option>
      <option value="admin">Admin</option>
      <option value="karyawan">Karyawan</option>
     </select>
    </div>

    <div class="input-group">
     <label for="password">Password</label>
     <input id="password" type="password" name="password" class="input-control" placeholder="Password..." required />
    </div>

    <div class="btn-area">
     <button type="submit" class="btn-primary">Kirim</button>
     <a href="users.php" class="btn-cancel">Batal</a>
    </div>

   </form>
  </div>
 </div>


</body>

</html>