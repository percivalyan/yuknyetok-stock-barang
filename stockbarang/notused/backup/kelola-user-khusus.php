<?php
//Menghubungkan ke function.php
require 'function.php';

//Menghubungkan check.php
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
        <title>Kelola User - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
        <link href="styles.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"> warna gelap -->
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary"> -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #0d6efd;">
            <a class="navbar-brand" ><img class="logo" src="assets/logo_yukngestok.png" alt="Logo"></a>
             <!-- <a class="navbar-brand" href="index.php">Stock.U</a> -->
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
                       <!--  <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a> -->
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
                            <a class="navbar-brand" href="index.php">
                                <!-- <strong class="sb-sidenav-menu-heading" style="text-weight: uppercase; color: white;">m e n u</strong> -->
                            </a>
                            <a class="nav-link" href="index-user.php">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> -->
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk-user.php">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> -->
                                 <div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar-user.php">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> -->
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-up"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="kelola-user.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div> -->
                                Kelola User
                            </a>
                            <a class="nav-link" href="kontributor.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw-alt"></i></div>
                                Kontributor
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kelola User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Aplikasi Berbasis Web Stock Barang dari Kelompok 2 Sistem Berkas 03TPLP001</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button Tambah Stock Barang -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah User</button>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$iduser;?>">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$iduser;?>">Delete</button>
                                <br>
                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit<?=$iduser;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                                <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit E-mail dan Password User</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>                               

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    <input type="email" name="emailuser" value="<?=$em;?>" class="form-control" required><br>
                                                                    <input type="password" name="passwordbaru" placeholder="Masukan Password Baru" class="form-control" value="<?=$pw;?>" required><br>
                                                                    <input type="hidden" name="id" value="<?=$iduser;?>">
                                                                    <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                                                                </div>  
                                                            </form>  
                                                        </div>
                                                    </div>
                                                </div>

                                                 <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$iduser;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit E-mail dan Password Admin</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>                               

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    Anda yakin menghapus User "<?=$em;?>"?<br><br>
                                                                    <input type="hidden" name="id" value="<?=$iduser;?>">
                                                                    <button type="submit" class="btn btn-danger" name="hapususer">Hapus</button>
                                                                </div>  
                                                            </form>  
                                                        </div>
                                                    </div>
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
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
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
