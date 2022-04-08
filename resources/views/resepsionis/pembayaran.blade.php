@extends('template.master')

@section('title','Pembayaran')

@section('active','Pembayaran')

@section('content')
<h2>Pembayaran</h2>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container" style="overflow-x:auto">
<table class="table table-hover table table-striped table table-bordered" id="pembayaran">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Booking Kode</th>
            <th scope="col">Kembalian</th>
            <th scope="col">Jumlah Dibayar</th>
            <th scope="col">Total Harga</th>
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
                    <input type="text" class="form-control" name="kembalian" value="{{$item->kembalian}}" readonly>
                </td>
                <td>
                    <input type="number" class="form-control" name="jumlahdibayar" value="{{$item->jumlahdibayar}}">
                </td>
                <td>
                    @php
                    $hargas = 0;
                    @endphp
                    @foreach ($item->detailkamarorder as $item)
                    @php
                    $hargas += $item->totalharga;
                    @endphp
                    @endforeach
                    {{-- {{number_format($hargas,-2,".",".")}} --}}
                    <input type="number" class="form-control" name="totalharga" value="{{$hargas}}" readonly>
                </td>
                <td>
                    <select name="metodepembayaran" class="form-control" id="metodepembayaran">
                        <option value="" disabled>{{$item->metodepembayaran}}</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </td>
                <td>
                    {{-- {{"status belum terkonfirmasi"}} --}}
                    <select name="status" class="form-control" id="metodepembayaran">
                        <option value="" disabled>{{$item->statuspembayaran}}</option>
                        <option value="confirmed">Terkonfirmasi</option>
                        <option value="unconfirmed">Tidak Terkonfirmasi</option>
                        <option value="done">Sudah Terkonfirmasi</option>
                    </select>
                </td>
                <td>
                        <button class="btn btn-success" type="submit">Tambahkan Pembayaran</button>
                        <a target="_blank" href="/tamu/laporanbooking/{{$item->kamar_orders_id}}" class="btn btn-danger">PDF</a>
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

@push('datatables')
<script>
$(document).ready(function() {
$('#pembayaran').DataTable();
});
</script>
@endpush