<?php
$h = '$2y$12$Q886LGNwk96o7HKzVLc7E.9oZNho1vd57KcA6K2pEScuy/wm4dPA2';
if (password_verify('user123', $h)) {
    echo "OK\n";
} else {
    echo "GAGAL\n";
}
