<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KartuKeluarga;
use App\Models\DetilKK;
class Warga extends Model
{
    use HasFactory;

    protected $table = 'citizens';
    protected $primaryKey = 'nik';
    public $timestamps = false;
    public $fillable = [
        'nik', 'id_user', 'nama', 'alamat', 'no_telp', 'pendidikan', 'pekerjaan', 'status_pernikahan', 'tgl_lahir'
    ];

    public function kartuKeluarga()
    {
        return $this->belongsToMany(KartuKeluarga::class, 'detil_kk');
    }

    public function detil_kk() {
        return $this->hasMany(DetilKK::class, 'nik_keluarga', 'nik');
    }
}
