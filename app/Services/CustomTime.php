<?php
namespace App\Services;
class CustomTime
{
    public static function FormatDate($date)
    {
        $tanggal = explode(' ', date('D, d M Y', strtotime($date)));
        switch ($tanggal[0]) {
            case 'Sun,':
                $tanggal[0] = 'Minggu,';
                break;
            case 'Mon,':
                $tanggal[0] = 'Senin,';
                break;
            case 'Tue,':
                $tanggal[0] = 'Selasa,';
                break;
            case 'Wed,':
                $tanggal[0] = 'Rabu,';
                break;
            case 'Thu,':
                $tanggal[0] = 'Kamis,';
                break;
            case 'Fri,':
                $tanggal[0] = 'Jumat,';
                break;
            case 'Sat,':
                $tanggal[0] = 'Sabtu,';
                break;
        }
        switch ($tanggal[2]) {
            case 'Jan':
                $tanggal[2] = 'Januari';
                break;
            case 'Feb':
                $tanggal[2] = 'Februari';
                break;
            case 'Mar':
                $tanggal[2] = 'Maret';
                break;
            case 'Apr':
                $tanggal[2] = 'April';
                break;
            case 'May':
                $tanggal[2] = 'Mei';
                break;
            case 'Jun':
                $tanggal[2] = 'Juni';
                break;
            case 'Jul':
                $tanggal[2] = 'Juli';
                break;
            case 'Aug':
                $tanggal[2] = 'Agustus';
                break;
            case 'Sep':
                $tanggal[2] = 'September';
                break;
            case 'Oct':
                $tanggal[2] = 'Oktober';
                break;
            case 'Nov':
                $tanggal[2] = 'November';
                break;
            case 'Dec':
                $tanggal[2] = 'Desember';
                break;
        }
        return implode(' ', $tanggal);
    }
}
