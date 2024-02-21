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
            case "edit-wali-kelas":

                // Data file
                    $database   = "wali_kelas";
                    $link       = $base_url_admin."/wali-kelas";
                // Data file

                $id_wali_kelas  = $_POST['___in_id_wali_kelas'];
                $id_akun        = htmlspecialchars($_POST['___in_id_akun']);
                $id_kelas       = htmlspecialchars($_POST['___in_id_kelas']);

                try {
                    $sql = "UPDATE $database
                            SET id_akun         = :id_akun,
                                id_kelas        = :id_kelas
                            WHERE id_$database  = :id_wali_kelas
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_wali_kelas", $id_wali_kelas, PDO::PARAM_INT);
                    $statement->bindParam(":id_akun", $id_akun, PDO::PARAM_INT);
                    $statement->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);

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

            case "add-rombel":

                // Data file
                    $link       = $_POST['___in_link'];
                    $database   = "rombel";
                // Data file

                $id_semester    = htmlspecialchars($_POST['___in_id_semester']);
                $id_kelas       = htmlspecialchars($_POST['___in_id_kelas']);
                $id_siswa       = htmlspecialchars($_POST['___in_id_siswa']);

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (id_semester,id_kelas,id_siswa)
                            VALUES(:id_semester,:id_kelas,:id_siswa)" );
                            
                    $stmt->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                    $stmt->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                    $stmt->bindParam(":id_siswa", $id_siswa, PDO::PARAM_INT);

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

            case "edit-rombel":

                // Data file
                    $link       = $_POST['___in_link'];
                    $database   = "rombel";
                // Data file

                $id_rombel      = $_POST['___in_id_rombel'];
                $id_siswa       = htmlspecialchars($_POST['___in_id_siswa']);

                try {
                    $sql = "UPDATE $database
                            SET id_siswa        = :id_siswa
                            WHERE id_$database  = :id_rombel
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_rombel", $id_rombel, PDO::PARAM_INT);
                    $statement->bindParam(":id_siswa", $id_siswa, PDO::PARAM_INT);

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