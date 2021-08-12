<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        if( Auth::user()->tipe == 1 ){
        $suratmasuk = SuratMasuk::all();
        if (Request()->ajax()) {
            return DataTables::of($suratmasuk)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('suratmasuk.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="'.asset($row->file_masuk).'" title="Unduh" class="edit btn btn-warning btn-sm"><i class="fas fa-download"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Hapus" class="btn btn-danger btn-sm" onclick="hapus('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.surat_masuk.index');
    }
        else {
            return view('backend.error');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Auth::user()->tipe == 1 ){
        $klasifikasi = Klasifikasi::all();
        return view('backend.surat_masuk.create' , compact('klasifikasi'));
        }
        else {
            return view('backend.error');
        }
    }

    public function store(Request $request)
    {
        if( Auth::user()->tipe == 1 ){
        $this->validate($request,[
            'file_masuk' => 'required|max:2048'
        ]);

        $file_masuk = $request->file_masuk;
        $new_file = time(). $file_masuk->getClientOriginalName();

        SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'asal_surat' => $request->asal_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_surat' => $request->tgl_surat,
            'tgl_terima' => $request->tgl_catat,
            'file_masuk' => 'uploads/suratmasuk/' .$new_file,
            'keterangan' => $request->keterangan
        ]);

        $file_masuk->move('uploads/suratmasuk/', $new_file);

        echo json_encode(["status" => TRUE]);
    }else {
        return view('backend.error');
    }
    }

    public function edit($id)
    {
        if( Auth::user()->tipe == 1 ){
        $klasifikasi = Klasifikasi::all();
        $suratmasuk = SuratMasuk::findorfail($id);
        return view('backend.surat_masuk.edit', compact('suratmasuk','klasifikasi'));
        }
        else {
            return view('backend.error');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'filemasuk' => 'mimes:png,jpg,docx,pdf'
        ]);


        if ($request->has('filemasuk')) {
            $file = $request->filemasuk;
            $new_file = Str::random(16) .$file->getClientOriginalName();
            $file->move('uploads/suratmasuk/', $new_file);
            $suratmasuk = SuratMasuk::findorfail($id);

            if ($suratmasuk->file_masuk != '') {
                unlink($suratmasuk->file_masuk);
            }

            $file_data['file_masuk'] = 'uploads/suratmasuk/'. $new_file;
            SuratMasuk::whereId($id)->update($file_data);
            echo json_encode(["status" => TRUE]);

        }

    }

    public function destroy($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        unlink($suratmasuk->file_masuk);
        $suratmasuk->delete();

        echo json_encode(["status" => TRUE]);
    }

    //  agenda surat masuk
    public function agenda(){
        if( Auth::user()->tipe == 1 ){
        $suratmasuk = SuratMasuk::all();
        return view('backend.surat_masuk.agenda', compact('suratmasuk'));
        }
        else {
            return view('backend.error');
        }
    }

    // cetak agenda berbentuk pdf
    public function agendamasuk_pdf(){
        $inst = Instansi::first();
        $suratmasuk = SuratMasuk::all();
        $pdf = PDF::loadview('backend.surat_masuk.printagenda', compact('suratmasuk','inst'))->setPaper('A4','potrait');
        return $pdf->stream( "agenda-suratmasuk.pdf", array("Attachment" => false));
        exit(0);

    }
}
