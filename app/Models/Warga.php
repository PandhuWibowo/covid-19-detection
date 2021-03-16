<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'citizens';
    protected $primaryKey = 'nik';
    public $timestamps = false;
    public $fillable = [
        'nik', 'id_user', 'nama', 'alamat', 'no_telp', 'pendidikan', 'pekerjaan', 'status_pernikahan', 'tgl_lahir'
    ];
}
