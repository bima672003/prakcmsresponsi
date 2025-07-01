<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanServis extends Model
{
    use HasFactory;

    protected $fillable = ['antrian_servis_id', 'deskripsi', 'biaya'];

    public function antrianServis()
    {
        return $this->belongsTo(AntrianServis::class);
    }
}
