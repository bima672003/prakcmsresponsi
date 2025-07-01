<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'no_telepon'];

    public function antrianServis()
    {
        return $this->hasMany(AntrianServis::class);
    }

    public function transaksiServis()
    {
        return $this->hasMany(TransaksiServis::class);
    }
}