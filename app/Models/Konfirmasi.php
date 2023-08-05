<?php

// app/Models/Konfirmasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    use HasFactory;

    protected $fillable = ['pesan', 'admin_id', 'wartawan_id','tanggal', 'jam'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function wartawan()
    {
        return $this->belongsTo(User::class, 'wartawan_id');
    }
}
