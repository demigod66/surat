<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suratmasukcount = DB::table('surat_masuk')->count();
        $suratkeluarcount = DB::table('surat_keluar')->count();
        $arsipgurucount = DB::table('arsip_guru')->count();
        $ijazahcount = DB::table('ijazah')->count();
        $userscount = DB::table('users')->count();
        $ijazahcount = DB::table('ijazah')->count();
        return view('backend.home', compact('suratmasukcount','suratkeluarcount','arsipgurucount','ijazahcount','userscount','ijazahcount'));
    }
}
