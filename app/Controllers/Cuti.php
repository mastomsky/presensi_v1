<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCuti;
use App\Libraries\secure;

class Cuti extends BaseController

{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelCuti = new ModelCuti();
    }
    public function index()
    {
        $data = [
            'judul' => 'Request Cuti',
            'menu' => 'cuti',
            'page' => 'cuti/v_cuti',
            'data' => $this->ModelCuti->getJoin()->getResult(),
        ];
        return view('v_template_front', $data);
    }

    public function add()
    {
        $cuti = new \stdClass();
        $cuti->keperluan = null;
        $cuti->tgl_mulai = null;
        $cuti->tgl_selesai = null;
        $cuti->mulai_kerja = null;
        $cuti->berkas = null;
        $cuti->keterangan = null;
        $id = session()->get('id_karyawan');
        $query = $this->ModelCuti->getbyID($id)->getRow();
        if (@empty($query)) {
            $data =  array(
                'judul' => 'Form Cuti',
                'menu' => 'cuti',
                'page' => 'cuti/form_cuti',
                'form' => 'add',
                'row' => $cuti

            );
            return view('v_template_front', $data);
        } elseif ($query->status_cuti != null) {
            $data =  array(
                'judul' => 'Form Cuti',
                'menu' => 'cuti',
                'page' => 'cuti/form_cuti',
                'form' => 'add'
            );
            return view('v_template_front', $data);
        } else {
            return redirect()->back()->with('pesanerror', 'Request Cuti Anda Masih Pending, Anda Tidak Bisa Request Saat Ini');
        }
    }

    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);
        $query = $this->ModelCuti->get($id);
        if ($query->getNumRows() > 0) {
            $shift = $query->getRow();
            $data = array(
                'judul' => 'Form cuti',
                'menu' => 'cuti',
                'form' => 'edit',
                'page' => 'cuti/form_cuti',
                'row' => $shift

            );
            return view('v_template_front', $data);
        } else {
            return redirect()->back()->with('pesanerror', 'Data Tidak Di Temukan!!');
        }
    }
    public function processadd()
    {

        if ($this->validate(
            [
                'tgl_mulai' => [
                    'label' => 'tgl_mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Mulai Tidak Boleh Kosong !!'
                    ]
                ],
                'tgl_selesai' => [
                    'label' => 'tgl_selesai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Selesai Tidak Boleh Kosong !!'
                    ]
                ],
                'mulai_kerja' => [
                    'label' => 'mulai_kerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mulai Kerja Tidak Boleh Kosong !!'
                    ]
                ],
                'keterangan' => [
                    'label' => 'keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !!'
                    ]
                ],
                'berkas' => [
                    'label' => 'File Bukti',
                    'rules' => [
                        'uploaded[berkas]',
                        'is_image[berkas]',
                        'mime_in[berkas,image/jpg,image/jpeg,image/png]',
                        'max_size[berkas,2048]',
                    ],
                    'errors' => [
                        'uploaded' => ' File Bukti Wajib Di Upload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
            ]
        )) {
            $id_cuti = $this->request->getPost('id_cuti');
            $id_karyawan = session()->get('id_karyawan');
            $tgl_mulai = $this->request->getPost('tgl_mulai');
            $tgl_selesai = $this->request->getPost('tgl_selesai');
            $mulai_kerja = $this->request->getPost('mulai_kerja');
            $keterangan = $this->request->getPost('keterangan');
            $berkas = $this->request->getFile('berkas');
            $file_name = $id_karyawan . "-" . date('Y-m-d') . "-" . date('His') . ".png";

            $data = [
                'id_cuti' => $id_cuti,
                'id_karyawan' => $id_karyawan,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'mulai_kerja' => $mulai_kerja,
                'keterangan' => $keterangan,
                'berkas' => $file_name
            ];
            $berkas->move('uploads/berkas_cuti/', $file_name);
            $this->ModelCuti->dataAdd($data);
            if ($this->db->affectedRows() > 0) {
                session()->setFlashdata('pesan', 'Request Cuti Berhasil Di Tambahkan !!');
            }
            return redirect()->to('karyawan/cuti');
        } else {
            return redirect()->back()->withInput('pesanerror', 'Request Cuti Gagal Di Tambahkan !!');
        }
    }
    public function processedit()
    {

        if ($this->validate(
            [
                'keperluan' => [
                    'label' => 'Keperluarn Cuti',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field}  Mulai Tidak Boleh Kosong !!'
                    ]
                ],
                'tgl_mulai' => [
                    'label' => 'tgl_mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Mulai Tidak Boleh Kosong !!'
                    ]
                ],
                'tgl_selesai' => [
                    'label' => 'tgl_selesai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Selesai Tidak Boleh Kosong !!'
                    ]
                ],
                'mulai_kerja' => [
                    'label' => 'mulai_kerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mulai Kerja Tidak Boleh Kosong !!'
                    ]
                ],
                'keterangan' => [
                    'label' => 'keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !!'
                    ]
                ],
                'berkas' => [
                    'label' => 'File Bukti',
                    'rules' => [
                        'uploaded[berkas]',
                        'is_image[berkas]',
                        'mime_in[berkas,image/jpg,image/jpeg,image/png,image/pdf]',
                        'max_size[berkas,200]',
                    ],
                    'errors' => [
                        'uploaded' => ' File Bukti Wajib Di Upload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ],
            ]
        )) {
            $id_cuti = $this->request->getPost('id_cuti');
            $keperluan = $this->request->getPost('keperluan');
            $id_karyawan = session()->get('id_karyawan');
            $tgl_mulai = $this->request->getPost('tgl_mulai');
            $tgl_selesai = $this->request->getPost('tgl_selesai');
            $mulai_kerja = $this->request->getPost('mulai_kerja');
            $keterangan = $this->request->getPost('keterangan');
            $berkas = $this->request->getFile('berkas');
            $ext = "." . $berkas->getExtension();
            $file_name = $id_karyawan . "-" . date('Y-m-d') . "-" . date('His') . $ext;

            $data = [
                'id_cuti' => $id_cuti,
                'keperluan' => $keperluan,
                'id_karyawan' => $id_karyawan,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'mulai_kerja' => $mulai_kerja,
                'keterangan' => $keterangan,
            ];
            if (!empty($berkas)) {
                $data['berkas'] = $file_name;
            }
            $cekBerkas = $this->ModelCuti->get($id_cuti)->getRow();
            if ($cekBerkas->berkas != null) {
                $target_file = './uploads/berkas_cuti/' . $cekBerkas->berkas;
                unlink($target_file);
            }
            $berkas->move('uploads/berkas_cuti/', $file_name);
            $this->ModelCuti->dataAdd($data);
            if ($this->db->affectedRows() > 0) {
                session()->setFlashdata('pesan', 'Request Cuti Berhasil Di Tambahkan !!');
            }
            return redirect()->to('karyawan/cuti');
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function del($id)
    {
        $id = $this->secure->decrypt_url($id);
        $berkas = $this->ModelCuti->get($id)->getRow();
        if ($berkas->berkas != null) {
            $target_file = './uploads/berkas_cuti/' . $berkas->berkas;
            unlink($target_file);
        }
        $this->ModelCuti->del($id);
        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('pesan', 'Data Request Cuti Berhasil Di Hapus');
        }
        return redirect()->to('karyawan/cuti');
    }


    // Panel
    public function cuti()
    {
        $data = [
            'judul' => 'Data Cuti',
            'menu' => 'cuti',
            'page' => 'backend/cuti/v_cuti',
        ];
        return view('v_template_back', $data);
    }
    public function detail_cuti($id)
    {
        $id = $this->secure->decrypt_url($id);
        $data = [
            'judul' => 'Detail Permohonan Cuti',
            'menu' => 'cuti',
            'page' => 'backend/cuti/detail_cuti',
            'row' => $this->ModelCuti->getbyID($id)->getRow(),
        ];
        return view('v_template_back', $data);
    }
    public function cuti_setujui()
    {
        $id = $this->request->getPost('id');
        $result = $this->ModelCuti->setuju($id);
        if ($result != false) {
            $hasil['hasil'] = 'true';
            echo json_encode($hasil);
        } else {
            $hasil['hasil'] = 'false';
            echo json_encode($hasil);
        }
    }
    public function cuti_tolak()
    {
        $id = $this->request->getPost('id');
        $result = $this->ModelCuti->tolak($id);
        if ($result != false) {
            $hasil['hasil'] = 'true';
            echo json_encode($hasil);
        } else {
            $hasil['hasil'] = 'false';
            echo json_encode($hasil);
        }
    }
}
