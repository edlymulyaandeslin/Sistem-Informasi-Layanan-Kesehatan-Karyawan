<?php
session_start();
include '../../koneksi.php';

$user_id = $_POST['user_id'];

// query to get user details
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$no_erp = $_POST['no_erp'];
$nama_karyawan = $user['nama'];
$jabatan = $_POST['jabatan'];
$agama = $_POST['agama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$pendidikan = $_POST['pendidikan'];

$query = "INSERT INTO karyawan (user_id, no_erp, nama_karyawan, jabatan, agama, tanggal_lahir, pendidikan) VALUES ('$user_id', '$no_erp', '$nama_karyawan', '$jabatan', '$agama', '$tanggal_lahir', '$pendidikan')";
$result = mysqli_query($conn, $query);

if ($result) {
 echo "<script>alert('Karyawan berhasil ditambahkan!'); window.location.href = 'karyawan.php';</script>";
}