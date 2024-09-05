<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeamanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function satpam() {
        return $this->belongsTo(Satpam::class);
    }
}
