<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';
    protected $fillable = [
        'no_surat',
        'tujuan_surat',
        'asal_surat',
        'isi',
        'kode',
        'tgl_surat',
        'tgl_terima',
        'file_masuk',
        'keterangan'
    ];

}
