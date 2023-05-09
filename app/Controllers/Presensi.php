<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPresensi;
use App\Models\ModelKaryawan;
use App\Libraries\secure;

class Presensi extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelPresensi = new ModelPresensi();
        $this->ModelKaryawan = new ModelKaryawan();
    }
    public function index()
    {
        $presensi = $this->ModelPresensi->cekPresensi();
        if ($presensi == null) {
            $data = [
                'judul' => 'Absen Masuk',
                'menu' => 'presensi',
                'page' => 'presensi/v_absen_masuk',
                'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),

            ];
            return view('v_template_front', $data);
        } else {
            // absen pulang
            if ($presensi['lokasi_out'] == null or $presensi['foto_out'] == null) {
                $data = [
                    'judul' => 'Absen Pulang',
                    'menu' => 'presensi',
                    'page' => 'presensi/v_absen_pulang',
                    'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),

                ];
                return view('v_template_front', $data);
            } else {
                $data = [
                    'judul' => 'Sudah Absen',
                    'menu' => 'presensi',
                    'page' => 'presensi/v_absen_sudah',
                    'presensi' => $this->ModelPresensi->cekPresensi(),

                ];
                return view('v_template_front', $data);
            }
        }
    }

    public function insertPresensiIn()
    {
        $foto = $this->request->getPost('image');
        $id_karyawan = session()->get('id_karyawan');
        $id_shift = $this->request->getPost('id_shift');;
        $lokasi = $this->request->getPost('lokasi');

        $folder_path = "uploads/presensi/";
        $format_name_file = $id_karyawan . "-" . date('Y-m-d') . "-" . date('His');
        $image_parts = explode(";base64", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = $format_name_file . ".png";
        $file = $folder_path . $file_name;

        $data = [
            'id_karyawan' => $id_karyawan,
            'id_shift' => $id_shift,
            'tgl_presensi' => date('Y-m-d'),
            'jam_in' => date('H:i:s'),
            'lokasi_in' => $lokasi,
            'foto_in' => $file_name,

        ];

        $this->ModelPresensi->insertPresensiIn($data);
        file_put_contents($file, $image_base64);
    }
    public function insertPresensiOut()
    {
        $presensi = $this->ModelPresensi->cekPresensi();
        $id_presensi = $presensi['id_presensi'];
        $foto = $this->request->getPost('image');
        $id_karyawan = session()->get('id_karyawan');
        $lokasi = $this->request->getPost('lokasi');

        // image
        $folder_path = "uploads/presensi/";
        $format_name_file = $id_karyawan . "-" . date('Y-m-d') . "-" . date('His');
        $image_parts = explode(";base64", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = $format_name_file . ".png";
        $file = $folder_path . $file_name;

        $data = [
            'id_presensi' => $id_presensi,
            'jam_out' => date('H:i:s'),
            'lokasi_out' => $lokasi,
            'foto_out' => $file_name,

        ];

        $this->ModelPresensi->insertPresensiOut($data);
        file_put_contents($file, $image_base64);
    }
    public function presensiIzin()
    {
        # code...
    }

    // panel absensi
    public function presensi()
    {
        $data = [
            'judul' => 'Data Absensi',
            'menu' => 'absensi',
            'page' => 'backend/presensi/v_presensi',
        ];
        return view('v_template_back', $data);
    }
    public function detail($id)
    {
        $id = $this->secure->decrypt_url($id);
        $query = $this->ModelPresensi->detail_presensi($id);
        if ($query->getNumRows() > 0) {
            $presensi = $query->getRow();
            $data = [
                'judul' => 'Detail Absensi ',
                'menu' => 'absensi',
                'page' => 'backend/presensi/detail_absensi',
                'row' => $presensi,
                'karyawan' => $this->ModelKaryawan->get($presensi->id_karyawan)->getRow(),
            ];
            return view('v_template_back', $data);
        } else {
            return redirect()->back()->with('pesanerror', 'Data tidak Ditemukan');
        }
    }
}
