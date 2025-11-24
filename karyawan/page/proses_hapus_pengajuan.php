<?php
include '../../koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM layanan_kesehatan WHERE id = '$id'";

mysqli_query($conn, $query);

echo "<script>alert('Pengajuan berhasil dihapus!'); window.location.href = 'layanan_kesehatan.php';</script>";