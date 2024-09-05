<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengurusPaguyuban extends Model
{
use HasFactory;
    protected $fillable = [
        'warga_id',
        'paguyuban_id',
        'posisi'
    ];

    public function warga() {
        return $this->belongsTo(Warga::class);
    }

    public function paguyuban() {
        return $this->belongsTo(Paguyuban::class);
    }
}
