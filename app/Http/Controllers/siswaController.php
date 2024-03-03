<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;

use Illuminate\Support\Facades\Session;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $katakunci =$request ->katakunci;
       $jumlahbaris=4;
       if(strlen($katakunci)){
        $data=siswa::where('nis','like',"%$katakunci%")
        ->orWhere('nama','like',"%$katakunci%")
        ->orWhere('jurusan','like',"%$katakunci%")
        ->paginate($jumlahbaris);
       }else{
        $data=siswa::orderBy('nis','desc')->paginate($jumlahbaris);
       }
        return view('index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Session::flash('nis', $request->nis);
         Session::flash('nama', $request->nama);
         Session::flash('jurusan',$request->jurusan);
        $request->validate([
            'nis'=> 'required|numeric|unique:siswa,nis',
            'nama'=> 'required',
            'jurusan'=> 'required',
        ],[
            'nis.required'=>'NIS harus diisi',
            'nis,numeric'=>'NIS harus dalam angka',
            'nis.unique'=>'NIS sudah ada',
            'nama.required'=>'Nama harus diisi',
            'jurusan.required'=>'Jurusan harus diisi',
        
        ]);
        $data =[
            'nis'=> $request->nis,
            'nama'=> $request->nama,
            'jurusan'=> $request->jurusan,
        ];
        siswa::create($data);
        return redirect()->route('siswa.index')->with('succes','Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=siswa::where('nis',$id)->first();
        return view('page.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nama.required'=>'Nama harus diisi',
            'jurusan.required'=>'Jurusan harus diisi',
        
        ]);
        $data = [
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];

        siswa::where('nis',$id)->update($data);
        return redirect()->to('siswa')->with('success','Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        siswa::where('nis',$id)->delete();
        return redirect()->to('siswa')->with('success','Data berhasil di hapus!');
    }
}
