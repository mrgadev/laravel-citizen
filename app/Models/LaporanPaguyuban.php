<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPaguyuban extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'paguyuban_id',
        'judul',
        'laporan_umum',
        'hasil_kegiatan',
        'evaluasi'
    ];

    public function paguyuban() {
        // membuat relasi ke data paguyuban
        // satu laporan has one paguyuban
        return $this->belongsTo(Paguyuban::class);
    }
}
