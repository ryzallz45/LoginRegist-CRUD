<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

if (isset($_POST['datamahasiswa'])) {
    $output = '';

    $nrp = $_POST['datamahasiswa'];
    $sql = "SELECT * FROM mahasiswa WHERE nrp = '$nrp'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <tbody>';
    foreach ($result as $row) {
        $output .= '<tr>
                        <td colspan="2" class="text-center">
                            <img src="img/' . $row['gambar'] . '" width="50%" class="rounded-circle shadow-lg mb-3">
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">NRP</th>
                        <td>' . $row['nrp'] . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Nama</th>
                        <td>' . $row['nama'] . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tempat dan Tanggal Lahir</th>
                        <td>' . $row['tmpt_Lahir'] . ', ' . date("d M Y", strtotime($row['tgl_Lahir'])) . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Jenis Kelamin</th>
                        <td>' . $row['jekel'] . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Jurusan</th>
                        <td>' . $row['jurusan'] . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">E-Mail</th>
                        <td>' . $row['email'] . '</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Alamat</th>
                        <td>' . $row['alamat'] . '</td>
                    </tr>';
    }
    $output .= '</tbody></table></div>';

    // Tampilkan $output
    echo $output;
}
?>
