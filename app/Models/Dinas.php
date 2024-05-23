<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    use HasFactory;
    protected $fillable = [
        "credential_id", 
        "foto_dinas",
        "nama_dinas",
        "alamat_dinas",
        "email_dinas",
        "telepon_dinas",
        "informasi_dinas"
    ];
    public function credential() {
        return $this->belongsTo(Credential::class);
    }
}
