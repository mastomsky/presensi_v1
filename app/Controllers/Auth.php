<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController

{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
    }
    public function index()
    {
        $data = [
            'judul' => 'E-Absensi | Login',
        ];
        return view('v_login', $data);
    }
    public function cekLoginKaryawan()
    {
        if ($this->validate(
            [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $cek =  $this->db->table('tbl_karyawan')->where(['username' => $username])->get()->getRowArray();
            if ($cek) {
                if ($cek['blokir_karyawan'] == 1) {
                    session()->setFlashdata('pesanerror', 'User anda Terblokir !!, Harap hubungi admin !!');
                    return redirect()->to('karyawan/login');
                    return false;
                } else {
                    if ($cek['status_karyawan'] == 1) {
                        if (password_verify($password, $cek['password'])) {
                            session()->set('id_karyawan', $cek['id_karyawan']);
                            session()->set('level', 2);
                            $this->db->table('tbl_karyawan')->set('salah_password', '0', false)->where('username', $cek['username'])->update();
                            return redirect()->to('Home');
                        } else {
                            if ($cek['salah_password'] == 2) {
                                $this->db->table('tbl_karyawan')->where('username', $cek['username'])->update(['blokir_karyawan' => '1']);
                            }
                            $this->db->table('tbl_karyawan')->set('salah_password', 'salah_password + 1', false)->where('username', $cek['username'])->update();
                            $sisa_kesempatan = 2 - $cek['salah_password'];

                            if ($cek['salah_password'] == 2) {
                                session()->setFlashdata('pesanerror', 'Username anda Terblokir !!, Harap hubungi admin!');
                            } else {
                                session()->setFlashdata('pesanerror', 'Password Salah, sisa ' . $sisa_kesempatan . ' kesempatan, Silahkan coba lagi!');
                            }
                            return redirect()->to('karyawan/login');
                        }
                    } else {
                        session()->setFlashdata('pesan', 'Username Anda Belum Aktif, Silahkan Hubungi Admin !!');
                        return redirect()->to('karyawan/login');
                    }
                }
            } else {
                session()->setFlashdata('pesanerror', 'Username Atau Password Salah !!');
                return redirect()->to('karyawan/login');
            }
        } else {
            return redirect()->to('karyawan/login')->withInput();
        }
    }
    public function logoutKaryawan()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('karyawan/login');
    }
    // USER 

    public function loginAdmin()
    {

        return view('backend/v_login');
    }
    public function cekLoginUser()
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
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $cek =  $this->db->table('tbl_user')->where(['username' => $username,])->get()->getRowArray();
            if ($cek) {
                if ($cek['blokir_user'] == 1) {
                    session()->setFlashdata('pesanerror', 'Username anda Terblokir !!, Harap hubungi admin !!');
                    return redirect()->to('panel/login');
                    return false;
                } else {
                    if ($cek['status_user'] == 1) {
                        if (password_verify($password, $cek['password'])) {
                            session()->set('id_user', $cek['id_user']);
                            session()->set('level', 1);
                            $this->db->table('tbl_user')->set('salah_password', '0', false)->where('username', $cek['username'])->update();
                            return redirect()->to('panel/dashboard');
                        } else {
                            if ($cek['salah_password'] == 2) {
                                $this->db->table('tbl_user')->where('username', $cek['username'])->update(['blokir_user' => '1']);
                            }
                            $this->db->table('tbl_user')->set('salah_password', 'salah_password + 1', false)->where('username', $cek['username'])->update();
                            $sisa_kesempatan = 2 - $cek['salah_password'];

                            if ($cek['salah_password'] == 2) {
                                session()->setFlashdata('pesanerror', 'Username anda Terblokir !!, Harap hubungi admin!');
                            } else {
                                session()->setFlashdata('pesanerror', 'Password Salah, sisa ' . $sisa_kesempatan . ' kesempatan, Silahkan coba lagi!');
                            }
                            return redirect()->to('panel/login');
                        }
                    } else {
                        session()->setFlashdata('pesan', 'Username Anda Belum Aktif, Silahkan Hubungi Admin !!');
                        return redirect()->to('panel/login');
                    }
                }
            } else {
                session()->setFlashdata('pesanerror', 'Username Atau Password Salah !!');
                return redirect()->to('panel/login');
            }
        } else {
            return redirect()->to('panel/login')->withInput();
        }
    }
    public function logoutUser()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('panel/login');
    }
    // Register
    public function register()
    {
        $data = [
            'judul' => 'E-Absensi | Register',
        ];
        return view('v_register', $data);
    }

    public function register_now()
    {
        if ($this->validate(
            [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[tbl_karyawan.username]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!',
                        'is_unique' => '{field} Sudah Dipakai',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong !!',
                        'min_length' => '{field} Anda Terlalu Sedikit, Minimal 8 Huruf/Angka !!',
                    ]
                ],
            ]
        )) {
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'username' => $this->request->getPost('username'),
                'foto_karyawan' => 'user_profile.png',
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];
            $this->db->table('tbl_karyawan')->insert($data);
            if ($this->db->affectedRows() > 0) {
                session()->setFlashdata('pesan', 'Akun Anda Berhasil Dibuat, Silahkan Hubungi Admin Untuk Aktivasi Akun Anda!!');
            }
            return redirect()->to('auth');
        }
    }
}
