@extends('template.master')

@section('title', 'Data Tamu')

@section('active','Data Tamu')

@section('content')
    <h2>Data Tamu</h2>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="container text-center">
        <div style="overflow-x:auto">
            <table class="table table-bordered table table-hover table table-striped" id="example">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Booking Kode</th>
                    <th scope="col">Tamu</th>
                    <th scope="col">Jumlah Di Bayar</th>
                    <th scope="col">Tanggal Checkin</th>
                    <th scope="col">Tanggal Checkout</th>
                    <th scope="col">Kamar</th>
                    <th scope="col">Harga Kamar</th>
                    <th scope="col">Lama Menginap</th>
                    <th scope="col">Total bayar</th>
                    <th scope="col">Methode Pembayaran</th>
                    <th scope="col">Status Pembayaran</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($kamarorders as $kamarorder)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$kamarorder->booking_kode}}</td>
                    <td>{{$kamarorder->user->name}}</td>
                    <td>
                        <form action="/welcome/datatamu/update/{{$kamarorder->id}}" method="POST">
                            @csrf
                            @method('PUT')
                        @if ($kamarorder->jumlahdibayar == null)
                            {{-- <span class="text-danger">belum di bayar</span> --}}
                            <input type="number" class="form-control" name="jumlahdibayar">
                        @else
                        {{number_format($kamarorder->jumlahdibayar,-2,".",".")}}
                        @endif
                    </td>
                    <td>
                        @foreach ($kamarorder->detailkamarorder as $item)
                            <ol>
                                <li type="number">{{$item->tanggal_checkin}}</li>
                            </ol>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kamarorder->detailkamarorder as $item)
                        <ol>
                            <li>{{$item->tanggal_checkout}}</li>
                        </ol>
                    @endforeach
                    </td>
                    <td>
                        @foreach ($kamarorder->detailkamarorder as $item)
                        <ol>
                            <li>{{$item->kamars->tipe_kamar->tipe_kamar}}</li>
                        </ol>
                    @endforeach
                    </td>
                    <td>
                        @foreach ($kamarorder->detailkamarorder as $item)
                        <ol>
                            <li>{{number_format($item->kamars->hargakamarpermalam,-2,".",".")}}</li>
                        </ol>
                    @endforeach
                    </td>
                    <td>
                        @foreach ($kamarorder->detailkamarorder as $item)
                        <ol>
                            {{$item->lama_menginap}}</li>
                        </ol>
                    @endforeach
                    </td>
                    <td>
                    @php
                        $hargas = 0;
                    @endphp
                    @foreach ($kamarorder->detailkamarorder as $item)
                    @php
                    $hargas += $item->totalharga;
                    @endphp
                    @endforeach
                    @php
                    echo number_format($hargas,-2,".",".");
                    @endphp
                    </td>
                    <td>
                        {{-- <span class="text-danger">belum di bayar</span> --}}
                        <select name="metodepembayaran" class="form-control" id="metodepembayaran">
                            <option value="{{$kamarorder->metodepembayaran}}">{{$kamarorder->metodepembayaran}}</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </td>
                    <td>
                            {{-- {{"status belum terkonfirmasi"}} --}}
                            <select name="status" class="form-control" id="metodepembayaran">
                                <option value="unconfirmed">Tidak Terkonfirmasi</option>
                                <option value="confirmed">Terkonfirmasi</option>
                                <option value="unconfirmed">Tidak Terkonfirmasi</option>
                                <option value="done">Sudah Terkonfirmasi</option>
                            </select>
                    </td>
                    <td>
                            <button class="btn btn-success" type="submit">Tambahkan Pembayaran</button>
                        </form>
                    </td>
                @empty
                    <td class="text-center text-danger">Pesanan Belum Ada</td>
                @endforelse
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('datatables')
<script>
$(document).ready(function() {
$('#example').DataTable();
});
</script>
@endpush