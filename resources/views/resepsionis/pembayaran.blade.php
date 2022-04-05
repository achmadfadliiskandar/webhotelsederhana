@extends('template.master')

@section('title','Pembayaran')

@section('active','Pembayaran')

@section('content')
<h2>Pembayaran</h2>
<div class="container" style="overflow-x:auto">
<table class="table table-hover table table-striped table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Booking Kode</th>
            <th scope="col">Jumlah Dibayar</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Kembalian</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status Pembayaran</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($kamarorders as $item)
        <form action="/resepsionis.payment/{{$item->id}}" method="POST">
            @csrf
            @method('PUT')
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->booking_kode}}</td>
                <td>
                    <input type="number" class="form-control" name="jumlahdibayar" value="{{$item->jumlahdibayar}}">
                </td>
                <td>
                    <input type="number" class="form-control" name="totalharga" value="{{$item->totalharga}}" readonly>
                </td>
                <td>
                    <input type="number" class="form-control" name="kembalian" value="{{$item->kembalian}}" readonly>
                </td>
                <td>
                    <select name="metodepembayaran" class="form-control" id="metodepembayaran">
                        <option value="">{{$item->metodepembayaran}}</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </td>
                <td>
                    {{-- {{"status belum terkonfirmasi"}} --}}
                    <select name="statuspembayaran" class="form-control" id="metodepembayaran">
                        <option value="">{{$item->statuspembayaran}}</option>
                        <option value="confirmed">Terkonfirmasi</option>
                        <option value="unconfirmed">Tidak Terkonfirmasi</option>
                        <option value="done">Sudah Terkonfirmasi</option>
                    </select>
                </td>
                <td>
                        <button class="btn btn-success" type="submit">Tambahkan Pembayaran</button>
                        <a target="_blank" href="/tamu/laporanbooking/{{$item->id}}" class="btn btn-danger">PDF</a>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-danger text-center">Tidak ada Pembayaran</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection