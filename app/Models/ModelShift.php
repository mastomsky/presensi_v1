<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelShift extends Model
{
    var $column_order = array(
        null, 'id_shift', 'nama_shift','start_in','end_out'
    ); //set column field database for datatable orderable
    var $column_search = array('nama_shift'); //set column field database for datatable searchable
    var $order = array('id_shift' => 'desc'); // default order 

    private function _get_datatables_query($db)
    {
        $db->select('*');
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
        $db = $this->db->table('tbl_shift');
        $this->_get_datatables_query($db);
        if (@$_POST['length'] != -1)
            $db->limit(@$_POST['length'], @$_POST['start']);
        $query = $db->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $db = $this->db->table('tbl_shift');
        $this->_get_datatables_query($db);
        $query = $db->get();
        return $query->getNumRows();
    }
    function count_all()
    {

        $db = $this->db->table('tbl_shift');
        return $db->countAllResults();
    }
    public function get($id = null)
    {
        $db = $this->db->table('tbl_shift');

        if ($id != null) {
            $db->where('id_shift', $id);
        }
        $query = $db->get();
        return $query;
    }
    public function dataShift()
    {
        return $this->db->table('tbl_shift')->get();
    }
    public function dataAdd($data)
    {
        return $this->db->table('tbl_shift')->insert($data);
    }
    public function dataEdit($data)
    {
        return $this->db->table('tbl_shift')->where('id_shift', $data['id_shift'])->update($data);
    }
    public function del($id)
    {
        return $this->db->table('tbl_shift')
            ->where('id_shift', $id)
            ->delete();
    }
}