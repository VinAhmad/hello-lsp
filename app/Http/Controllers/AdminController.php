<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Input_Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {

        $credentials=$request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials)){
            session()->regenerateToken();
            return redirect()->intended('/admin');
        }else{
            return back()->with('LoginError','Username atau password yang anda masukan salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function index(Request $request)
    {

        if($request->id!=null OR $request->kategori!=null OR $request->created_at!=null){
            if($request->id){
                $data=Aspirasi::where('id',$request->id)->latest()->get();
            }
            if($request->kategori){
                $data=Aspirasi::where('IdKategori',$request->kategori)->latest()->get();
            }
            if($request->created_at){
                $data=Aspirasi::where('created_at',$request->created_at)->latest()->get();
            }
        }
        else{
            $data=Aspirasi::latest()->get();
        }

        return view('admin',[
            'aspirasi'=>$data
        ]);

    }
    public function history()
    {

        $data=Aspirasi::where('status','Selesai')->latest()->get();

        return view('admin-history',[
            'aspirasi'=>$data
        ]);

    }

    public function edit(Aspirasi $aspirasi,Request $request)
    {
        $status=$request->only('status');
        Aspirasi::where('id',$aspirasi->id)->update($status);
        $message='Status laporan dengan id:'.$aspirasi->id.' berhasil dirubah menjadi '. $request->status;
        return redirect('/admin')->with('success',$message);

    }
    public function destroy(Aspirasi $aspirasi)
    {

        Aspirasi::where('IdLaporan',$aspirasi->input_aspirasi->id)->delete();
        Input_Aspirasi::where('id',$aspirasi->id)->delete();
        return back()->with('success','Data berhasil dihapus');
    }
}
