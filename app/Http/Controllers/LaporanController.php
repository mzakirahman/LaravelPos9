<?php

namespace App\Http\Controllers;
use App\Helpers\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\LaporanController;

class LaporanController extends Controller
{
    public function myFunction()
    {
        $nominal = 1500000;
        $prefix = true;

        $result = formatRupiah($nominal, $prefix);
        return view('my-view', ['formattedNominal' => $result]);
    }

}
