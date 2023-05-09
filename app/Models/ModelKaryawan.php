<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKaryawan extends Model
{
    var $column_order = array(null, 'nip', 'nama_karyawan', 'nama_shift', 'nama_lokasi', 'nama_jabatan', 'username', 'jam_in', 'jam_out', 'foto_in', 'foto_out'); //set column field database for datatable orderable
    var $column_search = array('nama_karyawan'); //set column field database for datatable searchable
    var $order = array('id_karyawan' => 'desc'); // default order 

    private function _get_datatables_query($db)
    {

        $db->select('tbl_karyawan.*,nama_lokasi,nama_jabatan,nama_shift');
        $db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_karyawan.id_jabatan', 'LEFT');
        $db->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_karyawan.id_lokasi', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_karyawan.id_shift', 'LEFT');
        $i = 0;
        foreach ($this->column_search as $kar) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $db->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $db->like($kar, $_POST['search']['value']);
                } else {
                    $db->orLike($kar, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $db->groupEnd(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $db->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $db->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $db = $this->db->table('tbl_karyawan');
        $this->_get_datatables_query($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $db = $this->db->table('tbl_karyawan');

        $this->_get_datatables_query($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    function count_all()
    {
        $db = $this->db->table('tbl_karyawan');
        return $db->countAllResults();
    }
    function count_all_aktif()
    {
        $db = $this->db->table('tbl_karyawan');
        $db->where('status_karyawan', "1");
        return $db->countAllResults();
    }
    public function get($id = null)
    {
        $db = $this->db->table('tbl_karyawan');
        $db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_karyawan.id_jabatan', 'LEFT');
        $db->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_karyawan.id_lokasi', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_karyawan.id_shift', 'LEFT');
        if ($id != null) {
            $db->where('id_karyawan', $id);
        }
        $query = $db->get();
        return $query;
    }

    public function NIP()
    {
        $db = $this->db->table('tbl_karyawan');
        $db->select('RIGHT(tbl_karyawan.nip,5) as nip', FALSE);
        $db->orderBy('nip', 'DESC');
        $db->limit(1);
        $query = $db->get();
        if ($query->getNumRows() <> 0) {
            $data = $query->getRow();
            $kode = intval($data->nip) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "NIP" . date("dmy") . $batas;
        return $kodetampil;
    }
    public function dataKaryawan()
    {
        return $this->db->table('tbl_karyawan')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_karyawan.id_jabatan', 'LEFT')
            ->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_karyawan.id_lokasi', 'LEFT')
            ->join('tbl_shift', 'tbl_shift.id_shift=tbl_karyawan.id_shift', 'LEFT')
            ->where([
                'id_karyawan' => session()->get('id_karyawan'),
            ])->get();
    }
    public function dataKaryawanku()
    {
        $db = $this->db->table('tbl_karyawan');
        $db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_karyawan.id_jabatan', 'LEFT');
        $db->join('tbl_lokasi', 'tbl_lokasi.id_lokasi=tbl_karyawan.id_lokasi', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_karyawan.id_shift', 'LEFT');
        return $db->get();
    }
    public function dataAdd($data)
    {
        $db = $this->db->table('tbl_karyawan');
        $db->insert($data);
    }
    public function dataEdit($data)
    {
        $this->db->table('tbl_karyawan')->where('id_karyawan', $data['id_karyawan'])->update($data);
    }
    public function del($id)
    {
        return $this->db->table('tbl_karyawan')
            ->where('id_karyawan', $id)
            ->delete();
    }
    public function check_username($code, $id = null)
    {
        $db = $this->db->table('tbl_karyawan');
        $db->where('username', $code);
        if ($id = null) {
            $db->where('id_karyawan !=', $id);
        }
        $query = $db->get();
        return $query;
    }
    public function cek_presensibyID($id = null)
    {
        $db = $this->db->table('tbl_presensi');
        if ($id = null) {
            $db->where('id_karyawan !=', $id);
        }
        $query = $db->get();
        return $query;
    }
    // BLokir
    public function blokir($id)
    {
        $db = $this->db->table('tbl_karyawan');
        $db->set('blokir_karyawan', "1");
        $db->where('id_karyawan', $id);
        $db->update();
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }
    // Unblock
    public function buka_blokir($id)
    {
        $db = $this->db->table('tbl_karyawan');
        $params = [
            'salah_password' => 0,
        ];
        $db->set('blokir_karyawan', "0");
        $db->where('id_karyawan', $id);
        $db->update($params);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }
}
