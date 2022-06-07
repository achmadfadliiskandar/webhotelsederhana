<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran : {{$guestpdf->guest->nama}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    h2{
        font-weight: 500;
        font-size: 50px;
    }
</style>
<body style="font-family:Arial, Helvetica, sans-serif">
    <h2 style="text-transform:uppercase;color:#4b0082;">invoice</h2>
    {{-- <br> --}}
    <hr>
    <p>Alamat : Jalan Kopo No 27 Beji Depok</p>
    <p>Kode Pos : 16412</p>
    <p>Email : <a href="indigo@gmail.com">indigo@gmail.com</a></p>
    <p>Website : <a href="https://webhotelbelajar.achmadf1.my.id/" target="_blank">https://webhotelbelajar.achmadf1.my.id/</a></p>
    <span style="float: right;margin-top:-150px;margin-right:77px;">Nama Pemesan : {{$guestpdf->guest->nama}}</span>
    <br>
    <span style="float: right;margin-right:-10px;margin-top:-150px;">Email Pemesan : {{$guestpdf->guest->email}}</span>
    <br>
    <span style="float: right;margin-right:85px;margin-top:-150px;">Kode Invoice : {{$guestpdf->kodebooking}}</span>
    <br>
    <span style="float: right;margin-right:-30px;margin-top:-150px;">Tanggal Order : {{$guestpdf->guest->created_at}}</span>
    <br>
    <span style="float: right;margin-right:-30px;margin-top:-150px;">Due Date : {{$guestpdf->updated_at}}</span>
    <h3>Informasi Kamar</h3>
    <div class="alert alert-info">Bawalah Bukti Ini pada saat checkin dan disarankan datang saat hari menginap tiba</div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Nama Kamar</th>
            <th scope="col">Harga Kamar</th>
            <th scope="col">Lama Menginap</th>
            <th scope="col">Total Harga</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {{-- <td>{{$loop->iteration}}</td> --}}
            <td>{{$guestpdf->guest->kamar->tipe_kamar->tipe_kamar}}</td>
            <td>{{number_format($guestpdf->guest->kamar->hargakamarpermalam)}}</td>
            <td>{{$guestpdf->guest->lama_menginap}}</td>
            <td>{{number_format($guestpdf->guest->totalharga)}}</td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1">Tanggal Menginap : {{$guestpdf->guest->rencanacheckin}}</td>
                <td colspan="1">Tanggal Keluar : {{$guestpdf->guest->rencanacheckout}}</td>
                <td colspan="2">Keterangan : 
                @if ($guestpdf->guest->rencanacheckin < date('Y-m-d'))
                pdf / bukti ini sudah tidak berlaku
                @else
                pdf / bukti ini masih berlaku
                @endif</td>
            </tr>
        </tfoot>
    </table>
    <div class="card" style="width: 100%;">
        <div class="card-header">
            Informasi Pembayaran
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Total Yang Harus Di bayarkan : {{number_format($guestpdf->guest->totalharga)}}</li>
        <li class="list-group-item text-capitalize">dibayar : </li>
        <li class="list-group-item">kembalian : </li>
        <li class="list-group-item">keterangan : </li>
        <li class="list-group-item">metode pembayaran : </li>
    </ul>
    </div>
</body>
</html>