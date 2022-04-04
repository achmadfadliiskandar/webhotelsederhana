<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{asset('gambarhotel/IndigoShine.jpg')}}">

    <title>IndigoShine-Hotel</title>
    </head>
<body>
    
    <!-- navbar -->
    {{-- @include('templatelandingpage.navbar') --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">IndigoShine</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </ul>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user()->role == 'tamu')
                        <a class="nav-link" href="/tamu.home">Dashboard Tamu</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if (Auth::user()->role == 'tamu')
                        <a class="nav-link" href="/tamu/buktibooking">Cetak Pembayaran</a>
                        @endif
                    </li>
            </ul>
        </div>
    </nav>
    <!-- end navbar -->

    <div class="container mt-5 mb-5 pt-5 pb-5">
        <h1 class="text-center">Dashboard</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h2>Welcome User : {{Auth::user()->name}}</h2>
        <h4>Email : {{Auth::user()->email}}</h4>
        <hr>
        <h2 class="text-center py-3">Pesanan Kamar Anda </h2>
        <div class="container-fluid">
            <div style="overflow-x: auto;">
                <table style="width: 100%;" class="table table-bordered table table-striped table table-hover">
                    <thead>
                    <tr>
                        {{-- <th scope="col">Kode Booking</th> --}}
                        <th scope="col">Kode Kamar</th>
                        <th scope="col">Detail Kamar</th>
                        <th scope="col">Tanggal Checkin</th>
                        <th scope="col">Tanggal Checkout</th>
                        {{-- <th scope="col">Laporan PDF</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $no => $booking)
                        {{-- first tabel --}}
                        <tr>
                            {{-- <td>{{$booking->kodebooking}}</td> --}}
                            <td>{{$booking->kamar->nokamar}}</td>
                            <td>{{$booking->kamar->tipe_kamar->tipe_kamar}}</td>
                            <td>{{$booking->rencanacheckin}}</td>
                            <td>{{$booking->rencanacheckout}}</td>
                            <td>
                                @if ($booking->deleted_at)
                                    <button class="btn btn-danger" disabled>Batalkan</button>
                                @else
                                
                                {{-- bisa --}}
                                <form action="/welcome/removeorder/{{$booking->id}}" onsubmit="return confirm('apakah yakin ingin membatalkan pesanan kamar ini??');" class="d-inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Batalkan</button>
                                </form>

                                @endif
                            </td>
                        </tr>
                        {{-- end tabel --}}
                        @empty
                            <tr>
                                <td colspan="7" class="text-danger text-center">Anda Belum Memesan Kamar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <hr>
                <h2 class="text-center">Bukti Pembayaran</h2>
                <p class="text-center">bukti yang digunakan untuk melakukan pembayaran saat memesan kamar</p>
                <table class="table table-bordered table table-striped table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Booking</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($kamarorders as $kamarorder)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$kamarorder->booking_kode}}</td>
                        <td>
                            <a href="/tamu/laporanbooking/{{$kamarorder->id}}" target="_blank" class="btn btn-info">Laporan Pdf</a>
                        </td>
                        </tr>
                    @empty
                        <td class="text-danger text-center" colspan="3">Anda Belum Mempunyai Bukti Ke Hotel</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('templatelandingpage.footer')
    <!-- end footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </body>
</html>

<!-- css -->
<style>
    .navbar{
        background-color: #4b0082;
    }
    .footer{
        height: 100px;
        background-color: #4b0082;
    }
    .btn-primary{
        background-color: #4b0082;
        color: whitesmoke;
        border: #4b0082;
    }
    .btn-primary:hover{
        background-color: #4b0082;
        color: whitesmoke;
        border: #4b0082;
    }
</style>
<!-- end css -->