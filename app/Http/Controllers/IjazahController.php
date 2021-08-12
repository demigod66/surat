<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Ijazah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IjazahController extends Controller
{

    public function index()
    {
        if( Auth::user()->tipe == 1 ){
            $ijazah = Ijazah::all();
            if (Request()->ajax()) {
                return DataTables::of($ijazah)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $btn =  '<a href="'.route('ijazah.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . ' <a href="'.asset($row->file).'" title="Unduh" class="edit btn btn-warning btn-sm"><i class="fas fa-download"></i></a> ';

                        $btn = $btn . '<a href="javascript:void(0)" title="Hapus" class="btn btn-danger btn-sm" onclick="hapus('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('backend.ijazah.index');
            }

            else {
                return view('backend.error');
            }
    }

    public function create()
    {
        if( Auth::user()->tipe == 1 ){

            return view('backend.ijazah.create');
            }
            else {
                return view('backend.error');
            }
    }


    public function store(Request $request)
    {

            $this->validate($request, [
                'filekeluar' => 'mimes:pdf',
                // 'no_ijazah' => 'min:17|max:17|unique:ijazah,no_ijazah',
                // 'nisn' => 'min:10|max:10|unique:ijazah,nisn'
            ]);

            $filekeluar = $request->filekeluar;
            $new_file = time(). $filekeluar->getClientOriginalName();

            Ijazah::create([
                'nama_siswa' => $request->nama_siswa,
                'jurusan' => $request->jurusan,
                'no_ijazah' => $request->no_ijazah,
                'nisn' => $request->nisn,
                'tgl_lulus' => $request->tgl_lulus,
                'file' => 'uploads/ijazah/' .$new_file
            ]);

            $filekeluar->move('uploads/ijazah/', $new_file);

            echo json_encode(["status" => TRUE]);

    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        if( Auth::user()->tipe == 1 ){
            $ijazah = Ijazah::findorfail($id);
            return view('backend.ijazah.edit', compact('ijazah'));
            }
            else {
                return view('backend.error');
            }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'filekeluar' => 'mimes:pdf',
            // 'no_ijazah' => 'min:17|max:17|unique:ijazah,no_ijazah',
            // 'nisn' => 'min:10|max:10|unique:ijazah,nisn'
        ]);


        if( Auth::user()->tipe == 1 ){
            $request->validate([
                'filekeluar' => 'mimes:pdf'
            ]);


            if ($request->has('filekeluar')) {
                $filekeluar = $request->filekeluar;
                $new_file = Str::random(16) .$filekeluar->getClientOriginalName();
                $filekeluar->move('uploads/ijazah/', $new_file);
                $ijazah = Ijazah::findorfail($id);

                if ($ijazah->file != '') {
                    unlink($ijazah->file);
                }

                $file_data['file'] = 'uploads/ijazah/'. $new_file;
                Ijazah::whereId($id)->update($file_data);
                echo json_encode(["status" => TRUE]);

            }
        }
        else {
            return view('backend.error');
        }
    }


    public function destroy($id)
    {
        $ijazah = Ijazah::findOrFail($id);
        unlink($ijazah->file);
        $ijazah->delete();

        echo json_encode(["status" => TRUE]);
    }
}
