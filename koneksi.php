<?php
$host = "localhost";
$user = "xirpl1-21";
$pass = "0095896860";
$db   = "db_xirpl1-21_1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// jangan echo apapun di sini, biar tidak ganggu halaman lain
?>


