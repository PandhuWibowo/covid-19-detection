<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilKK extends Model
{
    use HasFactory;

    protected $table = 'detil_kk';
    protected $primaryKey = null;
    public $timestamps = false;
    public $incrementing = false;
    public $fillable = [
        'id_kk', 'nik_keluarga', 'status_keluarga'
    ];
}
