<?php
    require "../appweb/Config/SetWebsite.php";
    require "../appweb/Config/Db.php";
    require "../appweb/Config/AssetsWebsite.php";

    session_start();
    error_reporting(E_ALL);

    if (isset($_POST['_cek_username'])) {
        //Mendapatkan data user dari Form Login
        $myUsername = preg_replace('/<[^<]+?>/', '', $_POST['___in_username']);

        try{
            $stmt   = $pdo->prepare("SELECT 
                                id_akun, username, nama
                                FROM akun
                                WHERE username = ? LIMIT 1");

            $stmt->bindValue(1, $myUsername);
            $stmt->execute();

            $resultLogin    = $stmt->fetch(PDO::FETCH_ASSOC);
            $rowsLogin      = $stmt->rowCount();

            if ($rowsLogin>0){
                $_SESSION['_msg__'] = 'UsernameAda';
            }else{
                $_SESSION['_msg__'] = 'UsernameKosong';
                echo "<script>window.location(history.back(0))</script>";
                exit();
                die();
            }
        }catch(Exception $e) {
            $_SESSION['_msg__'] = 'UsernameKosong';
            echo "<script>window.location(history.back(0))</script>";
            exit();
            die();
        }
    }elseif (isset($_POST['_ubah_password'])) {
        //Mendapatkan data user dari Form Login
        $myUsername         = preg_replace('/<[^<]+?>/', '', $_POST['___in_username']);
        $password           = htmlspecialchars($_POST['___in_password']);
        $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);

        try{
            $sql = "UPDATE akun SET password = :password WHERE username = :username";
                          
            $statement = $pdo->prepare($sql);

            $statement->bindParam(":username", $myUsername, PDO::PARAM_STR);
            $statement->bindParam(":password", $password_enkrip, PDO::PARAM_STR);

            $count = $statement->execute();

            if ($count>0) {
                // Jika berhasil
                $_SESSION['_alert__']       = '0';
                $_SESSION['_msg__']         = 'FromLupaPassword';

                echo "<script>window.location = '$base_url_admin/masuk';</script>";
                die();
                exit();
            }else{
                $_SESSION['_msg__'] = 'GagalLogin';
                echo "<script>window.location(history.back(0))</script>";
                exit();
                die();
            }
        }catch(PDOException $e){
            $_SESSION['_msg__'] = 'GagalLogin';
            echo "<script>window.location(history.back(0))</script>";
            exit();
            die();
        }
    }

    if ($_SESSION['_msg__']==="UsernameKosong") {
        $_SESSION['_alert__']   = '1';
    }elseif ($_SESSION['_msg__']==="UsernameAda") {
        $_SESSION['_alert__']   = '2';
    }elseif ($_SESSION['_msg__']==="FromLupaPassword") {
        $_SESSION['_alert__']   = '5';
    }else{
        $_SESSION['_alert__']   = '0';
        $_SESSION['_msg__']     = '0';
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Lupa Password - <?= $nama_web ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="<?= $nama_web ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="<?= $base_url; ?>/assets/files/images/<?= $icon; ?>" />

    <!-- App css -->
    <link href="<?= $base_url_admin ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= $base_url_admin ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- App-dark css -->
    <link href="<?= $base_url_admin ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled"/>
    <link href="<?= $base_url_admin ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled"/>

    <!-- icons -->
    <link href="<?= $base_url_admin ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
</head>
<body class="loading authentication-bg-pattern">
    <div class="account-pages py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 py-3">
                    <div class="card shadow my-5">
                        <div class="card-header text-center">
                            <img src="<?= $base_url; ?>/assets/files/images/<?= $logoDesktop; ?>" alt="<?= $judulLogoDesktop; ?>" class="w-50">
                        </div>
                        <div class="card-body p-4">
                            <?php
                                if ($_SESSION['_msg__']==="UsernameKosong") {
                                    echo "<div class='alert alert-danger text-left' role='alert'>";
                                    echo "<h4 class='alert-heading text-danger'><i class='fas fa-exclamation-triangle'></i> GAGAL!</h4>";
                                    echo "<p class='mb-0'><strong>Username</strong> ada <strong>tidak terdaftar</strong> pada sistem kami! Mohon periksa kembali.</p>";
                                    echo "</div>";
                                    $_SESSION['_msg__'] = 0;
                                }elseif ($_SESSION['_msg__']==="UsernameAda") {
                                    echo "<div class='alert alert-success text-left' role='alert'>";
                                    echo "<h4 class='alert-heading text-success'><i class='fas fa-exclamation-triangle'></i> Halo ".$resultLogin['nama']."!</h4>";
                                    echo "<p class='mb-0'>Silahkan masukkan <strong>password</strong> baru anda!</p>";
                                    echo "</div>";
                                    $_SESSION['_msg__'] = 0;
                                }elseif ($_SESSION['_msg__']==="FromLupaPassword") {
                                    echo "<div class='alert alert-success text-left' role='alert'>";
                                    echo "<h4 class='alert-heading text-success'><i class='fas fa-check-double'></i> BERHASIL MENGUBAH PASSWORD!</h4>";
                                    echo "<p class='mb-0'>Silahkan <strong>login</strong> menggunakan password baru Anda!</p>";
                                    echo "</div>";
                                    $_SESSION['_msg__'] = 0;
                                }
                            ?>

                            <?php if (isset($_POST['_cek_username']) AND $rowsLogin>0): ?>
                                <form action="" method="POST" data-parsley-validate="">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="username" name="___in_username" placeholder="Masukkan username anda..." value="<?= $resultLogin['username'] ?>" readonly>
                                        <label for="username" class="form-label" style="font-weight: normal !important;">Username</label>
                                    </div>

                                    <small class="mb-0 text-muted fw-bolder">Tampilkan Password <span id="buttonShowPassword" onclick="showPassword()"><i class="fas fa-eye-slash"></i></span></small>
                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control" id="pass" name="___in_password" placeholder="Masukkan password anda..." required="">
                                        <label for="pass" class="form-label" style="font-weight: normal !important;">Password</label>
                                    </div>

                                    <div class="d-grid mt-3 text-center">
                                        <button class="btn btn-lg btn-success" type="submit" name="_ubah_password">UBAH PASSWORD <i class="fas fa-user-edit"></i></button>

                                        <p class="my-2 text-muted">Sudah punya akun?</p>

                                        <a href="<?= $base_url_admin ?>/masuk" class="btn btn-outline-success"><span class="mdi mdi-login-variant"></span> MASUK</a>
                                    </div>
                                </form>
                            <?php else: ?>
                                <form action="" method="POST" data-parsley-validate="">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="username" name="___in_username" placeholder="Masukkan username anda..." required="">
                                        <label for="username" class="form-label" style="font-weight: normal !important;">Username</label>
                                    </div>

                                    <div class="d-grid mt-3 text-center">
                                        <button class="btn btn-lg btn-success" type="submit" name="_cek_username">CEK USERNAME <i class="fas fa-search"></i></button>

                                        <p class="my-2 text-muted">Sudah punya akun?</p>

                                        <a href="<?= $base_url_admin ?>/masuk" class="btn btn-outline-success"><span class="mdi mdi-login-variant"></span> MASUK</a>
                                    </div>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="<?= $base_url_admin ?>/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/feather-icons/feather.min.js"></script>

    <!-- Plugin js-->
    <script src="<?= $base_url_admin ?>/assets/libs/parsleyjs/parsley.min.js"></script>

    <!-- Validation init js-->
    <script src="<?= $base_url_admin ?>/assets/js/pages/form-validation.init.js"></script>

    <!-- App js -->
    <script src="<?= $base_url_admin ?>/assets/js/app.min.js"></script>

    <script>
        function showPassword() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('pass').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('pass').type = 'text';
                
                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('buttonShowPassword').innerHTML = `<i class="fas fa-eye"></i>`;
            }else{
                //ubah form input password menjadi text
                document.getElementById('pass').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('buttonShowPassword').innerHTML = `<i class="fas fa-eye-slash"></i>`;
            }
        }
    </script>
    
</body>
</html>