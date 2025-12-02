<?php
session_start();
include '../../koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$hashed_password', '$role')";

$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('User baru berhasil ditambahkan!'); window.location.href = 'users.php';</script>";
}