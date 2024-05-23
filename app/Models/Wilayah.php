<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    protected $fillable = [
        "wilayah",
        "foto_wilayah",
        "luas_lahan",
        "topografi",
        "tipe_tanah",
        "kondisi_iklim",
        "kesuburan_tanah",
        "drainase",
        "rekomendasi_tanaman"
    ];
}
