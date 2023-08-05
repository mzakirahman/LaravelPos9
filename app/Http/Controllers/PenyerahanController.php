<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penyerahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyerahanController extends Controller
{
    public function index()
{
    // Retrieve Penyerahan data with the 'pengirim' relationship
    $penyerahans = Penyerahan::with('pengirim')->paginate(5);

    // Load the 'penyerahans.index' view and pass the data
    return view('penyerahans.index', compact('penyerahans'));
}

    public function create()
    {
        $wartawans = User::where('level', 2)->get();
        return view('penyerahans.create', compact('wartawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_surat' => 'required',
            'link' => 'required',
            'tanggal' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $penyerahan = new Penyerahan();
        $penyerahan->judul_surat = $request->judul_surat;
        $penyerahan->link = $request->link;
        $penyerahan->tanggal = $request->tanggal;

        // Menggunakan informasi pengguna yang sedang login untuk menentukan wartawan pengirim
        $penyerahan->wartawan_id = Auth::id();

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $penyerahan->lampiran = $lampiranPath;
        }

        $penyerahan->save();

        return redirect()->back();
    }

    public function destroy(Penyerahan $penyerahan)
    {
        $penyerahan->delete();
        return redirect()->route('penyerahans.index')->with('success', 'Surat berhasil dihapus');
    }
}