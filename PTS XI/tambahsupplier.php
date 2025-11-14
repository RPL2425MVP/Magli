<?php include 'koneksikategori.php'; ?>
<?php
if (isset($_POST['simpan'])) {
    $id     = $_POST['id_supplier'];
    $nama   = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telp   = $_POST['no_telp'];

    $query = "INSERT INTO supplier (id_supplier, nama_supplier, alamat, no_telp) 
              VALUES ('$id', '$nama', '$alamat', '$telp')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Supplier berhasil ditambahkan'); window.location='indexsupplier.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #000000, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        textarea {
            resize: none;
        }
        .btn {
            display: inline-block;
            width: 48%;
            padding: 10px;
            text-align: center;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-simpan {
            background: #000;
            color: #fff;
        }
        .btn-simpan:hover {
            background: #333;
        }
        .btn-kembali {
            background: #fff;
            color: #000;
            border: 1px solid #000;
        }
        .btn-kembali:hover {
            background: #f1f1f1;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Supplier</h2>
        <form method="POST">
            <label>ID Supplier:</label>
            <input type="text" name="id_supplier" required>

            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" required>

            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>

            <label>No. Telp:</label>
            <input type="text" name="no_telp" required>

            <div class="btn-group">
                <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
                <a href="indexsupplier.php" class="btn btn-kembali">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
