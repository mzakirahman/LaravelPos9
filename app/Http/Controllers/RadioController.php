<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Radio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RadioController;

class RadioController extends Controller
{
    public function index()
    {
        $radios = Radio::paginate(3);
        $user = Auth::user();
        return view('radios.index', compact('radios', 'user'));
    }
    public function add()
    {
        $radios = Radio::paginate(3);
        $user = Auth::user();
        return view('radios.add', compact('radios', 'user'));
    }

    public function create()
    {
        $wartawans = User::where('level', 2)->get(); // Fetch wartawans with level 2
        $user = Auth::user();
        return view('radios.create', compact('wartawans', 'user'));
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
        Radio::create([
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
    
        return redirect('/radios')->with('success', 'Data media cetak radio berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
        // Ambil data radio berdasarkan ID
        $radio = Radio::findOrFail($id);

        // Ambil data wartawan untuk opsi dropdown
        $wartawans = User::where('level', 2)->get();

        // Tampilkan halaman edit dengan passing data radio dan wartawan
        return view('radios.edit', compact('radio', 'wartawans'));
    }

    // Fungsi untuk mengupdate data Media Cetak radio berdasarkan ID
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

        // Ambil data radio berdasarkan ID
        $radio = Radio::findOrFail($id);

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $fileName);
            $lampiranPath = 'lampiran/' . $fileName;

            // Hapus lampiran lama jika ada
            if ($radio->lampiran) {
                Storage::delete('public/' . $radio->lampiran);
            }

            // Update lampiran baru
            $radio->lampiran = $lampiranPath;
        }

        // Update data radio
        $radio->wartawan_id = $request->input('wartawan_id');
        $radio->nama_media = $request->input('nama_media');
        $radio->jenis_media = $request->input('jenis_media');
        $radio->jenis_pesanan = $request->input('jenis_pesanan');
        $radio->jumlah_pesanan = $request->input('jumlah_pesanan');
        $radio->satuan = $request->input('satuan');

        // Hitung harga berdasarkan jumlah pesanan dan satuan
        $harga = $radio->jumlah_pesanan * $radio->satuan;
        $radio->harga = $harga;

        // Hitung total transfer dan jumlah setelah dipotong dengan pajak
        $totalTransfer = $harga - ($harga * $request->input('pajak') / 100);
        $radio->total_transfer = $totalTransfer;
        $radio->jumlah = $totalTransfer;

        $radio->pajak = $request->input('pajak');
        $radio->bulan = $request->input('bulan');
        $radio->save();

        return redirect('/radios')->with('success', 'Data media cetak radio berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $radios = Radio::find($id);  
        $user = Auth::user(); 
        $radios->delete();
        return redirect('/radios');
    }
    public function show($id)
    {
        $radio = Radio::find($id);

        if (!$radio) {
            // Jika data tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->route('radios.index')->with('error', 'Data not found.');
        }

        return view('radios.show', compact('radios'));
    }
    public function search(Request $request)
{
    // Ambil keyword dari input pencarian
    $keyword = $request->input('keyword');

    // Lakukan pencarian data sesuai dengan kata kunci (keyword) jika ada keyword yang dimasukkan
    if ($keyword) {
        $radios = Radio::where(function ($query) use ($keyword) {
            $query->where('nama_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_pesanan', 'like', '%' . $keyword . '%')
                ->orWhere('jumlah_pesanan', 'like', '%' . $keyword . '%');
        })->paginate(3);
    } else {
        // Jika tidak ada keyword yang dimasukkan, tampilkan semua data
        $radios = Radio::paginate(3);
    }

    // Kirim data hasil pencarian (atau semua data jika tidak ada keyword) ke tampilan (view) yang sesuai
    $user = Auth::user();
    return view('radios.index', compact('radios', 'user'));
}
}
