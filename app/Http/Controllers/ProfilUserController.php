<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilUserController extends Controller
{
    public function index(){

        return redirect('user/profil');
    }

    public function profil(){
    	$user = Auth::user();
    	return view('backend.user.updateprofil', compact('user'));
    }

    public function ubah_profil(Request $request, $id){
    	$request->validate([
    		'nama' => 'required',
    	]);

    	 if ($request->foto != '') {
            $foto = $request->foto;
            $new_foto = time().$foto->getClientOriginalName();
            $foto->move('uploads/profil/', $new_foto);
            $old = Auth::user();

            if ($old->foto != '') {
                unlink($old->foto);
            }

            $foto_data['foto'] = 'uploads/profil/'.$new_foto;
            User::whereId($id)->update($foto_data);
        }

        $foto_data = [
        	'name' => $request->nama,
        ];
        User::whereId($id)->update($foto_data);
        session()->flash('success', 'Berhasil Disimpan');
        return redirect('user/profil');
    }

    public function password(){
    	return view('backend.user.password');
    }

    public function ubah_password(Request $request){
        $request->validate([
            'pass_lama' => 'required',
            'pass_baru' => 'required|same:pass_conf',
            'pass_conf' => 'required'
        ]);

        if (!Hash::check($request->pass_lama, Auth::user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $data_password = [
            'password' => bcrypt($request->pass_conf)
        ];

        User::whereId(Auth::user()->id)->update($data_password);
        return back()->with('success', 'Password berhasil diubah');
    }

}
