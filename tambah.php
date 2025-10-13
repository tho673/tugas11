<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    if ($query) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <h2>Tambah Barang</h2>
    <form method="post">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="back-btn">Kembali</a>
    </form>
</div>
</body>
</html>


