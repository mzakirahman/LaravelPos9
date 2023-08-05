<!-- resources/views/penyerahans/create.blade.php -->

@extends('layout.main')

@section('judul', 'Form Penyerahan Pemesanan')

@section('isi')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('penyerahans.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul_surat">Judul Surat:</label>
                            <input type="text" name="judul_surat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="text" name="link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lampiran">Lampiran:</label>
                            <input type="file" class="form-control-file" name="lampiran" id="lampiran">
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Surat:</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
