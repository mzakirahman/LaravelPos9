<!-- resources/views/surats/create.blade.php -->

@extends('layout.main')

@section('judul', 'Form Surat Pemesanan')

@section('isi')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('surats.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="wartawan_id">Dikirim kewartawan:</label>
                            <select name="wartawan_id" class="form-control">
                                @foreach ($wartawans as $wartawan)
                                    <option value="{{ $wartawan->id }}">{{ $wartawan->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_media" class="form-label">Nama Media</label>
                            <input type="text" name="nama_media" class="form-control" id="nama_media" aria-describedby="emailHelp">
                        </div>  
                        <div class="form-group">
                            <label for="subjek">Subjek:</label>
                            <input type="text" name="subjek" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi:</label>
                            <textarea name="isi" rows="4" class="form-control"></textarea>
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
