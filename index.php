<?php
// Mulai session dengan aman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Ambil data user yang login
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Ambil semua data barang
$result = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px 14px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-add { background-color: #28a745; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-del { background-color: #dc3545; }
        .btn-logout { background-color: #343a40; }

        .btn:hover {
            opacity: 0.8;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 15px 0;
        }

        .role-info {
            font-size: 14px;
            color: #f8f9fa;
        }
    </style>
</head>
<body>

<header>
    <h2>📦 Data Barang</h2>
    <div>
        <span class="role-info">
            Login sebagai: <b><?= htmlspecialchars($username) ?></b> (<?= htmlspecialchars($role) ?>)
        </span>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</header>

<div class="container">
    <?php if ($role === 'admin'): ?>
        <a href="tambah.php" class="btn btn-add">+ Tambah Barang</a>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <?php if ($role === 'admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php
        $no = 1;
        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['stok']) ?></td>
                <?php if ($role === 'admin'): ?>
                    <td>
                        <a href="edit.php?id=<?= $row['id_barang'] ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_barang'] ?>" class="btn btn-del" onclick="return confirm('Yakin ingin menghapus barang ini?');">Hapus</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr><td colspan="<?= ($role === 'admin') ? 5 : 4 ?>" class="no-data">Belum ada data barang</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
