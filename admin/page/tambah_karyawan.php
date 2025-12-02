<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/page/login.php");
  exit();
}

$query = "SELECT * FROM users WHERE role = 'karyawan'";
$result = mysqli_query($conn, $query);
$users_karyawan_role = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Karyawan Baru</title>

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
   Karyawan Baru
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="content">
   <h2 class="form-title">Silakan Isi Form</h2>
   <form action="proses_tambah_karyawan.php" method="POST" class="full-form">
    <div class="input-group">
     <label for="user_id">User</label>
     <select id="user_id" name="user_id" required class="input-control">
      <option value="" selected disabled>— Pilih User —</option>
      <?php foreach ($users_karyawan_role as $user) : ?>
      <option value="<?= $user['id'] ?>"><?= $user['nama'] ?></option>
      <?php endforeach; ?>
     </select>
    </div>

    <div class="input-group">
     <label for="no_erp">No ERP</label>
     <input id="no_erp" name="no_erp" class="input-control" placeholder="No ERP..." required />
    </div>

    <div class="input-group">
     <label for="jabatan">Jabatan</label>
     <input id="jabatan" type="text" name="jabatan" class="input-control" placeholder="Jabatan..." required />
    </div>

    <div class="input-group">
     <label for="agama">Agama</label>
     <select id="agama" name="agama" required class="input-control">
      <option value="" selected disabled>— Pilih Agama —</option>
      <option value="islam">Islam</option>
      <option value="kristen">Kristen</option>
      <option value="hindu">Hindu</option>
      <option value="budha">Budha</option>
      <option value="konghucu">Konghucu</option>
     </select>
    </div>

    <div class="input-group">
     <label for="tanggal_lahir">Tanggal lahir</label>
     <input id="tanggal_lahir" type="date" name="tanggal_lahir" class="input-control" required />
    </div>

    <div class="input-group">
     <label for="pendidikan">Pendidikan Terakhir</label>
     <select id="pendidikan" name="pendidikan" required class="input-control">
      <option value="" selected disabled>— Pilih Pendidikan —</option>
      <option value="sd">SD</option>
      <option value="smp">SMP</option>
      <option value="sma/smk">SMA/SMK</option>
      <option value="sarjana">Sarjana (S1/S2/S3)</option>
     </select>
    </div>

    <div class="btn-area">
     <button type="submit" class="btn-primary">Kirim</button>
     <a href="karyawan.php" class="btn-cancel">Batal</a>
    </div>
   </form>
  </div>
 </div>


</body>

</html>