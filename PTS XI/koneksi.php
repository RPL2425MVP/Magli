<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_rpl2425");

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
