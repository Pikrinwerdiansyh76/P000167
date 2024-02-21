 <div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= $url_images ?>/avatar/<?= $_SESSION['_avatar__'] ?>" alt="<?= $_SESSION['_nama__'] ?>" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="<?= $base_url_admin ?>/#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?= $_SESSION['_nama__'] ?></a>
                </div>

            <p class="text-muted left-user-info"><?= $_SESSION['_level__'] ?></p>

            <?php if ($_SESSION['_level__']==="Pelapor"): ?>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="<?= $base_url_admin ?>/pelapor/ubah-data/<?= $_SESSION['_username__'] ?>" class="text-muted left-user-info">
                            <i class="mdi mdi-cog"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="<?= $base_url_admin ?>/pelapor/ubah-password/<?= $_SESSION['_username__'] ?>" class="text-muted left-user-info">
                            <i class="fas fa-lock fa-sm"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="<?= $base_url_admin ?>/keluar-admin">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="<?= $base_url_admin ?>/profil-saya" class="text-muted left-user-info">
                            <i class="mdi mdi-cog"></i>
                        </a>
                    </li>

                    <li class="list-inline-item">
                        <a href="<?= $base_url_admin ?>/keluar-admin">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                </ul>
            <?php endif ?>
        </div>

        <!--- Sidemenu -->
        <?php
            switch ($_SESSION['_level__']) {
                case 'Administrator':

                try {
                    $queryDS  = $pdo->prepare("
                        SELECT id_semester
                        FROM semester
                        ORDER BY id_semester DESC
                        LIMIT 1
                    ");

                    $queryDS->execute();
                    $resultDS = $queryDS->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    var_dump($e);
                }
        ?>

        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title bg-body mt-2">MENU</li>

                <li>
                    <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="<?= $base_url_admin ?>/#DataUmum" data-bs-toggle="collapse" class="<?php if(($_GET['module']=='pengaturan') OR ($_GET['module']=='kelas') OR ($_GET['module']=='semester') OR ($_GET['module']=='mapel') OR ($_GET['module']=='wali-kelas')){ echo 'text-light'; } ?>">
                        <i class="fas fa-folder-open"></i>
                        <span> Data Umum </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse <?php if(($_GET['module']=='pengaturan') OR ($_GET['module']=='kelas') OR ($_GET['module']=='semester') OR ($_GET['module']=='mapel') OR ($_GET['module']=='wali-kelas')){ echo 'show'; } ?>" id="DataUmum">
                        <ul class="nav-second-level">
                            <li>
                                <a href="<?= $base_url_admin ?>/kelas" class="<?php if($_GET['module']=='kelas'){ echo 'text-light'; } ?>">
                                    <i class="mdi mdi-arrow-right-bold-outline"></i> Data Kelas
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url_admin ?>/semester" class="<?php if($_GET['module']=='semester'){ echo 'text-light'; } ?>">
                                    <i class="mdi mdi-arrow-right-bold-outline"></i> Data Semester
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url_admin ?>/mapel" class="<?php if($_GET['module']=='mapel'){ echo 'text-light'; } ?>">
                                    <i class="mdi mdi-arrow-right-bold-outline"></i> Data Mata Pelajaran
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url_admin ?>/wali-kelas" class="<?php if($_GET['module']=='wali-kelas'){ echo 'text-light'; } ?>">
                                    <i class="mdi mdi-arrow-right-bold-outline"></i> Data Wali Kelas
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url_admin ?>/pengaturan" class="<?php if($_GET['module']=='pengaturan'){ echo 'text-light'; } ?>">
                                    <i class="mdi mdi-arrow-right-bold-outline"></i> Pengaturan Sistem
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="<?= $base_url_admin ?>/jadwal-mengajar" class="<?php if($_GET['module']=='jadwal-mengajar'){ echo 'text-light'; } ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span> Jadwal Mengajar </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/guru" class="<?php if($_GET['module']=='guru'){ echo 'text-light'; } ?>">
                        <i class="fas fa-user-tie"></i>
                        <span> Data Guru </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/siswa" class="<?php if($_GET['module']=='siswa'){ echo 'text-light'; } ?>">
                        <i class="fas fa-users"></i>
                        <span> Data Siswa </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/rekap-presensi/<?= $resultDS['id_semester'] ?>" class="<?php if($_GET['module']=='rekap-presensi'){ echo 'text-light'; } ?>">
                        <i class="fas fa-list-alt"></i>
                        <span> Rekap Presensi </span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?= $base_url_admin ?>/pegawai" class="<?php if($_GET['module']=='pegawai'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-card-account-details-star"></i>
                        <span> Data Akun Admin </span>
                    </a>
                </li> -->

                <li class="bg-danger">
                    <a href="<?= $base_url_admin ?>/keluar-edit" class="link-light">
                        <i class="fe-log-out"></i>
                        <span> Logout </span>
                    </a>
                </li>
            </ul>
        </div>

        <?php
                    break;
                case 'Guru':

                try {
                    $queryDS  = $pdo->prepare("
                        SELECT id_semester
                        FROM semester
                        ORDER BY id_semester DESC
                        LIMIT 1
                    ");

                    $queryDS->execute();
                    $resultDS = $queryDS->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    var_dump($e);
                }
        ?>

        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title bg-body mt-2">MENU</li>

                <li>
                    <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/jadwal-mengajar/guru/<?= $_SESSION['_id_akun__'] ?>/<?= $resultDS['id_semester'] ?>" class="<?php if($_GET['module']=='jadwal-mengajar'){ echo 'text-light'; } ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span> Jadwal Mengajar </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/presensi/<?= $_SESSION['_id_akun__'] ?>/<?= $resultDS['id_semester'] ?>" class="<?php if($_GET['module']=='presensi'){ echo 'text-light'; } ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span> Presensi </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/rekap-presensi/<?= $resultDS['id_semester'] ?>" class="<?php if($_GET['module']=='rekap-presensi'){ echo 'text-light'; } ?>">
                        <i class="fas fa-list-alt"></i>
                        <span> Rekap Presensi </span>
                    </a>
                </li>

                <li class="bg-danger">
                    <a href="<?= $base_url_admin ?>/keluar-edit" class="link-light">
                        <i class="fe-log-out"></i>
                        <span> Logout </span>
                    </a>
                </li>
            </ul>
        </div>

        <?php
                    break;
                case 'Siswa':

                try {
                    $queryDS  = $pdo->prepare("
                        SELECT id_semester
                        FROM semester
                        ORDER BY id_semester DESC
                        LIMIT 1
                    ");

                    $queryDS->execute();
                    $resultDS = $queryDS->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    var_dump($e);
                }
        ?>

        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title bg-body mt-2">MENU</li>

                <li>
                    <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'text-light'; } ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="<?= $base_url_admin ?>/rekap-presensi/<?= $resultDS['id_semester'] ?>" class="<?php if($_GET['module']=='rekap-presensi'){ echo 'text-light'; } ?>">
                        <i class="fas fa-list-alt"></i>
                        <span> Rekap Presensi </span>
                    </a>
                </li>

                <li class="bg-danger">
                    <a href="<?= $base_url_admin ?>/keluar-edit" class="link-light">
                        <i class="fe-log-out"></i>
                        <span> Logout </span>
                    </a>
                </li>
            </ul>
        </div>

        <?php
                    break;
            }
        ?>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>