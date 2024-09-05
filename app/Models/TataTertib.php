<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TataTertib extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'judul',
        'isi',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
