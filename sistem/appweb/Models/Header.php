<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= $url_images ?>/avatar/<?= $_SESSION['_avatar__'] ?>" alt="<?= $_SESSION['_nama__'] ?>" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    <?= $_SESSION['_nama__'] ?> <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Semangat Kerja!</h6>
                </div>

                <?php if ($_SESSION['_level__']==="Pelapor"): ?>
                    <!-- item-->
                    <a href="<?= $base_url_admin ?>/pelapor/ubah-data/<?= $_SESSION['_username__'] ?>" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profil Saya</span>
                    </a>
                    <!-- item-->
                    <a href="<?= $base_url_admin ?>/pelapor/ubah-data/<?= $_SESSION['_username__'] ?>" class="dropdown-item notify-item">
                        <i class="fas fa-lock fa-sm"></i>
                        <span>Ubah Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="<?= $base_url_admin ?>/keluar-edit" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Keluar</span>
                    </a>
                <?php else: ?>
                    <!-- item-->
                    <a href="<?= $base_url_admin ?>/profil-saya" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profil Saya</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="<?= $base_url_admin ?>/keluar-edit" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Keluar</span>
                    </a>
                <?php endif ?>
            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="<?= $base_url_admin ?>/dashboard" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="<?= $url_images; ?>/<?= $icon; ?>" alt="<?= $judulIcon; ?>" height="30">
            </span>
            <span class="logo-lg">
                <img src="<?= $url_images; ?>/<?= $logoDesktop; ?>" alt="<?= $judulLogoDesktop; ?>" height="25">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main">Portal <?= $slogan ?></h4>
        </li>
    </ul>

    <div class="clearfix"></div> 
</div>