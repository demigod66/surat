<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->tipe == 1 ){
         $user = User::all();
        if (Request()->ajax()) {
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('user.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.user.index');
    }
    else {
        return view('backend.error');
    }
    }

    public function create()
    {
        if( Auth::user()->tipe == 1 ){
        return view('backend.user.create');
        }
        else {
            return view('backend.error');
        }
    }


    public function store(Request $request)
    {

        if ($request->input('password')){
            $password = bcrypt($request->password);
            }else {
                $password = bcrypt(123456);
            }
            User::create([
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                'password' =>  $password
            ]);


        echo json_encode(["status" => TRUE]);
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        if( Auth::user()->tipe == 1 ){
        $user = User::findorfail($id);
        return view('backend.user.edit', compact('user'));
        }
        else {
            return view('backend.error');
        }
    }


    public function update(Request $request, $id)
    {
        if($request->input('password')) {
            $user_data = [
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                'password' => bcrypt($request->password)
                ];
         }
         else{
            $user_data = [
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                ];
         }
         User::whereId($id)->update($user_data);
         echo json_encode(["status" => TRUE]);
    }


    public function destroy($id)
    {
        if( Auth::user()->tipe == 1 ){
        $user = User::findOrFail($id);
        $user->delete();

        echo json_encode(["status" => TRUE]);
        }
        else {
            return view('backend.error');
        }
    }
}
