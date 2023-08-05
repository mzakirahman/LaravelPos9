<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use App\Models\Radio;
use App\Models\Surat;
use App\Models\Galeri;
use App\Models\Harian;
use App\Models\Mingguan;
use App\Models\Infotorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Wartawan extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $harians = Harian::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.harians.index', compact('harians'));
    }

    public function add()
    {
        $user = Auth::user();
        $galeris = Galeri::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.galeris.add', compact('galeris'));
    }

    public function addd()
    {
        $user = Auth::user();
        $infotorials = Infotorial::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.infotorials.addd', compact('infotorials'));
        
    }

    public function ad()
    {
        $user = Auth::user();
        $mingguans = Mingguan::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.mingguans.ad', compact('mingguans'));
    }
    public function aa()
    {
        $user = Auth::user();
        $radios = Radio::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.radios.aa', compact('radios'));
    }
    public function ab()
    {
        $user = Auth::user();
        $tvs = Tv::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.tvs.ab', compact('tvs'));
    }

    public function aad()
    {
        $user = Auth::user();
        $surats = Surat::where('wartawan_id', $user->id)->paginate(5);
        return view('wartawan.surats.aad', compact('surats'));
    }
}
