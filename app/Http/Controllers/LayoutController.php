<?php

namespace App\Http\Controllers;


use App\Models\Tv;
use App\Models\Radio;
use App\Models\Galeri;
use App\Models\Harian;
use App\Models\Mingguan;
use App\Models\Infotorial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        return view('layout.home')->with([
            'user' => Auth::user(),
        ]);
    }

    public function add()
    {
        $infotorial = new Infotorial();
        $jumlahPesananInfotorial = $infotorial->jumlah_pesanan();
        Log::debug('Total Transfer Infotorial: ' . $jumlahPesananInfotorial);

        $harian = new Harian();
        $jumlahPesananHarian = $harian->jumlah_pesanan();

        $mingguan = new Mingguan();
        $jumlahPesananMingguan = $mingguan->jumlah_pesanan();

        $radio = new Radio();
        $jumlahPesananRadio = $radio->jumlah_pesanan();

        $tv = new Tv();
        $jumlahPesananTv = $tv->jumlah_pesanan();

        $categories = ['Infotorial', 'Harian', 'Mingguan', 'Radio', 'Tv'];
        $data = [];

        foreach ($categories as $category) {
            $model = app("App\Models\\$category");
            $jumlahPesanan = $model->sum('jumlah_pesanan');
            $data[$category] = $jumlahPesanan;
        }

        // Get the dates to be used in the chart
        $dates = Infotorial::pluck('bulan')->toArray();

        // Konversi tanggal menjadi instansi Carbon untuk memudahkan pengelompokan berdasarkan bulan
        $dates = array_map(function ($date) {
            return Carbon::parse($date)->format('Y-m');
        }, $dates);
        
        // Hapus duplikat tanggal
        $dates = array_unique($dates);
        
        // Siapkan data untuk setiap kategori dan tanggal
        $chartData = [];
        foreach ($categories as $category) {
            $model = app("App\Models\\$category");
            $data = [];
            foreach ($dates as $date) {
                $totalPesananPerBulan = $model->whereYear('bulan', Carbon::parse($date)->year)
                    ->whereMonth('bulan', Carbon::parse($date)->month)
                    ->sum('jumlah_pesanan');
                $data[] = $totalPesananPerBulan;
            }
            $chartData[$category] = $data;
        }

        return view('layout.dashboard')->with([
            'jumlahPesananInfotorial' => $jumlahPesananInfotorial,
            'jumlahPesananHarian' => $jumlahPesananHarian,
            'jumlahPesananMingguan' => $jumlahPesananMingguan,
            'jumlahPesananRadio' => $jumlahPesananRadio,
            'jumlahPesananTv' => $jumlahPesananTv,
            'categories' => $categories,
            'data' => $data,
            'dates' => $dates, // Pass the dates to the view
            'chartData' => $chartData, // Pass the chart data to the view
            'user' => Auth::user(),
        ]);
    }
}