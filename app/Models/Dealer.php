<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
    protected $fillable = [
        "credential_id", "nama_dealer", "telepon_dealer", "email_dealer", "alamat_dealer", "surat_izin_distribusi", "foto_ktp", "riwayat_kerjasama", "pas_foto_dealer", "informasi_dealer"
    ];
}
