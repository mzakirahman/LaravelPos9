<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyerahan extends Model
{
    use HasFactory;
    protected $table = 'penyerahans';
    protected $fillable = [
    'judul_surat', 
    'link',
    'tanggal',
    'wartawan_id',
    'lampiran'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'wartawan_id');
    }
}