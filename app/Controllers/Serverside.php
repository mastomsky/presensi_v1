<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLokasi;
use App\Models\ModelCuti;
use App\Models\ModelJabatan;
use App\Models\ModelKaryawan;
use App\Models\ModelPresensi;
use App\Models\ModelShift;
use App\Models\ModelUser;
use App\Libraries\secure;

class Serverside extends BaseController
{
    public function __construct()
    {
        $this->secure = new secure();
        $this->ModelLokasi = new ModelLokasi();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelPresensi = new ModelPresensi();
        $this->ModelCuti = new ModelCuti();
        $this->ModelJabatan = new ModelJabatan();
        $this->ModelShift = new ModelShift();
        $this->ModelUser = new ModelUser();
    }
    function get_berkas_byid()
    {
        $list = $this->ModelCuti->get_datatables_berkas_ById();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cuti) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = tgl_indo($cuti->created_at);
            $row[] = word_limiter($cuti->keterangan, 10);
            $row[] = ($cuti->status_cuti == null ? '<span class="badge badge-warning">Pending</span>' : ($cuti->status_cuti == 0 ? '<span class="badge badge-danger">Di Tolak</span>' : '<span class="badge badge-success">Di Setujui</span>'));
            $row[] = '<a href="' . site_url('karyawan/cuti/edit/' . $this->secure->encrypt_url($cuti->id_cuti)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="' . site_url('karyawan/cuti/del/' . $this->secure->encrypt_url($cuti->id_cuti)) . '" id="btn_hapus" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelCuti->count_all(),
            "recordsFiltered" => $this->ModelCuti->count_filtered_berkas(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_cuti()
    {
        $list = $this->ModelCuti->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cuti) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($cuti->nama_karyawan);
            $row[] = tgl_indo($cuti->created_at);
            $row[] = ($cuti->status_cuti == null ? '<span class="badge badge-warning">Pending</span>' : ($cuti->status_cuti == 2 ? '<span class="badge badge-danger">Di Tolak</span>' : '<span class="badge badge-success">Di Setujui</span>'));
            $row[] = '<a href="' . site_url('panel/cuti/detail_cuti/' . $this->secure->encrypt_url($cuti->id_cuti)) . '" class="btn btn-info btn-sm" ><i class="fa fa-eye mr-1"></i>Lihat</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelCuti->count_all(),
            "recordsFiltered" => $this->ModelCuti->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_presensi()
    {
        $list = $this->ModelPresensi->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $presensi) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($presensi->nama_karyawan);
            $row[] = tgl_indo($presensi->tgl_presensi);
            $row[] = $presensi->foto_in != null ? '<img src="' . base_url('uploads/presensi/' . $presensi->foto_in) . '" class="img" style="width:100px">' : null;

            $t = strtotime($presensi->jam_in);
            $jam_in =  date('H:i a', $t);
            $o = strtotime($presensi->jam_out);
            $jam_out =  date('H:i a', $o);
            $row[] =  $jam_in . '<br>' . jam_in($presensi->start_in, $presensi->jam_in);
            $row[] = $presensi->foto_out != null ? '<img src="' . base_url('uploads/presensi/' . $presensi->foto_out) . '" class="img" style="width:100px">' : null;
            $row[] =  ($presensi->jam_out != null ? $jam_out : '<span class="badge badge-warning">Belum Keluar</span>');
            $row[] = '<a href="' . site_url('panel/absensi/detail/' . $this->secure->encrypt_url($presensi->id_presensi)) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelPresensi->count_all(),
            "recordsFiltered" => $this->ModelPresensi->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_presensi_harian()
    {
        $list = $this->ModelPresensi->get_datatables_harian();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $presensi) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($presensi->nama_karyawan);
            $row[] = tgl_indo($presensi->tgl_presensi);
            $row[] = $presensi->foto_in != null ? '<img src="' . base_url('uploads/presensi/' . $presensi->foto_in) . '" class="img" style="width:100px">' : null;

            $t = strtotime($presensi->jam_in);
            $jam_in =  date('H:i a', $t);
            $o = strtotime($presensi->jam_out);
            $jam_out =  date('H:i a', $o);
            $row[] =  $jam_in . '<br>' . jam_in($presensi->start_in, $presensi->jam_in);
            $row[] = $presensi->foto_out != null ? '<img src="' . base_url('uploads/presensi/' . $presensi->foto_out) . '" class="img" style="width:100px">' : null;
            $row[] =  ($presensi->jam_out != null ? $jam_out : '<span class="badge badge-warning">Belum Keluar</span>');
            $row[] = '<a href="' . site_url('panel/presensi/edit/' . $this->secure->encrypt_url($presensi->id_presensi)) . '" class="btn btn-primary btn-sm" id="btn_hapus"><i class="fa fa-edit"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelPresensi->count_all(),
            "recordsFiltered" => $this->ModelPresensi->count_filtered_harian(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_presensi_byId()
    {
        $list = $this->ModelPresensi->get_datatables_byId();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $presensi) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = tgl_indo($presensi->tgl_presensi);
            $t = strtotime($presensi->jam_in);
            $jam_in =  date('H:i a', $t);
            $o = strtotime($presensi->jam_out);
            $jam_out =  date('H:i a', $o);
            $row[] =  $jam_in . '<br>' . jam_in($presensi->start_in, $presensi->jam_in);
            $row[] =  ($presensi->jam_out != null ? $jam_out : '<span class="badge badge-warning">Belum Keluar</span>');

            $row[] = '<a  class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelPresensi->count_all(),
            "recordsFiltered" => $this->ModelPresensi->count_filtered_byId(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_jabatan()
    {
        $list = $this->ModelJabatan->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $jabatan) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($jabatan->nama_jabatan);
            $row[] = '<a  href="' . site_url('panel/jabatan/edit/' . $this->secure->encrypt_url($jabatan->id_jabatan)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a  href="' . site_url('panel/jabatan/del/' . $this->secure->encrypt_url($jabatan->id_jabatan)) . '" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelJabatan->count_all(),
            "recordsFiltered" => $this->ModelJabatan->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_shift()
    {
        $list = $this->ModelShift->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $shift) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($shift->nama_shift);
            $t = strtotime($shift->start_in);
            $row[] =  date('H:i a', $t);
            $o = strtotime($shift->end_out);
            $row[] =  date('H:i a', $o);
            $row[] = '<a  href="' . site_url('panel/shift/edit/' . $this->secure->encrypt_url($shift->id_shift)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a  href="' . site_url('panel/shift/del/' . $this->secure->encrypt_url($shift->id_shift)) . '" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelShift->count_all(),
            "recordsFiltered" => $this->ModelShift->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_lokasi()
    {
        $list = $this->ModelLokasi->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $lokasi) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($lokasi->nama_lokasi);
            $row[] = ucfirst($lokasi->alamat_lokasi);
            $row[] = $lokasi->lokasi_latlng;
            $row[] = $lokasi->radius_lokasi;

            $row[] = '<a  href="' . site_url('panel/lokasi/edit/' . $this->secure->encrypt_url($lokasi->id_lokasi)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a  href="' . site_url('panel/lokasi/del/' . $this->secure->encrypt_url($lokasi->id_lokasi)) . '" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelLokasi->count_all(),
            "recordsFiltered" => $this->ModelLokasi->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_karyawan()
    {
        $list = $this->ModelKaryawan->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $karyawan) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($karyawan->nip);
            $row[] = $karyawan->telpon;
            $row[] = ucfirst($karyawan->nama_karyawan);
            $row[] = ucfirst($karyawan->nama_lokasi);
            $row[] = ucfirst($karyawan->nama_jabatan);
            $row[] = ucfirst($karyawan->nama_shift);
            $row[] = ($karyawan->status_karyawan == 0 ? '<span class="badge badge-danger">Tidak Aktif</span>' : '<span class="badge badge-success">Aktif</span>');


            $row[] = '<a  href="' . site_url('panel/karyawan/edit/' . $this->secure->encrypt_url($karyawan->id_karyawan)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a  href="' . site_url('panel/karyawan/del/' . $this->secure->encrypt_url($karyawan->id_karyawan)) . '" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelKaryawan->count_all(),
            "recordsFiltered" => $this->ModelKaryawan->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_user()
    {
        $list = $this->ModelUser->get_datatables();

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = ucfirst($user->nama_user);
            $row[] = ucfirst($user->nama_jabatan);
            $row[] = ($user->status_user == 0 ? '<span class="badge badge-danger">Tidak Aktif</span>' : '<span class="badge badge-success">Aktif</span>');

            $row[] = '<a  href="' . site_url('panel/user/edit/' . $this->secure->encrypt_url($user->id_user)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a  href="' . site_url('panel/user/del/' . $this->secure->encrypt_url($user->id_user)) . '" class="btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->ModelUser->count_all(),
            "recordsFiltered" => $this->ModelUser->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
}
