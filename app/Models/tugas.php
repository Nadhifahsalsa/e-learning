<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = ['id_siswa', 'id_dosen', 'nama_tugas', 'deskripsi', 'deadline'];
}
