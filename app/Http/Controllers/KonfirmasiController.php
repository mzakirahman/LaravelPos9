<?php

// app/Http/Controllers/KonfirmasiController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Konfirmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonfirmasiController extends Controller
{
    // ...

    public function create()
    {   
        $user = Auth::user();
        $wartawans = User::where('level', 2)->get();
        return view('konfirmasis.create', compact('wartawans','user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pesan' => 'required',
            'wartawan_id' => 'required|exists:users,id',
            'tanggal' => 'required|date', // Tambahkan validasi tanggal
            'jam' => 'required', // Tambahkan validasi jam
        ]);

        // Konversi tanggal ke format Y-m-d
        $validatedData['tanggal'] = date('Y-m-d', strtotime($validatedData['tanggal']));

        $validatedData['admin_id'] = Auth::id();

        Konfirmasi::create($validatedData);

        return redirect()->back();
    }

    // ...
}
