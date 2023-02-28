<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Input_Aspirasi;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->id)){
            return view('aspirasi', [
                'kategori' => Kategori::all(),
                'aspirasi' => Aspirasi::where('IdLaporan',$request->id)->latest()->get()
            ]);
        }

        return view('aspirasi', [
            'kategori' => Kategori::all()
        ]);
    }
    public function insert(Request $request)
    {
        if (Siswa::where('nis', $request->nis_f)->first()) {
            $credentials = $request->validate([
                'nis_f' => 'numeric|required',
                'IdKategori' => 'required',
                'lokasi' => 'required',
                'image'=>'required',
                'laporan' => 'required'
            ]);

            if($request->file('image')){
                $credentials['image']=$request->file('image')->store('images');
            }

            $insertLaporan = Input_Aspirasi::create($credentials);
            $idlaporan = $insertLaporan->id;

            Aspirasi::create([
                'IdLaporan' => $idlaporan,
                'IdKategori' => $request->IdKategori
            ]);
            return redirect()->back()->with('success', 'Data anda berhasil masuk dengan id: ' . $insertLaporan->id);
        } else {
            return redirect()->back()->with('error', 'NIS tidak terdaftar')->withInput();
        }
    }
    public function feedback(Aspirasi $aspirasi,Request $request)
    {
        $feedback=$request->only('feedback');
        Aspirasi::where('id',$aspirasi->id)->update($feedback);
        return back();
    }
}
