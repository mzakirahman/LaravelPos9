@extends('layout.main')

@section('judul')
Form Surat Balasan Kesanggupan
@endsection

@section('isi')
<div class="container">
     <div class="row">
        <div class="col-md-8 offset-md-2">
                <div class="card">
            <div class="card-body">
                <form action="/pesanans" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul_surat">Judul Surat:</label>
                        <input type="text" class="form-control" name="judul_surat" id="judul_surat" required>
                    </div>

                    <div class="form-group">
                        <label for="isi_surat">Isi Surat:</label>
                        <textarea class="form-control" name="isi_surat" id="isi_surat" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran:</label>
                        <input type="file" class="form-control-file" name="lampiran" id="lampiran">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kirim Surat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
