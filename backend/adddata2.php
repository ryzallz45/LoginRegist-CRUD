<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:../frontend/login.php');
    exit;
}

require 'function.php';

if (isset($_POST['simpan'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan!');
                document.location.href = '../frontend/index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal ditambahkan!');
            </script>";
    }
}
?>
