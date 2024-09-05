<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hunian extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama',
        'tipe',
        'luas',
        'km',
        'kt',
        'alamat',
        'deskripsi',
        'foto',
    ];

    public function riwayat_hunians() {
        // membuat relasi ke data hunian
        // satu hunian bisa terdapat banyak warga
        return $this->hasMany(RiwayatHunian::class);
    }

    public function keluarga() {
        // membuat relasi ke data keluarga
        // satu hunian bisa terdapat satu keluarga
        return $this->hasMany(Keluarga::class);
    }
}
