<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Klasifikasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PDF;


use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{

    public function index()
    {
        if( Auth::user()->tipe == 1 ){
        $suratkeluar = SuratKeluar::all();
        if (Request()->ajax()) {
            return DataTables::of($suratkeluar)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('suratkeluar.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="'.asset($row->filekeluar).'" title="Unduh" class="edit btn btn-warning btn-sm"><i class="fas fa-download"></i></a> ';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Hapus" class="btn btn-danger btn-sm" onclick="hapus('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.surat_keluar.index');
        }

        else {
            return view('backend.error');
        }
    }


    public function create()
    {
        if( Auth::user()->tipe == 1 ){
        $klasifikasi = Klasifikasi::all();
        return view('backend.surat_keluar.create', compact('klasifikasi'));
        }
        else {
            return view('backend.error');
        }
    }


    public function store(Request $request)
    {
        if( Auth::user()->tipe == 1 ){
        $this->validate($request, [
            'filekeluar' => 'mimes:png,jpg,jpeg,png,pdf,docx,doc'
        ]);

        $filekeluar = $request->filekeluar;
        $new_file = time(). $filekeluar->getClientOriginalName();

        SuratKeluar::create([
            'no_surat' => $request->no_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_surat' => $request->tgl_surat,
            'tgl_catat' => $request->tgl_catat,
            'keterangan' => $request->keterangan,
            'filekeluar' => 'uploads/suratkeluar/' .$new_file
        ]);

        $filekeluar->move('uploads/suratkeluar/', $new_file);

        echo json_encode(["status" => TRUE]);
        }
        else {
            return view('backend.error');
        }
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        if( Auth::user()->tipe == 1 ){
        $suratkeluar = SuratKeluar::findorfail($id);
        $klasifikasi = Klasifikasi::all();
        return view('backend.surat_keluar.edit', compact('suratkeluar','klasifikasi'));
        }
        else {
            return view('backend.error');
        }
    }


    public function update(Request $request, $id)
    {
        if( Auth::user()->tipe == 1 ){
        $request->validate([
            'filekeluar' => 'mimes:png,jpg,docx,pdf'
        ]);


        if ($request->has('filekeluar')) {
            $file = $request->filekeluar;
            $new_file = Str::random(16) .$file->getClientOriginalName();
            $file->move('uploads/suratkeluar/', $new_file);
            $suratmasuk = SuratKeluar::findorfail($id);

            if ($suratmasuk->file_masuk != '') {
                unlink($suratmasuk->file_masuk);
            }

            $file_data['filekeluar'] = 'uploads/suratkeluar/'. $new_file;
            SuratKeluar::whereId($id)->update($file_data);
            echo json_encode(["status" => TRUE]);

        }
    }
    else {
        return view('backend.error');
    }

    }


    public function destroy($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        unlink($suratkeluar->filekeluar);
        $suratkeluar->delete();

        echo json_encode(["status" => TRUE]);
    }



    public function agenda(){
        if( Auth::user()->tipe == 1 ){
        $suratkeluar = SuratKeluar::all();
        return view('backend.surat_keluar.agenda', compact('suratkeluar'));
        }
        else {
            return view('backend.error');
        }
    }


    public function agendakeluar_pdf(){
        if( Auth::user()->tipe == 1 ){
        $inst = Instansi::first();
        $suratkeluar = SuratKeluar::all();
        $pdf = PDF::loadview('backend.surat_keluar.printagenda', compact('suratkeluar','inst'))->setPaper('A4','potrait');
        return $pdf->stream( "agenda-suratmasuk.pdf", array("Attachment" => false));
        exit(0);
    }
    else {
        return view('backend.error');
    }
}
}
