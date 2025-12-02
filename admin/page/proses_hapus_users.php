<?php
include '../../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = '$id'";

mysqli_query($conn, $query);

echo "<script>alert('User berhasil dihapus!'); window.location.href = 'users.php';</script>";