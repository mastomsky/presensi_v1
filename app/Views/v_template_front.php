<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="theme-color" content="#000000" />
    <title>E-Absensi | <?= ucfirst($judul) ?></title>
    <meta name="description" content="E-Absensi Face Recognition With Detect Location" />
    <meta name="keywords" content="Face Recognition,Absensi,Presensi,E-Absensi" />
    <meta name="author" content="mutamidul.my.id">
    <link rel="icon" type="image/png" href="<?= base_url('landing') ?>/images/cup-icon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('landing') ?>/images/cup-icon.png" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/style.css" />
    <script src="<?= base_url('front') ?>/assets/js/plugins/webcamjs/webcam.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/rowGroup.dataTables.min.css">
    <!-- Fullcalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>

    <!-- leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.css"
        integrity="sha512-mD70nAW2ThLsWH0zif8JPbfraZ8hbCtjQ+5RU1m4+ztZq6/MymyZeB55pWsi4YAX+73yvcaJyk61mzfYMvtm9w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="<?= base_url('front') ?>/assets/js/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">


</head>

<body style="background-color: #e9ecef">
    <!-- loader -->
    <!-- <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div> -->
    <!-- * loader -->
    <script src="<?= base_url('front') ?>/assets/js/lib/jquery-3.4.1.min.js"></script>
    <script src='https://rawgit.com/schmich/instascan-builds/master/instascan.min.js'></script>
    <!-- App Capsule -->
    <div id="appCapsule">
        <?php
        if ($page) {
            echo view($page);
        }
        ?>
    </div>
    <!-- * App Capsule -->
    <div id="pesan" data-pesan="<?= session()->get('pesan'); ?>"></div>
    <div id="pesanerror" data-pesanerror="<?= session()->get('pesanerror'); ?>"></div>
    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="<?= site_url('home/index') ?>" class="item <?= $menu == 'home' ? 'active' : '' ?>">
            <div class="col">
                <i class="fas fa-home fa-3x <?= $menu == 'home' ? '' : 'text-dark' ?>"></i>
                <strong>Home</strong>
            </div>
        </a>
        <a href="<?= site_url('home/calendar') ?>" class="item <?= $menu == 'calendar' ? 'active' : '' ?>">
            <div class="col">
                <i class="fas fa-calendar-alt fa-3x <?= $menu == 'calendar' ? '' : 'text-dark' ?>"></i>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="<?= site_url('karyawan/absensi/kamera') ?>" class="item <?= $menu == 'presensi' ? 'active' : '' ?>">
            <div class="action-button large">
                <i class="fas fa-camera text-white fa-3x"></i>
            </div>
        </a>
        <!-- <div class="dropdown">
            <a class="btn item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <div class="col">
                    <div class="action-button large">
                        <i class="fas fa-camera text-white fa-3x"></i>
                    </div>
                </div>
            </a>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= site_url('karyawan/absensi/kamera') ?>">Kamera</a>
                <a class="dropdown-item" href="<?= site_url('karyawan/absensi/qr-code') ?>">Qr Code</a>
            </div>
        </div> -->

        <a href="#" class="item">
            <div class="col">
                <i class="fas fa-file-alt fa-3x <?= $menu == 'dosc' ? '' : 'text-dark' ?>"></i>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="<?= site_url('home/profile') ?>" class="item <?= $menu == 'profile' ? 'active' : '' ?>">
            <div class="col">
                <i class="fas fa-user-tie fa-3x <?= $menu == 'profile' ? '' : 'text-dark' ?>"></i>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.js"
        integrity="sha512-Dqm3h1Y4qiHUjbhxTuBGQsza0Tfppn53SHlu/uj1f+RT+xfShfe7r6czRf5r2NmllO2aKx+tYJgoxboOkn1Scg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap-->
    <script src="<?= base_url('front') ?>/assets/js/lib/popper.min.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/lib/bootstrap.min.js"></script>
    <!-- Chart JS -->
    <script src="<?= base_url('front') ?>/assets/chart/dist/chart.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- DataTables -->
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/jquery.dataTables.js"></script>
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/dataTables.rowGroup.min.js"></script>

    <!-- Owl Carousel -->
    <script src="<?= base_url('front') ?>/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= base_url('front') ?>/assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Sweetalert -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script> -->
    <script src="<?= base_url('front') ?>/assets/js/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Base Js File -->
    <script src="<?= base_url('front') ?>/assets/js/base.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/style.js"></script>


</body>

</html>