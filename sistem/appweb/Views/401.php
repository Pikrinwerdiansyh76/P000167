<?php
    require "../../../../appweb/Config/SetWebsite.php";
    require "../../../../appweb/Config/Db.php";
    require "../../../../appweb/Config/AssetsWebsite.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Error Page | 404 | Page not Found | Adminto - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $base_url_admin ?>/assets/images/favicon.ico">

	<!-- App css -->
	<link href="<?= $base_url_admin ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	<link href="<?= $base_url_admin ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	<!-- App-dark css -->
	<link href="<?= $base_url_admin ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled"/>
	<link href="<?= $base_url_admin ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled"/>

	<!-- icons -->
	<link href="<?= $base_url_admin ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="index.html" class="logo">
                            <img src="<?= $base_url_admin ?>/assets/images/logo-dark.png" alt="" height="22" class="logo-light mx-auto">
                        </a>
                        <img src="<?= $base_url; ?>/assets/files/images/<?= $logoDesktop; ?>" alt="<?= $judulLogoDesktop; ?>" class="w-75 mb-4">
                    </div>
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center">
                                <h1 class="text-error">404</h1>
                                <h3 class="mt-3 mb-2">Page not Found</h3>
                                <p class="text-muted mb-3">It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. You might want to check your internet connection. Here's a little tip that might help you get back on track.</p>

                                <a href="<?= $base_url_admin ?>/dashboard" class="btn btn-danger waves-effect waves-light"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                            </div>


                        </div> <!-- end card-body -->
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

    <!-- App js -->
    <script src="<?= $base_url_admin ?>/assets/js/app.min.js"></script>

</body>
</html>