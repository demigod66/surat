<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, ArsipGuru};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ArsipGuruController extends Controller
{

    public function index()
    {
        $user = Auth::user()->tipe == 1 ? User::all() : User::select('id', 'name')->where('tipe', 0)->get();
        if (Request()->ajax()) {
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('arsipguru.show', $row->id).'" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory"><i class="fas fa-edit"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.arsip_guru.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->file as $f) {
            $file = Str::random(16).'.'.$f->extension();
            $f->move('uploads/arsipguru/', $file);

            ArsipGuru::Create([
                'id_user' => Auth::user()->tipe == 1 ? $request->iduser : Auth::user()->id,
                'nama_file' => $file
            ]);
        }

        echo json_encode(["status" => TRUE]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arsip = ArsipGuru::select('id', 'nama_file')->where('id_user', $id)->get();
        return view('backend.arsip_guru.show', compact('arsip'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
