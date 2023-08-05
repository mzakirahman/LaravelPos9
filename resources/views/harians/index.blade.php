
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

    /* CSS untuk menempatkan tombol dalam satu baris */
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center; /* Menengahkan tombol */
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Media Cetak Harian</h4>
            <div class="d-flex">
                <form class="d-flex" action="{{ route('harians.search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" style="font-size: 10px;">
                        <button class="btn btn-primary btn-sm" type="submit" style="font-size: 10px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('harians.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <!-- /.card-body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Media</th>
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
                            <td class="text-center">{{ $harian->id }}</td>
                            <td class="text-center">{{ $harian->nama_media }}</td>
                            <td class="text-center">{{ $harian->jenis_media }}</td>
                            <td class="text-center">{{ $harian->jenis_pesanan }}</td>
                            <td class="text-center">{{ $harian->jumlah_pesanan }}</td>
                            <td class="text-center">{{ formatRupiah($harian->satuan) }}</td>
                            <td class="text-center">{{ formatRupiah($harian->harga) }}</td>
                            <td class="text-center">{{ $harian->pajak }}</td>
                            <td class="text-center">{{ formatRupiah($harian->total_transfer) }}</td>
                            <td class="text-center">{{ formatRupiah($harian->jumlah) }}</td>
                            <td class="text-center">{{ $harian->bulan }}</td>
                            <td class="text-center">
                                @if ($harian->lampiran)
                                    <a href="{{ asset('storage/' . $harian->lampiran) }}">Download Lampiran</a>
                                @else
                                    Tidak Ada Lampiran
                                @endif
                                <div class="action-buttons">
                                    <a href="{{ route('harians.edit', $harian->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('harians.destroy', $harian->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                        @method('DELETE')
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
