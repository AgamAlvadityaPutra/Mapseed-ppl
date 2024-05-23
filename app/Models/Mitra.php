<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Benih;

class Mitra extends Model
{
    use HasFactory;
    protected $fillable = ["credential_id", "nama_pimpinan_perusahaan", "nama_perusahaan", "telepon_perusahaan", "email_perusahaan", "alamat_perusahaan", "nomor_induk_berusaha", "npwp", "informasi_perusahaan", "akta_perusahaan", "surat_pernyataan_usaha_perseorangan", "surat_izin_usaha_produksi_benih"];
}
