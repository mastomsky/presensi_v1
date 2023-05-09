<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCuti extends Model
{
    var $column_order = array(
        null, 'nama_karyawan', 'created_at', 'keterangan', 'tgl_mulai', 'tgl_selesai', 'mulai_kerja', 'berkas', 'nama_user', 'diketahui'
    ); //set column field database for datatable orderable
    var $column_search = array('nama_karyawan', 'created_at', 'status_cuti'); //set column field database for datatable searchable
    var $order = array('id_cuti' => 'desc'); // default order 

    private function _get_datatables_query($db)
    {
        $db->select('id_cuti, nama_karyawan, tbl_cuti.created_at, keterangan, tgl_mulai, tgl_selesai, mulai_kerja, berkas, nama_user,status_cuti,diketahui');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_cuti.id_karyawan', 'LEFT');
        $db->join('tbl_user', 'tbl_user.id_user = tbl_cuti.diketahui', 'LEFT');
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
        $db = $this->db->table('tbl_cuti');
        $this->_get_datatables_query($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $db = $this->db->table('tbl_cuti');
        $this->_get_datatables_query($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    private function _get_datatables_query_berkas($db)
    {
        $db->select('tbl_cuti.*,nama_user,nama_karyawan');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_cuti.id_karyawan', 'LEFT');
        $db->join('tbl_user', 'tbl_user.id_user = tbl_cuti.diketahui', 'LEFT');
        $db->like('tbl_cuti.id_karyawan', session()->get('id_karyawan'));
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
    function get_datatables_berkas_ById()
    {
        $db = $this->db->table('tbl_cuti');

        $this->_get_datatables_query_berkas($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered_berkas()
    {
        $db = $this->db->table('tbl_cuti');
        $this->_get_datatables_query_berkas($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    function count_all()
    {

        $db = $this->db->table('tbl_cuti');
        return $db->countAllResults();
    }
    function count_all_izin()
    {

        $db = $this->db->table('tbl_cuti');
        $db->where('id_karyawan', session()->get('id_karyawan'));
        $db->where('status_cuti', 1);
        $db->like('keperluan', 1);
        return $db->countAllResults();
    }
    function count_all_sakit()
    {

        $db = $this->db->table('tbl_cuti');
        $db->where('id_karyawan', session()->get('id_karyawan'));
        $db->where('status_cuti', 1);
        $db->like('keperluan', 2);
        return $db->countAllResults();
    }

    public function get($id = null)
    {
        $db = $this->db->table('tbl_cuti');

        if ($id != null) {
            $db->where('id_cuti', $id);
        }
        $query = $db->get();
        return $query;
    }
    public function getJoin()
    {
        $db = $this->db->table('tbl_cuti');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_cuti.id_karyawan', 'LEFT');
        $db->where('tbl_cuti.id_karyawan', session()->get('id_karyawan'));
        return $db->get();
    }
    public function getbyID($id)
    {
        $db = $this->db->table('tbl_cuti');
        $db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_cuti.id_karyawan', 'LEFT');
        $db->where('id_cuti', $id);
        $db->orWhere('tbl_cuti.id_karyawan', $id);
        return $db->get();
    }
    public function dataAdd($data)
    {
        return $this->db->table('tbl_cuti')->insert($data);
    }
    public function dataEdit($data)
    {
        return $this->db->table('tbl_cuti')->where('id_cuti', $data['id_cuti'])->update($data);
    }
    public function del($id)
    {
        return $this->db->table('tbl_cuti')
            ->where('id_cuti', $id)
            ->delete();
    }

    public function check_status_cuti($code, $id = null)
    {
        $db = $this->db->table('tbl_cuti');
        $db->where('status_cuti', $code);
        if ($id = null) {
            $db->where('tbl_cuti.id_karyawan !=', $id);
        }
        $query = $db->get();
        return $query;
    }
    // Publish
    public function setuju($id)
    {
        $db = $this->db->table('tbl_cuti');
        $params = [
            'updated_at' => date("Y-m-d"),
            'diketahui' => session()->get('id_user')
        ];
        $db->set('status_cuti', 1);
        $db->where('id_cuti', $id);
        $db->update($params);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }
    // Draft
    public function tolak($id)
    {
        $db = $this->db->table('tbl_cuti');
        $params = [
            'updated_at' => date("Y-m-d"),
            'diketahui' => session()->get('id_user')
        ];
        $db->set('status_cuti', 2);
        $db->where('id_cuti', $id);
        $db->update($params);
        if ($this->db->affectedRows() > 0) {
            return true;
        }
    }
}
