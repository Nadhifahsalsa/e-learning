<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matkul extends Model
{
    use HasFactory;
    protected $table = 'matkul';
    protected $fillable = [
        'nama_mk','dosen_mk','ruang_mk'
    ];
}
