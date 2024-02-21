<?php
    $hal                = "Pengaturan Website";
    $penyimpananGambar  = $url_images;
    $database           = "pengaturan";
    $link               = "pengaturan";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar <?= $hal ?></li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pengaturan</th>
                                            <th>Jenis Pengaturan</th>
                                            <th>Terakhir Update</th>
                                            <th width="125">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no=1;
                                            $myStatus="Active";
                                            $stmt = $pdo->prepare("
                                                    SELECT *
                                                    FROM $database
                                                    WHERE status = ?
                                                    ORDER BY no_urut ASC");

                                            $stmt->bindValue(1, $myStatus);
                                            $stmt->execute();

                                            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $result['judul'] ?></td>
                                            <td><?= $result['jenis_pengaturan'] ?></td>
                                            <td><?= indoTgl($result['tgl_update']) ?></td>
                                            <td class="text-center">
                                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahPengaturan<?= $result['id_pengaturan'] ?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Ubah</a>
                                                <div id="UbahPengaturan<?= $result['id_pengaturan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="<?= $base_url_admin ?>/editPengaturan" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body row">
                                                                <div class="col-12">
                                                                    <div class="alert alert-warning alert-dismissible fade show text-start" role="alert">
                                                                        <h4 class="alert-heading">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                            </svg> PERHATIAN!
                                                                        </h4>
                                                                        <hr class="my-2">
                                                                        <ul class="mb-1">
                                                                            <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                                            <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                                                        </ul>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 my-1">
                                                                    <div class="form-floating">
                                                                        <input type="text" class="form-control" id="judul" name="___in_judul" placeholder="Cth: Beranda" value="<?= $result['judul']; ?>" required="">
                                                                        <label for="judul">Nama Pengaturan</label>
                                                                    </div>
                                                                </div>

                                                                <?php if ($result['jenis_pengaturan']==="Gambar"): ?>
                                                                    <div class="col-12 my-3">
                                                                        <div class="form-floating">
                                                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" data-height="300" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar">
                                                                            <label for="gambar">Gambar</label>
                                                                        </div>
                                                                    </div>

                                                                <?php elseif ($result['jenis_pengaturan']==="Deskripsi"): ?>
                                                                    <div class="col-md-12 my-1">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="deskripsi" name="___in_deskripsi" placeholder="Cth: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua." value="<?= $result['deskripsi']; ?>" required="">
                                                                            <label for="deskripsi">Deskripsi <?= $result['judul'] ?></label>
                                                                        </div>
                                                                    </div>

                                                                <?php elseif ($result['jenis_pengaturan']==="Teks"): ?>
                                                                    <div class="col-md-12 my-1">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="deskripsi" name="___in_deskripsi" placeholder="Cth: 0816 9070 19" value="<?= $result['deskripsi']; ?>" required="">
                                                                            <label for="deskripsi">Masukkan <?= $result['judul'] ?></label>
                                                                        </div>
                                                                    </div>

                                                                <?php elseif ($result['jenis_pengaturan']==="Textarea"): ?>
                                                                    <div class="col-md-12 my-1">
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" id="deskripsi" name="___in_deskripsi" placeholder="Cth: 0816 9070 19" style="height: 250px" required=""><?= $result['deskripsi'] ?></textarea>
                                                                            <label for="deskripsi">Masukkan <?= $result['judul'] ?></label>
                                                                        </div>
                                                                    </div>

                                                                <?php endif ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                                <input type="hidden" name="___in_id_pengaturan" value="<?= $result['id_pengaturan']; ?>">
                                                                <input type="hidden" name="___in_jenis_pengaturan" value="<?= $result['jenis_pengaturan']; ?>">
                                                                <input type="hidden" name="___in_gambar_lama" value="<?= $result['gambar']; ?>">
                                                                <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal -->
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
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->