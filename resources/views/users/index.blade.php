@extends('layout.main')

@section('judul')
    
@endsection

@section('isi')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5>User</h5>
            <div class="d-flex">
                <form class="d-flex" action="{{ route('users.search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" style="font-size: 10px;">
                        <button class="btn btn-primary btn-sm" type="submit" style="font-size: 10px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        
                        <th class="text-center text-left">Nama</th>
                        <th class="text-center text-left">Email</th>
                        <th class="text-center text-left">Username</th>
                        <th class="text-center text-left">Password</th>
                        <th class="text-center text-left">Level</th>
                        <th class="text-center text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        
                        <td class="text-center text-left">{{ $user->name }}</td>
                        <td class="text-center text-left">{{ $user->email }}</td>
                        <td class="text-center text-left">{{ $user->username }}</td>
                        <td class="text-center text-left">{{ $user->password }}</td>
                        <td class="text-center text-left">{{ $user->level }}</td>
                        <td class="text-center text-right">
                            <a href="/users/{{ $user->id }}/edit" class="btn btn-success">Edit</a>
                            <form action="/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>       
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        
        </div>
    </div>
</div>
@endsection
