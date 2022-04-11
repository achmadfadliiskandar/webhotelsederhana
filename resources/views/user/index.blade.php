@extends('template.master')

@section('title','Data User')

@section('active', 'Data User')

@section('content')
<h2>Data User</h2>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<a href="/user.create" class="my-3 btn btn-primary">Tambah User</a>
<div class="container">
<table class="table table-bordered table table-hover table table-striped">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection