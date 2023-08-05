<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Infotorial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class InfotorialController extends Controller
{
    public function index()
    {
        $infotorials = infotorial::paginate(3);
        $user = Auth::user();
        return view('infotorials.index', compact('infotorials', 'user'));
    }
    public function add()
    {
        $infotorials = Infotorial::paginate(3);
        $user = Auth::user();
        return view('infotorials.add', compact('infotorials', 'user'));
    }

    public function create()
    {
        $wartawans = User::where('level', 2)->get(); // Fetch wartawans with level 2
        $user = Auth::user();
        return view('infotorials.create', compact('wartawans', 'user'));
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
        Infotorial::create([
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
    
        return redirect('/infotorials')->with('success', 'Data media cetak infotorial berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
        // Ambil data infotorial berdasarkan ID
        $infotorial = Infotorial::findOrFail($id);

        // Ambil data wartawan untuk opsi dropdown
        $wartawans = User::where('level', 2)->get();

        // Tampilkan halaman edit dengan passing data infotorial dan wartawan
        return view('infotorials.edit', compact('infotorial', 'wartawans'));
    }

    // Fungsi untuk mengupdate data Media Cetak infotorial berdasarkan ID
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

        // Ambil data infotorial berdasarkan ID
        $infotorial = Infotorial::findOrFail($id);

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $fileName);
            $lampiranPath = 'lampiran/' . $fileName;

            // Hapus lampiran lama jika ada
            if ($infotorial->lampiran) {
                Storage::delete('public/' . $infotorial->lampiran);
            }

            // Update lampiran baru
            $infotorial->lampiran = $lampiranPath;
        }

        // Update data infotorial
        $infotorial->wartawan_id = $request->input('wartawan_id');
        $infotorial->nama_media = $request->input('nama_media');
        $infotorial->jenis_media = $request->input('jenis_media');
        $infotorial->jenis_pesanan = $request->input('jenis_pesanan');
        $infotorial->jumlah_pesanan = $request->input('jumlah_pesanan');
        $infotorial->satuan = $request->input('satuan');

        // Hitung harga berdasarkan jumlah pesanan dan satuan
        $harga = $infotorial->jumlah_pesanan * $infotorial->satuan;
        $infotorial->harga = $harga;

        // Hitung total transfer dan jumlah setelah dipotong dengan pajak
        $totalTransfer = $harga - ($harga * $request->input('pajak') / 100);
        $infotorial->total_transfer = $totalTransfer;
        $infotorial->jumlah = $totalTransfer;

        $infotorial->pajak = $request->input('pajak');
        $infotorial->bulan = $request->input('bulan');
        $infotorial->save();

        return redirect('/infotorials')->with('success', 'Data media cetak infotorial berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $infotorials = Infotorial::find($id);  
        $user = Auth::user(); 
        $infotorials->delete();
        return redirect('/infotorials');
    }
    public function show($id)
    {
        $infotorial = Infotorial::find($id);

        if (!$infotorial) {
            // Jika data tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->route('infotorials.index')->with('error', 'Data not found.');
        }

        return view('infotorials.show', compact('infotorials'));
    }
    public function search(Request $request)
{
    // Ambil keyword dari input pencarian
    $keyword = $request->input('keyword');

    // Lakukan pencarian data sesuai dengan kata kunci (keyword) jika ada keyword yang dimasukkan
    if ($keyword) {
        $infotorials = Infotorial::where(function ($query) use ($keyword) {
            $query->where('nama_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_pesanan', 'like', '%' . $keyword . '%')
                ->orWhere('jumlah_pesanan', 'like', '%' . $keyword . '%');
        })->paginate(3);
    } else {
        // Jika tidak ada keyword yang dimasukkan, tampilkan semua data
        $infotorials = Infotorial::paginate(3);
    }

    // Kirim data hasil pencarian (atau semua data jika tidak ada keyword) ke tampilan (view) yang sesuai
    $user = Auth::user();
    return view('infotorials.index', compact('infotorials', 'user'));
}
}
