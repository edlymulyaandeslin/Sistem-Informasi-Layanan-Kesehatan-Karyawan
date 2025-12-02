<?php
session_start();
include '../../koneksi.php';

$id = $_GET['id'];

$nama = $_POST['nama'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = $_POST['password'];
if (!empty($password)) {
 $hashed_password = password_hash($password, PASSWORD_BCRYPT);
 $query = "UPDATE users SET nama='$nama', email='$email', role='$role', password='$hashed_password' WHERE id=$id";
} else {
 $query = "UPDATE users SET nama='$nama', email='$email', role='$role' WHERE id=$id";
}

$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('User berhasil diperbarui!'); window.location.href = 'users.php';</script>";
}