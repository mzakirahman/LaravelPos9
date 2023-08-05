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
                    @foreach ($tvs as $tv)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{$tv->jenis_media}}</td>
                        <td class="text-center">{{$tv->jenis_pesanan}}</td>
                        <td class="text-center">{{$tv->jumlah_pesanan}}</td>
                        <td class="text-center">{{ formatRupiah($tv->satuan)}}</td>
                        <td class="text-center">{{ formatRupiah($tv->jumlah_pesanan * $tv->satuan) }}</td>
                        <td class="text-center">{{$tv->pajak}}</td>
                        <td class="text-center">{{ formatRupiah($tv->total_transfer)}}</td>
                        <td class="text-center">{{ formatRupiah($tv->jumlah)}}</td>
                        <td class="text-center">{{$tv->tanggal}}</td>
                        <td class="text-center">
                            <div>
                                @if ($tv->lampiran)
                                <a href="{{ asset('storage/' . $tv->lampiran) }}">Bukti Pembayaran</a>
                                @else
                                Tidak ada bukti pembayaran
                                @endif
                            </div>
                            <div>
                                <form action="/wartawan/tvs/{{ $tv->id }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
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
                {{ $tvs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
