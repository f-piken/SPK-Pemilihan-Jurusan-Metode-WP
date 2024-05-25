<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use PDF;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index')->with([
            'mahasiswa' => Mahasiswa::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'kelamin'=>'required|min:3',
            'lahir'=>'required|min:3',
            'alamat'=>'required|min:3',
            'email'=>'required|min:3',
        ]);

        $mhs = new Mahasiswa;
        $mhs->nama = $request->nama;
        $mhs->jenis_kelamin = $request->kelamin;
        $mhs->tgl_lahir = $request->lahir;
        $mhs->alamat = $request->alamat;
        $mhs->email = $request->email;
        $mhs->save();

        return to_route('mahasiswa.index')->with('success','Data Berhasil di tambah.');
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
    public function edit(string $id_mahasiswa )
    {
        return view('mahasiswa.edit')->with([
            'mahasiswa' => Mahasiswa::find($id_mahasiswa),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_mahasiswa)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'kelamin'=>'required|min:3',
            'lahir'=>'required|min:3',
            'alamat'=>'required|min:3',
            'email'=>'required|min:3',
        ]);

        $mhs = Mahasiswa::find($id_mahasiswa);
        $mhs->nama = $request->nama;
        $mhs->jenis_kelamin = $request->kelamin;
        $mhs->tgl_lahir = $request->lahir;
        $mhs->alamat = $request->alamat;
        $mhs->email = $request->email;
        $mhs->save();

        return to_route('mahasiswa.index')->with('success','Data Berhasil di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_mahasiswa)
    {
        $mhs = mahasiswa::find($id_mahasiswa);
        $mhs -> delete();

        return back()->with('success','Data Berhasil di Hapus');
    }

    public function mhsdownloadPdf(){
        $mhs = mahasiswa::all();
        $pdf = PDF::loadView('mahasiswa.laporan',['mahasiswa'=>$mhs])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('laporan-mahasiswa.pdf');
    }
}
