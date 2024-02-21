<?php
    switch ($_GET['act']) {
        case "list":
            $hal        = "Data Wali Kelas";
            $database   = "wali_kelas";
            $database2  = "akun";
            $database3  = "kelas";
            $database4  = "semester";
            $link       = "wali-kelas";

            try {
                $queryDataSemester  = $pdo->prepare("
                    SELECT *
                    FROM $database4
                    ORDER BY id_semester DESC
                    LIMIT 1
                ");

                $queryDataSemester->execute();
                $resultDataSemester = $queryDataSemester->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                var_dump($e);
            }
?>

<div class="content">
    <div class="container-fluid">
        <div class="container">
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active"><?= $hal ?></li>
                </ol>
            </nav>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="20%">Kelas</th>
                                    <th>Nama Wali</th>
                                    <th width="30%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no=1;
                                    $queryData  = $pdo->prepare("
                                        SELECT *
                                        FROM $database
                                        INNER JOIN $database2 ON $database.id_$database2 = $database2.id_$database2
                                        INNER JOIN $database3 ON $database.id_$database3 = $database3.id_$database3
                                    ");

                                    $queryData->execute();
                                    while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <tr>
                                    <td class="text-wrap"><?= $no++ ?></td>
                                    <td class="text-wrap text-center"><?= $resultData['nama_kelas'] ?></td>
                                    <td class="text-wrap text-center"><?= $resultData['nama'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#editWaliKelas<?= $resultData['id_wali_kelas'] ?>"><i class="fas fa-edit"></i> Ubah Data</button>
                                            <a href="<?= $base_url_admin ?>/<?= $link ?>/rombel/<?= $resultData['id_kelas'] ?>/<?= $resultDataSemester['id_semester'] ?>" class="btn btn-xs btn-outline-pink"><i class="fas fa-users"></i> Daftar Rombel</a>
                                        </div>

                                        <div id="editWaliKelas<?= $resultData['id_wali_kelas'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <form action="<?= $base_url_admin ?>/editWaliKelas" method="POST" data-parsley-validate="" class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-12 text-start">
                                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                <h4 class="alert-heading">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                    </svg> PERHATIAN!
                                                                </h4>
                                                                <hr class="my-2">
                                                                <ul class="mb-1">
                                                                    <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                                </ul>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 my-1">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="id_kelas" name="___in_id_kelas" required="">
                                                                    <?php
                                                                        try {
                                                                            $queryDataK  = $pdo->prepare("
                                                                                SELECT *
                                                                                FROM $database3
                                                                                ORDER BY id_kelas ASC
                                                                            ");

                                                                            $queryDataK->execute();
                                                                            while($resultDataK = $queryDataK->fetch(PDO::FETCH_ASSOC)){
                                                                    ?>
                                                                        <option value="<?= $resultDataK['id_kelas'] ?>" <?php if ($resultDataK['id_kelas']===$resultData['id_kelas']) { echo "selected"; } ?>><?= $resultDataK['nama_kelas'] ?></option>
                                                                    <?php
                                                                            }
                                                                        } catch (Exception $e) {
                                                                            var_dump($e);
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label for="id_kelas">Kelas</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 my-1">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="id_akun" name="___in_id_akun" required="">
                                                                    <?php
                                                                        try {
                                                                            $Level  = "Guru";
                                                                            $queryDataWK  = $pdo->prepare("
                                                                                SELECT *
                                                                                FROM $database2
                                                                                WHERE level = ?
                                                                                ORDER BY id_akun ASC
                                                                            ");

                                                                            $queryDataWK->bindValue(1, $Level);
                                                                            $queryDataWK->execute();
                                                                            while($resultDataWK = $queryDataWK->fetch(PDO::FETCH_ASSOC)){
                                                                    ?>
                                                                        <option value="<?= $resultDataWK['id_akun'] ?>" <?php if ($resultDataWK['id_akun']===$resultData['id_akun']) { echo "selected"; } ?>><?= $resultDataWK['nama'] ?></option>
                                                                    <?php
                                                                            }
                                                                        } catch (Exception $e) {
                                                                            var_dump($e);
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label for="id_akun">Wali Kelas</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="___in_id_wali_kelas" value="<?= $resultData['id_wali_kelas'] ?>" required="">
                                                        <button type="submit" name="_submit_" class="btn btn-info"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                    </div>
                                                </form>
                                            </div>
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

<?php
            break;
        case "rombel":
            $hal        = "Data Wali Kelas";
            $halActive  = "Daftar Rombel";
            $database   = "wali_kelas";
            $database2  = "akun";
            $database3  = "kelas";
            $database4  = "semester";
            $database5  = "rombel";
            $database6  = "siswa";
            $link       = "wali-kelas";

            if (isset($_POST['_submit_'])) {
                $getKelas   = $_GET['kelas'];
                $getSemester= $_POST['___in_id_semester'];

                echo "<script>window.location = '$base_url_admin/$link/rombel/$getKelas/$getSemester';</script>";
                die();
                exit();
            }else{
                $getKelas   = $_GET['kelas'];
                $getSemester= $_GET['semester'];
            }

            try {
                $queryDataWaliKelas  = $pdo->prepare("
                    SELECT *
                    FROM $database
                    INNER JOIN $database2 ON $database.id_$database2 = $database2.id_$database2
                    INNER JOIN $database3 ON $database.id_$database3 = $database3.id_$database3
                    WHERE $database.id_kelas = ?
                    LIMIT 1
                ");

                $queryDataWaliKelas->bindValue(1, $getKelas);
                $queryDataWaliKelas->execute();
                $rowDataWaliKelas    = $queryDataWaliKelas->rowCount();
                if ($rowDataWaliKelas>0) {
                    $resultDataWaliKelas = $queryDataWaliKelas->fetch(PDO::FETCH_ASSOC);

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

                        if ($rowDataSemester>0) {
                            $resultDataSemester = $queryDataSemester->fetch(PDO::FETCH_ASSOC);

                            try {
                                $queryRombel  = $pdo->prepare("
                                    SELECT *
                                    FROM $database5
                                    WHERE id_semester = ?
                                    AND id_kelas = ?
                                ");

                                $queryRombel->bindValue(1, $getSemester);
                                $queryRombel->bindValue(2, $resultDataWaliKelas['id_kelas']);
                                $queryRombel->execute();
                                $rowRombel = $queryRombel->rowCount();
                            } catch (Exception $e) {
                                var_dump($e);
                            }
                        }else{
                            echo "<script>window.location = '$base_url_admin/$link';</script>";
                            die();
                            exit();
                        }
                    } catch (Exception $e) {
                        var_dump($e);
                    }
                }else{
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
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/<?= $link ?>"><?= $hal ?></a></li>
                            <li class="breadcrumb-item active"><?= $halActive ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <a href="<?= $base_url_admin ?>/<?= $link ?>" class="btn btn-xs btn-outline-secondary rounded-pill"><i class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                    <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addRombel"><i class="fas fa-plus"></i> Tambah Rombel</button>
                    <button type="button" class="btn btn-outline-pink rounded-pill" data-bs-toggle="modal" data-bs-target="#filterSemester"><i class="fas fa-filter"></i> Filter Semester</button>

                    <div id="addRombel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form action="<?= $base_url_admin ?>/addRombel" method="POST" data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah Rombel</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <h4 class="alert-heading">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg> PERHATIAN!
                                            </h4>
                                            <hr class="my-2">
                                            <ul class="mb-1">
                                                <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-12 my-1">
                                        <select class="form-select form-select-lg id_siswa p-0" id="id_siswa" name="___in_id_siswa" aria-label="Pilih Pegawai" required="">
                                            <option value="">-Pilih Salah Satu Siswa-</option>
                                            <?php
                                                $StatusActive = "Active";
                                                try{
                                                    $querySiswa = $pdo->prepare("
                                                        SELECT *
                                                        FROM $database6
                                                        WHERE status = ?
                                                    ");

                                                    $querySiswa->bindValue(1, $StatusActive);
                                                    $querySiswa->execute();
                                                    while($resultSiswa = $querySiswa->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?= $resultSiswa['id_siswa']; ?>">[<?= $resultSiswa['nisn']; ?>] <?= $resultSiswa['nama_siswa']; ?></option>
                                            <?php
                                                    }
                                                }catch(Exception $e){
                                                    var_dump($e);
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="___in_id_semester" value="<?= $getSemester ?>" required="">
                                    <input type="hidden" name="___in_id_kelas" value="<?= $resultDataWaliKelas['id_kelas'] ?>" required="">
                                    <input type="hidden" name="___in_link" value="<?= $base_url_admin ?>/<?= $link ?>/rombel/<?= $resultDataWaliKelas['id_kelas'] ?>/<?= $getSemester ?>" required="">
                                    <button type="submit" name="_submit_" class="btn btn-info"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="filterSemester" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form action="<?= $base_url_admin ?>/<?= $link ?>/rombel/<?= $resultDataWaliKelas['id_kelas'] ?>/<?= $getSemester ?>" method="POST" data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Filter Semester</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12 my-1">
                                        <select class="form-select form-select-lg id_siswa p-0" id="id_semester" name="___in_id_semester" aria-label="Pilih Semester" required="">
                                            <?php
                                                try{
                                                    $querySemester = $pdo->prepare("
                                                        SELECT *
                                                        FROM $database4
                                                    ");

                                                    $querySemester->execute();
                                                    while($resultSemester = $querySemester->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?= $resultSemester['id_semester']; ?>" <?php if ($resultSemester['id_semester']==$getSemester) { echo 'selected'; } ?>><?= $resultSemester['tahun_ajaran']; ?> <?= $resultSemester['nama_semester']; ?></option>
                                            <?php
                                                    }
                                                }catch(Exception $e){
                                                    var_dump($e);
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="___in_link" value="<?= $base_url_admin ?>/<?= $link ?>/rombel/<?= $resultDataWaliKelas['id_kelas'] ?>/<?= $getSemester ?>" required="">
                                    <button type="submit" name="_submit_" class="btn btn-info"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
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
                                <th width="20%">Kelas</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataWaliKelas['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Wali Kelas</th>
                                <th width="5%">:</th>
                                <td><?= $resultDataWaliKelas['nama'] ?></td>
                            </tr>
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
                            <tr>
                                <th width="20%">Jumlah Siswa</th>
                                <th width="5%">:</th>
                                <td><?= $rowRombel ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="15%">NISN</th>
                                    <th>Nama Siswa</th>
                                    <th width="15">Jenis Kelamin</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no=1;
                                    try {
                                        $queryData  = $pdo->prepare("
                                            SELECT *
                                            FROM $database5
                                            INNER JOIN $database6 ON $database5.id_$database6 = $database6.id_$database6
                                            WHERE $database5.id_semester = ?
                                            AND $database5.id_kelas = ?
                                        ");

                                        $queryData->bindValue(1, $getSemester);
                                        $queryData->bindValue(2, $resultDataWaliKelas['id_kelas']);
                                        $queryData->execute();
                                        while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <tr>
                                    <td class="text-wrap"><?= $no++ ?></td>
                                    <td class="text-wrap text-center"><span class="badge bg-pink fs-5"><?= $resultData['nisn'] ?></span></td>
                                    <td class="text-wrap"><?= $resultData['nama_siswa'] ?></td>
                                    <th class="text-wrap text-center"><?= $resultData['jenis_kelamin'] ?></th>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#editRombel<?= $resultData['id_rombel'] ?>"><i class="fas fa-edit"></i> Ubah Data</button>
                                        </div>

                                        <div id="editRombel<?= $resultData['id_rombel'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form action="<?= $base_url_admin ?>/editRombel" method="POST" data-parsley-validate="" class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-12 text-start text-wrap">
                                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                <h4 class="alert-heading">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                    </svg> PERHATIAN!
                                                                </h4>
                                                                <hr class="my-2">
                                                                <ul class="mb-1">
                                                                    <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                                </ul>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 my-1 text-start">
                                                            <select class="form-select form-select-lg id_siswa p-0" id="id_siswa" name="___in_id_siswa" aria-label="Pilih Pegawai" required="">
                                                                <?php
                                                                    $StatusActive = "Active";
                                                                    try{
                                                                        $querySiswa = $pdo->prepare("
                                                                            SELECT *
                                                                            FROM $database6
                                                                            WHERE status = ?
                                                                        ");

                                                                        $querySiswa->bindValue(1, $StatusActive);
                                                                        $querySiswa->execute();
                                                                        while($resultSiswa = $querySiswa->fetch(PDO::FETCH_ASSOC)){
                                                                ?>
                                                                <option value="<?= $resultSiswa['id_siswa']; ?>" <?php if ($resultSiswa['id_siswa']===$resultData['id_siswa']) { echo 'selected'; } ?>>[<?= $resultSiswa['nisn']; ?>] <?= $resultSiswa['nama_siswa']; ?></option>
                                                                <?php
                                                                        }
                                                                    }catch(Exception $e){
                                                                        var_dump($e);
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="___in_id_rombel" value="<?= $resultData['id_rombel'] ?>" required="">
                                                        <input type="hidden" name="___in_link" value="<?= $base_url_admin ?>/<?= $link ?>/rombel/<?= $resultDataWaliKelas['id_kelas'] ?>/<?= $getSemester ?>" required="">
                                                        <button type="submit" name="_submit_" class="btn btn-info"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                    </div>
                                                </form>
                                            </div>
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
        default:
            echo "<script>window.location = '$base_url_admin/404';</script>";
            die();
            exit();
    }
?>