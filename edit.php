<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok' WHERE id_barang='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <h2>Edit Barang</h2>
    <form method="post">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

        <button type="submit" name="update">Perbarui</button>
        <a href="index.php" class="back-btn">Kembali</a>
    </form>
</div>
</body>
</html>

