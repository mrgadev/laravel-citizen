<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaKota extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];

    public function wargas() {
        return $this->hasMany(Warga::class);
    }
}
