<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelCuti;
use App\Models\ModelPresensi;
use App\Libraries\secure;
use App\Models\ModelKaryawan;
use App\Models\ModelLokasi;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelPresensi = new ModelPresensi();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelLokasi = new ModelLokasi();

        $this->secure = new secure();
        $this->ModelCuti = new ModelCuti();
    }

    public function index()
    {

        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'backend/v_dashboard',
            'karyawanaktif' => $this->ModelKaryawan->count_all_aktif(),
            'lokasi' => $this->ModelLokasi->count_all(),

        ];
        return view('v_template_back', $data);
    }
    public function profile()
    {
        $data = [
            'judul' => 'Profile',
            'menu' => 'profile',
            'page' => 'backend/v_profile'
        ];
        return view('v_template_back', $data);
    }


    public function setting()
    {
        $data = [
            'judul' => 'Setting',
            'menu' => 'setting',
            'page' => 'backend/v_setting',
            'setting' => $this->ModelAdmin->dataSetting(),
        ];
        return view('v_template_back', $data);
    }
    public function laporanHarian()
    {
        $data = [
            'judul' => 'Laporan Harian',
            'menu' => 'laporanHarian',
            'page' => 'backend/laporan/laporanHarian'
        ];
        return view('v_template_back', $data);
    }
    public function laporanMingguan()
    {
        $data = [
            'judul' => 'Laporan Mingguan',
            'menu' => 'laporanMingguan',
            'page' => 'backend/laporan/laporanMingguan'
        ];
        return view('v_template_back', $data);
    }
    public function laporanBulanan()
    {
        $data = [
            'judul' => 'Laporan Bulanan',
            'menu' => 'laporanBulanan',
            'page' => 'backend/laporan/laporanBulanan'
        ];
        return view('v_template_back', $data);
    }
}
