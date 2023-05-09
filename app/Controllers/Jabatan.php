<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJabatan;
use App\Libraries\secure;

class Jabatan extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelJabatan = new ModelJabatan();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Jabatan',
            'menu' => 'jabatan',
            'page' => 'backend/jabatan/v_jabatan',
        ];
        return view('v_template_back', $data);
    }
    public function add()
    {
        $jabatan = new \stdClass();
        $jabatan->id_jabatan = null;
        $jabatan->nama_jabatan = null;


        $data = [
            'judul' => 'Form Tambah',
            'menu' => 'jabatan',
            'form' => 'add',
            'page' => 'backend/jabatan/form_jabatan',
            'row' => $jabatan
        ];
        return view('v_template_back', $data);
    }
    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);
        $query = $this->ModelJabatan->get($id);
        if ($query->getNumRows() > 0) {
            $jabatan = $query->getRow();
            $data = array(
                'judul' => 'Form Ubah',
                'menu' => 'jabatan',
                'form' => 'edit',
                'page' => 'backend/jabatan/form_jabatan',
                'row' => $jabatan,

            );
            return view('v_template_back', $data);
        } else {
            return redirect()->to('panel/jabatan')->with('pesanerror', 'Data Tidak Di Temukan');
        }
    }
    public function process()
    {

        if ($this->validate(
            [
                'nama_jabatan' => [
                    'label' => 'nama_jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama jabatan Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $data = [
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'nama_jabatan' => $this->request->getPost('nama_jabatan'),

            ];
            if (isset($_POST['add'])) {
                $this->ModelJabatan->dataAdd($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                }
                return redirect()->to('panel/jabatan');
            } else if (isset($_POST['edit'])) {

                $this->ModelJabatan->dataEdit($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Ubah !!');
                }
                return redirect()->to('panel/jabatan');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function del($id)
    {
        $id = $this->secure->decrypt_url($id);
        $this->ModelJabatan->del($id);
        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('pesan', 'Data Jabatan Berhasil Di Hapus');
        }
        return redirect()->to('panel/jabatan');
    }
}
