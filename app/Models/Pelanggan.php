<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'no_telepon'];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function antrianServis()
    {
        return $this->hasMany(AntrianServis::class);
    }
}