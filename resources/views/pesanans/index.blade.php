@extends('layout.main')

@section('judul')
    Surat Balasan Kesanggupan
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
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center text-left">Judul Surat</th>
                                <th class="text-center text-left">Isi Surat</th>
                                <th class="text-center text-left" style="width: 150px;">Tanggal Surat</th>
                                <th class="text-center text-left">Wartawan Pengirim</th>
                                <th class="text-center">Lampiran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanans as $pesanan)
                            <tr>
                                <td class="text-center text-left">{{ $pesanan->judul_surat }}</td>
                                <td class="text-center text-left">{{ $pesanan->isi_surat }}</td>
                                <td class="text-center text-left">{{ $pesanan->tanggal }}</td>
                                <td class="text-center text-left">{{ $pesanan->pengirim->username }}</td>
                                <td class="text-center text-left">
                                    @if ($pesanan->lampiran)
                                    <a href="{{ asset('storage/' . $pesanan->lampiran) }}">Download Lampiran</a>
                                    @else
                                    Tidak Ada Lampiran
                                    @endif
                                </td>
                                <td class="text-center text-left">
                                    <!-- Tambahkan tombol "Delete" -->
                                    <form action="/pesanans/{{ $pesanan->id }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                        @method("DELETE")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pesanans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
