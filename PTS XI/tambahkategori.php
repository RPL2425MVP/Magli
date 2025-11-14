<?php
include "functionkategori.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id_kategori'];
    $nama = $_POST['nama_kategori'];

    if (tambahKategori($id, $nama)) {
        echo "<script>alert('Kategori berhasil ditambahkan'); window.location='indexkategori.php';</script>";
    } else {
        echo "Gagal menambah kategori!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background:#f4f6f9; 
            text-align:center; 
            padding:30px; 
        }
        .container {
            display:inline-block;
            background:white; 
            padding:20px; 
            border-radius:8px; 
            box-shadow:0 4px 8px rgba(0,0,0,0.1); 
            text-align:left;
        }
        input { 
            width:100%; 
            padding:8px; 
            margin:5px 0 15px; 
            border:1px solid #ddd; 
            border-radius:5px; 
        }
        button, a {
            display:inline-block; 
            padding:10px 20px; 
            border:none; 
            border-radius:5px;
            font-weight:bold; 
            cursor:pointer; 
            text-decoration:none;
            margin-top:10px;
        }
        button { background:#28a745; color:white; }
        button:hover { background:#218838; }
        a { background:#007BFF; color:white; }
        a:hover { background:#0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Kategori</h2>
        <form method="post">
            <label>ID Kategori:</label><br>
            <input type="text" name="id_kategori" required><br>
            
            <label>Nama Kategori:</label><br>
            <input type="text" name="nama_kategori" required><br>
            
            <button type="submit" name="submit">Simpan</button>
            <a href="../PTS XI/index.php">Home</a>
        </form>
    </div>
</body>
</html>
