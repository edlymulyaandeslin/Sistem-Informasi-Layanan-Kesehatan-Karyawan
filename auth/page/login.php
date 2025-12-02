<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login Page</title>
 <link rel="stylesheet" href="login.css">

</head>

<body>

 <div class="login-container">
  <div class="title">
   <a href="../../index.php">
    SILKK
   </a>
  </div>
  <div class="subtitle">

   Sistem Informasi Layanan Kesehatan Karyawan</div>

  <form action="../proses_login.php" method="POST">

   <div class="input-group">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" required placeholder="Masukkan email...">
   </div>

   <div class="input-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Masukkan password...">
   </div>

   <button type="submit" class="login-btn">Login</button>

   <!-- <div class="footer-text">
    Belum punya akun? <a href="register.php">Daftar disini</a>
   </div> -->
  </form>

 </div>

</body>

</html>