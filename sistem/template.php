<?php
    error_reporting(E_ALL);
    // error_reporting(0);
    require "../appweb/Config/SetWebsite.php";
    require "../appweb/Config/Db.php";
    require "../appweb/Config/AssetsWebsite.php";
    require "appweb/Libraries/others.php";

    session_start();

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }else{
        try{
            $stmtS  = $pdo->prepare("
                SELECT id_akun
                FROM akun
                WHERE session = ?
            ");

            $stmtS->bindValue(1, $_SESSION['_session__']);
            $stmtS->execute();
            $rowsS  = $stmtS->rowCount();

            if ($rowsS==0) {
                try{
                    $stmtS2  = $pdo->prepare("
                        SELECT id_siswa
                        FROM siswa
                        WHERE session = ?
                    ");

                    $stmtS2->bindValue(1, $_SESSION['_session__']);
                    $stmtS2->execute();
                    $rowsS2  = $stmtS2->rowCount();

                    if ($rowsS2==0) {
                        header("location: $base_url_admin/keluar-edit");
                        die();
                        exit();
                    }
                }catch(Exception $e) {
                    var_dump($e);
                    exit();
                    die();
                }
            }
        }catch(Exception $e) {
            var_dump($e);
            exit();
            die();
        }
    }

    if ($_SESSION['_msg__']==="Gagal") {
        $_SESSION['_alert__']   = 0;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="Berhasil") {
        $_SESSION['_alert__']   = 1;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="FromLogin") {
        $_SESSION['_alert__']   = 2;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="cekFile") {
        $_SESSION['_alert__']   = 3;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="CekSize") {
        $_SESSION['_alert__']   = 3;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="GagalSlug") {
        $_SESSION['_alert__']   = 4;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="UsernameTerdaftar") {
        $_SESSION['_alert__']   = 5;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="PasswordTidakSama") {
        $_SESSION['_alert__']   = 6;
        $_SESSION['_msg__']     = NULL;
    }else{
        $_SESSION['_alert__']   = NULL;
        $_SESSION['_msg__']     = NULL;
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>
        <?php if ($_GET['module']=="rekap-presensi" AND $_GET['act']=="rekap-presensi"): ?>
            <?php
                $database   = "wali_kelas";
                $database2  = "akun";
                $database3  = "kelas";
                $database4  = "semester";
                $database5  = "jadwal_mengajar";
                $database6  = "mapel";
                $database7  = "absensi";
                $database8  = "siswa";
                $database9  = "rombel";
                $link       = "rekap-presensi";

                if (isset($_POST['_submit_'])) {
                    $getKelas       = $_POST['___in_id_kelas'];
                    $getSemester    = $_POST['___in_id_semester'];
                    $getBulan       = $_POST['___in_bulan'];

                    echo "<script>window.location = '$base_url_admin/$link/$getKelas/$getSemester/$getBulan';</script>";
                    die();
                    exit();
                }else{
                    $getKelas       = $_GET['id_kelas'];
                    $getSemester    = $_GET['semester'];
                    $getBulan       = $_GET['bulan'];
                    $getBulan2      = explode("-", $_GET['bulan'])[1];
                }

                try {
                    $queryDataKelas  = $pdo->prepare("
                        SELECT *
                        FROM $database3
                        WHERE id_kelas = ?
                        LIMIT 1
                    ");

                    $queryDataKelas->bindValue(1, $getKelas);
                    $queryDataKelas->execute();
                    $rowDataKelas    = $queryDataKelas->rowCount();
                    if ($rowDataKelas>0) {
                        $resultDataKelas = $queryDataKelas->fetch(PDO::FETCH_ASSOC);

                        try {
                            $queryDataSemester  = $pdo->prepare("
                                SELECT *
                                FROM $database4
                                WHERE id_semester = ?
                                LIMIT 1
                            ");

                            $queryDataSemester->bindValue(1, $getSemester);
                            $queryDataSemester->execute();
                            $rowDataSemester    = $queryDataSemester->rowCount();

                            if ($rowDataSemester>0) {
                                $resultDataSemester = $queryDataSemester->fetch(PDO::FETCH_ASSOC);
                            }else{
                                echo "<script>window.location = '$base_url_admin/$link';</script>";
                                die();
                                exit();
                            }
                        } catch (Exception $e) {
                            var_dump($e);
                        }
                    }else{
                        echo "<script>window.location = '$base_url_admin/$link';</script>";
                        die();
                        exit();
                    }
                } catch (Exception $e) {
                    var_dump($e);
                }
            ?>
            Rekap Presensi <?= $resultDataKelas['nama_kelas'] ?> (Bulan <?= getBulan2($getBulan2) ?>)
        <?php else: ?>
            <?= $_GET['module'] ?> - Portal Admin <?= $nama_web ?>
        <?php endif ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="<?= $nama_web ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="<?= $base_url; ?>/assets/files/images/<?= $icon; ?>" />

    <!-- icons -->
    <link href="<?= $base_url_admin ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?= $base_url_admin ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= $base_url_admin ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- App-dark css -->
    <link href="<?= $base_url_admin ?>/assets/css/bootstrap-dark.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled"/>
    <link href="<?= $base_url_admin ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled"/>

    <!-- Plugins CSS-->
        <!-- All Pages Sweet Alerts js -->
        <link href="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- End All Pages Sweet Alerts js -->

        <!-- Pengaturan & Dashboard -->
        <?php if (($_GET['module']==="pengaturan") OR ($_GET['module']==="dashboard")): ?>
            <link href="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

            <link href="<?= $base_url_admin ?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <!-- End Pengaturan & Dashboard -->

        <!-- Data -->
        <?php elseif (($_GET['module']==="kelas") OR ($_GET['module']==="semester") OR ($_GET['module']==="mapel") OR ($_GET['module']==="wali-kelas") OR ($_GET['module']==="jadwal-mengajar") OR ($_GET['module']==="presensi") OR ($_GET['module']==="rekap-presensi")): ?>
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

            <link href="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

            <link rel="stylesheet" type="text/css" href="<?= $base_url_admin ?>/assets/libs/selectize/css/selectize.css" />
            <link rel="stylesheet" type="text/css" href="<?= $base_url_admin ?>/assets/libs/selectize/css/selectize.bootstrap5.css" />
        <!-- End Data -->

        <!-- Pegawai, Guru & Siswa -->
        <?php elseif (($_GET['module']==="pegawai") OR ($_GET['module']==="guru") OR ($_GET['module']==="siswa")): ?>
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

            <link href="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= $base_url_admin ?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="<?= $base_url_admin ?>/assets/libs/validation-pass-arpateam/css/style.css">

            <link rel="stylesheet" type="text/css" href="<?= $base_url_admin ?>/assets/libs/selectize/css/selectize.css" />
            <link rel="stylesheet" type="text/css" href="<?= $base_url_admin ?>/assets/libs/selectize/css/selectize.bootstrap5.css" />
        <!-- End Pegawai, Guru & Siswa -->
        <?php endif ?>
    <!-- Plugins CSS-->

    <base href="<?= $base_url_admin; ?>/">
</head>
<!-- body start -->
<body class="loading" data-layout='{"mode": "dark", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "dark", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <?php require "appweb/Models/Header.php"; ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php require "appweb/Models/Menu.php"; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
     
        <div class="content-page">
            <!-- content -->
            <?php require "appweb/Controllers/Contents.php"; ?>
            <!-- End content -->

            <!-- Footer Start -->
            <?php require "appweb/Models/Footer.php"; ?>
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="<?= $base_url_admin ?>/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?= $base_url_admin ?>/assets/libs/feather-icons/feather.min.js"></script>
    
    <!-- App js-->
    <script src="<?= $base_url_admin ?>/assets/js/app.min.js"></script>

    <!-- Plugins js-->
        <!-- Pengaturan & Dashboard -->
        <?php if (($_GET['module']==="pengaturan") OR ($_GET['module']==="dashboard")): ?>
            <script src="<?= $base_url_admin ?>/assets/libs/parsleyjs/parsley.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropify/js/dropify.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-fileuploads.init.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-validation.init.js"></script>

            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>

            <script src="<?= $base_url_admin ?>/assets/libs/flatpickr/flatpickr.min.js"></script>
            <script>
                "use strict";
                !(function (t) {
                    function e() {}
                    (e.prototype.init = function () {
                        t("#masa_berlaku").flatpickr();
                    }),
                        (t.FormPickers = new e()),
                        (t.FormPickers.Constructor = e);
                })(window.jQuery),
                    window.jQuery.FormPickers.init();
            </script>

            <script>
                "use strict";
                $(document).ready(function () {
                    $("#datatable").DataTable({"order": []});
                    $(".datatables").DataTable({"order": []});
                    var a = $("#datatable-buttons").DataTable({ "order": [], buttons: ["pdf"] });
                    $("#key-table").DataTable({ keys: !0 }),
                        $("#responsive-datatable").DataTable({"order": []}),
                        $("#selection-datatable").DataTable({ select: { style: "multi" } }),
                        a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
                        $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
                        $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
                        $(".dataTables_length label").addClass("form-label");
                });
            </script>
        <!-- End Pengaturan & Dashboard -->

        <!-- Data -->
        <?php elseif (($_GET['module']==="kelas") OR ($_GET['module']==="semester") OR ($_GET['module']==="mapel") OR ($_GET['module']==="wali-kelas") OR ($_GET['module']==="jadwal-mengajar") OR ($_GET['module']==="presensi") OR ($_GET['module']==="rekap-presensi")): ?>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>

            <script src="<?= $base_url_admin ?>/assets/libs/parsleyjs/parsley.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropify/js/dropify.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-fileuploads.init.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-validation.init.js"></script>

            <script type="text/javascript" src="<?= $base_url_admin ?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
            <script type="text/javascript" src="<?= $base_url_admin ?>/assets/libs/selectize/js/selectize.min.js"></script>

            <script>
                "use strict";
                $(document).ready(function () {
                    $("#datatable").DataTable({"order": []});
                    $(".datatables").DataTable({"order": []});
                    var a = $("#datatable-buttons").DataTable({ "order": [], buttons: ["pdf"] });
                    $("#key-table").DataTable({ keys: !0 }),
                        $("#responsive-datatable").DataTable({"order": []}),
                        $("#selection-datatable").DataTable({ select: { style: "multi" } }),
                        a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
                        $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
                        $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
                        $(".dataTables_length label").addClass("form-label");
                });
            </script>

            <script>
                function confirmHapusPelayananSKTLK(enkripsi, link) {
                    Swal.fire({
                        title: 'Apakah anda yakin ingin Menghapus Data Pelayanan SKTLK ini?',
                        text: "Data yang telah dihapus tidak dapat dikembalikan lagi!",
                        showDenyButton: true,
                        confirmButtonText: 'Ya, Hapus Saja',
                        denyButtonText: 'Batal',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location = "<?= $base_url_admin ?>/actionHapusPelayananSKTLK/" + enkripsi + "/" + link;
                        } else if (result.isDenied) {
                            Swal.fire('Data Pelayanan SKTLK tidak jadi dihapus', '', 'info')
                        }
                    })
                }
            </script>

            <script>
                $(function () {
                    $(".id_siswa").selectize({
                        sortField: "text",
                    });
                    $(".id_guru").selectize({
                        sortField: "text",
                    });
                    $(".id_mapel").selectize({
                        sortField: "text",
                    });
                });
            </script>
        <!-- End Data -->

        <!-- Pegawai, Guru & Siswa -->
        <?php elseif (($_GET['module']==="pegawai") OR ($_GET['module']==="guru") OR ($_GET['module']==="siswa")): ?>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

            <script src="<?= $base_url_admin ?>/assets/libs/parsleyjs/parsley.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/dropify/js/dropify.min.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-fileuploads.init.js"></script>
            <script src="<?= $base_url_admin ?>/assets/js/pages/form-validation.init.js"></script>
            <script src="<?= $base_url_admin ?>/assets/libs/validation-pass-arpateam/js/validation.js"></script>

            <script type="text/javascript" src="<?= $base_url_admin ?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
            <script type="text/javascript" src="<?= $base_url_admin ?>/assets/libs/selectize/js/selectize.min.js"></script>

            <script>
                $(function () {
                    $(".id_kelas").selectize({
                        sortField: "text",
                    });
                });
            </script>

            <!-- Show Password -->
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
                function showUlangiPassword() {

                    // membuat variabel berisi tipe input dari id='passUlangi', id='passUlangi' adalah form input password 
                    var x = document.getElementById('passUlangi').type;

                    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
                    if (x == 'password') {

                        //ubah form input password menjadi text
                        document.getElementById('passUlangi').type = 'text';
                        
                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowUlangiPassword').innerHTML = `<i class="fas fa-eye"></i>`;
                    }else{

                        //ubah form input password menjadi text
                        document.getElementById('passUlangi').type = 'password';

                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowUlangiPassword').innerHTML = `<i class="fas fa-eye-slash"></i>`;
                    }
                }
            </script>
            <!-- Show Password -->

            <script>
                "use strict";
                $(document).ready(function () {
                    $("#datatable").DataTable({"order": []});
                    $(".datatables").DataTable({"order": []});
                    var a = $("#datatable-buttons").DataTable({ "order": [], buttons: ["pdf"] });
                    $("#key-table").DataTable({ keys: !0 }),
                        $("#responsive-datatable").DataTable({"order": []}),
                        $("#selection-datatable").DataTable({ select: { style: "multi" } }),
                        a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
                        $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
                        $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
                        $(".dataTables_length label").addClass("form-label");
                });
            </script>
        <!-- End Pegawai, Guru & Siswa -->
        <?php endif ?>

        <!-- All Pages Sweet Alerts js -->
            <script src="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
            <?php if ($_SESSION['_alert__']===0): ?>
                <script>
                    Swal.fire({ title: "GAGAL!", text: "Sistem tidak dapat memproses permintaan anda. Silahkan coba lagi!", icon: "error" });
                </script>
            <?php elseif ($_SESSION['_alert__']===1): ?>
                <script>
                    Swal.fire({ title: "BERHASIL!", text: "Permintaan anda berhasil di proses oleh sistem!", icon: "success" });
                </script>
            <?php elseif ($_SESSION['_alert__']===2): ?>
                <script>
                    Swal.fire({ title: "Hai <?= $_SESSION['_nama__'] ?>, Selamat Datang di Ruang Kerja <?= $nama_web ?>", text: "Jangan lupa semangat kerja untuk hari ini!", icon: "info" });
                </script>
            <?php elseif ($_SESSION['_alert__']===3): ?>
                <script>
                    Swal.fire({ title: "GAGAL!", text: "Sistem tidak dapat mengupload file anda! File anda terlalu besar atau file anda tidak dapat diterima oleh sistem kami! Mohon ulangi lagi!", icon: "error" });
                </script>
            <?php elseif ($_SESSION['_alert__']===4): ?>
                <script>
                    Swal.fire({ title: "GAGAL!", text: "Pengaturan Slug error! Mohon ulangi kembali!", icon: "error" });
                </script>
            <?php elseif ($_SESSION['_alert__']===5): ?>
                <script>
                    Swal.fire({ title: "USERNAME TERDAFTAR!", text: "Mohon masukkan username yang lain!", icon: "error" });
                </script>
            <?php elseif ($_SESSION['_alert__']===6): ?>
                <script>
                    Swal.fire({ title: "GAGAL!", text: "Mohon masukkan password anda kembali!", icon: "error" });
                </script>
            <?php endif ?>
        <!-- End All Pages Sweet Alerts js -->
    <!-- Plugins js-->
    
</body>
</html>