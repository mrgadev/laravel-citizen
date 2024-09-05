<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IuranIpl extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'warga_id',
        'nama_tagihan',
        'bulan',
        'tahun',
        'jumlah_tagihan',
        'metode_pembayaran',
        'link_pembayaran',
        'tgl_pembayaran',
        'status',
        'invoice'
    ];
    public function warga() {
        return $this->belongsTo(Warga::class);
    }
}
