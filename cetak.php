<?php 

require_once './assets/vendor/dompdf/autoload.inc.php';
include './config/koneksi-db.php';

    if(isset($_GET['no'])) { // memperoleh anggota_id
        $no_pendaftar = $_GET['no'];

        if(!empty($no_pendaftar)) {
            // Query
            $sql = "SELECT * FROM data_pendaftar WHERE no_pendaftar = '{$no_pendaftar}';";
            $query = mysqli_query($db_conn, $sql);
            $row = $query->num_rows;
            
            if($row > 0) {
                $data = mysqli_fetch_array($query); // memperoleh data anggota

                $no_pendaftar = $data['no_pendaftar'];
                $nama_lengkap = $data['nama_lengkap'];
                $nik = $data['nik'];
                $jenis_kelamin = ($data['jenis_kelamin'] === 'L') ? 'Laki-laki' : 'Perempuan';
                $sekolah_asal = $data['sekolah_asal'];
            }
        }

$html = '
 <!DOCTYPE html>
  <html lang="en">
  <head>
    <title> Bukti Pendaftaran</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap-4.3/css/bootstrap.css">
    <style type="text/css">
        * {
            box-sizing: border-box;
        }
        .box {
            margin: 5px auto;
            width: 500px;
            height: 296px;
        }
        #card {
            margin: 10px 10px;
            padding: 5px;
            float: left;
            width: 100%;
        }
        table {
            width: 75%;
            float: left;
        }
        table, tr, td {
            vertical-align: top;
        }
        tr td p {
            line-height: 16px;
        }
        tr td {
            text-align: left;
            vertical-align: top;
        }
        #member-photo {
            float: right;
            margin-top: 10px;
        }
    </style>
 </head>
 <body>
    <div class="box">
        <h1 class="text-center">Bukti Pendaftaran</h1>
        <div id="card">
            <table>
                <tr>
                    <td><p>No Pendaftaran</p></td>
                    <td><p>: ' . $no_pendaftar . '</p></td>
                </tr>
                <tr>
                    <td><p>Nama</p></td>
                    <td><p>: ' . $nama_lengkap . '</p></td>
                </tr>
                <tr>
                    <td><p>NIK</p></td>
                    <td><p>: ' . $nik . '</p></td>
                </tr>
                <tr>
                    <td><p>Jenis Kelamin</p></td>
                    <td><p>: ' . $jenis_kelamin . '</p></td>
                </tr>
                <tr>
                    <td><p>Sekolah Asal</p></td>
                    <td><p>: ' . $sekolah_asal . '</p></td>
                </tr>
            </table>
        <div>
    </div>
 </body>
 </html>';

 } else {
            echo "<script>alert('No Pendaftaran Kosong');</script>";
            // mengalihkan halaman
            echo "<meta http-equiv='refresh' content='0; url=index.php?p=data'>";
            exit;
        }

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Bukti Pendaftaran", array("Attachment" => 0));

 ?>