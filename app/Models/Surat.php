<?php

namespace App\Models;

// app/Models/Surat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $tabel = 'surats';
    protected $fillable = [
        'wartawan_id',
        'nama_media',
        'subjek',
        'isi',
        'lampiran',
        'tanggal',
    ];

    // Relasi dengan admin (admin_id adalah foreign key)

    // Relasi dengan wartawan (wartawan_id adalah foreign key)
    public function wartawan()
    {
        return $this->belongsTo(User::class, 'wartawan_id');
    }
}
