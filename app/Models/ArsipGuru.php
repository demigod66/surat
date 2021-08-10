<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipGuru extends Model
{
    use HasFactory;
    protected $table = 'arsip_guru';
    protected $fillable = ['id_user', 'nama_file'];
}
