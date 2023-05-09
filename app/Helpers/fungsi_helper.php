<?php

function tgl_indo($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date('H:i:s', strtotime($waktu));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
}
// selisih waktu 
function dateDiff($date)
{
    $mydate = date("Y-m-d H:i:s");
    $theDiff = "";
    //echo $mydate;//2014-06-06 21:35:55
    $datetime1 = date_create($date);
    $datetime2 = date_create($mydate);
    $interval = date_diff($datetime1, $datetime2);
    //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
    $min = $interval->format('%i');
    $sec = $interval->format('%s');
    $hour = $interval->format('%h');
    $mon = $interval->format('%m');
    $day = $interval->format('%d');
    $year = $interval->format('%y');
    if ($interval->format('%i%h%d%m%y') == "00000") {
        //echo $interval->format('%i%h%d%m%y')."<br>";
        return $sec . " Detik yang lalu";
    } else if ($interval->format('%h%d%m%y') == "0000") {
        return $min . " Menit yang lalu";
    } else if ($interval->format('%d%m%y') == "000") {
        return $hour . " Jam yang lalu";
    } else if ($interval->format('%m%y') == "00") {
        return $day . " Hari";
    } else if ($interval->format('%y') == "0") {
        return $mon . " Bulan";
    } else {
        return $year . " Tahun";
    }
}
function jam_in($start_in, $jam_in)
{
    if (strtotime($start_in) < strtotime($jam_in)) {
        return  "<span class='badge badge-danger'>Terlambat</span> <br>" . menit($start_in, $jam_in);
    } elseif (strtotime($start_in) > strtotime($jam_in)) {
        return "<span class='badge badge-success'>ON Time</span>";
    } else {
        return '';
    }
}
function menit($awal, $akhir)
{
    $awal = strtotime($awal);
    $akhir = strtotime($akhir);
    $diff  = $akhir - $awal;
    $jam   = floor($diff / (60 * 60));
    $menit = $diff - ($jam * (60 * 60));
    $detik = $diff % 60;
    return  $jam .  ' jam, ' . floor($menit / 60) . ' menit, ' . $detik . ' detik';
}
// nomer indo
function telp_indo($no)
{
    if (!preg_match('/[^+0-9]/', trim($no))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($no), 0, 3) == '+62') {
            $hp = trim($no);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($no), 0, 1) == '0') {
            $hp = '+62' . substr(trim($no), 1);
        } else {
            $hp = '00000';
        }
    }
    return $hp;
}
