<?php
include "functionkategori.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID kategori tidak ditemukan!");
}

$id = $_GET['id'];

if (hapusKategori($id)) {
    echo "<script>alert('Kategori berhasil dihapus'); window.location='indexkategori.php';</script>";
} else {
    echo "Gagal menghapus kategori!";
}
?>
