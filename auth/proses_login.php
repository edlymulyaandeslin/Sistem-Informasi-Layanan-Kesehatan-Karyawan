<?php
include '../koneksi.php';

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Cek apakah user ada
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
 $data = mysqli_fetch_assoc($result);

 // Cek password 
 if (password_verify($password, $data['password'])) {
  // LOGIN BERHASIL
  session_start();
  $_SESSION['user_id'] = $data['id'];
  $_SESSION['nama'] = $data['nama'];

  if ($data['role'] === 'karyawan') {
   header("Location: ../karyawan/page/dashboard.php");
   exit;
  } else {
   header("Location: ../admin/page/dashboard.php");
   exit;
  }
 } else {
  echo "<script>alert('Password salah!'); window.location.href = 'page/login.php';</script>";
 }
} else {
 echo "<script>alert('Email tidak ditemukan!'); window.location.href = 'page/login.php';</script>";
}