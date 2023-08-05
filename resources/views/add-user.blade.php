@extends('layout.main')

@section('judul')
    Konfirmasi
@endsection

@section('isi')
    <h1>Buat Konfirmasi Baru</h1>

<form method="POST" action="{{ route('add.user') }}">
    @csrf
    <label for="name">Nama:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Tambah Pengguna</button>
</form>
@endsection