<?php
include 'koneksi.php';

$pesan = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // default user biasa

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = 'Username sudah digunakan!';
    } else {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: login.php");
            exit;
        } else {
            $pesan = 'Gagal daftar: ' . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Daftar Akun</h2>
    <?php if ($pesan): ?>
        <p class="error"><?= $pesan ?></p>
    <?php endif; ?>
    <form method="POST" autocomplete="off">
        <label>Username</label>
        <input type="text" name="username" required autocomplete="off">
        <label>Password</label>
        <input type="password" name="password" required autocomplete="off">
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
