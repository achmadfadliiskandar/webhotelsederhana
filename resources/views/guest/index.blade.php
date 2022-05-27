<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{asset('gambarhotel/IndigoShine.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>Guest Order</title>
    </head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <img src="{{asset('gambarhotel/IndigoShine.jpg')}}" width="30" class="m-2" height="30" class="d-inline-block align-top" alt="">
            <a class="navbar-brand" href="/">IndigoShine</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            {{-- @guest --}}
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#facility">Fasilitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#faq">Faq</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#room">Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#saran">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guestorder">Pemesanan</a>
            </li> --}}
            @guest
            <li class="nav-item">
                <a class="nav-link" href="/login/">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register/">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guestorder/">Pemesanan</a>
            </li>
            @endguest
            {{-- @endguest --}}
            {{-- @auth
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
                            @if (Auth::user()->role == 'admin')
                            <a class="nav-link" href="/admin.admin">Dashboard Admin</a>
                            @endif
                            @if (Auth::user()->role == 'resepsionis')
                            <a class="nav-link" href="/resepsionis.resepsionis">Dasboard Resepsionis</a>
                            @endif
                            @if (Auth::user()->role == 'tamu')
                            <a class="nav-link" href="/tamu.home">Dashboard Tamu</a>
                            @endif
                        </li>
                </ul>
            @endauth --}}
            </ul>
        </div>
        </div>
    </nav>
    <!-- end navbar -->
    <div class="container mt-5 pt-3">
        <h1 class="text-center">Guest Order</h1>
        <p class="text-center">Order Khusus Pengguna yang tidak memiliki akun</p>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        {{-- <div class="alert alert-danger"><strong style="text-transform: capitalize;">note</strong>: untuk yang tidak memiliki akun</div> --}}
        <div class="alert alert-success">Jika Terjadi Kecurangan dalam pemesanan Tolong Sampaikan/Adukan Ke Pihak Hotel silahkan hubungi melalui nomor ini : <strong>081878156894</strong> dan Sertakan bukti berupa vidio ataupun ss </div>
        <div style="overflow-x:auto">
            <table id="example" class="table table-striped table table-hover table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cheklist</th>
                        <th>Nama</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @forelse ($guests as $guest)
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>
                            </td>
                            <td>{{$guest->nama}}</td>
                            <td>{{$guest->nomortelpon}}</td>
                            <td>{{$guest->email}}</td>
                            <td>{{$guest->kamar->tipe_kamar->tipe_kamar}}</td>
                            <td>
                                <form action="" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Batalkan</button>
                                </form>
                            </td>
                        @empty
                            <td colspan="8" class="text-danger text-center text-capitalize">tidak ada data</td>
                        @endforelse
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Cheklist</th>
                        <th>Nama</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- footer -->
    @include('templatelandingpage.footer')
    <!-- end footer -->

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });
    </script>
    </body>
</html>
<style>
    .navbar{
        background-color: #4b0082;
    }
    #gambarhotel{
        background-image: url('gambarhotel/halamanhotel2.jpg');
        background-repeat: no-repeat;
        /* background-size: auto; */
        background-size: 100% 100%;
    }
    .footer{
        height: 100px;
        background-color: #4b0082;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        /* min-height: calc(58vh - 95px);  */
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
<!-- js -->
<!-- end js -->

<!-- datatabels -->
<!-- end datatables -->