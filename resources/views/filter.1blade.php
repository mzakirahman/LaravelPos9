<!-- resources/views/filter.blade.php -->

@extends('layout.main')

@section('judul')
    
@endsection

@section('isi')
<div style="text-align: center;">
    <h3>Filter Rekap Media berdasarkan Tanggal</h3>
    <<form action="{{ route('report') }}" method="GET">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required>
        <button type="submit">Filter</button>
    </form>
</div>
@endsection
