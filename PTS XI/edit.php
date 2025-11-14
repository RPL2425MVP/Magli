
<?php
include 'koneksi.php';

// --- Ambil id dari URL dengan aman ---
$id = $_GET['id'] ?? null;



// --- Ambil data obat berdasarkan id ---
$stmt = $koneksi->prepare("SELECT * FROM obat WHERE id_obat = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Data obat dengan ID $id tidak ditemukan.");
}

$data = $result->fetch_assoc();

// --- Jika tombol update ditekan ---
if (isset($_POST['update'])) {
    $id_obat        = intval($_POST['id_obat']); // ambil dari input readonly
    $nama_obat      = trim($_POST['nama_obat']);
    $id_kategori    = intval($_POST['id_kategori']);
    $harga_jual     = floatval($_POST['harga_jual']);
    $harga_beli     = floatval($_POST['harga_beli']);
    $stok           = intval($_POST['stok']);
    $tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
    $id_supplier    = intval($_POST['id_supplier']);

    // query update (prepared statement)
    $query = "UPDATE obat SET 
                nama_obat = ?, 
                id_kategori = ?, 
                harga_jual = ?, 
                harga_beli = ?, 
                stok = ?, 
                tgl_kadaluarsa = ?, 
                id_supplier = ?
              WHERE id_obat = ?";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param(
        "siddiisi", 
        $nama_obat, $id_kategori, $harga_jual, $harga_beli, 
        $stok, $tgl_kadaluarsa, $id_supplier, $id_obat
    );

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diubah'); window.location='index.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Obat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        input[readonly] {
            background: #f0f0f0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #2c5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ubah Data Obat</h2>
        <form method="POST">
            <!-- ID obat ditampilkan tapi tidak bisa diubah -->
            <input type="text" name="id_obat" value="<?= htmlspecialchars($data['id_obat']) ?>" readonly>

            <input type="text" name="nama_obat" value="<?= htmlspecialchars($data['nama_obat']) ?>" required>

            <!-- Dropdown kategori -->
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                while ($row = mysqli_fetch_assoc($kategori)) {
                    $selected = ($row['id_kategori'] == $data['id_kategori']) ? "selected" : "";
                    echo "<option value='".$row['id_kategori']."' $selected>".htmlspecialchars($row['nama_kategori'])."</option>";
                }
                ?>
            </select>

            <input type="number" step="0.01" name="harga_jual" value="<?= htmlspecialchars($data['harga_jual']) ?>" required>
            <input type="number" step="0.01" name="harga_beli" value="<?= htmlspecialchars($data['harga_beli']) ?>" required>
            <input type="number" name="stok" value="<?= htmlspecialchars($data['stok']) ?>" required>
            <input type="date" name="tgl_kadaluarsa" value="<?= htmlspecialchars($data['tgl_kadaluarsa']) ?>" required>

            <!-- Dropdown supplier -->
            <label>Supplier</label>
            <select name="id_supplier" required>
                <option value="">-- Pilih Supplier --</option>
                <?php
                $supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                while ($row = mysqli_fetch_assoc($supplier)) {
                    $selected = ($row['id_supplier'] == $data['id_supplier']) ? "selected" : "";
                    echo "<option value='".$row['id_supplier']."' $selected>".htmlspecialchars($row['nama_supplier'])."</option>";
                }
                ?>
            </select>
              
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>

