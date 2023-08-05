
@extends('layout.main')

@section('judul', 'Surat Pemesanan')

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
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('surats.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center text-left">Nama Media</th>
                                <th class="text-center text-left">Subjek</th>
                                <th class="text-center text-left">Isi</th>
                                <th class="text-center text-left">Lampiran</th>
                                <th class="text-center text-left">Tanggal Surat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surats as $surat)
                                <tr>
                                    <td class="text-center text-left">{{ $surat->nama_media }}</td>
                                    <td class="text-center text-left">{{ $surat->subjek }}</td>
                                    <td class="text-center text-left">{{ $surat->isi }}</td>
                                    <td class="text-center text-left">
                                        @if ($surat->lampiran)
                                            <a href="{{ asset('storage/' . $surat->lampiran) }}">Download Lampiran</a>
                                        @else
                                            Tidak Ada Lampiran
                                        @endif
                                    </td>
                                    <td class="text-center text-left">{{ $surat->tanggal }}</td>
                                    <td class="text-center text-left">
                                        <!-- Tambahkan tombol "Delete" -->
                                        <form action="{{ route('surats.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $surats->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
