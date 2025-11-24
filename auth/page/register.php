<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Register Page</title>

 <link rel="stylesheet" href="register.css">
</head>

<body>

 <div class="register-container">
  <div class="title">
   <a href="../../index.php">
    SILKK
   </a>
  </div>
  <div class="subtitle">Sistem Informasi Layanan Kesehatan Karyawan</div>

  <form action="../proses_register.php" method="POST">

   <div class="input-group">
    <label for="nama">Nama Lengkap</label>
    <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap...">
   </div>

   <div class="input-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required placeholder="Masukkan email...">
   </div>

   <div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Masukkan password...">
   </div>

   <div class="input-group">
    <label for="confirm_password">Konfirmasi Password</label>
    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Ulangi password...">
   </div>

   <button type="submit" class="register-btn">Register</button>
  </form>

  <div class="footer-text">
   Sudah punya akun? <a href="login.php">Login disini</a>
  </div>

 </div>

</body>

</html>