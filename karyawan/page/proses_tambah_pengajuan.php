<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include '../../koneksi.php';


$karyawan_id = $_POST['karyawan_id'];

$query = "SELECT * FROM karyawan WHERE id = '$karyawan_id'";
$result = mysqli_query($conn, $query);
$karyawan = mysqli_fetch_assoc($result);

$no_layanan = 'LYN-' . date('Ymd')  . mt_rand(1000, 9999);
$nama_karyawan = $karyawan['nama_karyawan'];
$tanggal_berobat = $_POST['tanggal_berobat'];
$umur = $_POST['umur'];
$alamat = $_POST['alamat'];
$jenis_layanan = $_POST['jenis_layanan'];
$deskripsi = $_POST['deskripsi'];
$status = 'diajukan';
$created_at = date('Y-m-d H:i:s');

$query = "INSERT INTO layanan_kesehatan (karyawan_id, no_layanan, nama_karyawan, tanggal_berobat, umur, alamat, jenis_layanan, deskripsi, status, created_at) VALUES ('$karyawan_id', '$no_layanan', '$nama_karyawan', '$tanggal_berobat', '$umur', '$alamat', '$jenis_layanan', '$deskripsi', '$status', '$created_at')";

$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('Pengajuan berhasil dibuat!'); window.location.href = 'layanan_kesehatan.php';</script>";
}