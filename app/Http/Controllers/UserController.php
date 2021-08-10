<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = User::all();
        if (Request()->ajax()) {
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  onClick="get(' . $row->id . ')" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="ti-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.user.index');
    }

    public function create()
    {
        return view('backend.user.create');
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
}
