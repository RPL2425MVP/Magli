<?php
include "functionkategori.php";
$kategori = getAllKategori();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 30px; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 70%; margin: 20px auto; background: #fff; }
        th, td { border: 1px solid #000; padding: 10px; text-align: center; }
        th { background: #000; color: white; }
        a.btn { padding: 6px 12px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        a.tambah { background: #28a745; color: white; }
        a.ubah { background: #ffc107; color: black; }
        a.hapus { background: #dc3545; color: white; }
        a.home { background: #17a2b8; color: white; }
        .menu { text-align:center; margin-bottom:15px; }
    </style>
</head>
<body>
    <h2>Data Kategori</h2>
    <div class="menu">
        <a href="tambahkategori.php" class="btn tambah">+ Tambah Kategori</a>
        <a href="../PTS XI/index.php" class="btn home">Home</a>
    </div>
    <table>
        <tr>
            <th>ID Kategori</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($kategori as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id_kategori']) ?></td>
            <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
            <td>
                <a href="ubahkategori.php?id=<?= $row['id_kategori'] ?>" class="btn ubah">Ubah</a>
                <a href="hapuskategori.php?id=<?= $row['id_kategori'] ?>" class="btn hapus" onclick="return confirm('Yakin hapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
