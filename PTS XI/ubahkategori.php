<?php
include "functionkategori.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID kategori tidak ditemukan!");
}

$id = $_GET['id'];
$kategori = getKategori($id);

if (!$kategori) {
    die("Data kategori tidak ditemukan!");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_kategori'];
    if (ubahKategori($id, $nama)) {
        echo "<script>alert('Kategori berhasil diubah'); window.location='indexkategori.php';</script>";
    } else {
        echo "Gagal mengubah kategori!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Kategori</title>
</head>
<body>
    <h2>Ubah Kategori</h2>
    <form method="post">
        <label>ID Kategori:</label><br>
        <input type="text" value="<?= $kategori['id_kategori'] ?>" disabled><br><br>
        <label>Nama Kategori:</label><br>
        <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" required><br><br>
        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
