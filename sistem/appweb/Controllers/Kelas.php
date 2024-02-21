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
            case "add-kelas":

                // Data file
                $link           = $base_url_admin."/kelas";
                $database       = "kelas";
                // Data file

                $nama_kelas     = htmlspecialchars($_POST['___in_nama_kelas']);

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (nama_kelas)
                            VALUES(:nama_kelas)" );
                            
                    $stmt->bindParam(":nama_kelas", $nama_kelas, PDO::PARAM_STR);

                    $count = $stmt->execute();
                            
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

            case "edit-kelas":

                // Data file
                    $database   = "kelas";
                    $link       = $base_url_admin."/kelas";
                // Data file

                $id_kelas       = $_POST['___in_id_kelas'];
                $nama_kelas     = htmlspecialchars($_POST['___in_nama_kelas']);

                try {
                    $sql = "UPDATE $database
                            SET nama_kelas      = :nama_kelas
                            WHERE id_$database  = :id_kelas
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                    $statement->bindParam(":nama_kelas", $nama_kelas, PDO::PARAM_STR);

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