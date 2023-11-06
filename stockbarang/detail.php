<?php
    // Menghubungkan ke function.php
    require 'function.php';

    // Menghubungkan check.php
    require 'check.php';  

    // Mendapatkan id data barang
    $idbarang = $_GET['id'];

    // Mendapatkan informasi barang berdasarkan database
    $get = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang = '$idbarang'");
    $fetch = mysqli_fetch_assoc($get);

    // Set Variable
    $namabarang = $fetch['namabarang'];
    $deskripsi = $fetch['deskripsi'];
    $idbarang = $fetch['idbarang'];
    $tanggal = date("Ymd"); 
    $tgl_id = $tanggal . $idbarang;
    $stock = $fetch['stock'];
    $gambar = $fetch['image']; // Ambil Gambar

    if ($gambar == null) {
        // Jika Tidak Ada Gambar
        $img = 'No Photo';
    } else {
        // Jika Ada Gambar
        $img = '<img src="images/'.$gambar.'" class="zoomable">';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detail Barang - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
    <link href="styles.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .zoomable {
            max-width: 200px;
            max-width: 200px;
            width: auto;
            height: auto;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #0d6efd;">
        <a class="navbar-brand" ><img class="logo" src="assets/logo_yukngestok.png" alt="Logo"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </div>
        </form>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="kontributor.php">Informasi Kelompok</a>
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
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                            Kelola Admin
                        </a>
                        <a class="nav-link" href="kelola-user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                            Kelola User
                        </a>
                        <a class="nav-link" href="kontributor.php">
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
                    <h1 class="mt-4">Detail Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Aplikasi Berbasis Web Stock Barang dari Kelompok 2 Sistem Berkas 03TPLP001</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2><?= $namabarang; ?></h2>
                            <td><?= $img; ?></td>
                        </div>
                        <strong>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-9">: <?= $deskripsi; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">ID Barang</div>
                                <div class="col-md-9">: <?= $tgl_id ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-9">: <?= $stock; ?></div>
                            </div>
                            <br>
                        </strong>
                        <h3>Barang Masuk</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datamasuk" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatamasuk = mysqli_query($conn, "SELECT * FROM masuk m WHERE idbarang = '$idbarang'"); //Get masuk
                                    $i = 1;
                                    while($fetch=mysqli_fetch_array($ambildatamasuk)) {
                                        $tanggal = $fetch['tanggal'];
                                        $keterangan = $fetch['keterangan'];
                                        $qty = $fetch['qty'];
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $tanggal; ?></td>
                                        <td><?= $keterangan; ?></td>
                                        <td><?= $qty; ?></td>
                                    </tr>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h3>Barang Keluar</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datakeluar" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Penerima</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatakeluar = mysqli_query($conn, "SELECT * FROM keluar k WHERE idbarang = '$idbarang'"); //Get keluar
                                    $i = 1;
                                    while ($fetch = mysqli_fetch_array($ambildatakeluar)) {
                                        $tanggal = $fetch['tanggal'];
                                        $penerima = $fetch['penerima'];
                                        $qty = $fetch['qty'];
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $tanggal; ?></td>
                                        <td><?= $penerima; ?></td>
                                        <td><?= $qty; ?></td>
                                    </tr>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </main>
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
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Stock Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>                               
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required><br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required><br>
                    <input type="num" name="stock" placeholder="Jumlah Stock Barang" class="form-control" required><br>
                    <input type="file" name="file" class="form-control"><br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>  
            </form>  
        </div>
    </div>
</div>
</html>
