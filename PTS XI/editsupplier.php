
<?php include 'koneksikategori.php'; ?>
<?php
// Cek apakah ada ID di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Supplier tidak ditemukan!");
}
$id = $_GET['id'];

// Ambil data supplier berdasarkan ID
$result = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data supplier tidak ditemukan!");
}

// Proses update data supplier
if (isset($_POST['update'])) {
    $nama   = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telp   = $_POST['no_telp'];

    $query = "UPDATE supplier 
              SET nama_supplier='$nama', alamat='$alamat', no_telp='$telp' 
              WHERE id_supplier='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location='indexsupplier.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f9; }
        .container {
            width: 380px; margin:40px auto; background:white; 
            padding:20px; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.1);
        }
        h2 { text-align:center; margin-bottom:20px; }
        label { font-weight:bold; }
        input, textarea {
            width:100%; padding:10px; margin:8px 0; border:1px solid #ddd; border-radius:5px;
        }
        button {
            padding:10px; width:100%; border:none; border-radius:5px;
            background:#28a745; color:white; font-weight:bold; cursor:pointer;
        }
        button:hover { background:#218838; }
        a {
            display:block; margin-top:10px; text-align:center; text-decoration:none; 
            color:#333; font-size:14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Supplier</h2>
        <form method="POST">
            <label>ID Supplier:</label><br>
            <input type="text" name="id_supplier" value="<?= $data['id_supplier']; ?>" readonly><br>
            
            <label>Nama Supplier:</label><br>
            <input type="text" name="nama_supplier" value="<?= $data['nama_supplier']; ?>" required><br>
            
            <label>Alamat:</label><br>
            <textarea name="alamat" required><?= $data['alamat']; ?></textarea><br>
            
            <label>No. Telp:</label><br>
            <input type="text" name="no_telp" value="<?= $data['no_telp']; ?>" required><br>
            
            <button type="submit" name="update">Simpan Perubahan</button>
            <a href="indexsupplier.php">Kembali</a>
        </form>
    </div>
</body>
</html>
```
