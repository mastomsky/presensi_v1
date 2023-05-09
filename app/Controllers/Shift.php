<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelShift;
use App\Libraries\secure;

class Shift extends BaseController
{
    public function __construct()
    {
        $this->ModelShift = new ModelShift();
        $this->secure = new secure();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Shift',
            'menu' => 'shift',
            'page' => 'backend/shift/v_shift',
            'data' => $this->ModelShift->dataShift()->getResult(),

        ];
        return view('v_template_back', $data);
    }
    public function add()
    {
        $shift = new \stdClass();
        $shift->id_shift = null;
        $shift->nama_shift = null;
        $shift->start_in = null;
        $shift->end_out = null;
        $data = array(

            'judul' => 'Form Shift',
            'menu' => 'shift',
            'form' => 'add',
            'page' => 'backend/shift/form_shift',
            'row' => $shift


        );
        return view('v_template_back', $data);
    }
    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);

        $query = $this->ModelShift->get($id);
        if ($query->getNumRows() > 0) {
            $shift = $query->getRow();
            $data = array(
                'judul' => 'Form Shift',
                'menu' => 'shift',
                'form' => 'edit',
                'page' => 'backend/shift/form_shift',
                'row' => $shift

            );
            return view('v_template_back', $data);
        } else {
        }
    }
    public function process()
    {

        if ($this->validate(
            [
                'nama_shift' => [
                    'label' => 'nama_shift',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Shift Tidak Boleh Kosong !!'
                    ]
                ],
                'start_in' => [
                    'label' => 'start_in',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong !!'
                    ]
                ],
                'end_out' => [
                    'label' => 'end_out',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Masuk Tidak Boleh Kosong !!'
                    ]
                ],
            ]
        )) {
            $id_shift = $this->request->getPost('id_shift');
            $nama_shift = $this->request->getPost('nama_shift');
            $start_in = $this->request->getPost('start_in');
            $end_out = $this->request->getPost('end_out');
            $data = [
                'id_shift' => $id_shift,
                'nama_shift' => $nama_shift,
                'start_in' => $start_in,
                'end_out' => $end_out
            ];
            if (isset($_POST['add'])) {
                $this->ModelShift->dataAdd($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                }
                return redirect()->to('shift');
            } else if (isset($_POST['edit'])) {

                $this->ModelShift->dataEdit($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Ubah !!');
                }
                return redirect()->to('shift');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function delete($id)
    {
        $id = $this->secure->decrypt_url($id);
        $this->ModelShift->del($id);

        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('pesan', 'Data Shift Berhasil Di Hapus');
        }
        return redirect()->to('shift');
    }
}
