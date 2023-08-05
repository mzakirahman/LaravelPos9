<!DOCTYPE html>
<html lang="en">
        
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapan Media</title>
    <style>
        #emp {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        #emp td,
        #emp th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #emp tr:nth-child(even) {
            background-color: #0bfdfd;
            text-align: center;
        }

        #emp th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<table style="width: 80%;">  
</table>
<body>
{{-- Bagian Ketrangan  --}}
    <div class="card-header">
        <h2>Rakapan Pemesanan Media Diskominfotik Bengkalis Bidang Sumber Daya Komunikasi dan Informasi</h2>
    <div class="card-header">

    </div>

    {{-- Bagian Tabel yang Mau dicetak --}}
    <h4>1. Media Online</h4>
    <table id="emp" border="2">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Media</th>
                <th class="text-center">Jenis Media</th>
                <th class="text-center">Jenis Pesanan</th>
                <th class="text-center">Jumlah Pesanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Total Transfer</th>
                <th class="text-center">Jumlah</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($infotorials as $infotorial)
                <tr>
                    <td class="text-center text-left">{{ $infotorial->id }}</td>
                    <td class="text-center text-left">{{ $infotorial->nama_media }}</td>
                    <td class="text-center text-left">{{ $infotorial->jenis_media }}</td>
                    <td class="text-center text-left">{{ $infotorial->jenis_pesanan }}</td>
                    <td class="text-center text-left">{{ $infotorial->jumlah_pesanan }}</td>
                    <td class="text-center text-left">{{ formatRupiah($infotorial->harga) }}</td>
                    <td class="text-center text-left">{{ formatRupiah($infotorial->satuan) }}</td>
                    <td class="text-center text-left">{{ formatRupiah($infotorial->total_transfer) }}</td>
                    <td class="text-center text-left">{{ formatRupiah($infotorial->jumlah) }}</td>
                    
                </tr>
        
            @endforeach
        </tbody>
    </table>
   
    <h4>2. Media Cetak Harian</h4>
    <table id="emp" border="2">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Media</th>
                <th class="text-center">Jenis Media</th>
                <th class="text-center">Jenis Pesanan</th>
                <th class="text-center">Jumlah Pesanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Total Transfer</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($harians as $harian)
                <tr>
                    <td class="text-center">{{$harian->id}}</td>
                    <td class="text-center">{{$harian->nama_media}}</td>
                    <td class="text-center">{{$harian->jenis_media}}</td>
                    <td class="text-center">{{$harian->jenis_pesanan}}</td>
                    <td class="text-center">{{$harian->jumlah_pesanan}}</td>
                    <td class="text-center">{{ formatRupiah($harian->harga)}}</td>
                    <td class="text-center">{{ formatRupiah($harian->satuan)}}</td>
                    <td class="text-center">{{ formatRupiah($harian->total_transfer)}}</td>
                    <td class="text-center">{{ formatRupiah($harian->jumlah)}}</td>
                </tr>
        
            @endforeach
        </tbody>
    </table>
    <h4>3. Media Cetak Mingguan</h4>
    <table id="emp" border="2">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Media</th>
                <th class="text-center">Jenis Media</th>
                <th class="text-center">Jenis Pesanan</th>
                <th class="text-center">Jumlah Pesanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Total Transfer</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mingguans as $mingguan)
                <tr>
                    <td class="text-center">{{$mingguan->id}}</td>
                    <td class="text-center">{{$mingguan->nama_media}}</td>
                    <td class="text-center">{{$mingguan->jenis_media}}</td>
                    <td class="text-center">{{$mingguan->jenis_pesanan}}</td>
                    <td class="text-center">{{$mingguan->jumlah_pesanan}}</td>
                    <td class="text-center">{{formatRupiah($mingguan->harga)}}</td>
                    <td class="text-center">{{formatRupiah($mingguan->satuan)}}</td>
                    <td class="text-center">{{formatRupiah($mingguan->total_transfer)}}</td>
                    <td class="text-center">{{formatRupiah($mingguan->jumlah)}}</td>
                    
                </tr>
        
            @endforeach
        </tbody>
    </table>
    <h4>4. Media Radio</h4>
    <table id="emp" border="2">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Media</th>
                <th class="text-center">Jenis Media</th>
                <th class="text-center">Jenis Pesanan</th>
                <th class="text-center">Jumlah Pesanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Total Transfer</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($radios as $radio)
                <tr>
                    <td class="text-center">{{$radio->id}}</td>
                    <td class="text-center">{{$radio->nama_media}}</td>
                    <td class="text-center">{{$radio->jenis_media}}</td>
                    <td class="text-center">{{$radio->jenis_pesanan}}</td>
                    <td class="text-center">{{$radio->jumlah_pesanan}}</td>
                    <td class="text-center">{{formatRupiah($radio->harga)}}</td>
                    <td class="text-center">{{$radio->satuan}}</td>
                    <td class="text-center">{{formatRupiah($radio->total_transfer)}}</td>
                    <td class="text-center">{{formatRupiah($radio->jumlah)}}</td>
                    
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>5. Media Tv</h4>
    <table id="emp" border="2">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Media</th>
                <th class="text-center">Jenis Media</th>
                <th class="text-center">Jenis Pesanan</th>
                <th class="text-center">Jumlah Pesanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Total Transfer</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tvs as $tv)
                <tr>
                    <td class="text-center">{{$tv->id}}</td>
                    <td class="text-center">{{$tv->nama_media}}</td>
                    <td class="text-center">{{$tv->jenis_media}}</td>
                    <td class="text-center">{{$tv->jenis_pesanan}}</td>
                    <td class="text-center">{{$tv->jumlah_pesanan}}</td>
                    <td class="text-center">{{formatRupiah($tv->harga)}}</td>
                    <td class="text-center">{{$tv->satuan}}</td>
                    <td class="text-center">{{formatRupiah($tv->total_transfer)}}</td>
                    <td class="text-center">{{formatRupiah($tv->jumlah)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>