<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Harian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HarianController;

class HarianController extends Controller
{
    public function index()
    {
        $harians = Harian::paginate(3);
        $user = Auth::user();
        return view('harians.index', compact('harians', 'user'));
    }
    public function add()
    {
        $harians = Harian::paginate(3);
        $user = Auth::user();
        return view('harians.add', compact('harians', 'user'));
    }

    public function create()
    {
        $wartawans = User::where('level', 2)->get(); // Fetch wartawans with level 2
        $user = Auth::user();
        return view('harians.create', compact('wartawans', 'user'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'wartawan_id' => 'required|exists:users,id,level,2',
            'nama_media' => 'required',
            'jenis_media' => 'required',
            'jenis_pesanan' => 'required',
            'jumlah_pesanan' => 'required|numeric|min:0',
            'satuan' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0|max:100',
            'bulan' => 'required|date',
            'lampiran' => 'required|mimes:pdf,doc,docx|max:2048', // Define validation rules for the lampiran file
        ]);
    
        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $fileName);
            $lampiranPath = 'lampiran/' . $fileName;
        } else {
            $lampiranPath = null;
        }
    
        // Mendapatkan data dari form
        $wartawanId = $request->input('wartawan_id');
        $wartawan = User::findOrFail($wartawanId); // Ambil data wartawan berdasarkan wartawan_id
    
        $jenisMedia = $request->input('jenis_media');
        $jenisPesanan = $request->input('jenis_pesanan');
        $jumlahPesanan = $request->input('jumlah_pesanan');
        $satuan = $request->input('satuan');
        $pajak = $request->input('pajak');
        $bulan = $request->input('bulan');
    
        // Hitung harga berdasarkan jumlah pesanan dan satuan
        $harga = $jumlahPesanan * $satuan;
    
        // Hitung total transfer dan jumlah setelah dipotong dengan pajak
        $totalTransfer = $harga - ($harga * $pajak / 100);
        $jumlahSetelahPajak = $harga - ($harga * $pajak / 100);
    
        // Simpan data ke database menggunakan metode create()
        Harian::create([
            'wartawan_id' => $wartawan->id,
            'nama_media' => $wartawan->username,
            'jenis_media' => $jenisMedia,
            'jenis_pesanan' => $jenisPesanan,
            'jumlah_pesanan' => $jumlahPesanan,
            'satuan' => $satuan,
            'harga' => $harga,
            'total_transfer' => $totalTransfer,
            'jumlah' => $jumlahSetelahPajak,
            'pajak' => $pajak,
            'bulan' => $bulan,
            'lampiran' => $lampiranPath,
        ]);
    
        return redirect('/harians')->with('success', 'Data media cetak harian berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
        // Ambil data Harian berdasarkan ID
        $harian = Harian::findOrFail($id);

        // Ambil data wartawan untuk opsi dropdown
        $wartawans = User::where('level', 2)->get();

        // Tampilkan halaman edit dengan passing data Harian dan wartawan
        return view('harians.edit', compact('harian', 'wartawans'));
    }

    // Fungsi untuk mengupdate data Media Cetak Harian berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi data yang diinputkan oleh pengguna
        $request->validate([
            'wartawan_id' => 'required|exists:users,id,level,2',
            'nama_media' => 'required',
            'jenis_media' => 'required',
            'jenis_pesanan' => 'required',
            'jumlah_pesanan' => 'required|numeric|min:0',
            'satuan' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0|max:100',
            'bulan' => 'required|date',
            'lampiran' => 'nullable|mimes:pdf,doc,docx|max:2048', // Define validation rules for the lampiran file
        ]);

        // Ambil data Harian berdasarkan ID
        $harian = Harian::findOrFail($id);

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $fileName);
            $lampiranPath = 'lampiran/' . $fileName;

            // Hapus lampiran lama jika ada
            if ($harian->lampiran) {
                Storage::delete('public/' . $harian->lampiran);
            }

            // Update lampiran baru
            $harian->lampiran = $lampiranPath;
        }

        // Update data Harian
        $harian->wartawan_id = $request->input('wartawan_id');
        $harian->nama_media = $request->input('nama_media');
        $harian->jenis_media = $request->input('jenis_media');
        $harian->jenis_pesanan = $request->input('jenis_pesanan');
        $harian->jumlah_pesanan = $request->input('jumlah_pesanan');
        $harian->satuan = $request->input('satuan');

        // Hitung harga berdasarkan jumlah pesanan dan satuan
        $harga = $harian->jumlah_pesanan * $harian->satuan;
        $harian->harga = $harga;

        // Hitung total transfer dan jumlah setelah dipotong dengan pajak
        $totalTransfer = $harga - ($harga * $request->input('pajak') / 100);
        $harian->total_transfer = $totalTransfer;
        $harian->jumlah = $totalTransfer;

        $harian->pajak = $request->input('pajak');
        $harian->bulan = $request->input('bulan');
        $harian->save();

        return redirect('/harians')->with('success', 'Data media cetak harian berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $harians = Harian::find($id);  
        $user = Auth::user(); 
        $harians->delete();
        return redirect('/harians');
    }
    public function show($id)
    {
        $harian = Harian::find($id);

        if (!$harian) {
            // Jika data tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->route('harians.index')->with('error', 'Data not found.');
        }

        return view('harians.show', compact('harians'));
    }
    public function search(Request $request)
{
    // Ambil keyword dari input pencarian
    $keyword = $request->input('keyword');

    // Lakukan pencarian data sesuai dengan kata kunci (keyword) jika ada keyword yang dimasukkan
    if ($keyword) {
        $harians = Harian::where(function ($query) use ($keyword) {
            $query->where('nama_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_pesanan', 'like', '%' . $keyword . '%')
                ->orWhere('jumlah_pesanan', 'like', '%' . $keyword . '%');
        })->paginate(3);
    } else {
        // Jika tidak ada keyword yang dimasukkan, tampilkan semua data
        $harians = Harian::paginate(3);
    }

    // Kirim data hasil pencarian (atau semua data jika tidak ada keyword) ke tampilan (view) yang sesuai
    $user = Auth::user();
    return view('harians.index', compact('harians', 'user'));
}
}
