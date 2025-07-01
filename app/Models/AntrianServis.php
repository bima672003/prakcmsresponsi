<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianServis extends Model
{
    use HasFactory;

    protected $fillable = ['kendaraan_id', 'pelanggan_id', 'karyawan_id', 'status','waktu_daftar', ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

   public function pekerjaanServis()
{
    return $this->hasMany(PekerjaanServis::class);
}
public function antrianServis()
{
    return $this->belongsTo(AntrianServis::class);
}


    public function transaksiServis()
    {
        return $this->hasOne(TransaksiServis::class);
    }
}