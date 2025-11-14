<?php
include 'koneksi.php'; // pastikan koneksi sudah benar

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// --- Fungsi generate ID unik (VARCHAR 20) ---
function generateIDObat($koneksi) {
    $prefix = "OBT"; // prefix 3 karakter
    $query = "SELECT id_obat FROM obat WHERE id_obat LIKE '$prefix%' ORDER BY id_obat DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query generate ID gagal: " . mysqli_error($koneksi));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        $lastId = $row['id_obat']; 
        $num = (int)substr($lastId, strlen($prefix)); // ambil angka setelah prefix
        $num++;
    } else {
        $num = 1;
    }

    // pad angka supaya total panjang <= 20 karakter
    $idLength = 20 - strlen($prefix);
    return $prefix . str_pad($num, $idLength, "0", STR_PAD_LEFT);
}

// --- Jika form disubmit ---
if (isset($_POST['simpan'])) {
    $id_obat        = generateIDObat($koneksi);
    $nama_obat      = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
    $id_kategori    = intval($_POST['id_kategori']);
    $harga_jual     = floatval($_POST['harga_jual']);
    $harga_beli     = floatval($_POST['harga_beli']);
    $stok           = intval($_POST['stok']);
    $tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
    $id_supplier    = intval($_POST['id_supplier']);

    // Insert data
    $query = "INSERT INTO obat 
              (id_obat, nama_obat, id_kategori, harga_jual, harga_beli, stok, tgl_kadaluarsa, id_supplier) 
              VALUES 
              ('$id_obat', '$nama_obat', $id_kategori, $harga_jual, $harga_beli, $stok, '$tgl_kadaluarsa', $id_supplier)";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil ditambahkan. ID Obat: $id_obat'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Obat</title>
<style>
body {font-family: Arial, sans-serif; background: linear-gradient(to right, #74ebd5, #9face6); display:flex; justify-content:center; align-items:center; height:100vh; margin:0;}
.container {background:white; padding:30px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.2); width:400px;}
h2 {text-align:center; margin-bottom:20px; color:#333;}
input, select {width:100%; padding:10px; margin:8px 0; border:1px solid #ddd; border-radius:6px; font-size:14px;}
button {width:100%; padding:12px; background:#28a745; color:white; border:none; border-radius:6px; cursor:pointer; font-size:16px; font-weight:bold;}
button:hover {background:#218838;}
.btn-home {display:block; text-align:center; margin-top:12px; padding:10px; background:#007bff; color:white; border-radius:6px; text-decoration:none;}
.btn-home:hover {background:#0056b3;}
</style>
</head>
<body>
<div class="container">
<h2>Tambah Obat</h2>
<form method="POST">
    <input type="text" name="nama_obat" placeholder="Nama Obat" required>

    <label>Kategori</label>
    <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <?php
        $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
        while ($row = mysqli_fetch_assoc($kategori)) {
            echo "<option value='".$row['id_kategori']."'>".$row['nama_kategori']."</option>";
        }
        ?>
    </select>

    <input type="number" step="0.01" name="harga_jual" placeholder="Harga Jual" required>
    <input type="number" step="0.01" name="harga_beli" placeholder="Harga Beli" required>
    <input type="number" name="stok" placeholder="Stok" required>
    <input type="date" name="tgl_kadaluarsa" required>

    <label>Supplier</label>
    <select name="id_supplier" required>
        <option value="">-- Pilih Supplier --</option>
        <?php
        $supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($row = mysqli_fetch_assoc($supplier)) {
            echo "<option value='".$row['id_supplier']."'>".$row['nama_supplier']."</option>";
        }
        ?>
    </select>

    <button type="submit" name="simpan">Simpan</button>
</form>
<a href="index.php" class="btn-home">Home</a>
</div>
</body>
</html>
