<?php
// Ganti "admin123" dengan password yang mau dipakai
$hash = password_hash("admin123", PASSWORD_DEFAULT);
echo $hash;
?>
