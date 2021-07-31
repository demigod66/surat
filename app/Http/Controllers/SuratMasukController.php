<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

use Yajra\DataTables\Facades\DataTables;

use PDF;
use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratmasuk = SuratMasuk::all();
        if (Request()->ajax()) {
            return DataTables::of($suratmasuk)
                ->addIndexColumn()
                ->addColumn('filemasuk', function ($suratmasuk) {
                    // return '<p>uploads/suratmasuk/'.$suratmasuk->id.'<p>';
                    return '<a href="'.asset($suratmasuk->file_masuk).'" target="_blank">Aaa</a>';
                })
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('suratmasuk.edit', $row->id).'" title="Edit" class="edit btn btn-primary btn-sm"><i class="ti-pencil-alt"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="ti-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action','filemasuk'])
                ->make(true);
        }
        return view('backend.surat_masuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('backend.surat_masuk.create' , compact('klasifikasi'));
    }

    public function store(Request $request)
    {
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

    }

    public function edit($id)
    {
        $klasifikasi = Klasifikasi::all();
        $suratmasuk = SuratMasuk::findorfail($id);
        return view('backend.surat_masuk.edit', compact('suratmasuk','klasifikasi'));
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            'filemasuk' => 'mimes:png,jpg,docx,pdf'
        ]);

        if ($request->has('filemasuk')) {
            $file_masuk = $request->file_masuk;
            $new_file = time() . $file_masuk->getClientOriginalName();
            $file_masuk->move('uploads/suratmasuk/', $new_file);
            $suratmasuk = SuratMasuk::findorfail($id);

            if ($suratmasuk->file_masuk != '') {
                unlink($suratmasuk->file_masuk);
            }

            $file_data['filemasuk'] = 'uploads/suratmasuk'. $new_file;



            SuratMasuk::whereId($id)->update($file_data);
            echo json_encode(["status" => TRUE]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
