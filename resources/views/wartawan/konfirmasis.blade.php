@extends('layout.main')

@section('judul')
    Jadwal Konfirmasi
@endsection

@section('isi')
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
                                <th class="text-center text-left">Pesan</th>
                                <th class="text-center text-left">Tanggal</th>
                                <th class="text-center text-left">Jam</th>
                                <th class="text-center text-left">Action</th>
                            </tr>
                        </thead>
                            <ul>
                               @foreach($konfirmasis as $konfirmasi)
                                <tr>
                                    <td class="text-center text-left">{{ $konfirmasi->pesan }}</td>
                                    <td class="text-center text-left" style="width: 150px;">{{ $konfirmasi->tanggal }}</td>
                                    <td class="text-center text-left">{{ $konfirmasi->jam }}</td>
                                    <td class="text-center text-left">
                                        <form action="/konfirmasis/{{ $konfirmasi->id }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </ul>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection