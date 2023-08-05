<?php

// app/Http/Controllers/RekapController.php

namespace App\Http\Controllers;

use PDF;
use App\Models\Tv;
use Carbon\Carbon;
use App\Models\Radio;
use App\Models\Galeri;
use App\Models\Harian;
use App\Models\Mingguan;
use App\Models\Infotorial;
use Illuminate\Http\Request;

class RekapanController extends Controller
{
    public function getAllReport(){
        $infotorials = Infotorial::all();
        $galeris = Galeri::all();
        $harians = Harian::all();
        $mingguans = Mingguan::all();
        $radios = Radio::all();
        $tvs = Tv::all();
        return view('report', compact('infotorials', 'galeris', 'harians', 'mingguans', 'radios', 'tvs'));
    }

    public function showForm()
    {
        return view('form');
    }

    // Fungsi untuk mengunduh PDF berdasarkan bulan yang dipilih
    public function downloadPDFReport(Request $request)
{
    $bulanAwal = $request->input('bulan_awal');
    $bulanAkhir = $request->input('bulan_akhir');

    // Konversi bulan menjadi format bulan awal dan akhir untuk filter data berdasarkan bulan
    $bulanAwal = Carbon::parse($bulanAwal)->startOfMonth();
    $bulanAkhir = Carbon::parse($bulanAkhir)->endOfMonth();

    // Lakukan query ke database berdasarkan bulan awal dan bulan akhir yang dipilih
    $infotorials = Infotorial::whereBetween('bulan', [$bulanAwal, $bulanAkhir])->get();
    $harians = Harian::whereBetween('bulan', [$bulanAwal, $bulanAkhir])->get();
    $mingguans = Mingguan::whereBetween('bulan', [$bulanAwal, $bulanAkhir])->get();
    $radios = Radio::whereBetween('bulan', [$bulanAwal, $bulanAkhir])->get();
    $tvs = Tv::whereBetween('bulan', [$bulanAwal, $bulanAkhir])->get();

    // Generate PDF dengan menggunakan data yang telah difilter
    $pdf = PDF::loadView('report', compact('infotorials', 'harians', 'mingguans', 'radios', 'tvs'));

    // Atur nama file saat diunduh
    $filename = 'RekapanMedia_' . $bulanAwal->format('Y-m') . '_to_' . $bulanAkhir->format('Y-m') . '.pdf';

    // Menggunakan 'stream' untuk menampilkan PDF dalam browser, atau 'download' untuk langsung mengunduh
    return $pdf->stream($filename);
}
}
