<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Edit User</title>

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
   Edit User
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="content">
   <h2 class="form-title">Update Form</h2>
   <form action="proses_update_users.php?id=<?= $user['id'] ?>" method="POST" class="full-form">
    <div class="input-group">
     <label for="nama">Nama</label>
     <input id="nama" name="nama" class="input-control" placeholder="Nama..." required value="<?= $user['nama'] ?>" />
    </div>

    <div class="input-group">
     <label for="email">Email</label>
     <input id="email" type="email" name="email" class="input-control" placeholder="Email..." required
      value="<?= $user['email'] ?>" />
    </div>

    <div class="input-group">
     <label for="role">Role</label>
     <select id="role" name="role" required class="input-control">
      <option value="" selected disabled>— Pilih Role —</option>
      <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
      <option value="karyawan" <?= ($user['role'] == 'karyawan') ? 'selected' : '' ?>>Karyawan</option>
     </select>
    </div>

    <div class="input-group">
     <label for="password">New Password</label>
     <input id="password" type="password" name="password" class="input-control" placeholder="New Password..." />
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