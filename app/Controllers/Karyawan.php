<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLokasi;
use App\Models\ModelJabatan;
use App\Models\ModelKaryawan;
use App\Models\ModelShift;
use App\Libraries\secure;
// Qrcode
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class Karyawan extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelLokasi = new ModelLokasi();
        $this->ModelJabatan = new ModelJabatan();
        $this->ModelShift = new ModelShift();
    }
    public function index()
    {
        $data = [
            'judul' => 'Karyawan',
            'menu' => 'karyawan',
            'page' => 'backend/karyawan/v_karyawan',
            'karyawan' => $this->ModelKaryawan->dataKaryawanku(),

        ];
        return view('v_template_back', $data);
    }
    public function add()
    {
        $karyawan = new \stdClass();
        $karyawan->id_karyawan = null;
        $karyawan->nama_karyawan = null;
        $karyawan->username = null;
        $karyawan->password = null;
        $karyawan->id_lokasi = null;
        $karyawan->id_shift = null;
        $karyawan->nip = null;
        $karyawan->telpon = null;
        $karyawan->status_karyawan = null;
        $karyawan->id_jabatan = null;

        $data = array(
            'judul' => 'Form Tambah',
            'menu' => 'karyawan',
            'page' => 'backend/karyawan/form_karyawan',
            'row' => $karyawan,
            'form' => 'add',
            'nip' => $this->ModelKaryawan->NIP(),
            'jabatan' => $this->ModelJabatan->get()->getResult(),
            'lokasi' => $this->ModelLokasi->get()->getResult(),
            'shift' => $this->ModelShift->get()->getResult(),

        );
        return view('v_template_back', $data);
    }
    public function edit($id)
    {
        $id = $this->secure->decrypt_url($id);
        $query = $this->ModelKaryawan->get($id);
        if ($query->getNumRows() > 0) {
            $karyawan = $query->getRow();
            $data = array(
                'judul' => 'Form Ubah',
                'menu' => 'karyawan',
                'form' => 'edit',
                'page' => 'backend/karyawan/form_karyawan',
                'row' => $karyawan,
                'jabatan' => $this->ModelJabatan->get()->getResult(),
                'lokasi' => $this->ModelLokasi->get()->getResult(),
                'shift' => $this->ModelShift->get()->getResult(),

            );
            return view('v_template_back', $data);
        } else {
        }
    }
    public function processadd()
    {

        if ($this->validate(
            [
                'nama_karyawan' => [
                    'label' => 'nama_karyawan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Tidak Boleh Kosong !!'
                    ]
                ],
                'id_jabatan' => [
                    'label' => 'id_jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !!'
                    ]
                ],
                'id_lokasi' => [
                    'label' => 'id_lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !!'
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
                        'required' => 'Password Tidak Boleh Kosong !!'
                    ]
                ],

            ]
        )) {
            $username  = $this->request->getPost('username');
            $nip  = $this->request->getPost('nip');

            $data = [
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'id_shift' => $this->request->getPost('id_shift'),
                'nip' => $this->request->getPost('nip'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'telpon' => telp_indo($this->request->getPost('telpon')),
                'foto_karyawan' => 'user_profile.png',
                'username' => $username,
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            if ($this->ModelKaryawan->check_username($username)->getNumRows() > 0) {
                return redirect()->back()->with('pesanerror', "Username '$username' Sudah Terpakai!!");
            } else {
                $this->_qrcode($nip);
                $this->ModelKaryawan->dataAdd($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                }
                return redirect()->to('panel/karyawan');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function processedit()
    {

        if ($this->validate(
            [
                'nama_karyawan' => [
                    'label' => 'nama_karyawan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Tidak Boleh Kosong !!'
                    ]
                ],
                'id_jabatan' => [
                    'label' => 'id_jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !!'
                    ]
                ],
                'id_lokasi' => [
                    'label' => 'id_lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !!'
                    ]
                ],

                'username' => [
                    'label' => 'username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong !!'
                    ]
                ],

            ]
        )) {
            $password = $this->request->getPost('password');
            $id = $this->request->getPost('id_karyawan');
            $username = $this->request->getPost('username');
            $nip = $this->request->getPost('nip');


            $data = [
                'id_karyawan' => $id,
                'nip' => $nip,
                'id_lokasi' => $this->request->getPost('id_lokasi'),
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'id_shift' => $this->request->getPost('id_shift'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'telpon' => $this->request->getPost('telpon'),
                'username' => $username,
            ];

            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }


            $qrcode = $this->ModelKaryawan->get($id)->getRow();
            if ($qrcode->nip != null) {
                $target_file = './uploads/karyawan/qrcode/' . $qrcode->nip . '.png';
                unlink($target_file);
            }
            if ($this->ModelKaryawan->check_username($id)->getNumRows() > 0) {
                return redirect()->back()->with('pesanerror', "Username '$username' Sudah Terpakai!!");
            } else {

                $this->_qrcode($nip);
                $this->ModelKaryawan->dataEdit($data);
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashdata('pesan', 'Data Berhasil Di Ubah !!');
                }
                return redirect()->to('panel/karyawan');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function del($id)
    {
        $id = $this->secure->decrypt_url($id);
        $this->ModelKaryawan->del($id);

        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('pesan', 'Data Karyawan Berhasil Di Hapus');
        }
        return redirect()->to('panel/karyawan');
    }
    public function importData()
    {
        if ($this->validate(
            [
                'importFile' => [
                    'label' => 'Inputan File',
                    'rules' => 'uploaded[importFile]|ext_in[importFile,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field}Tidak Boleh Kosong !!',
                        'ext_in' => '{field} Harus Ektensi xls & xlsx'
                    ]
                ],
            ]
        )) {
            $file_excel = $this->request->getFile('importFile');
            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
            $data = $spreadsheet->getActiveSheet()->toArray();
            $jumlaherror = 0;
            $jumlahsucces = 0;
            foreach ($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }
                $nama_karyawan = $row[1];
                $telpon = $row[2];
                $username = $row[3];
                $password = $row[4];

                $cek = $this->db->table('tbl_karyawan')->getWhere(['username' => $username])->getResult();
                $nip = $this->ModelKaryawan->NIP();
                if (count($cek) > 0) {
                    $jumlaherror++;
                } else {
                    $data = [
                        'id_shift' => null,
                        'id_jabatan' => null,
                        'id_lokasi' => null,
                        'nip' => $nip,
                        'nama_karyawan' => $nama_karyawan,
                        'telpon' => $telpon,
                        'foto_karyawan' => 'user_profile.png',
                        'username' => $username,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                    ];
                    $this->_qrcode($nip);
                    $this->db->table('tbl_karyawan')->insert($data);

                    if ($this->db->affectedRows() > 0) {
                        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan !!');
                    }

                    $jumlahsucces++;
                }
            }
            return redirect()->to('panel/karyawan')->with('pesan', "$jumlaherror Data gagal ditambahkan <br> $jumlahsucces Data berhasil ditambahkan");
        } else {
            return redirect()->back()->with('pesanerror', 'Inputan Wajib Di Isi!!');
        }
    }
    public function get_nip()
    {
        $result = $this->ModelKaryawan->NIP();
        echo json_encode($result);
    }
    public function blokir()
    {
        $id = $this->request->getPost('id');
        $result = $this->ModelKaryawan->blokir($id);
        if ($result != false) {
            $hasil['hasil'] = 'true';
            echo json_encode($hasil);
        } else {
            $hasil['hasil'] = 'false';
            echo json_encode($hasil);
        }
    }
    public function buka_blokir()
    {
        $id = $this->request->getPost('id');
        $result = $this->ModelKaryawan->buka_blokir($id);
        if ($result != false) {
            $hasil['hasil'] = 'true';
            echo json_encode($hasil);
        } else {
            $hasil['hasil'] = 'false';
            echo json_encode($hasil);
        }
    }
    function _qrcode($nip)
    {
        $writer = new PngWriter();
        // Create QR code
        $qrCode = QrCode::create('Data')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(FCPATH . '/uploads/img/logo.png')
            ->setResizeToWidth(150);

        // Create generic label
        $label = Label::create($nip)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        $result->saveToFile(FCPATH . '/uploads/karyawan/qrcode/' . $nip . '.png');
    }
}
