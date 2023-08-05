<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PesananController;

class PesananController extends Controller
{
    public function index()
{
    // Retrieve pesanan data with the 'pengirim' relationship
    $pesanans = Pesanan::with('pengirim')->paginate(5);

    // Load the 'pesanans.index' view and pass the data
    return view('pesanans.index', compact('pesanans'));
}

    public function create()
    {
        $wartawans = User::where('level', 2)->get();
        return view('pesanans.create', compact('wartawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_surat' => 'required',
            'isi_surat' => 'required',
            'tanggal' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $pesanan = new Pesanan();
        $pesanan->judul_surat = $request->judul_surat;
        $pesanan->isi_surat = $request->isi_surat;
        $pesanan->tanggal = $request->tanggal;

        // Menggunakan informasi pengguna yang sedang login untuk menentukan wartawan pengirim
        $pesanan->wartawan_id = Auth::id();

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $pesanan->lampiran = $lampiranPath;
        }

        $pesanan->save();

        return redirect()->back();
    
    }

    public function detail($id)
    {
        $pesanans = Pesanan::find($id);
        $user = Auth::user();
        return view('pesanans.detail', compact('pesanans', 'user'));
    }

    public function destroy($id)
    {
        $pesanans = Pesanan::find($id); 
        $user = Auth::user(); 
        $pesanans->delete();
        return redirect('/pesanans');
    }
}
