<?php

namespace App\Controllers;

use \App\Models\ModelKaryawan;
use App\Models\ModelPresensi;
use App\Libraries\secure;
use App\Models\ModelCuti;

class Home extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelPresensi = new ModelPresensi();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelCuti = new ModelCuti();
    }
    public function index()
    {
        $data = [
            'judul' => 'Home',
            'menu' => 'home',
            'page' => 'v_home',
            'presensi' => $this->ModelPresensi->cekPresensi(),
            'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),
            'countpresensi' => $this->ModelPresensi->count_all_hadir(),
            'countizin' => $this->ModelCuti->count_all_izin(),
            'countsakit' => $this->ModelCuti->count_all_sakit(),
            'countterlambat' => $this->ModelPresensi->count_all_terlambat(),
        ];
        return view('v_template_front', $data);
    }
    public function Profile()
    {
        $data = [
            'judul' => 'Profile',
            'menu' => 'profile',
            'page' => 'profile/v_profile',
            'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),

        ];
        return view('v_template_front', $data);
    }
    public function edit()
    {
        $data = array(
            'judul' => 'Ubah Profile',
            'menu' => 'profile',
            'page' => 'profile/form_profile',
            'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),
        );
        return view('v_template_front', $data);
    }
    public function processProfile()
    {
        if ($this->validate(
            [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!'
                    ]
                ],
                'passwordlama' => [
                    'label' => 'Password Lama',
                    'rules' => 'min_length[8]',
                    'errors' => [
                        'min_length' => 'Password Minimal 8 karakter!!',
                    ]
                ],
                'password' => [
                    'label' => 'Password Baru',
                    'rules' => 'min_length[8]',
                    'errors' => [
                        'min_length' => 'Password Minimal 8 karakter!!',

                    ]
                ],
                'passconf' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => '{field} Tidak Sama',
                        'min_length' => 'Password Minimal 8 karakter!!',
                    ]
                ],

            ]
        )) {
            $password = $this->request->getVar('password');
            $passwordlama = $this->request->getVar('passwordlama');
            $id = $this->request->getVar('id_karyawan');
            $username = $this->request->getVar('username');
            $foto = $this->request->getFile('foto');
            $ext = "." . $foto->getExtension();

            $file_name = $id . "-" . date('Ymd') . "-" . date('His') . "$ext";

            $data = [
                'id_karyawan' => $id,
                'username' => $username,
            ];

            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $cek = $this->ModelKaryawan->get($id)->getRow();

            if (password_verify($passwordlama, $cek->password)) {
                if (password_verify($password, $cek->password)) {
                    return redirect()->back()->with('pesanerror', "Password Baru Tidak Boleh Sama Dengan Password Yang Lama!!");
                } else {
                    if ($this->ModelKaryawan->check_username($id)->getNumRows() > 0) {
                        return redirect()->back()->with('pesanerror', "Username '$username' Sudah Terpakai!!");
                    } else {
                        if (@$_FILES['foto']['name'] != null) {
                            if ($cek->foto_karyawan == 'user_profile.png') {
                                $foto->move('uploads/karyawan/', $file_name);
                                $data['foto_karyawan'] = $file_name;
                                $this->ModelKaryawan->dataEdit($data);
                                if ($this->db->affectedRows() > 0) {
                                    session()->setFlashdata('pesan', 'Profile Berhasil Di Ubah !!');
                                }
                                return redirect()->to('karyawan/profile');
                            } else {
                                if ($cek->foto_karyawan != null) {
                                    $target_file = './uploads/karyawan/' . $cek->foto_karyawan;
                                    unlink($target_file);
                                }
                                $data['foto_karyawan'] = $file_name;
                                $foto->move('uploads/karyawan/', $file_name);
                                $this->ModelKaryawan->dataEdit($data);
                                if ($this->db->affectedRows() > 0) {
                                    session()->setFlashdata('pesan', 'Profile Berhasil Di Ubah !!');
                                }
                                return redirect()->to('karyawan/profile');
                            }
                        } else {
                            $this->ModelKaryawan->dataEdit($data);
                            if ($this->db->affectedRows() > 0) {
                                session()->setFlashdata('pesan', 'Profile Berhasil Di Ubah !!');
                            }
                            return redirect()->to('karyawan/profile');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('pesanerror', 'Password Lama Salah!!');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function lokasi()
    {
        $data = [
            'judul' => 'Lokasi Kerja',
            'menu' => 'lokasi',
            'page' => 'v_lokasi_kerja',
            'karyawan' => $this->ModelKaryawan->dataKaryawan()->getRowArray(),

        ];
        return view('v_template_front', $data);
    }
    public function calendar()
    {
        $data = [
            'judul' => 'Calendar',
            'menu' => 'calendar',
            'page' => 'calendar/v_calendar'
        ];
        return view('v_template_front', $data);
    }
    public function histori()
    {
        $data = [
            'judul' => 'Histori Absensi',
            'menu' => 'histori',
            'page' => 'histori/v_histori',
            'presensi' => $this->ModelPresensi->dataPresensi(),
        ];
        return view('v_template_front', $data);
    }
}
