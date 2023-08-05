<!-- resources/views/penyerahans/index.blade.php -->

@extends('layout.main')

@section('judul', 'Daftar Penyerahan Pemesanan')

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
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center text-left">Judul Surat</th>
                                <th class="text-center text-left">Link</th>
                                <th class="text-center text-left">Tanggal</th>
                                <th class="text-center text-left">Wartawan Pengirim</th>
                                <th class="text-center">Lampiran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyerahans as $penyerahan)
                                <tr>
                                    <td class="text-left">{{ $penyerahan->judul_surat }}</td>
                                    <td class="text-center text-left">{{ $penyerahan->link }}</td>
                                    <td class="text-center text-left">{{ $penyerahan->tanggal }}</td>
                                    <td class="text-center text-left">{{ $penyerahan->pengirim->username }}</td>
                                    <td class="text-center">
                                        @if ($penyerahan->lampiran)
                                            <a href="{{ asset('storage/' . $penyerahan->lampiran) }}">Download Lampiran</a>
                                            @else
                                            Tidak Ada Lampiran
                                            @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Add delete button -->
                                        <form action="{{ route('penyerahans.destroy', $penyerahan->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
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
                    {{ $penyerahans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
