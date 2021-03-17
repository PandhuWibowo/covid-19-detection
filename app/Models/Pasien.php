<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KartuKeluarga;
use App\Models\Warga;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'data_covid';
    protected $primaryKey = 'id_pendataan';
    public $timestamps = false;
    public $fillable = [
        'id_pendataan', 'id_user', 'nik', 'tgl_pendataan', 'tgl_terinfeksi', 'status_virus', 'status_penanganan', 'tgl_sembuh', 'id_kk'
    ];

    public function kartuKeluarga() {
        return $this->belongsTo(KartuKeluarga::class, 'id_kk');
    }

    public function warga() {
        return $this->belongsTo(Warga::class, 'nik');
    }
}
