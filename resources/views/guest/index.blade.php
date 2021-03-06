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
    <!-- jumbotron -->
    <div class="container-fluid" id="gambarhotel">
        <div class="jumbotron">
            <div class="container-fluid text-dark p-5">
            <div class="container p-5">
                <div class="row">
                    <div class="col-lg-12 text-light">
                        <h1 class="display-4 fw-bold shadow">Halaman Pemesanan Tanpa Akun</h1>
                        <hr>
                        <h3 class="display-4 fw-bold shadow">Accountless Order Page</h3>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- end jumbotron -->
    <div class="container mt-5 pt-3">
        <h1 class="text-center">Guest Order</h1>
        <p class="text-center">Order Khusus Pengguna yang tidak memiliki akun</p>
        @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
        @endif
        <form action="/guestorder/" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="kata-kunci" placeholder="silahkan cari kodebooking anda">
            <button class="btn btn-outline-secondary text-capitalize" type="submit" id="button-addon2">cari</button>
        </form>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
            </div>
        @endif --}}
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
        {{-- <div class="alert alert-danger"><strong style="text-transform: capitalize;">note</strong>: untuk yang tidak memiliki akun</div> --}}
        <div style="overflow-x:auto">
            <form action="/insertpdf/store" method="post">
                @csrf
            @if (isset($guests))
            <table id="example" class="table table-striped table table-hover table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Checklist</th>
                        <th>Nama</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (count($guests) > 0)
                    @forelse ($guests as $guest)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if ($guest->kodeupdate == null)
                                <input class="form-check-input mt-0" type="checkbox" value="{{$guest->id}}" name="guest_bookings_id[]" disabled>
                                @elseif($guest->konfirmasi == "DONE")
                                <span class="text-danger">Done</span>
                                {{-- <input class="form-check-input mt-0" type="checkbox" value="{{$guest->id}}" name="guest_bookings_id[]" disabled> --}}
                                @else
                                <input class="form-check-input mt-0" type="checkbox" value="{{$guest->id}}" name="guest_bookings_id[]">
                                @endif
                            </td>
                            <td>{{$guest->nama}}</td>
                            <td>{{$guest->nomortelpon}}</td>
                            <td>{{$guest->email}}</td>
                            <td>{{$guest->kamar->tipe_kamar->tipe_kamar}}</td>
                            <td>
                                {{-- <form action="" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Batalkan</button>
                                </form> --}}
                                @if ($guest->konfirmasi == "DONE")
                                <span class="text-danger">Done</span>
                                @else
                                <button type="button" class="btn btn-success konfirmasi" value="{{$guest->id}}">
                                    Konfirmasi
                                </button>
                                <button type="button" class="btn btn-danger cancelorder" value="{{$guest->id}}">
                                    Batalkan
                                </button>
                                @endif
                            </td>
                        @empty
                            <td colspan="8" class="text-danger text-center text-capitalize">tidak ada data</td>
                        @endforelse
                    </tr>
                    @else
                    <div class="alert alert-danger">Maaf yang anda cari tidak ada</div>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Checklist</th>
                        <th>Nama</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-primary my-3 w-100" style="background-color: #123456;">Cetak Pdf</button>
            @endif
        </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="/cancel-guest/" method="post">
                    @csrf
                    @method('DELETE')
                    <p>Apa Kamu yakin membatalkan order ini ? </p>
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="mb-3" style="display: none;">
                        <label for="kodebooking">Kode Booking</label>
                        <input type="hidden" name="kodebooking" id="kodebooking" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="kodedelete">Kode Delete</label>
                        <input type="text" name="kodedelete" required id="kodedelete" class="form-control">
                        <small>pakai kode booking anda untuk menghapus order anda</small>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Batalkan Sekarang</button>
                </form>
                </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="/kode-update/" method="post">
                    @csrf
                    @method('PATCH')
                    <p>Nama : <strong id="nama"></strong> </p>
                    <input type="hidden" name="id" id="id_s" class="form-control">
                    <div class="mb-3" style="display: none;">
                        <label for="kodebooking">Kode Booking</label>
                        <input type="hidden" name="kodebooking" id="kodebookings" class="form-control kodebooking">
                    </div>
                    <div class="mb-3">
                        <label for="kodeupdate">Kode Update</label>
                        <input type="text" name="kodeupdate" required id="kodeupdate" class="form-control">
                        <small>pakai kode booking anda untuk mengkonfirmasi order an anda</small>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Konfirmasi Sekarang</button>
                </form>
                </div>
                </div>
                </div>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
            $(document).on('click','.cancelorder', function () {
                var id = $(this).val();
                // alert(id);
                $('#exampleModal').modal('show');
                $('#id').val(id);
                $.ajax({
                    type: "GET",
                    url: "/get-cancel/" + id,
                    success: function (response) {
                        $("#kodebooking").val(response.guest.kodebooking)
                    }
                });
            });
            $(document).on('click','.konfirmasi',function(){
                var id_s = $(this).val();
                // alert(id);
                $('#confirmationModal').modal('show')
                $('#id_s').val(id_s);
                $.ajax({
                    type: "GET",
                    url: "/get-konfirmasi/" + id_s,
                    success: function (response) {
                        $("#nama").text(response.guest.nama)
                        $("#kodebookings").val(response.guest.kodebooking)
                    }
                });
            })
        });
    </script>

    </body>
</html>
<style>
    .navbar{
        background-color: #4b0082;
    }
    #gambarhotel{
        background-image: url('/gambarhotel/halamanhotel2.jpg');
        background-repeat: no-repeat;
        /* background-size: auto; */
        background-size: 100% 100%;
        text-shadow: 2px 2px #4b0082;
    }
    .footer{
        margin-top: 30px;
        margin-bottom: 30px;
        height: 100px;
        background-color: #4b0082;
        position: absolute;
        /* bottom: 0; */
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

