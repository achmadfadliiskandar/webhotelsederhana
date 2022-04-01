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
        <h1 class="text-center py-3">Cetak Bukti Pembayaran</h1>
        <p class="text-center">silahkan cetak bukti pembayaran untuk bukti pembayaran di hotel</p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container-fluid">
            <form action="/tamu/insertbooking" method="POST">
                @csrf
                {{-- <div class="mb-3">
                    <label for="booking_kode" class="form-label">Kode Booking</label>
                    <input type="text" class="form-control" id="booking_kode" name="booking_kode" value="{{$booking->bookingkode}}">
                </div> --}}
                <table class="table table-bordered table table-striped table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kamar Yang di booking</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($bookings as $booking)
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <select class="form-select" aria-label="Default select example">
                                    <option selected value="{{$booking->id}}">{{$booking->kamar->tipe_kamar->tipe_kamar}}</option>
                                    </select>
                                </td>
                            @empty
                                <td class="text-center text-danger" colspan="2">Anda Belum Memesan Kamar</td>
                            @endforelse
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary w-100">Cetak Bukti</button>
            </form>
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