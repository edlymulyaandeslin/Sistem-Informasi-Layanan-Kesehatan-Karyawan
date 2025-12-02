<?php
session_start();
include '../../koneksi.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
 header("Location: ../../auth/page/login.php");
 exit();
}

if (!isset($_GET['id'])) {
 echo "ID layanan tidak ditemukan.";
 exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT lk.*, k.nama_karyawan 
          FROM layanan_kesehatan lk
          JOIN karyawan k ON lk.karyawan_id = k.id
          WHERE lk.id = '$id'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
 echo "Data tidak ditemukan.";
 exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
 <meta charset="UTF-8">
 <title>Cetak Layanan Kesehatan</title>

 <style>
 body {
  font-family: Arial, sans-serif;
  padding: 25px;
  color: #222;
  line-height: 1.6;
 }

 .print-container {
  border: 2px solid #000;
  padding: 25px 35px;
  border-radius: 8px;
 }

 .title {
  text-align: center;
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 25px;
 }

 .info-table {
  width: 100%;
  border-collapse: collapse;
 }

 .info-table td {
  padding: 10px 5px;
  vertical-align: top;
  border-bottom: 1px solid #dcdcdc;
 }

 .label {
  font-weight: bold;
  width: 180px;
 }

 .btn-back {
  display: inline-block;
  margin-top: 25px;
  padding: 8px 14px;
  background: #3498db;
  color: white;
  text-decoration: none;
  border-radius: 4px;
 }

 @media print {
  .btn-back {
   display: none;
  }
 }
 </style>
</head>

<body onload="window.print()">

 <div class="print-container">

  <div class="title">
   Bukti Pengajuan Layanan Kesehatan
  </div>

  <table class="info-table">
   <tr>
    <td class="label">No Layanan</td>
    <td>: <?= $data['no_layanan'] ?></td>
   </tr>
   <tr>
    <td class="label">Nama Karyawan</td>
    <td>: <?= $data['nama_karyawan'] ?></td>
   </tr>
   <tr>
    <td class="label">Tanggal Berobat</td>
    <td>: <?= $data['tanggal_berobat'] ?></td>
   </tr>
   <tr>
    <td class="label">Umur</td>
    <td>: <?= $data['umur'] ?> tahun</td>
   </tr>
   <tr>
    <td class="label">Alamat</td>
    <td>: <?= $data['alamat'] ?></td>
   </tr>
   <tr>
    <td class="label">Jenis Layanan</td>
    <td>: <?= $data['jenis_layanan'] ?></td>
   </tr>
   <tr>
    <td class="label">Keterangan</td>
    <td>: <?= $data['deskripsi'] ?></td>
   </tr>
   <tr>
    <td class="label">Status</td>
    <td>: <?= ucfirst($data['status']) ?></td>
   </tr>
  </table>

 </div>

 <a href="layanan_kesehatan.php" class="btn-back">Kembali</a>

</body>

</html>