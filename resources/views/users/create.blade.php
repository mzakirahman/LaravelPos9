@extends('layout.main')

@section('judul')
    Tambah User
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="level">Level:</label>
                    <input type="number" name="level" class="form-control" required max="3">
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan User</button>
            </form>
        </div>
    </div>
@endsection
