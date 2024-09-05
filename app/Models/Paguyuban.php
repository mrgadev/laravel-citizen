<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paguyuban extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat'
    ];

    public function pengurus() {
        return $this->hasOne(PengurusPaguyuban::class);
    }

    public function laporan() {
        return $this->hasMany(LaporanPaguyuban::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }
}
