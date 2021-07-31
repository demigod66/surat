<?php

namespace App\Imports;

use App\Models\Klasifikasi;
use Maatwebsite\Excel\Concerns\ToModel;

class KlasifikasiImport implements ToModel
{
    public function model(array $row)
    {
        return new Klasifikasi([
            'id'    => $row[0],
            'nama'  => $row[1],
            'kode'  => $row[2],
            'uraian'    => $row[3],
        ]);
    }
}
