<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    protected $table = 'ijazah';
    protected $fillable = [
        'nama_siswa','jurusan','no_ijazah','nisn','tgl_lulus','file'
    ];
}
