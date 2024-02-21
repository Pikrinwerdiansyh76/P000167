<?php
switch ($_GET['act']) {
    case "list":
        $hal        = "Jadwal Mengajar";
        $database   = "wali_kelas";
        $database2  = "akun";
        $database3  = "kelas";
        $database4  = "semester";
        $database5  = "jadwal_mengajar";
        $database6  = "mapel";
        $link       = "presensi";

        $getLevel   = "Guru";
        $getHari    = getHari2(date("D"));

        if (isset($_POST['_submit_'])) {
            $getGuru    = $_GET['id_guru'];
            $getSemester = $_POST['___in_id_semester'];

            echo "<script>window.location = '$base_url_admin/$link/$getGuru/$getSemester';</script>";
            die();
            exit();
        } else {
            $getGuru    = $_GET['id_guru'];
            $getSemester = $_GET['semester'];
        }

        try {
            $queryDataGuru  = $pdo->prepare("
                    SELECT *
                    FROM $database2
                    WHERE id_akun = ?
                    LIMIT 1
                ");

            $queryDataGuru->bindValue(1, $getGuru);
            $queryDataGuru->execute();
            $rowDataGuru    = $queryDataGuru->rowCount();
            if ($rowDataGuru > 0) {
                $resultDataGuru = $queryDataGuru->fetch(PDO::FETCH_ASSOC);

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
                            <form action="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>"
                                method="POST" data-parsley-validate="" class="modal-content">
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
                                        value="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>"
                                        required="">
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
                        <table id="datatable"
                            class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="25%">Kelas</th>
                                    <th width="15%">Hari</th>
                                    <th width="20%">Jam</th>
                                    <th width="25%">Mata Pelajaran</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                        $no = 1;
                                        try {
                                            $queryData  = $pdo->prepare("
                                            SELECT *
                                            FROM $database5
                                            INNER JOIN $database3 ON $database5.id_$database3 = $database3.id_$database3
                                            INNER JOIN $database6 ON $database5.id_$database6 = $database6.id_$database6
                                            WHERE $database5.id_semester = ?
                                            AND $database5.id_akun = ?
                                            AND $database5.hari = ?
                                        ");

                                            $queryData->bindValue(1, $getSemester);
                                            $queryData->bindValue(2, $getGuru);
                                            $queryData->bindValue(3, $getHari);
                                            $queryData->execute();
                                            while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                                $arrJam     = explode(" s/d ", $resultData['jam']);
                                                $jamMulai   = $arrJam[0];
                                                $jamSelesai = $arrJam[1];
                                        ?>

                                <tr>
                                    <td class="text-wrap"><?= $no++ ?></td>
                                    <td class="text-wrap text-center"><?= $resultData['nama_kelas'] ?></td>
                                    <td class="text-wrap text-center"><span
                                            class="badge bg-pink fs-5"><?= $resultData['hari'] ?></span></td>
                                    <td class="text-wrap text-center"><?= $resultData['jam'] ?></td>
                                    <td class="text-wrap text-center"><?= $resultData['nama_mapel'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>/<?= $resultData['id_jadwal_mengajar'] ?>"
                                                class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i>
                                                Presensi</a>
                                        </div>
                                    </td>
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

<?php
        break;
    case "presensi":
        $hal        = "Jadwal Mengajar";
        $halActive  = "Presensi";
        $database   = "wali_kelas";
        $database2  = "akun";
        $database3  = "kelas";
        $database4  = "semester";
        $database5  = "jadwal_mengajar";
        $database6  = "mapel";
        $database7  = "absensi";
        $database8  = "siswa";
        $link       = "presensi";

        $getLevel   = "Guru";
        $getHari    = getHari2(date("D"));

        if (isset($_POST['_submit_'])) {
            $getGuru    = $_GET['id_guru'];
            $getSemester = $_POST['___in_id_semester'];
            $getJadwalMengajar = $_POST['___in_id_jadwal_mengajar'];

            echo "<script>window.location = '$base_url_admin/$link/$getGuru/$getSemester';</script>";
            die();
            exit();
        } else {
            $getGuru    = $_GET['id_guru'];
            $getSemester = $_GET['semester'];
            $getJadwalMengajar = $_GET['jadwal_mengajar'];
        }

        try {
            $queryDataGuru  = $pdo->prepare("
                    SELECT *
                    FROM $database2
                    WHERE id_akun = ?
                    LIMIT 1
                ");

            $queryDataGuru->bindValue(1, $getGuru);
            $queryDataGuru->execute();
            $rowDataGuru    = $queryDataGuru->rowCount();
            if ($rowDataGuru > 0) {
                $resultDataGuru = $queryDataGuru->fetch(PDO::FETCH_ASSOC);

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

                        try {
                            $queryDataJadwalMengajar  = $pdo->prepare("
                                    SELECT *
                                    FROM $database5
                                    INNER JOIN $database3 ON $database5.id_$database3 = $database3.id_$database3
                                    INNER JOIN $database6 ON $database5.id_$database6 = $database6.id_$database6
                                    WHERE id_jadwal_mengajar = ?
                                    LIMIT 1
                                ");

                            $queryDataJadwalMengajar->bindValue(1, $getJadwalMengajar);
                            $queryDataJadwalMengajar->execute();
                            $rowDataJadwalMengajar    = $queryDataJadwalMengajar->rowCount();

                            if ($rowDataJadwalMengajar > 0) {
                                $resultDataJadwalMengajar = $queryDataJadwalMengajar->fetch(PDO::FETCH_ASSOC);
                            } else {
                                echo "<script>window.location = '$base_url_admin/$link';</script>";
                                die();
                                exit();
                            }
                        } catch (Exception $e) {
                            var_dump($e);
                        }
                    } else {
                        echo "<script>window.location = '$base_url_admin/$link';</script>";
                        die();
                        exit();
                    }
                } catch (Exception $e) {
                    var_dump($e);
                }
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
                    <h3><?= $halActive ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i
                                        class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>"><?= $hal ?></a>
                            </li>
                            <li class="breadcrumb-item active"><?= $halActive ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <a href="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>"
                        class="btn btn-xs btn-outline-secondary rounded-pill"><i
                            class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="20%">Kelas</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataJadwalMengajar['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Hari</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataJadwalMengajar['hari'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Jam</th>
                                <th width="5%">:</th>
                                <td><i class="far fa-clock"></i> <?= $resultDataJadwalMengajar['jam'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Mata Pelajaran</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataJadwalMengajar['nama_mapel'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table id="datatable"
                            class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <form action="<?= $base_url_admin ?>/editPresensi" method="POST" data-parsley-validate="">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">No</th>
                                        <th width="15%">NISN</th>
                                        <th width="20%">Nama Siswa</th>
                                        <th width="10%">Jenis Kelamin</th>
                                        <th width="15%">Hadir</th>
                                        <th width="15%">Sakit</th>
                                        <th width="15%">Izin</th>
                                        <th width="15%">Alpha</th>



                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                            $no = 1;
                                            try {
                                                $queryData  = $pdo->prepare("
                                            SELECT *
                                            FROM $database7
                                            INNER JOIN $database8 ON $database7.id_$database8 = $database8.id_$database8
                                            WHERE $database7.id_semester = ?
                                            AND $database7.id_kelas = ?
                                            AND $database7.id_jadwal_mengajar = ?
                                        ");

                                                $queryData->bindValue(1, $getSemester);
                                                $queryData->bindValue(2, $resultDataJadwalMengajar['id_kelas']);
                                                $queryData->bindValue(3, $getJadwalMengajar);
                                                $queryData->execute();
                                                $rowData = $queryData->rowCount();
                                                if ($rowData > 0) {
                                                    while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                            ?>

                                    <tr>
                                        <td class="text-wrap"><?= $no++ ?></td>
                                        <td class="text-wrap text-center"><span
                                                class="badge bg-pink fs-5"><?= $resultData['nisn'] ?></span></td>
                                        <td class="text-wrap text-center"><?= $resultData['nama_siswa'] ?></td>
                                        <td class="text-wrap text-center"><?= $resultData['jenis_kelamin'] ?></td>
                                        <td class="text-wrap text-center">
                                            <label><input type="checkbox"
                                                    name="___in_kehadiran[<?= $resultData['id_absensi'] ?>][]"
                                                    value="Hadir"
                                                    <?= ($resultData['kehadiran'] === "Hadir") ? 'checked' : '' ?>>
                                                Hadir</label>
                                        </td>
                                        <td class="text-wrap text-center">
                                            <label><input type="checkbox"
                                                    name="___in_kehadiran[<?= $resultData['id_absensi'] ?>][]"
                                                    value="Sakit"
                                                    <?= ($resultData['kehadiran'] === "Sakit") ? 'checked' : '' ?>>
                                                Sakit</label>
                                        </td>
                                        <td class="text-wrap text-center">
                                            <label><input type="checkbox"
                                                    name="___in_kehadiran[<?= $resultData['id_absensi'] ?>][]"
                                                    value="Izin"
                                                    <?= ($resultData['kehadiran'] === "Izin") ? 'checked' : '' ?>>
                                                Izin</label>
                                        </td>
                                        <td class="text-wrap text-center">
                                            <label><input type="checkbox"
                                                    name="___in_kehadiran[<?= $resultData['id_absensi'] ?>][]"
                                                    value="Alpha"
                                                    <?= ($resultData['kehadiran'] === "Alpha") ? 'checked' : '' ?>>
                                                Alpha</label>
                                        </td>
                                        <td class="text-wrap text-center">
                                            <input type="hidden"
                                                name="___in_id_absensi[<?= $resultData['id_absensi'] ?>]"
                                                value="<?= $resultData['id_absensi'] ?>">
                                        </td>
                                    </tr>

                                    <?php
                                                    }
                                                    ?>
                                    <tr>
                                        <td colspan="9" class="text-wrap text-center">

                                            <input type="hidden" name="___in_link"
                                                value="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>/<?= $resultDataJadwalMengajar['id_jadwal_mengajar'] ?>">
                                            <button type="submit" name="_submit_" class="btn btn-sm btn-outline-info"><i
                                                    class="fas fa-save"></i> Simpan Presensi</button>
                                        </td>
                                    </tr>
                                    <?php
                                                } else {
                                                ?>

                                </tbody>
                            </form>
                            <tr>
                                <td class="text-wrap text-center" colspan="8">
                                    <div class="alert alert-warning mb-0" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i> Tidak ada presensi untuk
                                        hari
                                        ini!
                                        <hr class="my-1" />
                                        <form action="<?= $base_url_admin ?>/addPresensi" method="POST"
                                            data-parsley-validate="">
                                            <input type="hidden" name="___in_link"
                                                value="<?= $base_url_admin ?>/<?= $link ?>/<?= $getGuru ?>/<?= $getSemester ?>/<?= $resultDataJadwalMengajar['id_jadwal_mengajar'] ?>">
                                            <input type="hidden" name="___in_id_semester" value="<?= $getSemester ?>">
                                            <input type="hidden" name="___in_id_kelas"
                                                value="<?= $resultDataJadwalMengajar['id_kelas'] ?>">
                                            <input type="hidden" name="___in_id_jadwal_mengajar"
                                                value="<?= $getJadwalMengajar ?>">
                                            <button type="submit" name="_submit_" class="btn btn-sm btn-success"><i
                                                    class="fas fa-plus-circle"></i> Buat Presensi</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <?php
                                                }
                                            } catch (Exception $e) {
                                                var_dump($e);
                                            }
                            ?>
                        </table>
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