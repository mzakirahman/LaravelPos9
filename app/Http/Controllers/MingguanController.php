<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mingguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MingguanController;

class MingguanController extends Controller
{
    public function index()
    {
        $mingguans = Mingguan::paginate(3);
        $user = Auth::user();
        return view('mingguans.index', compact('mingguans', 'user'));
    }
    public function add()
    {
        $mingguans = Mingguan::paginate(3);
        $user = Auth::user();
        return view('mingguans.add', compact('mingguans', 'user'));
    }

    public function create()
    {
        $wartawans = User::where('level', 2)->get(); // Fetch wartawans with level 2
        $user = Auth::user();
        return view('mingguans.create', compact('wartawans', 'user'));
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
        Mingguan::create([
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
    
        return redirect('/mingguans')->with('success', 'Data media cetak mingguan berhasil ditambahkan.');
    }
    

    public function edit($id)
    {
        // Ambil data mingguan berdasarkan ID
        $mingguan = Mingguan::findOrFail($id);

        // Ambil data wartawan untuk opsi dropdown
        $wartawans = User::where('level', 2)->get();

        // Tampilkan halaman edit dengan passing data mingguan dan wartawan
        return view('mingguans.edit', compact('mingguan', 'wartawans'));
    }

    // Fungsi untuk mengupdate data Media Cetak mingguan berdasarkan ID
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
            'lampiran' => 'nullable', // Define validation rules for the lampiran file
        ]);

        // Ambil data mingguan berdasarkan ID
        $mingguan = Mingguan::findOrFail($id);

        // Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $fileName);
            $lampiranPath = 'lampiran/' . $fileName;

            // Hapus lampiran lama jika ada
            if ($mingguan->lampiran) {
                Storage::delete('public/' . $mingguan->lampiran);
            }

            // Update lampiran baru
            $mingguan->lampiran = $lampiranPath;
        }

        // Update data mingguan
        $mingguan->wartawan_id = $request->input('wartawan_id');
        $mingguan->nama_media = $request->input('nama_media');
        $mingguan->jenis_media = $request->input('jenis_media');
        $mingguan->jenis_pesanan = $request->input('jenis_pesanan');
        $mingguan->jumlah_pesanan = $request->input('jumlah_pesanan');
        $mingguan->satuan = $request->input('satuan');

        // Hitung harga berdasarkan jumlah pesanan dan satuan
        $harga = $mingguan->jumlah_pesanan * $mingguan->satuan;
        $mingguan->harga = $harga;

        // Hitung total transfer dan jumlah setelah dipotong dengan pajak
        $totalTransfer = $harga - ($harga * $request->input('pajak') / 100);
        $mingguan->total_transfer = $totalTransfer;
        $mingguan->jumlah = $totalTransfer;

        $mingguan->pajak = $request->input('pajak');
        $mingguan->bulan = $request->input('bulan');
        $mingguan->save();

        return redirect('/mingguans')->with('success', 'Data media cetak mingguan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $mingguans = Mingguan::find($id);  
        $user = Auth::user(); 
        $mingguans->delete();
        return redirect('/mingguans');
    }
    public function show($id)
    {
        $mingguan = Mingguan::find($id);

        if (!$mingguan) {
            // Jika data tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->route('mingguans.index')->with('error', 'Data not found.');
        }

        return view('mingguans.show', compact('mingguans'));
    }
    public function search(Request $request)
{
    // Ambil keyword dari input pencarian
    $keyword = $request->input('keyword');

    // Lakukan pencarian data sesuai dengan kata kunci (keyword) jika ada keyword yang dimasukkan
    if ($keyword) {
        $mingguans = Mingguan::where(function ($query) use ($keyword) {
            $query->where('nama_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_media', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_pesanan', 'like', '%' . $keyword . '%')
                ->orWhere('jumlah_pesanan', 'like', '%' . $keyword . '%');
        })->paginate(3);
    } else {
        // Jika tidak ada keyword yang dimasukkan, tampilkan semua data
        $mingguans = Mingguan::paginate(3);
    }

    // Kirim data hasil pencarian (atau semua data jika tidak ada keyword) ke tampilan (view) yang sesuai
    $user = Auth::user();
    return view('mingguans.index', compact('mingguans', 'user'));
}
}
