@extends('layout.main')

@section('judul')
    
@endsection

@section('isi')
<style>
    .table {
        width: 100%;
    }

    .table th,
    .table td {
        padding: 8px;
        white-space: nowrap; /* Agar konten tidak pindah ke baris baru */
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Bukti Pembayaran Pemesanan</h4>
            <div class="d-flex">
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Jenis Media</th>
                        <th class="text-center">Jenis Pesanan</th>
                        <th class="text-center">Jumlah Pesanan</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Pajak%</th>
                        <th class="text-center">Total Transfer</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($harians as $harian)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{$harian->jenis_media}}</td>
                        <td class="text-center">{{$harian->jenis_pesanan}}</td>
                        <td class="text-center">{{$harian->jumlah_pesanan}}</td>
                        <td class="text-center">{{ formatRupiah($harian->satuan)}}</td>
                        <td class="text-center">{{ formatRupiah($harian->jumlah_pesanan * $harian->satuan) }}</td>
                        <td class="text-center">{{$harian->pajak}}</td>
                        <td class="text-center">{{ formatRupiah($harian->total_transfer)}}</td>
                        <td class="text-center">{{ formatRupiah($harian->jumlah)}}</td>
                        <td class="text-center">{{$harian->bulan}}</td>
                        <td class="text-center">
                            <div>
                                @if ($harian->lampiran)
                                <a href="{{ asset('storage/' . $harian->lampiran) }}">Bukti Pembayaran</a>
                                @else
                                Tidak ada bukti pembayaran
                                @endif
                            </div>
                            <div>
                                <form action="/wartawan/harians/{{ $harian->id }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $harians->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
