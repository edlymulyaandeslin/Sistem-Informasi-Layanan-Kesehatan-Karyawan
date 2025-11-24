<?php

$host = 'localhost';
$username = 'root';
$password = 159357;
$database = 'db_layanan_kesehatan';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
 die("Koneksi gagal: " . mysqli_connect_error());
}