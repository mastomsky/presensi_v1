<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJabatan;
use App\Models\ModelUser;
use App\Libraries\secure;

class User extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelUser = new ModelUser();
        $this->ModelJabatan = new ModelJabatan();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data user',
            'menu' => 'user',
            'page' => 'backend/user/v_user',

        ];
        return view('v_template_back', $data);
    }
    public function add()
    {
        $user = new \stdClass();
        $user->id_user = null;
        $user->id_jabatan = null;
        $user->nama_user = null;
        $user->username = null;
        $user->password = null;
        $user->status_user = null;
        $user->blokir_user = null;
        $data = array(

            'judul' => 'Form user',
            'menu' => 'user',
            'form' => 'add',
            'page' => 'backend/user/form_user',
            'row' => $user,
            'jabatan' => $this->ModelJabatan->get()->getResult()


        );
        return view('v_template_back', $data);
    }
    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);
        $query = $this->ModelUser->get($id);
        if ($query->getNumRows() > 0) {
            $user = $query->getRow();
            $data = array(
                'judul' => 'Form Ubah',
                'menu' => 'user',
                'form' => 'edit',
                'page' => 'backend/user/form_user',
                'row' => $user,
                'jabatan' => $this->ModelJabatan->get()->getResult()


            );
            return view('v_template_back', $data);
        } else {
        }
    }
    public function process()
    {

        if ($this->validate(
            [
                'nama_user' => [
                    'label' => 'nama_user',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama user Tidak Boleh Kosong !!'
                    ]
                ],
                'username' => [
                    'label' => 'username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong !!'
                    ]
                ],
                'password' => [
                    'label' => 'password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'nama_user' => $this->request->getPost('nama_user'),
                'username' => $this->request->getPost('username'),
                'foto_user' => 'user_profile.png',
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            if (isset($_POST['add'])) {
                $this->ModelUser->dataAdd($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                }
                return redirect()->to('user');
            } else if (isset($_POST['edit'])) {

                $this->ModelUser->dataEdit($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Ubah !!');
                }
                return redirect()->to('user');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $id = $this->secure->decrypt_url($id);
        $this->ModelUser->del($id);

        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('pesan', 'Data user Berhasil Di Hapus');
        }
        return redirect()->to('user');
    }
}
