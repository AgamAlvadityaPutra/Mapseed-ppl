<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benih extends Model
{
    use HasFactory;
    protected $table = "benih";
    protected $fillable = [
        "foto_produk", 
        "nama_produk", 
        "nama_varietas", 
        "deskripsi", 
        "berat_produk", 
        "nomor_sertifikasi", 
        "masa_berlaku_produk", 
        "informasi_musim_tanam",
        "mitra_id"];
}
