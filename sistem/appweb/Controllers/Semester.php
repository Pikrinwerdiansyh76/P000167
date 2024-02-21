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
            case "add-semester":

                // Data file
                $link           = $base_url_admin."/semester";
                $database       = "semester";
                // Data file

                $nama_semester  = htmlspecialchars($_POST['___in_nama_semester']);
                $tahun_ajaran   = htmlspecialchars($_POST['___in_tahun_ajaran']);

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                            (nama_semester,tahun_ajaran)
                            VALUES(:nama_semester,:tahun_ajaran)" );
                            
                    $stmt->bindParam(":nama_semester", $nama_semester, PDO::PARAM_STR);
                    $stmt->bindParam(":tahun_ajaran", $tahun_ajaran, PDO::PARAM_STR);

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

            case "edit-semester":

                // Data file
                    $database   = "semester";
                    $link       = $base_url_admin."/semester";
                // Data file

                $id_semester    = $_POST['___in_id_semester'];
                $nama_semester  = htmlspecialchars($_POST['___in_nama_semester']);
                $tahun_ajaran   = htmlspecialchars($_POST['___in_tahun_ajaran']);

                try {
                    $sql = "UPDATE $database
                            SET nama_semester   = :nama_semester,
                                tahun_ajaran    = :tahun_ajaran
                            WHERE id_$database  = :id_semester
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                    $statement->bindParam(":nama_semester", $nama_semester, PDO::PARAM_STR);
                    $statement->bindParam(":tahun_ajaran", $tahun_ajaran, PDO::PARAM_STR);

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