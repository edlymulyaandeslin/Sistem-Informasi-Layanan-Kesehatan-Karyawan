<?php
include '../../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM karyawan WHERE id = '$id'";

mysqli_query($conn, $query);

echo "<script>alert('Karyawan berhasil dihapus!'); window.location.href = 'karyawan.php';</script>";