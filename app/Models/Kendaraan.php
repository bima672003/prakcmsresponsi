<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'merek', 'nomor_plat', 'tahun_pembuatan'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function antrianServis()
    {
        return $this->hasMany(AntrianServis::class);
    }
}
