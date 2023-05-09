<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?= ucfirst($judul) ?></title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('front') ?>/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="<?= base_url('front') ?>/assets/img/icon/register.png" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>E-Absensi</h1>
                <h4>Silahkan Register !!</h4>
            </div>
            <div id="pesan" data-pesan="<?= session()->get('pesan'); ?>"></div>
            <div id="pesanerror" data-pesanerror="<?= session()->get('pesanerror'); ?>"></div>
            <div class="section mt-1 mb-5">
                <?php $errors = validation_errors();
                if (session()->get('pesan')) {
                    echo '<div class="alert alert-danger">';
                    echo session()->get('pesan');
                    echo '</div>';
                }
                ?>
                <?= form_open('Auth/register_now') ?>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Lengkap">
                        <i class="fas fa-times-circle clear-input"></i>
                    </div>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($errors['nama_karyawan']) == isset($errors['nama_karyawan']) ? validation_show_error('nama_karyawan') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        <i class="fas fa-times-circle clear-input"></i>
                    </div>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($errors['username']) == isset($errors['username']) ? validation_show_error('username') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
                        <i class="fas fa-times-circle clear-input"></i>
                    </div>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($errors['password']) == isset($errors['password']) ? validation_show_error('password') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-links mt-2">
                    <div>
                        <a href="<?= base_url('auth') ?>">Login</a>
                    </div>
                    <div><a href="<?= site_url('auth/LupaPassword') ?>" class="text-muted">Forgot Password?</a></div>
                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                </div>

                <?= form_close() ?>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="<?= base_url('front') ?>/assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?= base_url('front') ?>/assets/js/lib/popper.min.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/lib/bootstrap.min.js"></script>
    <!-- Chart JS -->
    <script src="<?= base_url('front') ?>/assets/chart/dist/chart.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- Owl Carousel -->
    <script src="<?= base_url('front') ?>/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= base_url('front') ?>/assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="<?= base_url('front') ?>/assets/js/base.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/style.js"></script>


</body>

</html>