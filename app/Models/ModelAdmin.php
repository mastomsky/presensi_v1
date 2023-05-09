<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function dataSetting()
    {
        $builder = $this->db->table('tbl_setting');
        $query   = $builder->getWhere(['id_setting' => 1])->getRowArray();
        return $query;

    }
}