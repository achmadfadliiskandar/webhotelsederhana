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
            <form>
                <div class="mb-3">
                    <label for="tanggal_rencanacheckin" class="form-label">Tanggal Checkin</label>
                    <input type="date" class="form-control" id="tanggal_rencanacheckin" name="tanggal_rencanacheckin">
                </div>
                <div class="mb-3">
                    <label for="tanggal_rencanacheckout" class="form-label">Tanggal Checkout</label>
                    <input type="date" class="form-control" id="tanggal_rencanacheckout" name="tanggal_rencanacheckout">
                </div>
                <div class="mb-3">
                    <label for="hargakamar" class="form-label">Harga Kamar</label>
                    <input type="number" class="form-control" value="{{$kamars->hargakamarpermalam}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="lama_menginap" class="form-label">Lama Menginap</label>
                    <input type="number" class="form-control" id="lama_menginap" name="lama_menginap">
                </div>
                <div class="mb-3">
                    <label for="jumlah_penginap" class="form-label">Jumlah Penginap</label>
                    <input type="number" class="form-control" id="jumlah_penginap" name="jumlah_penginap">
                    <small>Jumlah Orang Yang menginap di kamar</small>
                </div>
                <div class="mb-3">
                    <label for="dp_dibayar">Jika ingin melakukan dp</label>
                <input type="checkbox" id="dp_dibayar" onclick="IfDibayar()">
                <input type="number" class="form-control" value="0" style="display: none;" id="forms" name="dp_dibayar">
                </div>
                <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                </form>
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