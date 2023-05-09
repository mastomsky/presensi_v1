<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pengaturan extends BaseController
{
    public function profile()
    {
        $data = [
            'judul' => 'Profile Website',
            'menu' => 'profile-website',
            'page' => 'backend/profile_website/v_profile',

        ];
        return view('v_template_back', $data);
    }
    public function gambar_slide()
    {
        $data = [
            'judul' => 'Gambar Slide',
            'menu' => 'gambar-slide',
            'page' => 'backend/profile_website/v_carousel',

        ];
        return view('v_template_back', $data);
    }
    public function gambar_add()
    {
        $gambar  = new \stdClass();
        $gambar->judul_gambar = null;
        $gambar->gambar = null;
        $data = [
            'judul' => 'Gambar Slide ',
            'menu' => 'gambar-slide',
            'form' => 'add',
            'page' => 'backend/profile_website/form_carousel',
            'row' => $gambar

        ];
        return view('v_template_back', $data);
    }
    public function testimoni()
    {
        $data = [
            'judul' => 'Testimoni',
            'menu' => 'testimoni',
            'page' => 'backend/profile_website/v_testimoni',

        ];
        return view('v_template_back', $data);
    }
    public function testimoni_add()
    {
        $testimoni  = new \stdClass();
        $testimoni->nama = null;
        $testimoni->keterangan = null;
        $testimoni->foto_testimoni = null;
        $data = [
            'judul' => 'Testimoni',
            'menu' => 'testimoni',
            'form' => 'add',
            'page' => 'backend/profile_website/form_testimoni',
            'row' => $testimoni

        ];
        return view('v_template_back', $data);
    }
}
