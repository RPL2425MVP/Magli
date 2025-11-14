```php
<?php
include "koneksikategori.php";

// ambil semua kategori
function getAllKategori() {
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori ASC");
    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

// ambil kategori berdasarkan id (VARCHAR)
function getKategori($id) {
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// tambah kategori baru
function tambahKategori($id, $nama) {
    global $koneksi;

    // cek apakah ID sudah ada
    $stmt = $koneksi->prepare("SELECT 1 FROM kategori WHERE id_kategori = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        return false; // ID sudah dipakai
    }

    $stmt = $koneksi->prepare("INSERT INTO kategori (id_kategori, nama_kategori) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $nama);
    return $stmt->execute();
}

// ubah kategori
function ubahKategori($id, $nama) {
    global $koneksi;
    $stmt = $koneksi->prepare("UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?");
    $stmt->bind_param("ss", $nama, $id);
    return $stmt->execute();
}

// hapus kategori
function hapusKategori($id) {
    global $koneksi;

    // cek dulu apakah kategori dipakai di tabel obat
    $stmt = $koneksi->prepare("SELECT 1 FROM obat WHERE id_kategori = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        return false; // gagal hapus karena masih dipakai
    }

    $stmt = $koneksi->prepare("DELETE FROM kategori WHERE id_kategori = ?");
    $stmt->bind_param("s", $id);
    return $stmt->execute();
}
?>

