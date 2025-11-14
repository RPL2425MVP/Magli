<?php
$host = "localhost";
$user = "root";     // default XAMPP
$pass = "";         // default XAMPP kosong
$db   = "db_rpl2425";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
