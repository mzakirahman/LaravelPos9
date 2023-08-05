<?php

// app/Http/Controllers/WartawanController.php

namespace App\Http\Controllers;


use App\Models\Konfirmasi;
use Illuminate\Support\Facades\Auth;

class WartawanController extends Controller
{
    public function index()
    {
        // Mendapatkan daftar konfirmasi yang dikirimkan oleh admin untuk wartawan tertentu (sesuai dengan user yang login)
        $konfirmasis = Konfirmasi::where('wartawan_id', Auth::id())->get();
        $user = Auth::user();
        return view('wartawan.konfirmasis', compact('konfirmasis', 'user'));
    }
    public function destroy($id)
    {
        // Temukan data konfirmasi berdasarkan ID dan pastikan itu milik wartawan yang sedang login (untuk keamanan)
        $konfirmasi = Konfirmasi::where('wartawan_id', Auth::id())->find($id);

        if (!$konfirmasi) {
            // Jika data konfirmasi tidak ditemukan atau bukan milik wartawan yang login, kembalikan respons error
            return redirect()->back()->with('error', 'Data konfirmasi tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        }

        // Hapus data konfirmasi dari database
        $konfirmasi->delete();

        // Setelah data dihapus, kembalikan ke halaman sebelumnya (atau halaman yang diinginkan)
        return redirect()->back()->with('success', 'Data konfirmasi berhasil dihapus.');
    }
}

