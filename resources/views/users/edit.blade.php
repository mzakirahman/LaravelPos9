@extends('layout.main')

@section('judul')
    From Edit User
@endsection

@section('isi')
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body px-0 pt-0 pb-2">
                <form action="/users/{{ $users->id }}" method="POST">
                    @method('PUT')
            <div class="mb-3">
                 <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->name}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->email}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->username}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->password}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Level</label>
                <input type="number" name="level" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->level}}">
            </div>
            @csrf
            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
        </form>
            </div>
        </div>
    </div>
</div>
@endsection