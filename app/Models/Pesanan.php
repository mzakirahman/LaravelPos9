<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $tabel = 'pesanans';
    protected $fillable = [
    'judul_surat', 
    'isi_surat',
    'tanggal',
    'wartawan_id',
    'lampiran'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'wartawan_id');
    }
}
