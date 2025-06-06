<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require '../backend/function.php';

// Ambil data mahasiswa dan iuran
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY nrp DESC");
$iuran = query("SELECT * FROM iuran ORDER BY tanggal_bayar DESC");

if (isset($_POST['submit'])) {
    // Proses input data iuran baru
    $nrp = $_POST['nrp'];
    $bulan = $_POST['tanggal_bayar'];
    $jumlah_iuran = $_POST['jumlah_iuran'];

    $query = "INSERT INTO iuran (nrp, tanggal bayar, jumlah_iuran) VALUES ('$nrp', '$tanggal bayar', '$jumlah_iuran')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tagihan berhasil ditambahkan'); window.location = 'tagihan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan tagihan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Tagihan Bulanan Iuran</title>
</head>

<body background="https://asset.gecdesigns.com/img/wallpapers/aesthetic-landscape-reflection-background-hd-wallpaper-sr10012410-1706502139247-cover.webp">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">Pengelolaan Tagihan Iuran Bulanan Anggota Organisasi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../backend/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-4">
        <h3 class="text-center fw-bold text-uppercase">Tagihan Bulanan Iuran</h3>
        <hr>
        
        <!-- Formulir Input Tagihan Baru -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h4 class="text-light">Tambah Tagihan Iuran</h4>
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-4 text-light">
                            <label for="nrp" class="form-label">NRP Mahasiswa</label>
                            <input type="text" name="nrp" class="form-control" required>
                        </div>
                        <div class="col-md-4 text-light">
                            <label for="bulan" class="form-label">Bulan</label>
                            <input type="text" name="bulan" class="form-control" required>
                        </div>
                        <div class="col-md-4 text-light">
                            <label for="jumlah_iuran" class="form-label">Jumlah Iuran</label>
                            <input type="number" name="jumlah_iuran" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Tambah Tagihan</button>
                </form>
            </div>
        </div>

        <!-- Tabel Tagihan Iuran -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-dark text-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Jurusan</th>
                            <th>Bulan</th>
                            <th>Jumlah Iuran</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($mahasiswa as $row) : ?>
                            <?php
                                // Ambil data iuran untuk setiap mahasiswa
                                $iuranData = array_filter($iuran, function($i) use ($row) {
                                    return $i['nrp'] == $row['nrp']; // Cocokkan dengan NRP mahasiswa
                                });
                            ?>
                            <?php if (!empty($iuranData)) : ?>
                                <?php foreach ($iuranData as $i) : ?>
                                    <tr class="table-secondary text-dark">
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['nrp']; ?></td>
                                        <td><?= $row['jurusan']; ?></td>
                                        <td><?= $i['bulan']; ?></td>
                                        <td><?= $i['jumlah_iuran']; ?></td>
                                        <td><?= $i['status_pembayaran'] == 1 ? 'Lunas' : 'Belum Lunas'; ?></td>
                                        <td>
                                            <a href="update_iuran.php?id=<?= $i['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                            <a href="hapus_iuran.php?id=<?= $i['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tagihan?');"><i class="bi bi-trash-fill"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr class="table-secondary text-dark">
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['nrp']; ?></td>
                                    <td><?= $row['jurusan']; ?></td>
                                    <td colspan="3">Tidak ada tagihan ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white text-center">
            <div class="col my-2" id="about">
                <h4 class="fw-bold text-uppercase">About</h4>
                <br><br><br>
            </div>
        </div>
    </div>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
        });
    </script>

    <!-- animasi gsap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
    <script>
        gsap.registerPlugin(TextPlugin);
        gsap.to('.tagihan', {
            duration: 1,
            delay: 0.6,
            text: 'Tagihan Bulanan Iuran :)'
        })
        gsap.from('.navbar', {
            duration: 1,
            y: '-100%',
            opacity: 0,
            ease: 'bounce',
        })
    </script>
</body>

</html>
