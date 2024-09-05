<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatHunian extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'warga_id',
        'hunian_id',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
    ];

    public function warga() {
        return $this->belongsTo(Warga::class);
    }

    public function hunian() {
        return $this->belongsTo(Hunian::class);
    }
}
