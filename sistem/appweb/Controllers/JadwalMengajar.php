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
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-jadwal-mengajar":

                // Data file
                    $link       = $_POST['___in_link'];
                    $database   = "jadwal_mengajar";
                // Data file

                $id_semester    = htmlspecialchars($_POST['___in_id_semester']);
                $id_kelas       = htmlspecialchars($_POST['___in_id_kelas']);
                $id_akun        = htmlspecialchars($_POST['___in_id_akun']);
                $id_mapel       = htmlspecialchars($_POST['___in_id_mapel']);
                $hari           = htmlspecialchars($_POST['___in_hari']);
                $jam            = htmlspecialchars($_POST['___in_jam_mulai'])." s/d ".htmlspecialchars($_POST['___in_jam_selesai']);

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (id_semester,id_kelas,id_akun,id_mapel,hari,jam)
                            VALUES(:id_semester,:id_kelas,:id_akun,:id_mapel,:hari,:jam)" );
                            
                    $stmt->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                    $stmt->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                    $stmt->bindParam(":id_akun", $id_akun, PDO::PARAM_INT);
                    $stmt->bindParam(":id_mapel", $id_mapel, PDO::PARAM_INT);
                    $stmt->bindParam(":hari", $hari, PDO::PARAM_STR);
                    $stmt->bindParam(":jam", $jam, PDO::PARAM_STR);

                    $count = $stmt->execute();
                            
                    $insertId = $pdo->lastInsertId();

                    if ($count>0) {
                        $_SESSION['_msg__'] = 'Berhasil';
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }     
                }catch(PDOException $e){
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            case "edit-jadwal-mengajar":

                // Data file
                    $link       = $_POST['___in_link'];
                    $database   = "jadwal_mengajar";
                // Data file

                $id_jadwal_mengajar = $_POST['___in_id_jadwal_mengajar'];
                $id_akun            = htmlspecialchars($_POST['___in_id_akun']);
                $id_mapel           = htmlspecialchars($_POST['___in_id_mapel']);
                $hari               = htmlspecialchars($_POST['___in_hari']);
                $jam                = htmlspecialchars($_POST['___in_jam_mulai'])." s/d ".htmlspecialchars($_POST['___in_jam_selesai']);

                try {
                    $sql = "UPDATE $database
                            SET id_akun         = :id_akun,
                                id_mapel        = :id_mapel,
                                hari            = :hari,
                                jam             = :jam
                            WHERE id_$database  = :id_jadwal_mengajar
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_jadwal_mengajar", $id_jadwal_mengajar, PDO::PARAM_INT);
                    $statement->bindParam(":id_akun", $id_akun, PDO::PARAM_INT);
                    $statement->bindParam(":id_mapel", $id_mapel, PDO::PARAM_INT);
                    $statement->bindParam(":hari", $hari, PDO::PARAM_STR);
                    $statement->bindParam(":jam", $jam, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    // $_SESSION['_msg__']  = "Gagal";
                    // echo "<script>window.location(history.back(0))</script>";
                    var_dump($e);
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