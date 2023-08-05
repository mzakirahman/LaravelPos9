<?php

namespace App\Models;

use App\Models\Rekapan;
use App\Models\Infotorial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infotorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'wartawan_id',
        'nama_media',
        'jenis_media',
        'jenis_pesanan',
        'jumlah_pesanan',
        'satuan',
        'harga',
        'total_transfer',
        'jumlah',
        'pajak',
        'bulan',
        'lampiran',
    ];

    public function jumlah_pesanan()
    {
        // Perform the calculation and return the result
        // For example, if the total transfer is stored in a column named 'transfer_amount'
        // you can calculate the sum of all transfer amounts using Eloquent's sum() method.
        return $this->sum('jumlah_pesanan');
    }
    public function getJumlahPesananByDate($date)
    {
        return $this->where('bulan', $date)->sum('jumlah_pesanan');
    }

    public function rekapan()
    {
        return $this->belongsTo(Rekapan::class, 'id_rekapan');
    }
}
