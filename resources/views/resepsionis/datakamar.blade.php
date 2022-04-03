@extends('template.master')

@section('title','Data Kamar')

@section('active','Data Kamar')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <h2>Data Kamar</h2>
    </div>
    {{-- <div class="col-sm-6">
        <form action="/resepsionis/datakamar/cari" method="GET">
        <input type="text" class="form-control" value="{{old('cari')}}">
        <input type="submit" class="btn btn-success w-100" value="Cari">
        </form>
    </div> --}}
</div>
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div style="overflow-x:auto;">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Kamar</th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Jumlah Orang - kamar</th>
            <th scope="col">Status</th>
            <th scope="col">Harga Kamar</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @if ($kamars->count())
            @foreach ($kamars as $kamar)
            <form action="/kamar.updatestatus/{{$kamar->id}}" class="d-inline-block" method="POST">
                @csrf
                @method('PUT')
            <tr class="table table-secondary table table-bordered table table-striped">
                <td>{{$loop->iteration}}</td>
                <td>{{$kamar->nokamar}}</td>
                <td>{{$kamar->tipe_kamar->tipe_kamar}}</td>
                <td>{{$kamar->jumlahorangperkamar}}</td>
                <td>
                    <select name="status" id="" class="form-control">
                        <option value="tersedia">{{$kamar->status}}</option>
                        <option value="tidak_tersedia" class="form-control">Tidak Tersedia</option>
                    </select>
                </td>
                {{-- <td><img src="{{asset('/image/'.$kamar->image)}}" alt=""></td> --}}
                <td>{{number_format($kamar->hargakamarpermalam,-2,".",".")}}</td>
                <td>
                        <button type="submit" class="btn btn-success">Ubah Status Kamar</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" class="text-center bg-light text-danger">Kamar Tidak ada</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
</div>
@endsection