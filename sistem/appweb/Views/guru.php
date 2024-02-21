<?php
switch ($_GET['act']) {
    case "list":
        $hal        = "Data Guru";
        $penyimpananGambar  = "$url_images/avatar";
        $database   = "akun";
        $link       = "akun";
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
                    <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#addGuru"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="addGuru" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= $base_url_admin ?>/addGuru" method="POST" data-parsley-validate=""
                                class="modal-content" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah <?= $hal ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                                <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap
                                                    dan benar!</li>
                                                <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="nip_nuptk"
                                                name="___in_nip_nuptk" placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="nip_nuptk">NIP / NUPTK</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nama" name="___in_nama"
                                                placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="nama">Nama</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="___in_email"
                                                placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="status_akun" name="___in_status_akun"
                                                required="">
                                                <option value="Active">Active</option>
                                                <option value="Non-Active">Non-Active</option>
                                            </select>
                                            <label for="status_akun">Status?</label>
                                        </div>
                                    </div>

                                    <!-- file preview template -->
                                    <div class="col-12 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-height="300" id="gambar"
                                                accept="image/webp, image/jpeg, image/jpg, image/png, image/gif"
                                                name="___in_gambar" required="">
                                            <label for="gambar">Avatar</label>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="col-md-12 my-1">
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <h4 class="alert-heading">
                                                <i class="fas fa-lock"></i> PENGATURAN KEAMANAN AKUN
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="username" name="___in_username"
                                                placeholder="Cth: arpateam15" minlength="5" maxlength="20"
                                                onkeyup="this.value=this.value.replace(/[^a-z][^0-9]/g,'');"
                                                required="">

                                            <label for="username">Username Akun <small></small></label>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6 my-2">
                                        <label class="font-weight-bold" for="pass">Password <span
                                                id="buttonShowPassword" onclick="showPassword()"><i
                                                    class="fas fa-eye-slash"></i></span></label>
                                        <input type="password" id="pass" name="___in_password" class="form-control"
                                            placeholder="Masukkan Password anda..."
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="10" maxlength="20"
                                            required>
                                        <div class="p-1" role="alert">
                                            <h5 class="font-weight-bold text-warning"><i
                                                    class="fas fa-exclamation-circle"></i> Ketentuan Password:</h5>

                                            <span id="length" class="invalid">Minimal <strong>10 Karakter</strong>
                                            </span>
                                            <br />
                                            <span id="letter" class="invalid">Kombinasi <strong>huruf
                                                    kecil</strong></span>
                                            <br />
                                            <span id="capital" class="invalid">Kombinasi <strong>huruf
                                                    besar</strong></span>
                                            <br />
                                            <span id="number" class="invalid">Kombinasi <strong>angka</strong>
                                            </span>
                                            <br />
                                        </div>
                                    </div>
                                    <!-- Password -->

                                    <!-- Ulangi Password -->
                                    <div class="col-md-6 my-2">
                                        <label class="font-weight-bold" for="passUlangi">Ulangi Password <span
                                                id="buttonShowUlangiPassword" onclick="showUlangiPassword()"><i
                                                    class="fas fa-eye-slash"></i></span></label>
                                        <input type="password" id="passUlangi" name="___in_ulangi_password"
                                            class="form-control" placeholder="Ulangi Password anda..."
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="10" maxlength="20"
                                            required>
                                        <div class="form-text confirm-message p-1"></div>
                                    </div>
                                    <!-- Ulangi Password -->
                                </div>
                                <div class="modal-footer">
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
                    <div class="card-body">
                        <table id="datatable"
                            class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th width="15%">NIP / NUPTK</th>
                                    <th width="20%">Nama Guru</th>
                                    <th width="20%">Email</th>
                                    <th width="15">Foto</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                        $no     = 1;
                                        $Level  = "Guru";
                                        $queryData  = $pdo->prepare("
                                        SELECT *
                                        FROM $database
                                        WHERE level = ?
                                        ORDER BY id_akun ASC
                                    ");

                                        $queryData->bindValue(1, $Level);
                                        $queryData->execute();
                                        while ($resultData = $queryData->fetch(PDO::FETCH_ASSOC)) {
                                        ?>

                                <tr>
                                    <td class="text-wrap"><?= $no++ ?></td>
                                    <td class="text-wrap text-center"><span
                                            class="badge bg-pink fs-5"><?= $resultData['nip_nuptk'] ?></span></td>
                                    <td class="text-wrap"><?= $resultData['nama'] ?></td>
                                    <td class="text-wrap"><?= $resultData['email'] ?></td>
                                    <th class="text-wrap text-center"><img
                                            src="<?= $penyimpananGambar ?>/<?= $resultData['avatar'] ?>" class="w-75">
                                    </th>
                                    <th class="text-wrap text-center">
                                        <?php if ($resultData['status'] === "Active") : ?>
                                        <span class="badge bg-success"><i class="fas fa-check"></i> Active</span>
                                        <?php else : ?>
                                        <span class="badge bg-danger"><i class="fas fa-ban"></i> Non-Active</span>
                                        <?php endif ?>
                                    </th>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editGuru<?= $resultData['id_siswa'] ?>"><i
                                                class="fas fa-edit"></i> Ubah Data</button>
                                        <hr class="my-1" />
                                        <button type="button" class="btn btn-xs btn-outline-pink" data-bs-toggle="modal"
                                            data-bs-target="#editPasswordGuru<?= $resultData['id_siswa'] ?>"><i
                                                class="fas fa-lock"></i> Ubah Password</button>

                                        <div id="editGuru<?= $resultData['id_siswa'] ?>" class="modal fade"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <form action="<?= $base_url_admin ?>/editGuru" method="POST"
                                                    data-parsley-validate="" class="modal-content"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Ubah <?= $resultData['nama'] ?>
                                                        </h4>
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
                                                                        viewBox="0 0 16 16" role="img"
                                                                        aria-label="Warning:">
                                                                        <path
                                                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                                    </svg> PERHATIAN!
                                                                </h4>
                                                                <hr class="my-2">
                                                                <ul class="mb-1">
                                                                    <li>Mohon pastikan anda mengisi <em>form</em>
                                                                        dibawah ini dengan lengkap dan benar!</li>
                                                                    <li>Ukuran File Gambar maksimal
                                                                        <strong>2MB</strong>!</li>
                                                                </ul>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 my-1">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="nip_nuptk"
                                                                    name="___in_nip_nuptk"
                                                                    placeholder="Cth: Aldi Febriyanto"
                                                                    value="<?= $resultData['nip_nuptk'] ?>" required="">
                                                                <label for="nip_nuptk">NIP / NUPTK</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 my-1">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="nama"
                                                                    name="___in_nama" placeholder="Cth: Aldi Febriyanto"
                                                                    value="<?= $resultData['nama'] ?>" required="">
                                                                <label for="nama">Nama</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8 my-1">
                                                            <div class="form-floating">
                                                                <input type="email" class="form-control" id="email"
                                                                    name="___in_email"
                                                                    placeholder="Cth: Aldi Febriyanto"
                                                                    value="<?= $resultData['email'] ?>" required="">
                                                                <label for="email">Email</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-1">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="status_akun"
                                                                    name="___in_status_akun" required="">
                                                                    <option value="Active" <?php if ($resultData['status'] === "Active") {
                                                                                                            echo "selected";
                                                                                                        } ?>>Active
                                                                    </option>
                                                                    <option value="Non-Active" <?php if ($resultData['status'] === "Non-Active") {
                                                                                                                echo "selected";
                                                                                                            } ?>>
                                                                        Non-Active</option>
                                                                </select>
                                                                <label for="status_akun">Status?</label>
                                                            </div>
                                                        </div>

                                                        <!-- file preview template -->
                                                        <div class="col-12 my-3">
                                                            <div class="form-floating">
                                                                <input type="file" data-plugins="dropify"
                                                                    data-default-file="<?= $penyimpananGambar ?>/<?= $resultData['avatar'] ?>"
                                                                    data-height="300" id="avatar"
                                                                    accept="image/webp, image/jpeg, image/jpg, image/png, image/gif"
                                                                    name="___in_gambar">
                                                                <label for="avatar">Image Share</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal"><i class="fas fa-times"></i>
                                                            BATAL</button>
                                                        <input type="hidden" name="___in_id_akun"
                                                            value="<?= $resultData['id_akun']; ?>">
                                                        <input type="hidden" name="___in_gambar_lama"
                                                            value="<?= $resultData['avatar']; ?>">
                                                        <input type="hidden" name="___in_slug_lama"
                                                            value="<?= $resultData['slug']; ?>">
                                                        <button type="submit" name="_submit_"
                                                            class="btn btn-info waves-effect waves-light"><i
                                                                class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div id="editPasswordGuru<?= $resultData['id_siswa'] ?>" class="modal fade"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content text-start">
                                                    <form action="<?= $base_url_admin ?>/editPasswordGuru" method="POST"
                                                        data-parsley-validate="" class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah Password
                                                                <?= $result['nama'] ?></h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row">
                                                            <div class="col-12">
                                                                <div class="alert alert-warning alert-dismissible fade show"
                                                                    role="alert">
                                                                    <h4 class="alert-heading">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" fill="currentColor"
                                                                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                                            viewBox="0 0 16 16" role="img"
                                                                            aria-label="Warning:">
                                                                            <path
                                                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                                        </svg> PERHATIAN!
                                                                    </h4>
                                                                    <hr class="my-2">
                                                                    <ul class="mb-1">
                                                                        <li>Mohon pastikan anda mengisi <em>form</em>
                                                                            dibawah ini dengan lengkap dan benar!</li>
                                                                    </ul>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="alert"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 my-1">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control"
                                                                        id="username" name="___in_username"
                                                                        placeholder="Masukkan Username" minlength="5"
                                                                        maxlength="20"
                                                                        onkeyup="this.value=this.value.replace(/[^a-z][^0-9]/g,'');"
                                                                        value="<?= $resultData['username'] ?>" readonly>
                                                                    <label for="username">Username Akun</label>
                                                                </div>
                                                            </div>

                                                            <!-- Password -->
                                                            <div class="col-md-6 my-2">
                                                                <label class="font-weight-bold"
                                                                    for="pass">Password</label>
                                                                <input type="password" id="pass" name="___in_password"
                                                                    class="form-control"
                                                                    placeholder="Masukkan Password anda..."
                                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                                    minlength="10" maxlength="20" required>
                                                            </div>
                                                            <!-- Password -->

                                                            <!-- Ulangi Password -->
                                                            <div class="col-md-6 my-2">
                                                                <label class="font-weight-bold" for="passUlangi">Ulangi
                                                                    Password</label>
                                                                <input type="password" id="passUlangi"
                                                                    name="___in_ulangi_password" class="form-control"
                                                                    placeholder="Ulangi Password anda..."
                                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                                    minlength="10" maxlength="20" required>
                                                            </div>
                                                            <!-- Ulangi Password -->
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect"
                                                                data-bs-dismiss="modal"><i class="fas fa-times"></i>
                                                                BATAL</button>
                                                            <input type="hidden" name="___in_id_akun"
                                                                value="<?= $resultData['id_akun']; ?>">
                                                            <button type="submit" name="_submit_"
                                                                class="btn btn-info waves-effect waves-light"><i
                                                                    class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                        </div>
                                                    </form>
                                                </div>
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
    default:
        echo "<script>window.location = '$base_url_admin/404';</script>";
        die();
        exit();
}
?>