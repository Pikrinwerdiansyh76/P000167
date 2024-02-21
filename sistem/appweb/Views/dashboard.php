<?php

    $LevelGuru      = "Guru";
    $StatusActive   = "Active";
    $database1      = "kelas";
    $database2      = "akun";
    $database3      = "semester";
    $database4      = "jadwal_mengajar";
    $database5      = "mapel";
    $database6      = "semester";

    try {
        $querySemester  = $pdo->prepare("
            SELECT id_semester
            FROM $database6
            ORDER BY id_semester DESC LIMIT 1
        ");

        $querySemester->execute();
        $resultSemester = $querySemester->fetch(PDO::FETCH_ASSOC);

        $getSemester    = $resultSemester['id_semester'];
    } catch (Exception $e) {
        var_dump($e);
    }

    try {
        $queryGuru  = $pdo->prepare("
            SELECT id_akun
            FROM akun
            WHERE level = ?
            AND status = ?
        ");

        $queryGuru->bindValue(1, $LevelGuru);
        $queryGuru->bindValue(2, $StatusActive);
        $queryGuru->execute();
        $rowGuru = $queryGuru->rowCount();
    } catch (Exception $e) {
        var_dump($e);
    }

    try {
        $querySiswa  = $pdo->prepare("
            SELECT id_siswa
            FROM siswa
            WHERE status = ?
        ");

        $querySiswa->bindValue(1, $StatusActive);
        $querySiswa->execute();
        $rowSiswa = $querySiswa->rowCount();
    } catch (Exception $e) {
        var_dump($e);
    }

?>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Hallo <?= $_SESSION['_nama__'] ?>!</h4>
                    <p>Selamat Datang di <strong><?= $nama_web ?></strong> - <strong><?= $slogan ?></strong></p>
                </div>
            </div>

            <?php if ($_SESSION['_level__']==="Siswa"): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="<?= $url_images ?>/<?= $logoDesktop ?>" class="w-50">
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Alamat: Manggenae, Kec. Dompu, Kab. Dompu, Prov. Nusa Tenggara Barat</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="my-0">Jadwal Mata Pelajaran</h4>
                        </div>
                        <div class="card-body border-top">
                            <div class="accordion" id="accordionExample">
                                <?php
                                    $no=1;
                                    $queryData  = $pdo->prepare("
                                        SELECT *
                                        FROM $database1
                                    ");

                                    $queryData->execute();
                                    while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $resultData['id_kelas'] ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $resultData['id_kelas'] ?>" aria-expanded="true" aria-controls="collapse<?= $resultData['id_kelas'] ?>">
                                            <?= $resultData['nama_kelas'] ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $resultData['id_kelas'] ?>" class="accordion-collapse collapse <?php if ($no===1) { echo 'show'; } ?>" aria-labelledby="heading<?= $resultData['id_kelas'] ?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-striped datatables">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">No</th>
                                                        <th width="20%">Hari</th>
                                                        <th width="15%">Jam</th>
                                                        <th width="25%">Guru</th>
                                                        <th width="35%">Mata Pelajaran</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                        $no=1;
                                                        try {
                                                            $queryData2  = $pdo->prepare("
                                                                SELECT *
                                                                FROM $database4
                                                                INNER JOIN $database2 ON $database4.id_$database2 = $database2.id_$database2
                                                                INNER JOIN $database5 ON $database4.id_$database5 = $database5.id_$database5
                                                                WHERE id_semester = ?
                                                                AND id_kelas = ?
                                                                ORDER BY hari, jam
                                                            ");

                                                            $queryData2->bindValue(1, $getSemester);
                                                            $queryData2->bindValue(2, $resultData['id_kelas']);
                                                            $queryData2->execute();
                                                            while($resultData2 = $queryData2->fetch(PDO::FETCH_ASSOC)){
                                                                $arrJam     = explode(" s/d ", $resultData2['jam']);
                                                                $jamMulai   = $arrJam[0];
                                                                $jamSelesai = $arrJam[1];
                                                    ?>

                                                    <tr>
                                                        <td class="text-wrap"><?= $no++ ?></td>
                                                        <td class="text-wrap text-center"><span class="badge bg-pink fs-5"><?= $resultData2['hari'] ?></span></td>
                                                        <td class="text-wrap text-center"><?= $resultData2['jam'] ?></td>
                                                        <td class="text-wrap text-center"><?= $resultData2['nama'] ?></td>
                                                        <td class="text-wrap text-center"><?= $resultData2['nama_mapel'] ?></td>
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

                                <?php
                                        $no++;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-4 my-auto">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="<?= $url_images ?>/<?= $logoDesktop ?>" class="w-50">
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Alamat: Manggenae, Kec. Dompu, Kab. Dompu, Prov. Nusa Tenggara Barat</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1><i class="fas fa-users"></i></h1>
                            <h2><?= $rowSiswa ?></h2>
                            <h5 class="text-muted">Total Siswa</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1><i class="fas fa-user-tie"></i></h1>
                            <h2><?= $rowGuru ?></h2>
                            <h5 class="text-muted">Total Guru</h5>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>