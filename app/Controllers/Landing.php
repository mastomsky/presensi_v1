<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Landing extends BaseController
{
    public function index()
    {
        $data = array(
            'judul' => 'Ini Baru Teh',
        );
        return view('v_template_landing', $data);
    }
}
