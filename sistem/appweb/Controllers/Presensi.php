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
        case "add-presensi":

            // Data file
            $link       = $_POST['___in_link'];
            $database1  = "absensi";
            $database2  = "rombel";
            // Data file

            $id_semester        = htmlspecialchars($_POST['___in_id_semester']);
            $id_kelas           = htmlspecialchars($_POST['___in_id_kelas']);
            $id_jadwal_mengajar = htmlspecialchars($_POST['___in_id_jadwal_mengajar']);
            $bulan              = date("Y-m");
            $tanggal            = date("Y-m-d");

            try {
                $querySiswa  = $pdo->prepare("
                        SELECT *
                        FROM $database2
                        WHERE id_semester = ?
                        AND id_kelas = ?
                    ");

                $querySiswa->bindValue(1, $id_semester);
                $querySiswa->bindValue(2, $id_kelas);
                $querySiswa->execute();
                while ($resultSiswa = $querySiswa->fetch(PDO::FETCH_ASSOC)) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO $database1
                                    (id_semester,id_kelas,id_jadwal_mengajar,id_siswa,bulan,tanggal)
                                    VALUES(:id_semester,:id_kelas,:id_jadwal_mengajar,:id_siswa,:bulan,:tanggal)");

                        $stmt->bindParam(":id_semester", $id_semester, PDO::PARAM_INT);
                        $stmt->bindParam(":id_kelas", $id_kelas, PDO::PARAM_INT);
                        $stmt->bindParam(":id_jadwal_mengajar", $id_jadwal_mengajar, PDO::PARAM_INT);
                        $stmt->bindParam(":id_siswa", $resultSiswa['id_siswa'], PDO::PARAM_INT);
                        $stmt->bindParam(":bulan", $bulan, PDO::PARAM_STR);
                        $stmt->bindParam(":tanggal", $tanggal, PDO::PARAM_STR);

                        $count      = $stmt->execute();
                        $insertId   = $pdo->lastInsertId();
                    } catch (PDOException $e) {
                        $_SESSION['_msg__'] = 'Gagal';
                        echo "<script>window.location(history.back(0))</script>";
                        die();
                        exit();
                    }
                }
            } catch (Exception $e) {
                var_dump($e);
            }

            $_SESSION['_msg__'] = 'Berhasil';
            echo "<script>window.location = '$link'</script>";
            die();
            exit();

            break;

        case "edit-presensi":

            // Data file
            $link       = $_POST['___in_link'];
            $database   = "absensi";
            // Data file

            try {
                $pdo->beginTransaction(); // Mulai transaksi

                // Loop melalui data presensi yang diterima dari $_POST
                foreach ($_POST['___in_id_absensi'] as $id_absensi => $id) {
                    // Ambil nilai kehadiran untuk absensi saat ini
                    $kehadiran = $_POST['___in_kehadiran'][$id_absensi][0]; // Untuk sementara, asumsikan hanya satu kehadiran yang dipilih

                    // Buat dan jalankan kueri UPDATE untuk setiap id_absensi
                    $sql = "UPDATE $database
                                SET kehadiran = :kehadiran
                                WHERE id_$database = :id_absensi";
                    $statement = $pdo->prepare($sql);
                    $statement->bindParam(":kehadiran", $kehadiran, PDO::PARAM_STR);
                    $statement->bindParam(":id_absensi", $id_absensi, PDO::PARAM_INT);
                    $statement->execute();
                }

                $pdo->commit(); // Commit transaksi jika tidak ada masalah
                $_SESSION['_msg__']  = "Berhasil";
                echo "<script>window.location = '$link'</script>";
                die();
            } catch (PDOException $e) {
                // Jika terjadi kesalahan, batalkan transaksi dan tampilkan pesan kesalahan
                $pdo->rollBack();
                $_SESSION['_msg__']  = "Gagal";
                echo "<script>window.location(history.back(0))</script>";
                die();
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
