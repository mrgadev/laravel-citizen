<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nomor_kk', 
        'alamat', 
        'telepon',
        'hunian_id',
        'tgl_mulai',
        'tgl_akhir',
        'status'
    ];

    public function wargas() {
        // membuat relasi ke data warga
        // satu keluarga has banyak warga
        return $this->hasMany(Warga::class);
    }

    public function hunian() {
        // membuat relasi ke data hunian
        // satu keluarga bisa terdapat satu hunian
        return $this->belongsTo(Hunian::class);
    }
}
