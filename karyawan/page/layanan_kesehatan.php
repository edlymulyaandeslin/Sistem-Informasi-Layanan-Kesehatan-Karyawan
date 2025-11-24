<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Dashboard Admin</title>

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
   Layanan Kesehatan
   <a href="../../auth/proses_logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="cards">
   <div class="card">
    <h3>Karyawan</h3>
    <p>358 terdaftar</p>
   </div>

   <div class="card">
    <h3>Pengajuan</h3>
    <p>32 pending</p>
   </div>

   <div class="card">
    <h3>Laporan</h3>
    <p>Tersedia bulan ini</p>
   </div>
  </div>
 </div>

</body>

</html>