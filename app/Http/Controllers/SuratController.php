<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;
use App\Http\Controllers\Wartawan;
use Illuminate\Support\Facades\Auth;


class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::paginate(5);
        return view('surats.index', compact('surats'));
    }
    public function create()
    {
        $wartawans = User::where('level', 2)->get(); // Fetch wartawans with level 2
        $user = Auth::user();
        return view('surats.create', compact('wartawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wartawan_id' => 'required',
            'nama_media' => 'required',
            'subjek' => 'required',
            'isi' => 'required',
            'tanggal' => 'required',
        ]);

        // Simpan data surat ke dalam basis data
        $surat = new Surat();
        $surat->wartawan_id = $request->wartawan_id;
        $surat->nama_media = $request->nama_media;
        $surat->subjek = $request->subjek;
        $surat->isi = $request->isi;
        $surat->tanggal = $request->tanggal;

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $surat->lampiran = $lampiranPath;
        }

        $surat->save();

        return redirect()->route('surats.index')->with('success', 'Surat berhasil dikirim');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();

        return redirect()->route('surats.index')->with('success', 'Surat berhasil dihapus');
    }
}