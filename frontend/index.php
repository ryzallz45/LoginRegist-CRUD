<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require '../backend/function.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY nrp DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <!-- Data Tables -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
     <!-- Font Google -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <!-- animasi Css Aos -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <!--My CSS -->
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/style_detail.css">


     <title>Home</title>
</head>

<body background="https://asset.gecdesigns.com/img/wallpapers/aesthetic-landscape-reflection-background-hd-wallpaper-sr10012410-1706502139247-cover.webp">
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
               <a class="navbar-brand" href="index.php">Pengelolaan Data Anggota Organisasi</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="#">Home</a>
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

     <div class="container">
          <div class="row my-2">
               <div class="col-md">
                    <h3 class="text-center fw-bold text-uppercase text-light data_mahasiswa"></h3>
                    <hr>
               </div>
          </div>
          <div class="row my-2">
               <div class="col-md">
                    <a href="addData.php" class="btn btn-primary" data-aos="fade-right" data-aos-duration="800"
                         data-aos-delay="1200"><i class="bi bi-person-plus-fill"></i>Tambah Data Anggota</a>
                         <a href="tagihan.php" class="btn btn-success ms-1" data-aos="fade-left"
                         data-aos-duration="1000" data-aos-delay="1600"><i class="bi bi-file-earmark-spreadsheet-fill"></i>Tagihan Bulanan Iuran</a>
               </div>
          </div>
          <div class="row my-3" data-aos="fade" data-aos-duration="1000" data-aos-delay="2000">
               <div class="col-md">
                    <table id="data" class="table table-striped table-responsive table-hover text-center"
                         style="width:100%">
                         <thead class="table-dark text-dark">
                              <tr>
                                   <th>No.</th>
                                   <th>Nama</th>
                                   <th>Jenis Kelamin</th>
                                   <th>Umur</th>
                                   <th>Jurusan</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php $no = 1; ?>
                              <?php foreach ($mahasiswa as $row) : ?>
                              <tr class="table-secondary text-dark">
                                   <td><?= $no++; ?></td>
                                   <td><?= $row['nama']; ?></td>
                                   <td><?= $row['jekel']; ?></td>
                                   <?php
                                $now = time();
                                $timeTahun = strtotime($row['tgl_Lahir']);
                                $setahun = 31536000;
                                $hitung = ($now - $timeTahun) / $setahun;
                                ?>
                                   <td><?= floor($hitung); ?> Tahun</td>
                                   <td><?= $row['jurusan']; ?></td>
                                   <td>
                                   <button class="btn btn-success btn-sm text-white detail"data-id="<?= $row['nrp']; ?>" style="font-weight: 600;">
                                   <i class="bi bi-info-circle-fill" data-aos="fade-right" data-aos-duration="800"></i>Detail</button>

                                        <a href="ubah.php?nrp=<?= $row['nrp']; ?>" class="btn btn-warning btn-sm"
                                             style="font-weight: 600;"><i class="bi bi-pencil-square"></i>Ubah</a> |

                                        <a href="../backend/hapus.php?nrp=<?= $row['nrp']; ?>" class="btn btn-danger btn-sm"
                                             style="font-weight: 600;"
                                             onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['nama']; ?> ?');"><i
                                                  class="bi bi-trash-fill"></i>Hapus</a>
                                   </td>
                              </tr>
                              <?php endforeach; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
     <!-- Close Container -->

<!-- Modal Detail Data -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 15px;">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold text-uppercase" id="detail">Detail Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="detail-mahasiswa" style="font-family: 'Arial', sans-serif;">
            
            </div>
        </div>
    </div>
</div>


     <!-- Close Modal Detail Data -->

     <!-- Footer -->
     <div class="container-fluid">
          <div class="row bg-dark text-white text-center">
               <div class="col my-2" id="about">
                    <h4 class="fw-bold text-uppercase">About</h4>
                    <br><br><br>
                    <p>
                   
                    </p>
               </div>
          </div>
     </div>

     <!-- Close Footer -->

     <!-- Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>

     <!-- Data Tables -->
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

     <script>
$(document).ready(function() {
    // Fungsi Detail
    $('.detail').click(function() {
        var datamahasiswa = $(this).attr("data-id");
        $.ajax({
            url: "../backend/detail.php", 
            method: "POST", 
            data: { datamahasiswa: datamahasiswa }, 
            success: function(data) {
                $('#detail-mahasiswa').html(data); 
                $('#detail').modal("show"); 

                // Animasi modal
                gsap.from('.modal-content', {
                    duration: 0.5,
                    opacity: 0,
                    y: 50
                });
            }
        });
    });
});


     </script>

     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script>
     AOS.init({
          once: true,

     });
     </script>

     <!-- animasi  gsap-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
     <script>
     gsap.registerPlugin(TextPlugin);
     gsap.to('.data_mahasiswa', {
          duration: 1,
          delay: 0.6,
          text: 'Data mahasiswa :)'
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