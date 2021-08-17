<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KlasifikasiImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{

    public function index()
    {
        if( Auth::user()->tipe == 1 ){
        $klasifikasi = Klasifikasi::all();
        if (Request()->ajax()) {
            return DataTables::of($klasifikasi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  onClick="get(' . $row->id . ')" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.klasifikasi.index');
    }
    return view('backend.error');
}



    public function store(Request $request)
    {
        Klasifikasi::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->nama,
                'kode' => $request->kode,
                'uraian' => $request->uraian,
            ],
        );

        echo json_encode(["status" => TRUE]);

}

    public function edit($id)
    {
        if( Auth::user()->tipe == 1 ){
        $klasifikasi = Klasifikasi::find($id);
        return response()->json($klasifikasi);
        }
        else {
            return view('backend.error');
        }
    }



    public function destroy($id)
    {
      $klasifikasi =  Klasifikasi::findOrFail($id)->delete();
        // unlink('uploads/klasifikasi_file/'.$klasifikasi->);
        echo json_encode(["status" => TRUE]);
    }


    //function untuk import excel
    public function import(Request $request){
       // validasi
		$this->validate($request, [
			'klasifikasi' => 'required|mimes:csv,xls,xlsx'
		]);
		$file = $request->file('klasifikasi');
		$nama_file = rand().$file->getClientOriginalName();
		$file->move('klasifikasi_file',$nama_file);
		Excel::import(new KlasifikasiImport, public_path('/klasifikasi_file/'.$nama_file));
        return redirect()->back()->with('sukses', 'Import Data Berhasil');
		return view('klasifikasi.index');

    }
}
