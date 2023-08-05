<!-- resources/views/konfirmasis/create.blade.php -->

@extends('layout.main')

@section('judul')
    Jadwal Konfirmasi Wartawan
@endsection

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    
                        <form action="/konfirmasis" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="wartawan_id">Wartawan Tujuan</label>
                            <select class="form-control" id="wartawan_id" name="wartawan_id">
                                @foreach($wartawans as $wartawan)
                                    <option value="{{ $wartawan->id }}">{{ $wartawan->username}}</option>
                                @endforeach
                            </select>
                        </div>
                         <!-- Form Input untuk Tanggal -->
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>

                        <!-- Form Input untuk Jam -->
                        <div class="form-group">
                            <label for="jam">Jam</label>
                            <input type="time" name="jam" id="jam" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                        </form>
                
                </div>
            </div>
        </div>
    </div>
@endsection
