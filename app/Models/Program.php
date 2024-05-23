<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'waktu_pelaksanaan',
        'tempat_pelaksanaan',
        'kuota',
        'informasi_program',
        'foto_program',
    ];

    public function members()
    {
        return $this->hasMany(ProgramMember::class);
    }
}
