<?php

include '../koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password != $confirm_password) {
 echo "<script>alert('Password dan Konfirmasi Password tidak sesuai!'); window.location.href = 'page/register.php';</script>";
 exit();
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$hashed_password', 'karyawan')";

$result = mysqli_query($conn, $query);

if ($result) {
 echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = 'page/login.php';</script>";
} else {
 echo "<script>alert('Registrasi gagal! Silakan coba lagi.'); window.location.href = 'page/register.php';</script>";
}