@extends('layout.main')

@section('judul')
    Detail Surat Pesanan
@endsection

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Surat Pesanan</h5>
                </div>
            </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>Judul Surat:</strong>
                        <p>{{ $pesanans->judul_surat }}</p>
                        <hr>   
                    </div>
                    <div class="mb-3">
                        <strong>Isi Surat:</strong>
                        <p>{{ $pesanans->isi_surat }}</p>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal:</strong>
                        <p>{{ $pesanans->tanggal }}</p>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <strong>Pengirim:</strong>
                        <p>{{ $pesanans->pengirim }}</p>
                        <hr>
                    </div>    

                    @if ($pesanans->lampiran)
                        <div class="mb-3">
                            <strong>Lampiran:</strong>
                            <p>
                            <a href="{{ asset('storage/'.$pesanans->lampiran) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-file-download"></i> Lihat Lampiran
                            </a>
                            </p>
                        </div>
                    @else
                        <p><strong>Tidak Ada Lampiran</strong></p>
                        <hr>
                    @endif
                     
                </div>
            </div>
        </div>
    </div>
@endsection
