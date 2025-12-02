<?php
session_start();
include '../../koneksi.php';

$id = $_GET['id'];

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

// update karyawan data
$query = "UPDATE karyawan SET user_id='$user_id', no_erp='$no_erp', nama_karyawan='$nama_karyawan', jabatan='$jabatan', agama='$agama', tanggal_lahir='$tanggal_lahir', pendidikan='$pendidikan' WHERE id=$id";

$result = mysqli_query($conn, $query);
if ($result) {
 echo "<script>alert('Karyawan berhasil diperbarui!'); window.location.href = 'karyawan.php';</script>";
}