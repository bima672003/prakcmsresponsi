<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiServis extends Model
{
    use HasFactory;

    protected $fillable = ['antrian_servis_id', 'karyawan_id', 'total_biaya', 'metode_pembayaran'];

   public function antrianServis()
{
    return $this->belongsTo(AntrianServis::class);
}

public function karyawan()
{
    return $this->belongsTo(Karyawan::class);
}


}
