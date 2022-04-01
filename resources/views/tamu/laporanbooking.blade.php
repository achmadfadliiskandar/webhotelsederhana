<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kode Bukti Pembayaran : {{$kamarorder->booking_kode}}</title>
</head>
<body>
    <h1 class="judul">Bukti Pembayaran : {{$kamarorder->user->name}}</h1>
    <p class="kalimat2">Jagalah Kartu / PDF ini jangan sampai hilang sebagai bukti untuk pemesanan kamar</p>
    <div class="buktipesan">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kamar Yang di pesan</th>
                <th scope="col">Tanggal Checkin</th>
                <th scope="col">Tanggal Checkout</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                @foreach ($kamarorder->detailkamarorder as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->bookings->kamar->tipe_kamar->tipe_kamar}}</td>
                        <td>{{$item->tanggal_checkin}}</td>
                        <td>{{$item->tanggal_checkout}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pembayaran">
        <h2 class="judul">Detail Pembayaran</h2>
        <p class="kalimat2">informasi mengenai pembayaran ada di bawah ini</p>
        <ul>
            @foreach ($kamarorder->detailkamarorder as $item)
            <li class="first">Nama Kamar : {{$item->bookings->kamar->tipe_kamar->tipe_kamar}}</li>
            <li>Harga Kamar Per Malam : {{number_format($item->bookings->kamar->hargakamarpermalam,-2,".",".")}}</li>
            <li>Lama Menginap : {{$item->bookings->lama_menginap}}</li>
            <li>Dp : {{number_format($item->bookings->dp_dibayar,-2,".",".")}}</li>
            <li>Total Harga : {{number_format($item->bookings->totalharga,-2,".",".")}}</li>
            @endforeach 
        </ul>
    </div>
    <h3 class="judul">Total Keseluruhan yang harus di bayarkan : {{number_format($item->bookings->totalharga,-2,".",".")}}</h3>
</body>
</html>

<style>
    .judul{
        font-family:Arial, Helvetica, sans-serif;
        text-align: center;
    }
    .kalimat2{
        text-align: center;
        font-family:Arial, Helvetica, sans-serif;
    }
    .buktipesan{
        overflow-x:auto; 
    }
    .table{
        text-align: center;
        /* border: 1px solid black; */
        /* width: 100%; */
        height: 100px;
        font-family:Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    tr:nth-child(even) {
    background-color: #dddddd;
    }
    td , th{
        padding: 8px;
    }
    th{
        border: 1px solid black;
    }
    td{
        border: 1px solid black;
    }
    ul{
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    ul li {
        border: 1px solid #ddd;
        margin-top: -1px;
        background-color: #f6f6f6;
        padding: 12px;
    }
    .first{
        background-color: #4adeae;
    }
</style>