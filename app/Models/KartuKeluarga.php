<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga';
    protected $primaryKey = 'id_kk';
    public $timestamps = false;
    public $incrementing = false;
    public $fillable = [
        'id_user', 'id_kk', 'nik_kepala_keluarga', 'status_tempat_tinggal'
    ];
}
