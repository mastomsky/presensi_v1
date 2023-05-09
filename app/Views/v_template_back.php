<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Absensi | <?= ucfirst($judul) ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- dataTables -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/dataTables/css/rowGroup.dataTables.min.css">
    <!-- select default -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/select2/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <!-- Sweetalert -->
    <link href="<?= base_url('front') ?>/assets/js/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- International telpon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('back') ?>/plugins/intl-tel-input/css/intlTelInput.css">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <?php
    $db = \Config\Database::connect();

    $user = $db->table('tbl_user')->where('id_user', session()->get('id_user'))->get()->getRowArray();
    ?>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('panel/dashboard') ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <img src="<?= base_url('back') ?>/dist/img/AdminLTELogo.png"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"> <?= $user['nama_user'] ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="<?= base_url('back') ?>/dist/img/AdminLTELogo.png" class="img-circle elevation-2"
                                alt="User Image">

                            <p>
                                <?= $user['nama_user'] ?>
                                <small> <?= $user['nama_user'] ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="<?= site_url('panel/logout') ?>" class="btn btn-default btn-flat float-right">Log
                                out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/panel/dashboard') ?>" class="brand-link">
                <img src="<?= base_url('back') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">E-Absensi</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('back') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user['nama_user'] ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item ">
                            <a href="<?= base_url('panel/dashboard') ?>" class="nav-link <?= $menu == 'dashboard' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>
                        </li>

                        <li
                            class="nav-item <?= ($menu == 'lokasi' || $menu == 'karyawan' || $menu == 'jabatan' || $menu == 'shift' ? 'menu-open' : '') ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Master Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/lokasi') ?>"
                                        class="nav-link <?= $menu == 'lokasi' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Lokasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/shift') ?>"
                                        class="nav-link <?= $menu == 'shift' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Jam Kerja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/jabatan') ?>"
                                        class="nav-link <?= $menu == 'jabatan' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Jabatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/karyawan') ?>"
                                        class="nav-link <?= $menu == 'karyawan' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Karyawan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="<?= base_url('panel/cuti') ?>"
                                class="nav-link <?= $menu == 'cuti' ? 'active' : null ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Data Permohonan Cuti

                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?= base_url('panel/absensi') ?>"
                                class="nav-link <?= $menu == 'absensi' ? 'active' : null ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Data Absensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="<?= base_url('panel/user') ?>"
                                class="nav-link <?= $menu == 'user' ? 'active' : null ?>">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>
                                    Data User

                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item ">
                            <a href="<?= base_url('panel/log_histori') ?>" class="nav-link <?= $menu == 'histori' ? 'active' : null ?>">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Log Histori
                                </p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a href="<?= base_url('panel/setting') ?>" class="nav-link <?= $menu == 'setting' ? 'active' : null ?>">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>
                                    Pengaturan Website
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/laporanHarian') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/laporanMingguan') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mingguan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('admin/laporanBulanan') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bulanan</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li
                            class="nav-item <?= ($menu == 'profile-wesite' || $menu == 'gambar-slide' || $menu == 'testimoni'  ? 'menu-open' : '') ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Profile Website
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/website/profile') ?>"
                                        class="nav-link <?= $menu == 'profile-website' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/website/profile/gambar-slide') ?>"
                                        class="nav-link <?= $menu == 'gambar-slide' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gambar Slide</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('panel/website/profile/testimoni') ?>"
                                        class="nav-link <?= $menu == 'testimoni' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Testimoni</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= ucfirst($judul) ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard') ?>">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active"><?= ucfirst($judul) ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <div id="pesan" data-pesan="<?= session()->get('pesan'); ?>"></div>
            <div id="pesanerror" data-pesanerror="<?= session()->get('pesanerror'); ?>"></div>
            <script src="<?= base_url('front') ?>/assets/js/plugins/sweetalert2/sweetalert2.all.min.js"></script>

            <script src="<?= base_url('front') ?>/assets/js/lib/jquery-3.4.1.min.js"></script>
            <script>
            var base_url = "<?= base_url() ?>"
            </script>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($page) {
                            echo view($page);
                        } ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://adminlte.io">inibaruteh.com</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('back') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('back') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- dataTables -->
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/jquery.dataTables.js"></script>
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/dataTables/js/dataTables.rowGroup.min.js"></script>

    <!-- AdminLTE -->
    <script src="<?= base_url('back') ?>/dist/js/adminlte.js"></script>
    <!-- select -->
    <script src="<?= base_url('back') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- international telpon jquery -->
    <script src="<?= base_url('back') ?>/plugins/intl-tel-input/js/intlTelInput-jquery.js"></script>
    <script src="<?= base_url('back') ?>/plugins/intl-tel-input/js/intlTelInput.js"></script>
    <!-- char -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"
        integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- AdminLTE dashboard -->
    <script src="<?= base_url('back') ?>/dist/js/pages/dashboard3.js"></script>
    <script src="<?= base_url('front') ?>/assets/js/style.js"></script>


</body>

</html>