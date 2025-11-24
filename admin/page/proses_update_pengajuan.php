<?php
session_start();
include '../../koneksi.php';

$id = $_GET['id'];

$jenis_layanan = $_POST['jenis_layanan'];
$deskripsi = $_POST['deskripsi'];
$status = $_POST['status'];

$query = "UPDATE layanan_kesehatan SET jenis_layanan='$jenis_layanan', deskripsi='$deskripsi', status='$status' WHERE id=$id";
$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('Pengajuan berhasil diverifikasi!'); window.location.href = 'layanan_kesehatan.php';</script>";
}