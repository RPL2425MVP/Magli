<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Obat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #000;
        }
        h2 {
            text-align: center;
            color: #000;
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 14px;
            border: 1px solid #000;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            background: #fff;
            color: #000;
            transition: 0.3s;
        }
        .btn:hover {
            background: #000;
            color: #fff;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 95%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }
        th {
            background: #000;
            color: #fff;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .top-bar {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <h2>Daftar Obat</h2>
        <a href="../PTS XI/tambah obat.php"><button class="btn">+ Tambah Data Obat</button></a>
        <a href="tambahkategori.php"><button class="btn">+ Tambah Kategori</button></a>
        <a href="tambahsupplier.php"><button class="btn">+ Tambah Supplier</button></a>
        <a href="index.php"><button class="btn">🏠 Home</button></a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Obat</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Supplier</th>
            <th>No. Telp Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Ambil data obat + kategori + supplier (termasuk no_telp)
        $sql = "SELECT obat.*, kategori.nama_kategori, supplier.nama_supplier, supplier.no_telp 
                FROM obat
                LEFT JOIN kategori ON obat.id_kategori = kategori.id_kategori
                LEFT JOIN supplier ON obat.id_supplier = supplier.id_supplier
                ORDER BY obat.id_obat ASC";
        $result = mysqli_query($koneksi, $sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $row['id_obat']; ?></td>
                <td><?= $row['nama_obat']; ?></td>
                <td><?= $row['nama_kategori']; ?></td>
                <td>Rp<?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                <td>Rp<?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['tgl_kadaluarsa']; ?></td>
                <td><?= $row['nama_supplier']; ?></td>
                <td><?= $row['no_telp']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_obat'] ?>"><button class="btn">Ubah</button></a>
                    <a href="hapus.php?id=<?= $row['id_obat'] ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <button class="btn">Hapus</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
