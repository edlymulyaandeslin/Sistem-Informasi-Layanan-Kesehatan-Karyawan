<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../../koneksi.php';

$user_id = $_SESSION['user_id'];

$jenis_layanan = $_POST['jenis_layanan'];
$deskripsi = $_POST['deskripsi'];
$created_at = date('Y-m-d H:i:s');

$query = "INSERT INTO layanan_kesehatan (user_id, jenis_layanan, deskripsi, status, created_at) VALUES ('$user_id', '$jenis_layanan', '$deskripsi', 'diajukan', '$created_at')";

$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('Pengajuan berhasil dibuat!'); window.location.href = 'layanan_kesehatan.php';</script>";
}