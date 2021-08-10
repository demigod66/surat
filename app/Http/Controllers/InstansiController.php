<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Encoder\EncoderInterface;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::all();
        return view('backend.instansi.index', compact('instansi') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.instansi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $filelogo = $request->file;
        $newlogo = time().$filelogo->getClientOriginalName();

        Instansi::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'email' => $request->email,
            'file' => 'uploads/logo/'. $newlogo
        ]);

        $filelogo->move('uploads/logo/' , $newlogo);
        echo json_encode(["status" => TRUE]);
    }


    public function edit($id)
    {
        $instansi = Instansi::findorfail($id);
        return view('backend.instansi.edit', compact('instansi') );
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'file|mimes:png,jpg,jpeg|max:2048'
        ]);


        if ($request->has('file')) {
            $file = $request->file;
            $new_file = time() .$file->getClientOriginalName();
            $file->move('uploads/logo/', $new_file);
            $file = Instansi::findorfail($id);


            $file_data['file'] = 'uploads/logo/'. $new_file;
            Instansi::whereId($id)->update($file_data);
            echo json_encode(["status" => TRUE]);
        }
    }


    public function destroy($id)
    {
        //
    }
}
