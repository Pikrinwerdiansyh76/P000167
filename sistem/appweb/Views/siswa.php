<?php
switch ($_GET['act']) {
    case "list":
        $hal        = "Data Siswa";
        $database   = "kelas";
        $link       = "siswa";
        $database1  = "akun";
        $database2  = "semester";

        try {
            $queryDataSemester  = $pdo->prepare("
                    SELECT *
                    FROM $database2
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
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable"
                            class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Nama Kelas</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                        $no = 1;
                                        $queryData  = $pdo->prepare("
                                        SELECT *
                                        FROM $database
                                    ");

                                        $queryData->execute();
                                        while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                        ?>

                                <tr>
                                    <td class="text-wrap"><?= $no++ ?></td>
                                    <td class="text-wrap text-center"><?= $resultData['nama_kelas'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?= $base_url_admin ?>/<?= $link ?>/detail/<?= $resultData['id_kelas'] ?>/<?= $resultDataSemester['id_semester'] ?>"
                                                class="btn btn-xs btn-primary">
                                                <i class="fas fa-eye"></i> Detail Data
                                            </a>

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
    case "detail":
        $hal        = "Detail Kelas";
        $halActive  = "Siswa";
        $database   = "siswa";
        $database1  = "kelas";
        $database2  = "semester";
        $database3  = "rombel";
        $link       = "siswa";

        if (isset($_POST['_submit_'])) {
            $getKelas   = $_GET['kelas'];
            $getSemester = $_POST['___in_id_semester'];

            echo "<script>window.location = '$base_url_admin/$link/detail/$getKelas/$getSemester';</script>";
            die();
            exit();
        } else {
            $getKelas   = $_GET['kelas'];
            $getSemester = $_GET['semester'];
        }

        try {
            $queryKelas = $pdo->prepare("
                SELECT id_kelas
                FROM $database1
                ORDER BY id_kelas DESC LIMIT 1
            ");

            $queryKelas->execute();
            while ($resultKelas = $queryKelas->fetch(PDO::FETCH_ASSOC)) {
                $resultKelasID = $resultKelas['id_kelas'];
            }
            $querySemester = $pdo->prepare("
                    SELECT id_semester
                    FROM $database2
                    ORDER BY id_semester DESC LIMIT 1
                ");

            $querySemester->execute();
            while ($resultSemester = $querySemester->fetch(PDO::FETCH_ASSOC)) {
                $resultSemesterID = $resultSemester['id_semester'];
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    ?>

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
            <a href="<?= $base_url_admin ?>/<?= $link ?>" class="btn btn-xs btn-outline-secondary rounded-pill"><i
                    class="far fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
        <div class="col-auto my-auto">
            <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal"
                data-bs-target="#addSiswa"><i class="fas fa-plus"></i> Tambah <?= $halActive ?></button>

            <div id="addSiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <form action="<?= $base_url_admin ?>/addSiswa" method="POST" data-parsley-validate=""
                        class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Tambah <?= $halActive ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <h4 class="alert-heading">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor"
                                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                            viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg> PERHATIAN!
                                    </h4>
                                    <hr class="my-2">
                                    <ul class="mb-1">
                                        <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan
                                            benar!</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-md-4 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nisn" name="___in_nisn"
                                        placeholder="Lorem ipsum dolor sit amet" required="">
                                    <label for="nisn">NISN</label>
                                </div>
                            </div>
                            <div class="col-md-8 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama_siswa" name="___in_nama_siswa"
                                        placeholder="Lorem ipsum dolor sit amet" required="">
                                    <label for="nama_siswa">Nama Siswa</label>
                                </div>
                            </div>

                            <div class="col-md-5 my-1">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama_ibu" name="___in_nama_ibu"
                                        placeholder="Lorem ipsum dolor sit amet" required="">
                                    <label for="nama_ibu">Nama Ibu</label>
                                </div>
                            </div>
                            <div class="col-md-4 my-1">
                                <div class="form-floating">
                                    <select class="form-select" id="jenis_kelamin" name="___in_jenis_kelamin"
                                        required="">
                                        <option value="- Pilih Salah Satu -">- Pilih Salah Satu -</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-md-3 my-1">
                                <div class="form-floating">
                                    <select class="form-select" id="status_akun" name="___in_status_akun" required="">
                                        <option value="- Pilih Salah Satu -">- Pilih Salah Satu -</option>
                                        <option value="Active">Active</option>
                                        <option value="Non-Active">Non-Active</option>
                                    </select>
                                    <label for="status_akun">Status?</label>
                                </div>
                            </div>
                            <div class="col-12 my-1">
                                <select class="form-select id_kelas p-0" id="id_kelas" name="___in_id_kelas"
                                    aria-label="Pilih Kelas" required="">
                                    <option value="">-Pilih Salah Satu Kelas-</option>
                                    <?php
                                            try {
                                                $queryKelas = $pdo->prepare("
                                                        SELECT *
                                                        FROM $database1
                                                    ");

                                                $queryKelas->execute();
                                                while ($resultKelas = $queryKelas->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                    <option value="<?= $resultKelas['id_kelas']; ?>"><?= $resultKelas['nama_kelas']; ?>
                                    </option>
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
                            <input type="hidden" name="___in_id_semester" value="<?= $resultSemesterID ?>">
                            <button type="submit" name="_submit_" class="btn btn-info"><i class="fas fa-save"></i>
                                SIMPAN PERUBAHAN</button>
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
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">NISN</th>
                            <th width="15%">Kelas</th>
                            <th width="15%">Nama Siswa</th>
                            <th width="15%">Nama Ibu</th>
                            <th width="15%">Jenis Kelamin</th>
                            <th width="10%">Status</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                                $no = 1;
                                // Fetch student details for the selected class
                                $queryData  = $pdo->prepare("
                                            SELECT $database.*, $database1.nama_kelas
                                            FROM $database
                                            INNER JOIN $database1 ON $database.id_kelas = $database1.id_kelas
                                            WHERE $database.id_kelas = :id_kelas
                                            ORDER BY $database.id_siswa ASC
                                        ");

                                $queryData->bindParam(':id_kelas', $getKelas, PDO::PARAM_INT);
                                $queryData->execute();

                                while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {

                                ?>

                        <tr>
                            <td class="text-wrap"><?= $no++ ?></td>
                            <td class="text-wrap text-center"><span
                                    class="badge bg-pink fs-5"><?= $resultData['nisn'] ?></span></td>
                            <th class="text-wrap text-pink text-center"><?= $resultData['nama_kelas'] ?></th>
                            <td class="text-wrap"><?= $resultData['nama_siswa'] ?></td>
                            <td class="text-wrap"><?= $resultData['nama_ibu'] ?></td>
                            <th class="text-wrap text-center"><?= $resultData['jenis_kelamin'] ?></th>
                            <th class="text-wrap text-center">
                                <?php if ($resultData['status'] === "Active") : ?>
                                <span class="badge bg-success"><i class="fas fa-check"></i> Active</span>
                                <?php else : ?>
                                <span class="badge bg-danger"><i class="fas fa-ban"></i> Non-Active</span>
                                <?php endif ?>
                            </th>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editSiswaUbahData<?= $resultData['id_siswa'] ?>"><i
                                            class="fas fa-edit"></i> Ubah Data</button>
                                </div>

                                <div id="editSiswaUbahData<?= $resultData['id_siswa'] ?>" class="modal fade"
                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                    style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <form action="<?= $base_url_admin ?>/editSiswaUbahData" method="POST"
                                            data-parsley-validate="" class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body row">
                                                <div class="col-12 text-start">
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        <h4 class="alert-heading">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="currentColor"
                                                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                                viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                <path
                                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                            </svg> PERHATIAN!
                                                        </h4>
                                                        <hr class="my-2">
                                                        <ul class="mb-1">
                                                            <li>Mohon pastikan anda mengisi <em>form</em>
                                                                dibawah ini dengan lengkap dan benar!</li>
                                                        </ul>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 my-1">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="nisn"
                                                            name="___in_nisn" placeholder="Lorem ipsum dolor sit amet"
                                                            value="<?= $resultData['nisn'] ?>" required="">
                                                        <label for="nisn">NISN</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 my-1">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="nama_siswa"
                                                            name="___in_nama_siswa"
                                                            placeholder="Lorem ipsum dolor sit amet"
                                                            value="<?= $resultData['nama_siswa'] ?>" required="">
                                                        <label for="nama_siswa">Nama Siswa</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 my-1">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="nama_ibu"
                                                            name="___in_nama_ibu"
                                                            placeholder="Lorem ipsum dolor sit amet"
                                                            value="<?= $resultData['nama_ibu'] ?>" required="">
                                                        <label for="nama_ibu">Nama Ibu</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 my-1">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="jenis_kelamin"
                                                            name="___in_jenis_kelamin" required="">
                                                            <option value="Laki-Laki" <?php if ($resultData['jenis_kelamin'] === "Laki-Laki") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>
                                                                Laki-Laki</option>
                                                            <option value="Perempuan" <?php if ($resultData['jenis_kelamin'] === "Perempuan") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>
                                                                Perempuan</option>
                                                        </select>
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 my-1">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="status_akun"
                                                            name="___in_status_akun" required="">
                                                            <option value="Active" <?php if ($resultData['jenis_kelamin'] === "Active") {
                                                                                                    echo 'selected';
                                                                                                } ?>>Active
                                                            </option>
                                                            <option value="Non-Active" <?php if ($resultData['jenis_kelamin'] === "Non-Active") {
                                                                                                        echo 'selected';
                                                                                                    } ?>>
                                                                Non-Active</option>
                                                        </select>
                                                        <label for="status_akun">Status?</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 my-1 text-start">
                                                    <select class="form-select id_kelas p-0" id="id_kelas"
                                                        name="___in_id_kelas" aria-label="Pilih Kelas" required="">
                                                        <option value="">-Pilih Salah Satu Kelas-</option>
                                                        <?php
                                                                    try {
                                                                        $queryKelas = $pdo->prepare("
                                                                            SELECT *
                                                                            FROM $database1
                                                                        ");

                                                                        $queryKelas->execute();
                                                                        while ($resultKelas = $queryKelas->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>
                                                        <option value="<?= $resultKelas['id_kelas']; ?>"
                                                            <?php if ($resultKelas['id_kelas'] === $resultData['id_kelas']) {
                                                                                                                                    echo 'selected';
                                                                                                                                } ?>>
                                                            <?= $resultKelas['nama_kelas']; ?></option>
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
                                                <input type="hidden" name="___in_id_siswa"
                                                    value="<?= $resultData['id_siswa'] ?>" required="">
                                                <input type="hidden" name="___in_slug"
                                                    value="<?= $resultData['slug'] ?>" required="">
                                                <button type="submit" name="_submit_" class="btn btn-info"><i
                                                        class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
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
    case "ubah-data":
        $hal        = "Data Siswa";
        $database   = "siswa";
        $link       = "siswa";

        $query  = $pdo->prepare("
                    SELECT *
                    FROM $database
                    WHERE username = ? ");

        $query->bindValue(1, $_GET['slug']);
        $query->execute();
        $rows   = $query->rowCount();

        if ($rows > 0) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "<script>window.location.href = '$base_url_admin/404';</script>";
            die();
            exit();
        }
    ?>

<div class="content">
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $result['nama'] ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i
                                        class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/<?= $link ?>"><?= $hal ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $result['nama'] ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 my-auto text-end">
                    <a href="<?= $base_url_admin ?>/<?= $link ?>" class="btn btn-sm btn-outline-secondary"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="modal-title">Form Ubah Data</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= $base_url_admin ?>/editSiswaUbahData" method="POST" data-parsley-validate=""
                            class="modal-content">
                            <div class="modal-body row">
                                <div class="col-12 text-wrap">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <h4 class="alert-heading">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor"
                                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg> PERHATIAN!
                                        </h4>
                                        <hr class="my-2">
                                        <ul class="mb-1">
                                            <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan
                                                benar!</li>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="col-md-8 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nama" name="___in_nama"
                                            placeholder="Lorem ipsum dolor sit amet" value="<?= $result['nama'] ?>"
                                            required="">
                                        <label for="nama">Nama <?= $hal ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1">
                                    <div class="form-floating">
                                        <select class="form-select" id="status_akun" name="___in_status_akun"
                                            required="">
                                            <option value="Active" <?php if ($result['nama'] === "Active") {
                                                                                echo 'selected';
                                                                            } ?>>Active</option>
                                            <option value="Non-Active" <?php if ($result['nama'] === "Non-Active") {
                                                                                    echo 'selected';
                                                                                } ?>>Non-Active</option>
                                        </select>
                                        <label for="status_akun">Status Akun?</label>
                                    </div>
                                </div>

                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="___in_email"
                                            placeholder="Cth: info@arpateam.com" value="<?= $result['email'] ?>"
                                            required="">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="no_telp" name="___in_no_telp"
                                            placeholder="Cth: 085701311015" pattern="^(0)8[1-9][0-9]{6,9}$"
                                            value="<?= $result['no_telp'] ?>" required="">
                                        <label for="no_telp">Nomor Telpon <small>(Cth: 085701311015)</small></label>
                                    </div>
                                </div>

                                <div class="col-md-12 my-1">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="alamat"
                                            name="___in_alamat"
                                            style="height: 100px"><?= $result['alamat'] ?></textarea>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="___in_id_siswa" value="<?= $result['id_siswa'] ?>">
                                <input type="hidden" name="___in_username" value="<?= $result['username'] ?>">
                                <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i
                                        class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                            </div>
                        </form>
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