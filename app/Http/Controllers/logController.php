<?php

namespace App\Http\Controllers;

use App\Models\LogPenilaian;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class logController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = LogPenilaian::with(['penilaian'])->get();
        return view('log.index', compact('log'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penilaian = Penilaian::all();
        
        return view('log.create', compact('penilaian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_penilaian = $request->input('id_penilaian');
        $nilai_baru = $request->input('nilai');

        // Mengambil entri penilaian
        $penilaian = Penilaian::findOrFail($id_penilaian);

    
        // Simpan data log penilaian
        $log = new LogPenilaian();
        $log->id_penilaian = $id_penilaian;
        $log->tgl_perubahan = now(); // Atau sesuai dengan kebutuhan
        $log->nilai_lama = $penilaian->nilai; // Jika perlu
        $log->nilai_baru = $nilai_baru;
        $log->save();
    
        // Update nilai pada entri penilaian
        $penilaian->nilai = $nilai_baru;
        $penilaian->save();
        return redirect()->route('log.index')->with('success', 'Penilaian berhasil diperbarui');
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
    public function edit(string $id_log)
    {
        $log = LogPenilaian::findOrFail($id_log);
        $penilaian = Penilaian::all(); // Untuk dropdown
        return view('log.edit', compact('log', 'penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_log)
    {
        $log = LogPenilaian::find($id_log);
        $id_penilaian = $request->input('id_penilaian');
        $nilai_baru = $request->input('nilai');

        // Mengambil entri penilaian terkait
        $penilaian = Penilaian::find($id_penilaian);

        
        // Update data log penilaian
        $log->tgl_perubahan = now();
        $log->nilai_lama = $penilaian->nilai;
        $log->nilai_baru = $nilai_baru;
        $log->save();
        
        // Update nilai pada entri penilaian
        $penilaian->nilai = $nilai_baru;
        $penilaian->save();

        return redirect()->route('log.index')->with('success', 'Penilaian berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_log)
    {
        $log = LogPenilaian::find($id_log);
        $log->delete();

        return back()->with('success','Data Berhasil di Hapus');
    }
}
