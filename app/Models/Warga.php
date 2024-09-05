<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{

    use HasFactory, SoftDeletes;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'keluarga_id',
        'hubungan_keluarga_id',
        'kota_id',

        'nama',
        'nik',
        'alamat',
        'telepon',
        'email',
        'gender',
        'status_kawin',
        'agama',
        'pekerjaan',
        'foto',
        'foto_ktp',
        'tgl_lahir',
        'verified_status'
    ];
    // protected $guarded = ['id'];

    // buat relasi inverse (kebalikan/belongsto) ke tabel keluargas
    public function keluarga() {
        // Banyak warga dimiliki oleh satu keluarga
        return $this->belongsTo(Keluarga::class);
    }

    public function hubungan_keluarga() {
        // membuat relasi ke data hubungan_keluarga
        // satu warga has one hubungan_keluarga
        return $this->belongsTo(HubunganKeluarga::class, 'hubungan_keluarga_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function riwayat_hunians() {
        // membuat relasi ke data riwayat_hunians
        // satu warga has banyak riwayat_hunians
        return $this->hasMany(RiwayatHunian::class);
    }

    public function kepengurusan() {
        return $this->hasMany(PengurusPaguyuban::class);
    }

    public function namaKota() {

        return $this->belongsTo(NamaKota::class, 'kota_id');
    }

    public function ipl() {
        return $this->hasMany(IuranIpl::class);
    }
}

