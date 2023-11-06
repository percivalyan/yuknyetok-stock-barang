<?php
// Menghubungkan ke function.php
require 'function.php';

// Registrasi
$registration_status = "";
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Memasukkan data registrasi ke database
    $insert = mysqli_query($conn, "INSERT INTO login (email, password) VALUES ('$email', '$password')");
    if ($insert) {
        $registration_status = "Akun berhasil dibuat. Silakan login.";
    } else {
        $registration_status = "Registrasi gagal. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Registration - Yuk Ngestok Membantu Bisnis Anda Lebih Mudah</title>
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
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Registration Admin</h3>
                            </div>
                            <a class="card-logo">
                               <img class="logo" src="assets/logo_blue.png" alt="Logo">
                            </a>
                            <div class="card-body">
                                <?php if (!empty($registration_status)) { ?>
                                    <div class="alert alert-info" role="alert">
                                        <?php echo $registration_status; ?>
                                    </div>
                                <?php } ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" required />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" required />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary" name="register">Register</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="login.php">Sudah punya akun Admin? Ayo login sekarang!</a></div>
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
                    <div class="text-muted">© Yuk Ngestok 2023</div>
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
