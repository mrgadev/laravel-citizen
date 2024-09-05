<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSatpam extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'satpam_id',
        'absensi'
    ];
    public function satpam() {
        return $this->belongsTo(Satpam::class);
    }
}
