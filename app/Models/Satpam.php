<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satpam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'nip',
        'tgl_lahir'
    ];

    // buat relasi ke data user
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jadwal() {
        return $this->hasMany(JadwalSatpam::class);
    }

    public function laporan() {
        return $this->hasMany(LaporanKeamanan::class);
    }
}
