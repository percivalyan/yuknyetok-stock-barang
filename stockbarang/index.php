<?php
require 'function.php';
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
    <title>Stock Barang - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
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
        <a class="navbar-brand">
            <img class="logo" src="assets/logo_yukngestok.png" alt="Logo">
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
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
                        <a class="navbar-brand" href="index.php"></a>
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
                    <h1 class="mt-4">Stock Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Aplikasi Berbasis Web Stock Barang dari Kelompok 2 Sistem Berkas 03TPLP001</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Stock Barang</button>
                            <a href="export-stockbarang.php" class="btn btn-info">Export Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $ambildatastock = mysqli_query($conn, "SELECT * FROM stock WHERE stock < 1");

                                while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                    $barang = $fetch['namabarang'];
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Perhatian!</strong> Apakah Stock <?= $barang; ?> Pertama Kali Ditambahkan? Jika Bukan yang Pertama Kali Ditambahkan Berarti Barang Telah Habis
                                    </div>
                                <?php
                                }
                                ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Edit dan Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                        
                                            $idb = $data['idbarang'];
                                            $tanggal = $data['tanggal'];
                                            $tanggal2 = str_replace('-', '', $data['tanggal']);
                                            $idbunik = $tanggal2 . $idb; // Menggabungkan tanggal dan ID barang
                                            $namabarang = $data['namabarang'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $tanggal = $data['tanggal'];
                                            
                                            //Cek Ada Gambar atau Tidak
                                            $gambar = $data['image']; //Ambil Gambar
                                            
                                            if($gambar == null) {
                                                //Jika Tidak Ada Gambar
                                                $img = 'No Photo';
                                            } else {
                                                //Jika Ada Gambar
                                                $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                            }
                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $img; ?></td>
                                                <td><?= $idbunik; ?></td>
                                                <td>
                                                    <strong><a href="detail.php?id=<?= $idb; ?>"><?= $namabarang; ?></a></strong>
                                                </td>
                                                <td><?= $deskripsi; ?></td>
                                                <td><?= $stock; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">Delete</button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Barang</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>                               

                                                            <!-- Modal body -->
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="modal-body">
                                                                    <input type="text" name="namabarang" value="<?=$namabarang;?>" placeholder="Nama Barang" class="form-control" required><br>
                                                                    <input type="text" name="deskripsi" value="<?=$deskripsi;?>" placeholder="Deskripsi Barang" class="form-control" required><br>
                                                                    <input type="file" name="file" class="form-control"><br>
                                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                    <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                                </div>  
                                                            </form>  
                                                        </div>
                                                    </div>
                                                </div>

                                            <!-- Delete Modal -->
                                                <div class="modal fade" id="delete<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Barang?</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>                               

                                                            <!-- Modal body -->
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    Anda yakin menghapus barang "<?=$namabarang;?>"?<br><br>
                                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                    <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                                </div>  
                                                            </form>  
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            };


                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <footer>
                          <ul>
                            <strong><h6>Panduan Penggunaan</h6></strong>
                            <li>Tambah Stock Barang: Untuk memasukkan Nama Barang, Deskripsi, Jumlah Stock, dan Gambar.</li>
                            <li>Export Data: Sebagai Report File aplikasi, untuk export tabel ke Excel dan PDF.</li>
                            <li>Edit: Untuk mengubah Nama Barang, Deskripsi, dan Gambar.</li>
                            <li>Delete: Untuk menghapus Barang dari Stock.</li>
                            <li>Jika ingin melihat detail barang, klik Nama Barang pada tabel.</li>
                          </ul>
                        </footer>
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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stock Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>                               
                <!-- Modal body -->
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
