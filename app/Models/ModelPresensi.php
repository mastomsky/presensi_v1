<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPresensi extends Model
{

    var $column_order = array(null, 'nama_karyawan', 'nama_shift', 'tgl_presensi', 'start_in', 'end_out', 'jam_in', 'jam_out', 'foto_in', 'foto_out'); //set column field database for datatable orderable
    var $column_search = array('nama_karyawan'); //set column field database for datatable searchable
    var $order = array('id_presensi' => 'desc'); // default order 

    private function _get_datatables_query($db)
    {

        $db->select('tbl_presensi.*, start_in,end_out,nama_karyawan,nama_shift');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        $i = 0;
        foreach ($this->column_search as $blog) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $db->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $db->like($blog, $_POST['search']['value']);
                } else {
                    $db->orLike($blog, $_POST['search']['value']);
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
        $db = $this->db->table('tbl_presensi');
        $this->_get_datatables_query($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $db = $this->db->table('tbl_presensi');

        $this->_get_datatables_query($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    private function _get_datatables_query_harian($db)
    {
        $tgl_presensi = date('Y-m-d');
        $db->select('tbl_presensi.*, start_in,end_out,nama_karyawan,nama_shift');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        $db->where('tgl_presensi', $tgl_presensi);
        $i = 0;
        foreach ($this->column_search as $blog) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $db->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $db->like($blog, $_POST['search']['value']);
                } else {
                    $db->orLike($blog, $_POST['search']['value']);
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
    function get_datatables_harian()
    {
        $db = $this->db->table('tbl_presensi');
        $this->_get_datatables_query_harian($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered_harian()
    {
        $db = $this->db->table('tbl_presensi');

        $this->_get_datatables_query_harian($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    private function _get_datatables_query_byId($db)
    {
        $db->select('tbl_presensi.*, start_in,end_out,nama_karyawan,nama_shift');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        $db->where('tbl_presensi.id_karyawan', session()->get('id_karyawan'));
        $i = 0;
        foreach ($this->column_search as $blog) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $db->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $db->like($blog, $_POST['search']['value']);
                } else {
                    $db->orLike($blog, $_POST['search']['value']);
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
    function get_datatables_byId()
    {
        $db = $this->db->table('tbl_presensi');
        $this->_get_datatables_query_byId($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered_byId()
    {
        $db = $this->db->table('tbl_presensi');

        $this->_get_datatables_query_byId($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    function count_all()
    {
        $db = $this->db->table('tbl_presensi');
        return $db->countAllResults();
    }
    function count_all_hadir()
    {
        $db = $this->db->table('tbl_presensi');
        $db->where('id_karyawan', session()->get('id_karyawan'));
        return $db->countAllResults();
    }
    public function count_all_terlambat()
    {
        $db = $this->db->table('tbl_presensi');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        $db->where('id_karyawan', session()->get('id_karyawan'));
        $db->where('tgl_presensi >=', 'start_in');
        return $db->countAllResults();
    }
    public function cekPresensi()
    {
        return $this->db->table('tbl_presensi')
            ->where('id_karyawan', session()->get('id_karyawan'))
            ->where('tgl_presensi', date('Y:m:d'))
            ->get()->getRowArray();
    }

    public function dataPresensi()
    {
        $db = $this->db->table('tbl_presensi');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        return $db->get();
    }
    public function dataPresensiHarian()
    {
        $date = date('Y-m-d');
        $db = $this->db->table('tbl_presensi');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->where('tgl_presensi', $date);
        return $db->get();
    }
    public function insertPresensiIn($data)
    {
        $this->db->table('tbl_presensi')->insert($data);
    }
    public function insertPresensiOut($data)
    {
        $this->db->table('tbl_presensi')
            ->where('id_presensi', $data['id_presensi'])
            ->update($data);
    }

    public function cetakPeriode($id_karyawan = null, $tgl_mulai, $tgl_selesai)
    {
        $db = $this->db->table('tbl_presensi');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        $db->where('tgl_presensi >=', $tgl_mulai);
        $db->where('tgl_presensi <=', $tgl_selesai);
        if ($id_karyawan = null) {
            $db->where('tbl_presensi.id_karyawan !=', $id_karyawan);
        }
        return $db->get();
    }
    public function detail_presensi($id)
    {
        $db = $this->db->table('tbl_presensi');
        $db->select('tbl_presensi.*, ,start_in,end_out,nama_karyawan,nama_shift,foto_karyawan');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT');
        $db->join('tbl_shift', 'tbl_shift.id_shift=tbl_presensi.id_shift', 'LEFT');
        if ($id != null) {
            $db->where('id_presensi', $id);
        }
        $query = $db->get();
        return $query;
    }
}
