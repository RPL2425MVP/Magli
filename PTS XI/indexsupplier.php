<?php include 'koneksikategori.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f9; padding:20px; }
        h2 { text-align:center; margin-bottom:20px; }
        table { border-collapse: collapse; width: 80%; margin: 0 auto; background:white; }
        th, td { border:1px solid #000; padding:10px; text-align:center; }
        th { background:#007BFF; color:white; }
        a.btn { padding:6px 12px; border-radius:5px; text-decoration:none; }
        .add { background:#28a745; color:white; }
        .edit { background:#ffc107; color:black; }
        .del { background:#dc3545; color:white; }
        .home { background:#17a2b8; color:white; }
    </style>
</head>
<body>
    <h2>Data Supplier</h2>
    <div style="text-align:center; margin-bottom:15px;">
        <a href="tambahsupplier.php" class="btn add">+ Tambah Supplier</a>
        <a href="index.php" class="btn home">Home</a>
    </div>
    <table>
        <tr>
            <th>ID Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id_supplier ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row['id_supplier']."</td>
                    <td>".$row['nama_supplier']."</td>
                    <td>".$row['alamat']."</td>
                    <td>".$row['no_telp']."</td>
                    <td>
                        <a href='editsupplier.php?id=".$row['id_supplier']."' class='btn edit'>Ubah</a>
                        <a href='hapussupplier.php?id=".$row['id_supplier']."' class='btn del' onclick='return confirm(\"Yakin mau hapus?\")'>Hapus</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>
</body>
</html>
