<?php
switch ($_GET['act']) {
    case "list":
        $hal        = "Daftar Kelas";
        $database   = "wali_kelas";
        $database2  = "akun";
        $database3  = "kelas";
        $database4  = "semester";
        $database5  = "jadwal_mengajar";
        $database6  = "mapel";
        $link       = "rekap-presensi";

        if (isset($_POST['_submit_'])) {
            $getSemester = $_POST['___in_id_semester'];

            echo "<script>window.location = '$base_url_admin/$link/$getSemester';</script>";
            die();
            exit();
        } else {
            $getSemester = $_GET['semester'];
        }

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

            if ($rowDataSemester > 0) {
                $resultDataSemester = $queryDataSemester->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "<script>window.location = '$base_url_admin/$link';</script>";
                die();
                exit();
            }
        } catch (Exception $e) {
            var_dump($e);
        }
?>

<div class="content">
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $hal ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i
                                        class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $hal ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-outline-pink rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#filterSemester"><i class="fas fa-filter"></i> Filter Semester</button>

                    <div id="filterSemester" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form action="<?= $base_url_admin ?>/<?= $link ?>/<?= $getSemester ?>" method="POST"
                                data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Filter Semester</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12 my-1">
                                        <select class="form-select form-select-lg id_siswa p-0" id="id_semester"
                                            name="___in_id_semester" aria-label="Pilih Semester" required="">
                                            <?php
                                                    try {
                                                        $querySemester = $pdo->prepare("
                                                        SELECT *
                                                        FROM $database4
                                                    ");

                                                        $querySemester->execute();
                                                        while ($resultSemester = $querySemester->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                            <option value="<?= $resultSemester['id_semester']; ?>"
                                                <?php if ($resultSemester['id_semester'] == $getSemester) {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>><?= $resultSemester['tahun_ajaran']; ?>
                                                <?= $resultSemester['nama_semester']; ?></option>
                                            <?php
                                                        }
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="___in_link"
                                        value="<?= $base_url_admin ?>/<?= $link ?>/<?= $getSemester ?>" required="">
                                    <button type="submit" name="_submit_" class="btn btn-info"><i
                                            class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="20%">Tahun Ajaran</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataSemester['tahun_ajaran'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Semester</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataSemester['nama_semester'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th width="20%">Kelas</th>
                                        <th>Nama Wali Kelas</th>
                                        <th width="30%">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                            $no = 1;
                                            $queryData  = $pdo->prepare("
                                            SELECT *
                                            FROM $database
                                            INNER JOIN $database2 ON $database.id_$database2 = $database2.id_$database2
                                            INNER JOIN $database3 ON $database.id_$database3 = $database3.id_$database3
                                        ");

                                            $queryData->execute();
                                            while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                            ?>

                                    <tr>
                                        <td class="text-wrap"><?= $no++ ?></td>
                                        <td class="text-wrap text-center"><?= $resultData['nama_kelas'] ?></td>
                                        <td class="text-wrap text-center"><?= $resultData['nama'] ?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="<?= $base_url_admin ?>/<?= $link ?>/<?= $resultData['id_kelas'] ?>/<?= $resultDataSemester['id_semester'] ?>/<?= date("Y-m") ?>"
                                                    class="btn btn-sm btn-outline-pink"><i
                                                        class="fas fa-external-link-alt"></i> Detail Rekap Presensi</a>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        break;
    case "rekap-presensi":
        $hal        = "Daftar Kelas";
        $halActive  = "Presensi";
    ?>

<div class="content">
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $halActive ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i
                                        class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base_url_admin ?>/<?= $link ?>/<?= $getSemester ?>"><?= $hal ?></a></li>
                            <li class="breadcrumb-item active"><?= $halActive ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <a href="<?= $base_url_admin ?>/<?= $link ?>/<?= $getSemester ?>"
                        class="btn btn-xs btn-outline-secondary rounded-pill"><i
                            class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                    <button type="button" class="btn btn-outline-pink rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#filterSemester"><i class="fas fa-filter"></i> Filter Bulan</button>

                    <div id="filterSemester" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form
                                action="<?= $base_url_admin ?>/<?= $link ?>/<?= $getKelas ?>/<?= $getSemester ?>/<?= $getBulan ?>"
                                method="POST" data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Filter Bulan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12 my-1">
                                        <select class="form-select form-select-lg id_siswa p-0" id="bulan"
                                            name="___in_bulan" aria-label="Pilih Bulan" required="">
                                            <?php
                                                    try {
                                                        $queryBulan = $pdo->prepare("
                                                        SELECT DISTINCT bulan
                                                        FROM $database7
                                                        WHERE id_semester = ?
                                                        AND id_kelas = ?
                                                    ");

                                                        $queryBulan->bindValue(1, $getSemester);
                                                        $queryBulan->bindValue(2, $getKelas);
                                                        $queryBulan->execute();
                                                        while ($resultBulan = $queryBulan->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                            <option value="<?= $resultBulan['bulan']; ?>" <?php if ($resultBulan['bulan'] === $getBulan) {
                                                                                                                echo 'selected';
                                                                                                            } ?>>
                                                <?= indoBln($resultBulan['bulan']); ?></option>
                                            <?php
                                                        }
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="___in_id_kelas" value="<?= $getKelas ?>" required="">
                                    <input type="hidden" name="___in_id_semester" value="<?= $getSemester ?>"
                                        required="">
                                    <input type="hidden" name="___in_link"
                                        value="<?= $base_url_admin ?>/<?= $link ?>/<?= $getKelas ?>/<?= $getSemester ?>/<?= $getBulan ?>"
                                        required="">
                                    <button type="submit" name="_submit_" class="btn btn-info"><i
                                            class="fas fa-search"></i> Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="15%">Kelas</th>
                                <th width="5%" class="text-center">:</th>
                                <td><?= $resultDataKelas['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Bulan</th>
                                <th width="5%" class="text-center">:</th>
                                <td><?= getBulan2($getBulan2) ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Tahun Ajaran</th>
                                <th width="5%" class="text-center">:</th>
                                <td><?= $resultDataSemester['tahun_ajaran'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Semester</th>
                                <th width="5%" class="text-center">:</th>
                                <td><?= $resultDataSemester['nama_semester'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th width="20%">NISN</th>
                                        <th width="25%">Nama Siswa</th>
                                        <th width="10%">Jenis Kelamin</th>
                                        <th width="10%">Hadir</th>
                                        <th width="10%">Sakit</th>
                                        <th width="10%">Izin</th>
                                        <th width="10%">Alpa</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                            $no     = 1;
                                            $Hadir  = "Hadir";
                                            $Sakit  = "Sakit";
                                            $Izin   = "Izin";
                                            $Alpa   = "Alpa";
                                            try {
                                                $queryData  = $pdo->prepare("
                                                SELECT *
                                                FROM $database9
                                                INNER JOIN $database8 ON $database9.id_$database8 = $database8.id_$database8
                                                WHERE $database9.id_semester = ?
                                                AND $database9.id_kelas = ?
                                            ");

                                                $queryData->bindValue(1, $getSemester);
                                                $queryData->bindValue(2, $getKelas);
                                                $queryData->execute();
                                                $rowData = $queryData->rowCount();
                                                while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                                    try {
                                                        $queryDataHadir  = $pdo->prepare("
                                                        SELECT DISTINCT tanggal
                                                        FROM $database7
                                                        WHERE id_semester = ?
                                                        AND id_kelas = ?
                                                        AND id_siswa = ?
                                                        AND bulan = ?
                                                        AND kehadiran = ?
                                                    ");

                                                        $queryDataHadir->bindValue(1, $getSemester);
                                                        $queryDataHadir->bindValue(2, $getKelas);
                                                        $queryDataHadir->bindValue(3, $resultData['id_siswa']);
                                                        $queryDataHadir->bindValue(4, $getBulan);
                                                        $queryDataHadir->bindValue(5, $Hadir);
                                                        $queryDataHadir->execute();
                                                        $rowDataHadir = $queryDataHadir->rowCount();
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                    try {
                                                        $queryDataSakit  = $pdo->prepare("
                                                        SELECT DISTINCT tanggal
                                                        FROM $database7
                                                        WHERE id_semester = ?
                                                        AND id_kelas = ?
                                                        AND id_siswa = ?
                                                        AND bulan = ?
                                                        AND kehadiran = ?
                                                    ");

                                                        $queryDataSakit->bindValue(1, $getSemester);
                                                        $queryDataSakit->bindValue(2, $getKelas);
                                                        $queryDataSakit->bindValue(3, $resultData['id_siswa']);
                                                        $queryDataSakit->bindValue(4, $getBulan);
                                                        $queryDataSakit->bindValue(5, $Sakit);
                                                        $queryDataSakit->execute();
                                                        $rowDataSakit = $queryDataSakit->rowCount();
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                    try {
                                                        $queryDataIzin  = $pdo->prepare("
                                                        SELECT DISTINCT tanggal
                                                        FROM $database7
                                                        WHERE id_semester = ?
                                                        AND id_kelas = ?
                                                        AND id_siswa = ?
                                                        AND bulan = ?
                                                        AND kehadiran = ?
                                                    ");

                                                        $queryDataIzin->bindValue(1, $getSemester);
                                                        $queryDataIzin->bindValue(2, $getKelas);
                                                        $queryDataIzin->bindValue(3, $resultData['id_siswa']);
                                                        $queryDataIzin->bindValue(4, $getBulan);
                                                        $queryDataIzin->bindValue(5, $Izin);
                                                        $queryDataIzin->execute();
                                                        $rowDataIzin = $queryDataIzin->rowCount();
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                    try {
                                                        $queryDataAlpa  = $pdo->prepare("
                                                        SELECT DISTINCT tanggal
                                                        FROM $database7
                                                        WHERE id_semester = ?
                                                        AND id_kelas = ?
                                                        AND id_siswa = ?
                                                        AND bulan = ?
                                                        AND kehadiran = ?
                                                    ");

                                                        $queryDataAlpa->bindValue(1, $getSemester);
                                                        $queryDataAlpa->bindValue(2, $getKelas);
                                                        $queryDataAlpa->bindValue(3, $resultData['id_siswa']);
                                                        $queryDataAlpa->bindValue(4, $getBulan);
                                                        $queryDataAlpa->bindValue(5, $Alpa);
                                                        $queryDataAlpa->execute();
                                                        $rowDataAlpa = $queryDataAlpa->rowCount();
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                            ?>

                                    <tr>
                                        <td class="text-wrap"><?= $no++ ?></td>
                                        <td class="text-wrap text-center"><span
                                                class="badge bg-pink fs-5"><?= $resultData['nisn'] ?></span></td>
                                        <td class="text-wrap text-center"><?= $resultData['nama_siswa'] ?></td>
                                        <td class="text-wrap text-center"><?= $resultData['jenis_kelamin'] ?></td>
                                        <td class="text-wrap text-center"><?= $rowDataHadir ?></td>
                                        <td class="text-wrap text-center"><?= $rowDataSakit ?></td>
                                        <td class="text-wrap text-center"><?= $rowDataIzin ?></td>
                                        <td class="text-wrap text-center"><?= $rowDataAlpa ?></td>
                                    </tr>

                                    <?php
                                                }
                                            } catch (Exception $e) {
                                                var_dump($e);
                                            }
                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        break;
    default:
        echo "<script>window.location = '$base_url_admin/404';</script>";
        die();
        exit();
}
?>