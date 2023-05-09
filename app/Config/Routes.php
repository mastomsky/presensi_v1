<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Landing::index');
$routes->group('karyawan', static function ($routes) {
    $routes->get('login', 'Auth::index');
    $routes->post('login', 'Auth::cekLoginKaryawan');
    $routes->get('logout', 'Auth::logoutKaryawan');
    $routes->get('dashboard', 'Home::index');
    $routes->get('histori', 'Home::histori');
    $routes->get('absensi/kamera', 'Presensi::index');
    $routes->get('absensi/qr-code', 'Presensi::qrCode');


    $routes->get('cuti', 'Cuti::index');
    $routes->get('cuti/add', 'Cuti::add');
    $routes->post('cuti/processadd', 'Cuti::processadd');
    $routes->get('cuti/edit/(:any)', 'Cuti::edit/$1');
    $routes->post('cuti/processaedit', 'Cuti::processedit');
    $routes->get('cuti/del/(:any)', 'Cuti::del/$1');

    $routes->get('profile', 'Home::Profile');
    $routes->get('profile/edit', 'Home::edit');
    $routes->post('profile/process', 'Home::processProfile');
});


$routes->group('panel', static function ($routes) {

    $routes->get('login', 'Auth::loginAdmin');
    $routes->post('login', 'Auth::cekLoginUser');
    $routes->get('logout', 'Auth::logoutUser');
    $routes->get('profile', 'Admin::profile');
    $routes->get('dashboard', 'Admin::index');

    $routes->get('lokasi', 'Lokasi::index');
    $routes->get('lokasi/add', 'Lokasi::add');
    $routes->get('lokasi/edit/(:any)', 'Lokasi::edit/$1');
    $routes->get('lokasi/del/(:any)', 'Lokasi::del/$1');
    $routes->get('lokasi/process', 'Lokasi::process');
    // Karyawan
    $routes->get('karyawan', 'Karyawan::index');
    $routes->get('karyawan/add', 'Karyawan::add');
    $routes->get('karyawan/add', 'Karyawan::add');
    $routes->get('karyawan/edit/(:any)', 'Karyawan::edit/$1');
    $routes->get('karyawan/del/(:any)', 'Karyawan::del/$1');
    // Shift
    $routes->get('shift', 'Shift::index');
    $routes->get('shift/add', 'Shift::add');
    $routes->get('shift/edit/(:any)', 'Shift::edit/$1');
    $routes->get('shift/del/(:any)', 'Shift::del/$1');
    // Jabatan
    $routes->get('jabatan', 'Jabatan::index');
    $routes->get('jabatan/add', 'Jabatan::add');
    $routes->get('jabatan/edit/(:any)', 'Jabatan::edit/$1');
    $routes->get('jabatan/process', 'Jabatan::process');
    $routes->get('jabatan/del/(:any)', 'Jabatan::del/$1');
    // Cuti
    $routes->get('cuti', 'Cuti::cuti');
    $routes->get('cuti/detail_cuti/(:any)', 'Cuti::detail_cuti/$1');
    // User
    $routes->get('user', 'User::index');
    $routes->get('user/add', 'User::index');
    $routes->get('user/edit/(:any)', 'User::edit/$1');
    $routes->get('user/del/(:any)', 'User::del/$1');
    // Absensi
    $routes->get('absensi', 'Presensi::presensi');
    $routes->get('absensi/detail/(:any)', 'Presensi::detail/$1');
    // Admin
    $routes->get('log_histori', 'Admin::history_login');
    // profil website
    $routes->get('website/profile', 'Pengaturan::profile');
    $routes->get('website/profile/gambar-slide', 'Pengaturan::gambar_slide');
    $routes->get('website/profile/gambar-slide/add', 'Pengaturan::gambar_add');
    $routes->get('website/profile/gambar-slide/edit/(:any)', 'Pengaturan::gambar_edit/$1');
    $routes->get('website/profile/gambar-slide/del/(:any)', 'Pengaturan::gambar_del/$1');


    $routes->get('website/profile/testimoni', 'Pengaturan::testimoni');
    $routes->get('website/profile/testimoni/add', 'Pengaturan::testimoni_add');
    $routes->get('website/profile/testimoni/edit/(:any)', 'Pengaturan::testimoni_edit/$1');
    $routes->get('website/profile/testimoni/del/(:any)', 'Pengaturan::testimoni_del/$1');
    // Laporan
    $routes->post('laporan/cetak_data', 'Laporan::cetak_data');
    $routes->post('laporan/cetak', 'Laporan::cetak');
});

// $routes->post('login/process', 'Auth::cekLoginKaryawan');
// $routes->post('Serverside/tabel_karyawan', 'Serverside::get_karyawan');


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
