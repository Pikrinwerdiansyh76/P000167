<?php

    session_start();
    // error_reporting(0);
    require "../../../appweb/Config/Db.php";
    require "../../../appweb/Config/AssetsWebsite.php";
    require "../../../appweb/Config/SetWebsite.php";

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }elseif(isset($_POST['_submit_'])){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-guru":

                // Data file
                $link               = $base_url_admin."/guru";
                $penyimpananGambar  = "../../../assets/files/images/avatar";
                $database           = "akun";
                // Data file

                // Cek username
                    $username   = preg_replace('/<[^<]+?>/', ' ', $_POST['___in_username']);

                    try{
                        $stmt   = $pdo->prepare("SELECT 
                            username
                            FROM $database
                            WHERE username = ? LIMIT 1
                        ");

                        $stmt->bindValue(1, $username);
                        $stmt->execute();

                        $rowsCekUsername = $stmt->rowCount();

                        if ($rowsCekUsername>0) {
                            $_SESSION['_msg__'] = 'UsernameTerdaftar';
                            echo "<script>window.location(history.back(0))</script>";
                            exit();
                        }
                    }catch(Exception $e){
                        $_SESSION['_msg__'] = 'UsernameTerdaftar';
                        echo "<script>window.location(history.back(0))</script>";
                        exit();
                    }
                // End Cek username

                // Password
                    $password           = htmlspecialchars($_POST['___in_password']);
                    $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password']);

                    if ($password!=$ulangi_password) {
                        $_SESSION['_msg__'] = 'PasswordTidakSama';
                        echo "<script>window.location(history.back(0))</script>";
                        exit();
                    }else{
                        $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                    }
                // End Password

                $nip_nuptk  = htmlspecialchars($_POST['___in_nip_nuptk']);
                $nama       = htmlspecialchars($_POST['___in_nama']);
                $email      = htmlspecialchars($_POST['___in_email']);
                $level      = "Guru";
                $status     = htmlspecialchars($_POST['___in_status_akun']);

                $seo        = seo($nama." ".$level);

                if (empty($_POST['___in_slug']) || $_POST['___in_slug']===NULL || $_POST['___in_slug']===0) {
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }else{
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar']['size'];
                    $nama_file_unik = seo($nama)."-".seo($level).".".$tipe_file2;

                    // Cek jenis file yang di upload
                    cekFile($tipe_file);
                    // Cek jenis file yang di upload

                    // Cek ukuran file yang di upload
                    cekUkuranFile2mb($ukuran);
                    // Cek ukuran file yang di upload

                    $avatar         = $nama_file_unik;
                // Gambar

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (username,password,nip_nuptk,nama,email,avatar,level,status,slug)
                            VALUES(:username,:password,:nip_nuptk,:nama,:email,:avatar,:level,:status,:slug)" );
                            
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $stmt->bindParam(":nip_nuptk", $nip_nuptk, PDO::PARAM_INT);
                    $stmt->bindParam(":nama", $nama, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $stmt->bindParam(":level", $level, PDO::PARAM_STR);
                    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
                    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);

                    $count = $stmt->execute();

                    // Upload gambar
                        uploadGambarAsli($avatar, $tipe_file, $lokasi_file, $lokasi_upload);
                    // Upload gambar
                            
                    $insertId = $pdo->lastInsertId();

                    if ($count>0) {
                        $_SESSION['_msg__'] = 'Berhasil';
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }     
                }catch(PDOException $e){
                    var_dump($e);
                    exit();
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            case "edit-guru":

                // Data file
                    $penyimpananGambar  = "../../../assets/files/images/avatar";
                    $database           = "akun";
                    $link               = $base_url_admin."/guru";
                // Data file


                $id_akun    = $_POST['___in_id_akun'];
                $nip_nuptk  = htmlspecialchars($_POST['___in_nip_nuptk']);
                $nama       = htmlspecialchars($_POST['___in_nama']);
                $email      = htmlspecialchars($_POST['___in_email']);
                $level      = "Guru";
                $status     = htmlspecialchars($_POST['___in_status_akun']);
                $session    = NULL;

                $seo        = seo($nama." ".$level);

                if ($seo===$_POST['___in_slug_lama']) {
                    $slug   = $_POST['___in_slug_lama'];
                }else{
                    $slug   = $seo;
                    cekSlug($database, $slug);
                }

                // Gambar
                    $lokasi_file    = $_FILES['___in_gambar']['tmp_name'];
                    $lokasi_upload  = "$penyimpananGambar/";
                    $nama_file      = $_FILES['___in_gambar']['name'];
                    $tipe_file      = strtolower($_FILES['___in_gambar']['type']);
                    $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                    $ukuran         = $_FILES['___in_gambar']['size'];
                    $nama_file_unik = seo($nama)."-".seo($level).".".$tipe_file2;

                    $in_gambar_lama     = $_POST['___in_gambar_lama'];
                    $cariExtensiGambar  = explode(".", $in_gambar_lama);
                    $extensiGambarnya   = $cariExtensiGambar[1];

                    if (empty($nama_file)){
                        // Ubah nama gambar
                        rename("$penyimpananGambar/$in_gambar_lama", "$penyimpananGambar/$nama_file_unik$extensiGambarnya");
                        // Ubah nama gambar

                        $avatar = $nama_file_unik.$extensiGambarnya;
                    }else{
                        // Cek jenis file yang di upload
                        cekFile($tipe_file);
                        // Cek jenis file yang di upload

                        // Cek ukuran file yang di upload
                        cekUkuranFile2mb($ukuran);
                        // Cek ukuran file yang di upload

                        // Hapus gambar
                        unlink("$penyimpananGambar/$in_gambar_lama");
                        // Hapus gambar

                        // Upload gambar
                        uploadGambarAsli($nama_file_unik, $tipe_file, $lokasi_file, $lokasi_upload);
                        // Upload gambar

                        $avatar = $nama_file_unik;
                    }
                // Gambar

                try {
                    $sql = "UPDATE $database
                            SET nip_nuptk       = :nip_nuptk,
                                nama            = :nama,
                                email           = :email,
                                avatar          = :avatar,
                                level           = :level,
                                status          = :status,
                                slug            = :slug,
                                session         = :session
                            WHERE id_$database  = :id_akun
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_akun", $id_akun, PDO::PARAM_INT);
                    $statement->bindParam(":nip_nuptk", $nip_nuptk, PDO::PARAM_INT);
                    $statement->bindParam(":nama", $nama, PDO::PARAM_STR);
                    $statement->bindParam(":email", $email, PDO::PARAM_STR);
                    $statement->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $statement->bindParam(":level", $level, PDO::PARAM_STR);
                    $statement->bindParam(":status", $status, PDO::PARAM_STR);
                    $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    $_SESSION['_msg__']  = "Gagal";
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;
            
            case "edit-password":

                // Data file
                $link       = $base_url_admin."/guru";
                $database   = "akun";
                // Data file

                $id_akun            = $_POST['___in_id_akun'];
                $password           = htmlspecialchars($_POST['___in_password']);
                $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password']);

                if ($password!=$ulangi_password) {
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                }else{
                    $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                }

                $session    = NULL;

                try {
                    $sql = "UPDATE $database
                            SET password    = :password,
                                session     = :session
                            WHERE id_akun   = :id_akun
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_akun", $id_akun, PDO::PARAM_STR);
                    $statement->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $statement->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        header("Location: $link");
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    $_SESSION['_msg__']  = "Gagal";
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            default:
                header("location: $base_url_admin/keluar-edit");
                die();
                exit();
        }
    }else{
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }