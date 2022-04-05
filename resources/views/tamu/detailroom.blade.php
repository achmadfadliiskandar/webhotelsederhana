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
    @include('templatelandingpage.navbar')
    <!-- end navbar -->

    <div class="container mt-5 mb-5 pt-5 pb-5">
        <div class="row">
            <h1 class="text-center">Informasi Kamar</h1>
            <p class="text-center">Agar User / tamu mengetahui informasi dan fasilitas2 yang ada di kamar</p>
            <div class="col-sm-6">
                <div class="card" style="width: 100%;">
                    <img src="{{asset('image/'.$kamars->image)}}" class="card-img-top" alt="gambar kosong">
                </div>
            </div>
            <div class="col-sm-6">
                <h2>Kode Kamar : {{$kamars->nokamar}}</h2>
                <h4>Tipe Kamar : {{$kamars->tipe_kamar->tipe_kamar}}</h4>
                <h3>Jumlah Max orang di kamar : {{$kamars->jumlahorangperkamar}}</h3>
                <h3>Harga Kamar Per malam : {{number_format($kamars->hargakamarpermalam,-2,".",".")}}</h3>
                <h4>Fasilitas Kamar : </h4>
                    <table class="table table-bordered table table-striped table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Fasilitas</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($kamars->detailkamar as $fasilitas)
                            @php
                                $fasilitas = $fasilitass->where('id',$fasilitas->fasilitas_id)->first(); 
                            @endphp
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$fasilitas->namafasilitas}}</td>
                        </tr>
                        @empty
                        <td><div class="alert alert-danger">Fasilitas Kamar tidak ada</div></td>
                    @endforelse
                    </tbody>
                    </table>
            </div>
            <div class="col-sm-12 my-3">
                <h2 class="text-center">Silahkan Pesan Kamar di bawah ini</h2>
                @if (empty(Auth::user()->name))
                <div class="alert alert-danger">silahkan login && register jika ingin memesan kamar</div>
                @else
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
                @endif
                @if ($kamars->status == 'tersedia')
                <form action="/welcome/addorder" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rencanacheckin" class="form-label">Tanggal Checkin</label>
                        <input type="date" class="form-control @error('rencanacheckin') is-invalid @enderror" id="rencanacheckin" name="rencanacheckin" value="{{old('rencanacheckin')}}">
                        @error('rencanacheckin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-none">
                        <label for="kamar_id" class="form-label">Kamar Id</label>
                        <input type="number" class="form-control @error('kamar_id') is-invalid @enderror" id="kamar_id" readonly name="kamar_id" value="{{$kamars->id}}">
                        @error('kamar_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rencanacheckout" class="form-label">Tanggal Checkout</label>
                        <input type="date" class="form-control @error('rencanacheckout') is-invalid @enderror" id="rencanacheckout" name="rencanacheckout" value="{{old('rencanacheckout')}}">
                        @error('rencanacheckout')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="hargakamar" class="form-label">Harga Kamar</label>
                        <input type="number" class="form-control" value="{{$kamars->hargakamarpermalam}}" readonly>
                    </div>
                    <label for="lama_menginap" class="form-label">Lama Menginap</label>
                    <div class="input-group mb-3">
                        <input type="number" readonly class="form-control @error('lama_menginap') is-invalid @enderror" id="lama_menginap" name="lama_menginap" value="{{old('lama_menginap')}}">
                        <button class="btn btn-outline-secondary" type="button" onclick="lamaMenginap();">klik untuk mengetahui lama menginap anda</button>
                        @error('lama_menginap')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <small>lama anda menginap adalah : <b id="jmlhari"></b> hari</small>
                    <div class="mb-3 mt-3">
                        <label for="jumlah_penginap" class="form-label">Jumlah Penginap</label>
                        <input type="number" class="form-control @error('jumlah_penginap') is-invalid @enderror" id="jumlah_penginap" name="jumlah_penginap" value="{{old('jumlah_penginap')}}">
                        <small>Jumlah Orang Yang menginap di kamar</small>
                        @error('jumlah_penginap')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="dp_dibayar">Jika ingin melakukan dp</label>
                    <input type="checkbox" id="dp_dibayar" onclick="IfDibayar()">
                    <input type="number" class="form-control" value="0" style="display: none;" id="forms" name="dp_dibayar">
                    </div>
                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                    <a href="/" class="btn btn-danger">Back</a>
                    </form>
                @else
                <div class="alert alert-danger">Kamar Tidak Tersedia</div>
                <a href="/" class="btn btn-danger">Back</a>
                @endif
                @endif
                @guest
                <a href="/" class="btn btn-danger">Back</a>
                @endguest
            </div>
        </div>
        </div>
    </div>

    <script>
        function IfDibayar(){
            // alert("testing")
            var checkBox = document.getElementById("dp_dibayar");
            var forms = document.getElementById("forms");
            if (checkBox.checked == true) {
                forms.style.display = "block";
            } else {
                forms.style.display = "none";
            }
        }
        function lamaMenginap(){
            var rencanacheckin = document.getElementById("rencanacheckin").value;
            var rencanacheckout = document.getElementById("rencanacheckout").value;
            const tanggaldatang = new Date(rencanacheckin);
            const tanggalpulang = new Date(rencanacheckout);
            const waktu = Math.abs(tanggalpulang - tanggaldatang);
            const hari = Math.ceil(waktu / (1000 * 60 * 60 * 24));
            document.getElementById("lama_menginap").value = hari;
            document.getElementById("jmlhari").innerHTML = hari;
            if (isNaN(hari)) {
                // console.log("ini angka nol");
                document.getElementById("jmlhari").innerHTML = 0;
            } else {
                // console.log("ini bukan angka nol")
                document.getElementById("jmlhari").innerHTML = hari;
            }
            // console.log(hari);
        }
    </script>

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