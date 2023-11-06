<?php
// Menghubungkan ke function.php
require 'function.php';

// Menghubungkan check.php
require 'check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Barang Masuk - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
    <link href="styles.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .zoomable {
            width: 100px;

        }
        .zoomable:hover {
            transform: scale(2.5);
            transition: 0.5s ease;
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #0d6efd;">
        <a class="navbar-brand" ><img class="logo" src="assets/logo_yukngestok.png" alt="Logo"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="kontributor-user.php">Informasi Kelompok</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-primary" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index-user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk-user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar-user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="kontributor-user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw-alt"></i></div>
                            Informasi Kelompok
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Barang Masuk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Aplikasi Berbasis Web Stock Barang dari Kelompok 2 Sistem Berkas 03TPLP001</li>
                        <li class="breadcrumb-item active">Menu Khusus User</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="export-barangmasuk.php" class="btn btn-info">Export Data</a>
                            <div class="row mt-4">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control">
                                        <input type="date" name="tgl_selesai" class="form-control ml-1">
                                        <button type="submit" name="filter_tgl" class="btn btn-info ml-1">Filter</button>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Keterangan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (isset($_POST['filter_tgl'])) {
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if ($mulai != null || $selesai != null) {
                                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang AND m.tanggal BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)");
                                                } else {
                                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang");
                                                }
                                            } else {
                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang");
                                            }

                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                $idb = $data['idbarang'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $tanggal2 = str_replace('-', '', $data['tanggal']);
                                                $idbunik = $tanggal2 . $idb; // Menggabungkan tanggal dan ID barang
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                                $deskripsi = $data['deskripsi'];
                                                $gambar = $data['image']; //Ambil Gambar

                                                if ($gambar == null) {
                                                    //Jika Tidak Ada Gambar
                                                    $img = 'No Photo';
                                                } else {
                                                    // =JIka Ada Gambar
                                                    $img = '<img src="images/' . $gambar . '" class="zoomable">';
                                                }
                                            ?>
                                        <tr>
                                            <td><?= $tanggal; ?></td>
                                            <td><?= $img; ?></td>
                                            <td><?= $idbunik; ?></td>
                                            <td><?= $namabarang; ?></td>
                                            <td><?= $qty; ?></td>
                                            <td><?= $keterangan; ?></td>                                           
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Yuk Nyetok 2023</div>
                        <div>
                            <a href="privacy_policy.html">Privacy Policy</a>
                                &middot;
                                <a href="terms_and_conditions.html">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>
</html>
