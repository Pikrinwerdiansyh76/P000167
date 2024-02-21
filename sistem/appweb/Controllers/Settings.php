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
    }elseif((isset($_POST['_submit_']))){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "edit-pengaturan":

                // Data file
                $link               = $base_url_admin."/pengaturan";
                // $penyimpananGambar  = "$base_url/assets/files/images/pages";
                $penyimpananGambar  = "../../../assets/files/images";
                $database           = "pengaturan";
                // Data file

                $id_pengaturan      = htmlspecialchars($_POST['___in_id_pengaturan']);
                $judul              = $_POST['___in_judul'];
                $jenis_pengaturan   = $_POST['___in_jenis_pengaturan'];

                if ($jenis_pengaturan==="Gambar") {
                    // Gambar
                        $lokasi_file    = $_FILES['___in_gambar']['tmp_name'];
                        $lokasi_upload  = "$penyimpananGambar/";
                        $nama_file      = $_FILES['___in_gambar']['name'];
                        $tipe_file      = strtolower($_FILES['___in_gambar']['type']);
                        $tipe_file2     = seo2($tipe_file); // ngedapetin png / jpg / jpeg
                        $ukuran         = $_FILES['___in_gambar']['size'];
                        $nama_file_unik = seo($judul).".".$tipe_file2;

                        $in_gambar_lama     = $_POST['___in_gambar_lama'];
                        $cariExtensiGambar  = explode(".", $in_gambar_lama);
                        $extensiGambarnya   = $cariExtensiGambar[1];

                        if (empty($nama_file)){
                            // Ubah nama gambar
                            rename("$penyimpananGambar/$in_gambar_lama", "$penyimpananGambar/$nama_file_unik$extensiGambarnya");
                            // Ubah nama gambar

                            $gambar = $nama_file_unik.$extensiGambarnya;
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

                            $gambar = $nama_file_unik;
                        }
                    // Gambar
                    $deskripsi  = NULL;
                }else{
                    $deskripsiE = explode('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', $_POST['___in_deskripsi']);
                    $deskripsi  = $deskripsiE[0];
                    $gambar     = NULL;
                }

                try {
                    $sql = "UPDATE $database
                            SET judul           = :judul,
                                gambar          = :gambar,
                                deskripsi       = :deskripsi,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_pengaturan
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_pengaturan", $id_pengaturan, PDO::PARAM_INT);
                    $statement->bindParam(":judul", $judul, PDO::PARAM_STR);
                    $statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
                    $statement->bindParam(":deskripsi", $deskripsi, PDO::PARAM_STR);

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