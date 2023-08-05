<?php

// app/Models/Rekapan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekapan extends Model
{
    protected $table = 'rekapan'; // Nama tabel dalam database

    // Definisikan properti fillable jika Anda ingin melakukan mass assignment
    protected $guarded = [];

    // Relasi dengan tabel Media Infotorial
    public function mediaInfotorial()
    {
        return $this->hasMany(MediaInfotorial::class, 'id_rekapan');
    }

    // Relasi dengan tabel Media Galeri
    public function mediaGaleri()
    {
        return $this->hasMany(MediaGaleri::class, 'id_rekapan');
    }

    // Relasi dengan tabel Harian
    public function harian()
    {
        return $this->hasMany(Harian::class, 'id_rekapan');
    }

    // Relasi dengan tabel Mingguan
    public function mingguan()
    {
        return $this->hasMany(Mingguan::class, 'id_rekapan');
    }

    // Relasi dengan tabel TV
    public function tv()
    {
        return $this->hasMany(Tv::class, 'id_rekapan');
    }

    // Relasi dengan tabel Radio
    public function radio()
    {
        return $this->hasMany(Radio::class, 'id_rekapan');
    }
}
