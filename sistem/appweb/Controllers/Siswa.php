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
} elseif (isset($_POST['_submit_'])) {
    require '../Libraries/others.php';
    require "../Libraries/fungsi_form.php";

    switch ($_GET['act']) {
        case "add-siswa":

            // Data file
            $link           = $base_url_admin . "/siswa";
            $database       = "siswa";
            $database2      = "rombel";
            // Data file

            $username           = "siswa";
            $password_enkrip    = password_hash($username, PASSWORD_DEFAULT);
            $nisn               = htmlspecialchars($_POST['___in_nisn']);
            $nama_siswa         = htmlspecialchars($_POST['___in_nama_siswa']);
            $nama_ibu           = htmlspecialchars($_POST['___in_nama_ibu']);
            $jenis_kelamin      = htmlspecialchars($_POST['___in_jenis_kelamin']);
            $avatar             = "avatar-default.jpeg";
            $status             = htmlspecialchars($_POST['___in_status_akun']);
            $id_semester        = htmlspecialchars($_POST['___in_id_semester']);
            $id_kelas           = htmlspecialchars($_POST['___in_id_kelas']);
            $seo                = seo($nama_siswa) . "-" . seo($nisn);

            if (empty($_POST['___in_slug']) || $_POST['___in_slug'] === NULL || $_POST['___in_slug'] === 0) {
                $slug   = $seo;
                cekSlug($database, $slug);
            } else {
                $slug   = $seo;
                cekSlug($database, $slug);
            }

            try {
                $stmt = $pdo->prepare("INSERT INTO $database
                            (username,password,nisn,nama_siswa,nama_ibu,jenis_kelamin,avatar,status,id_semester,id_kelas,slug)
                            VALUES(:username,:password,:nisn,:nama_siswa,:nama_ibu,:jenis_kelamin,:avatar,:status,:id_semester,:id_kelas,:slug)");

                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                $stmt->bindParam(":nisn", $nisn, PDO::PARAM_STR);
                $stmt->bindParam(":nama_siswa", $nama_siswa, PDO::PARAM_STR);
                $stmt->bindParam(":nama_ibu", $nama_ibu, PDO::PARAM_STR);
                $stmt->bindParam(":jenis_kelamin", $jenis_kelamin, PDO::PARAM_STR);
                $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                $stmt->bindParam(":status", $status, PDO::PARAM_STR);
                $stmt->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                $stmt->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);

                $count = $stmt->execute();

                $insertId = $pdo->lastInsertId();

                if ($count > 0) {
                    try {
                        $stmt2 = $pdo->prepare("INSERT INTO $database2
                                    (id_semester,id_kelas,id_siswa)
                                    VALUES(:id_semester,:id_kelas,:id_siswa)");

                        $stmt2->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                        $stmt2->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                        $stmt2->bindParam(":id_siswa", $insertId, PDO::PARAM_INT);

                        $count2 = $stmt2->execute();

                        $insertId2 = $pdo->lastInsertId();

                        if ($count2 > 0) {
                            $_SESSION['_msg__'] = 'Berhasil';
                            echo "<script>window.location = '$link'</script>";
                            die();
                            exit();
                        }
                    } catch (PDOException $e) {
                        var_dump($e);
                        exit();
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }
            } catch (PDOException $e) {
                var_dump($e);
                exit();
                $_SESSION['_msg__'] = 'Gagal';
                echo "<script>window.location(history.back(0))</script>";
                die();
                exit();
            }

            break;

        case "edit-siswa-ubah-data":

            $id_siswa     = $_POST['___in_id_siswa'];

            // Data file
            $database   = "siswa";
            $database2  = "rombel";
            $link       = $base_url_admin . "/siswa";

            // Data file

            $id_siswa       = htmlspecialchars($_POST['___in_id_siswa']);
            $nisn           = htmlspecialchars($_POST['___in_nisn']);
            $nama_siswa     = htmlspecialchars($_POST['___in_nama_siswa']);
            $nama_ibu       = htmlspecialchars($_POST['___in_nama_ibu']);
            $jenis_kelamin  = htmlspecialchars($_POST['___in_jenis_kelamin']);
            $avatar         = "avatar-default.jpeg";
            $status         = htmlspecialchars($_POST['___in_status_akun']);
            $id_kelas       = htmlspecialchars($_POST['___in_id_kelas']);
            $seo            = seo($nama_siswa) . "-" . seo($nisn);
            $slug           = $seo;
            $session        = NULL;

            try {
                $sql = "UPDATE $database
                            SET nisn            = :nisn,
                                nama_siswa      = :nama_siswa,
                                nama_ibu        = :nama_ibu,
                                jenis_kelamin   = :jenis_kelamin,
                                avatar          = :avatar,
                                status          = :status,
                                id_kelas        = :id_kelas,
                                slug            = :slug,
                                session         = :session
                            WHERE id_$database  = :id_siswa
                        ";

                $statement = $pdo->prepare($sql);

                $statement->bindParam(":id_siswa", $id_siswa, PDO::PARAM_INT);
                $statement->bindParam(":nisn", $nisn, PDO::PARAM_STR);
                $statement->bindParam(":nama_siswa", $nama_siswa, PDO::PARAM_STR);
                $statement->bindParam(":nama_ibu", $nama_ibu, PDO::PARAM_STR);
                $statement->bindParam(":jenis_kelamin", $jenis_kelamin, PDO::PARAM_STR);
                $statement->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                $statement->bindParam(":status", $status, PDO::PARAM_STR);
                $statement->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                $statement->bindParam(":slug", $slug, PDO::PARAM_STR);
                $statement->bindParam(":session", $session, PDO::PARAM_STR);

                $count = $statement->execute();

                if ($count > 0) {
                    try {
                        $sql = "UPDATE $database2
                                    SET id_kelas        = :id_kelas
                                    WHERE id_$database  = :id_siswa
                                ";

                        $statement2 = $pdo->prepare($sql);

                        $statement2->bindParam(":id_siswa", $id_siswa, PDO::PARAM_INT);
                        $statement2->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);

                        $count2 = $statement2->execute();

                        if ($count2 > 0) {
                            $_SESSION['_msg__']  = "Berhasil";
                            echo "<script>window.location = '$link'</script>";
                            die();
                            exit();
                        }
                    } catch (PDOException $e) {
                        $_SESSION['_msg__']  = "Gagal";
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }
            } catch (PDOException $e) {
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
} else {
    header("location: $base_url_admin/keluar-edit");
    die();
    exit();
}