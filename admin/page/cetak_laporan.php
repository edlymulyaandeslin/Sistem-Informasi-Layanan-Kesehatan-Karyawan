<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['user_id'])) {
 header("Location: ../../auth/page/login.php");
 exit();
}

$start = isset($_GET['start']) ? $_GET['start'] : null;
$end   = isset($_GET['end']) ? $_GET['end'] : null;

function valid_date($d)
{
 $t = DateTime::createFromFormat('Y-m-d', $d);
 return $t && $t->format('Y-m-d') === $d;
}

if (!$start || !$end || !valid_date($start) || !valid_date($end)) {
 echo "Parameter tanggal tidak valid. Gunakan format YYYY-MM-DD.";
 exit();
}

$s = mysqli_real_escape_string($conn, $start);
$e = mysqli_real_escape_string($conn, $end);

$query = "SELECT k.nama_karyawan, lk.id, lk.no_layanan, lk.tanggal_berobat, lk.umur, lk.alamat, lk.jenis_layanan, lk.deskripsi, lk.status, lk.created_at
          FROM layanan_kesehatan AS lk
          INNER JOIN karyawan AS k ON lk.karyawan_id = k.id
          WHERE lk.tanggal_berobat BETWEEN '$s' AND '$e'
          ORDER BY lk.tanggal_berobat ASC";

$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// statistik sederhana
$stats = [
 'total' => count($rows),
 'diajukan' => 0,
 'disetujui' => 0,
 'ditolak' => 0,
];

foreach ($rows as $r) {
 $st = strtolower(trim($r['status']));
 if (isset($stats[$st])) $stats[$st]++;
}

$period = date('d-m-Y', strtotime($s)) . " s/d " . date('d-m-Y', strtotime($e));
$printedAt = date('d-m-Y H:i');
?>
<!DOCTYPE html>
<html lang="id">

<head>
 <meta charset="UTF-8">
 <title>Cetak Laporan Layanan Kesehatan — <?= htmlspecialchars($period) ?></title>
 <meta name="viewport" content="width=device-width,initial-scale=1">
 <style>
 /* Page setup */
 @page {
  size: A4;
  margin: 18mm 12mm;
 }

 html,
 body {
  margin: 0;
  padding: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  color: #111;
 }

 body {
  background: #fff;
  -webkit-print-color-adjust: exact;
 }

 /* Outer card with border */
 .page {
  box-sizing: border-box;
  border: 1px solid #222;
  padding: 18px 20px;
  border-radius: 4px;
  margin: 10px auto;
 }

 /* Header */
 .header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  gap: 12px;
  margin-bottom: 10px;
 }

 .title {
  font-size: 16px;
  font-weight: 700;
  letter-spacing: 0.6px;
 }

 .meta {
  text-align: right;
  font-size: 12px;
  color: #333;
 }

 /* Summary stats */
 .stats {
  display: flex;
  gap: 12px;
  margin: 12px 0 8px;
  flex-wrap: wrap;
 }

 .stat {
  background: transparent;
  border: 1px solid #ddd;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 13px;
  min-width: 120px;
  text-align: center;
 }

 .stat .n {
  font-weight: 700;
  font-size: 15px;
  display: block;
  margin-bottom: 4px;
 }

 /* Table */
 table.report {
  width: 100%;
  border-collapse: collapse;
  margin-top: 8px;
  font-size: 12.8px;
  page-break-inside: auto;
 }

 table.report thead {
  background: #f6f6f6;
  display: table-header-group;
 }

 table.report thead th {
  padding: 8px 10px;
  border: 1px solid #cfcfcf;
  font-weight: 600;
  text-align: left;
 }

 table.report tbody td {
  padding: 8px 10px;
  border: 1px solid #e0e0e0;
  vertical-align: top;
 }

 table.report tbody tr:nth-child(odd) {
  background: #fff;
 }

 table.report tbody tr:nth-child(even) {
  background: #fbfbfb;
 }

 /* Narrow column widths */
 .col-no {
  width: 36px;
  text-align: center;
 }

 .col-no-layanan {
  width: 120px;
 }

 .col-tgl {
  width: 100px;
 }

 .col-umur {
  width: 60px;
  text-align: center;
 }

 .col-status {
  width: 90px;
  text-align: center;
 }

 /* Footer (printed at bottom of page content) */
 .footer {
  margin-top: 12px;
  font-size: 12px;
  color: #333;
  display: flex;
  justify-content: space-between;
  align-items: center;
 }

 /* Page break handling for print */
 .page-break {
  page-break-after: always;
 }

 /* Hide UI not needed for print */
 .no-print {
  display: none !important;
 }

 /* Small screens preview adjustments */
 @media screen and (max-width: 900px) {
  .page {
   margin: 8px;
   padding: 12px;
  }

  .stats {
   gap: 8px;
  }

  table.report thead th,
  table.report tbody td {
   font-size: 13px;
   padding: 6px 8px;
  }
 }

 /* When printing: remove border radius to avoid white gap on some printers */
 @media print {
  .page {
   border-radius: 0;
  }
 }
 </style>
</head>

<body onload="window.print()">

 <div class="page">
  <div class="header">
   <div>
    <div class="title">LAPORAN LAYANAN KESEHATAN</div>
    <div style="font-size:13px; color:#333; margin-top:4px;">Periode: <?= htmlspecialchars($period) ?></div>
   </div>

   <div class="meta">
    Dicetak: <?= htmlspecialchars($printedAt) ?><br>
    Total: <?= $stats['total'] ?> record
   </div>
  </div>

  <div class="stats" role="status" aria-live="polite">
   <div class="stat">
    <span class="n"><?= $stats['total'] ?></span>
    <span>Semua</span>
   </div>

   <div class="stat">
    <span class="n"><?= $stats['disetujui'] ?></span>
    <span>Disetujui</span>
   </div>

   <div class="stat">
    <span class="n"><?= $stats['diajukan'] ?></span>
    <span>Diajukan</span>
   </div>

   <div class="stat">
    <span class="n"><?= $stats['ditolak'] ?></span>
    <span>Ditolak</span>
   </div>
  </div>

  <table class="report" role="table" aria-label="Laporan layanan kesehatan">
   <thead>
    <tr>
     <th class="col-no">No</th>
     <th class="col-no-layanan">No Layanan</th>
     <th>Nama Karyawan</th>
     <th class="col-tgl">Tgl Berobat</th>
     <th class="col-umur">Umur</th>
     <th>Alamat</th>
     <th>Jenis Layanan</th>
     <th>Keterangan</th>
     <th class="col-status">Status</th>
    </tr>
   </thead>
   <tbody>
    <?php if ($stats['total'] === 0): ?>
    <tr>
     <td colspan="9" style="text-align:center; padding:18px 8px;">Tidak ada data untuk periode ini.</td>
    </tr>
    <?php else: ?>
    <?php foreach ($rows as $i => $r): ?>
    <tr>
     <td class="col-no"><?= $i + 1 ?></td>
     <td class="col-no-layanan"><?= htmlspecialchars($r['no_layanan']) ?></td>
     <td><?= htmlspecialchars($r['nama_karyawan']) ?></td>
     <td class="col-tgl"><?= htmlspecialchars($r['tanggal_berobat']) ?></td>
     <td class="col-umur"><?= htmlspecialchars($r['umur']) ?></td>
     <td><?= htmlspecialchars($r['alamat']) ?></td>
     <td><?= htmlspecialchars($r['jenis_layanan']) ?></td>
     <td><?= nl2br(htmlspecialchars($r['deskripsi'])) ?></td>
     <td class="col-status"><?= htmlspecialchars(ucfirst($r['status'])) ?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
   </tbody>
  </table>


 </div>

 <!-- Optional back link for convenience (not printed) -->
 <div style="margin-top:10px; text-align:left;">
  <a href="laporan.php?start=<?= urlencode($s) ?>&end=<?= urlencode($e) ?>" class="no-print"
   style="text-decoration:none; color:#fff; background:#4a90e2; padding:8px 12px; border-radius:6px;">Kembali ke
   Pratinjau</a>
 </div>

</body>

</html>