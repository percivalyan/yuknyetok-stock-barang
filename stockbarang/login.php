<?php
// Menghubungkan ke function.php
require 'function.php';

// Pengecekan Login
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Pencocokan email dan password dengan database
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email = '$email' and password = '$password'");

    // Menghitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);
    if($hitung > 0){
        $_SESSION['log'] = 'True';
        echo '<script>alert("Login berhasil!"); window.location.href="index.php";</script>';
    } else {
        echo '<script>alert("Login gagal!"); window.location.href="login.php";</script>';
    }
}

// (Login) Jika sudah login (sudah masuk ke dashboard) dan ingin kembali ke menu login maka akan dikembalikan ke dashboard
// Jika ingin ke menu login atau login kembali dengan akun yang sama atau berbeda maka harus logout terlebih dahulu
if(!isset($_SESSION['log'])){

} else {
    header('location:index.php');
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
        <title>Login - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="styles-login.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Admin</h3></div>
                                    <!-- <a class="card-header" <img class="logo" src="assets/logo_yukngestok.png" alt="Logo"></a> -->
                                    <a class="card-logo">
                                        <img class="logo" src="assets/logo_blue.png" alt="Logo">
                                    </a>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <button class="btn btn-primary" name="login">Login</button>
                                                <!-- <a class="btn btn-link" href="register.php">Register</a> -->
                                                <a class="btn btn-warning" href="login-user.php">Login User</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Belum punya akun Admin? Buat disini!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Yuk Ngestok 2023</div>
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
    </body>
</html>
