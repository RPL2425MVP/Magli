<?php
// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "obat");

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ambil semua siswa
function getAllSiswa() {
    global $Koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id ASC");
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// tambah siswa
function tambahSiswa($id_obat, $nama_obat, $id_kategori, $harga_jual, $harga_beli, $stok, $tgl_kadaluarsa, $id_suplier) {
    global $koneksi;
    $query = "INSERT INTO obat(id_obat, nama_obat, id_kategori , harga_jual, harga_beli, stok, tgl_kadaluarsa, id_suplier)
        VALUES ('$id_obat', '$nama_obat', '$id_kategori', '$harga_jual', '$harga_beli', '$stok', '$tgl_kadaluarsa, $id_suplier' )";

    return mysqli_query($koneksi, $query);
}

// hapus siswa
function hapusSiswa($id) {
    global $koneksi;
    $query = "DELETE FROM obat WHERE id = $id";
    return mysqli_query($Koneksi, $query);
}

// ambil data siswa by id
function getSiswa($id) {
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM obat WHERE id = $id");
    return mysqli_fetch_assoc($result);
}

// ubah siswa
function ubahSiswa($id_obat, $nama_obat, $id_kategori, $harga_jual, $harga_beli, $stok, $tgl_kadaluarsa, $id_suplier) {
    global $koneksi;
    $query = "UPDATE obat SET 
                id='$id_obat',
                nama_obat='$nama_obat',
                id_kategori='$id_kategori',
                harga_jual='$harga_jual',
                harga_beli='$harga_beli'
                stok='$stok',
                tgl_kadaluarsa='$tgl_kadaluarsa',
                id_suplier='$id',
                WHERE id=$id";
    return mysqli_query($koneksi, $query);
}
?>
