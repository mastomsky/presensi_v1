<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLokasi;
use App\Libraries\secure;

class Lokasi extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelLokasi = new ModelLokasi();
    }

    public function index()
    {
        $data = [
            'judul' => 'Lokasi',
            'menu' => 'lokasi',
            'page' => 'backend/lokasi/v_Lokasi',
            'data' => $this->ModelLokasi->get()->getResult(),

        ];
        return view('v_template_back', $data);
    }
    public function add()
    {
        $Lokasi = new \stdClass();
        $Lokasi->id_lokasi = null;
        $Lokasi->nama_lokasi = null;
        $Lokasi->alamat_lokasi = null;
        $Lokasi->lokasi_latlng = null;
        $Lokasi->radius_lokasi = null;

        $data = [
            'judul' => 'Form Add',
            'menu' => 'lokasi',
            'form' => 'add',
            'page' => 'backend/lokasi/form_Lokasi',
            'row' => $Lokasi
        ];
        return view('v_template_back', $data);
    }
    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);

        $query = $this->ModelLokasi->get($id);
        if ($query->getNumRows() > 0) {
            $Lokasi = $query->getRow();
            $data = array(
                'judul' => 'Form Lokasi',
                'menu' => 'lokasi',
                'form' => 'edit',
                'page' => 'backend/lokasi/form_Lokasi',
                'row' => $Lokasi,

            );
            return view('v_template_back', $data);
        } else {
            return redirect()->to('Lokasi')->with('pesanerror', 'Data Tidak Di Temukan');
        }
    }
    public function process()
    {

        if ($this->validate(
            [
                'nama_lokasi' => [
                    'label' => 'nama_lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lokasi Tidak Boleh Kosong !!'
                    ]
                ],
                'alamat_lokasi' => [
                    'label' => 'alamat_lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Tidak Boleh Kosong !!'
                    ]
                ],
                'lokasi_latlng' => [
                    'label' => 'lokasi_latlng',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lokasi Lokasi Tidak Boleh Kosong !!'
                    ]
                ],
                'radius_lokasi' => [
                    'label' => 'radius_lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Radius Lokasi Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $data = [
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'lokasi_latlng' => $this->request->getPost('lokasi_latlng'),
                'radius_lokasi' => $this->request->getPost('radius_lokasi'),
            ];
            if (isset($_POST['add'])) {
                $this->ModelLokasi->dataAdd($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                }
                return redirect()->to('Lokasi');
            } else if (isset($_POST['edit'])) {

                $this->ModelLokasi->dataEdit($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Ubah !!');
                }
                return redirect()->to('Lokasi');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }





    public function delete($id)
    {
        $id = $this->secure->decrypt_url($id);
        $this->ModelLokasi->del($id);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to('lokasi')->with('pesan', 'Berhasil menghapus data');
        }
    }
}
