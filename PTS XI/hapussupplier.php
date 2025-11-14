<?php include 'koneksikategori.php'; ?>
<?php
$id = $_GET['id'];
$query = "DELETE FROM supplier WHERE id_supplier='$id'";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Supplier berhasil dihapus'); window.location='indexsupplier.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
