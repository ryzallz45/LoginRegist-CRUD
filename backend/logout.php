<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
// Session dihapus dan logout

header('location: ../frontend/index.php');
    // kembali ke index.php