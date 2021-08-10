<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';
    protected $fillable =  ['no_surat','tujuan_surat','isi','kode','tgl_surat','tgl_catat','filekeluar','keterangan'];
}
