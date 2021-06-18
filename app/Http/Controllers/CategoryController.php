<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        if (Request()->ajax()) {
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  onClick="get(' . $row->id . ')" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="ti-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.category.index');
    }

    public function store(Request $request)
    {
        Category::updateOrCreate(
            ['id' => $request->categoryId],
            [
                'nama' => $request->category_name
            ]

        );
        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        echo json_encode(["status" => TRUE]);
    }
}
