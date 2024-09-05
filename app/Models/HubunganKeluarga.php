<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganKeluarga extends Model
{
    use HasFactory;
    protected $fillable = ['hubungan'];

    public function warga() {
        return $this->hasMany(Warga::class, 'hubungan_keluarga_id');
    }
}
