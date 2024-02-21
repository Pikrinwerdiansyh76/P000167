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
            case "add-mapel":

                // Data file
                $link           = $base_url_admin."/mapel";
                $database       = "mapel";
                // Data file

                $nama_mapel     = htmlspecialchars($_POST['___in_nama_mapel']);

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (nama_mapel)
                            VALUES(:nama_mapel)" );
                            
                    $stmt->bindParam(":nama_mapel", $nama_mapel, PDO::PARAM_STR);

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

            case "edit-mapel":

                // Data file
                    $database   = "mapel";
                    $link       = $base_url_admin."/mapel";
                // Data file

                $id_mapel       = $_POST['___in_id_mapel'];
                $nama_mapel     = htmlspecialchars($_POST['___in_nama_mapel']);

                try {
                    $sql = "UPDATE $database
                            SET nama_mapel      = :nama_mapel
                            WHERE id_$database  = :id_mapel
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_mapel", $id_mapel, PDO::PARAM_INT);
                    $statement->bindParam(":nama_mapel", $nama_mapel, PDO::PARAM_STR);

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