<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{asset('gambarhotel/IndigoShine.jpg')}}">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>IndigoShine-Hotel</title>
    </head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">
    
    <!-- navbar -->
    @include('templatelandingpage.navbar')
    <!-- end navbar -->

    <!-- jumbotron -->
    <div class="container-fluid" id="gambarhotel">
        <div class="jumbotron">
            <div class="container-fluid text-dark p-5">
            <div class="container p-5">
                <div class="row">
                    <div class="col-lg-12 text-light">
                        <h1 class="display-4 fw-bold shadow">Welcome to IndigoShine Hotel</h1>
                        <hr>
                        <p class="shadow text-light">Go to IndigoShine Hotel Website</p>
                        <a href="#about" class="btn btn-primary w-25">About</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- end jumbotron -->

    <!-- about -->
    @include('templatelandingpage.about')
    <!-- end about -->

    <a href="#" class="btn btn-primary" id="buttontop" onclick="buttontop()">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- fasilitas -->
    <section class="facility" id="facility">
        <div class="container">
            <h2 class="text-center">Fasilitas</h2>
            <p class="text-center">Fasiltas umum yang ada di hotel</p>
            <div class="row">
                @foreach($fasilitasumums as $fasilitasumum)
                @if ($fasilitasumum->status == 'tidak_tersedia')
                <div class="col-sm-4 mb-3 mt-3">
                    <div class="card text-white bg-danger mb-3" style="max-width: 100%;">
                        <div class="card-header">{{$fasilitasumum->nama_fasilitas}}</div>
                        <div class="card-body">
                        <h5 class="card-title">Status : {{$fasilitasumum->status}}</h5>
                        <p class="card-text">Keterangan : {{$fasilitasumum->deskripsi}}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-sm-4 mb-3 mt-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 100%;">
                        <div class="card-header">{{$fasilitasumum->nama_fasilitas}}</div>
                        <div class="card-body">
                        <h5 class="card-title">Status : {{$fasilitasumum->status}}</h5>
                        <p class="card-text">Keterangan : {{$fasilitasumum->deskripsi}}</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                </div>
        </div>
    </section>
    <!-- end fasilitas -->

    <!-- faq -->
    <section class="faq" id="faq">
        <hr>
        <div class="container">
            <h2 class="text-center">Faq</h2>
            <p class="text-center">Frequently Asked Questions / apa saja yang sering di tanyakan di web ini</p>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Apa Tujuan Website ini di buat 
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Untuk Mempermudah pesanan hotel dari jarak jauh sebelum membayar ke hotel</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Fitur apa saja yang ada di website ini
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    1.Login
                    2.Register
                    3.Memesan Kamar secara jarak jauh
                    4.history pesanan
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Apakah tarif di situs web Anda per orang atau per kamar?
                </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Semua tarif di situs web ini adalah per masa inap</div>
                </div>
            </div>
            </div>
        </div>
        <hr>
    </section>
    <!-- end faq -->

    <!-- room -->
    <section class="room bg-light" id="room">
        <div class="container">
            <h2 class="text-center">Room</h2>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="pencarian" placeholder="Kata Kunci Kode Kamar" aria-label="Recipient's username" aria-describedby="basic-addon2" title="Type in a name">
                <span class="input-group-text" id="basic-addon2">Cari Kamar</span>
            </div>
            <div class="row">
                @foreach($kamars as $kamar)
                <div class="col-sm-4 mb-3 mt-3">
                    <div class="card" style="width: 100%;" id="objekpencarian">
                        <img src="{{asset('image/'.$kamar->image)}}" class="card-img-top" style="height: 200px;" alt="gambar kosong">
                        <div class="card-body">
                        <h5 class="card-title">Kode Kamar : {{$kamar->nokamar}}</h5>
                        <h6 class="card-subtitle">Tipe Kamar : {{$kamar->tipe_kamar->tipe_kamar}}</h6>
                        {{-- <a href="/show-post/{{$post->id}}/{{$post->slug}}" class="btn btn-primary">Show More</a> --}}
                        <a href="/tamu/detailroom/{{$kamar->id}}" class="btn btn-primary my-3 w-100">Pesan Kamar</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="alert alert-danger" id="error" style="display: none;">Pencarian Tidak ada</div>
                </div>
        </div>
    </section>
    <!-- end room -->
    
    <!-- saran -->
    <section id="saran" class="saran">
        <div class="container">
            <h2 class="text-center">Saran</h2>
            <p class="text-center">silahkan memberikan komentar/saran</p>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }} &#128514;
            </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="card" style="width: 100%;">
                        <div class="card-header">
                            Adreess
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">Jalan Kopo No 27 Beji Depok</li>
                        </ul>
                    </div>
                    <div class="card my-3" style="width: 100%;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="https://www.instagram.com/17achmadfadliskandar" class="text-dark text-decoration-none" target="_blank">Instagram</a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://wa.me/0877327858528" class="text-dark text-decoration-none" target="_blank">WhatsApp</a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://t.me/achmadfadliskandar" class="text-dark text-decoration-none" target="_blank">Telegram</a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://github.com/achmadfadliiskandar" class="text-dark text-decoration-none" target="_blank">Github</a>
                            </li>
                            <li class="list-group-item">
                                <a href="https://achmadf1.my.id/" class="text-dark text-decoration-none" target="_blank">Developer</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form action="/saran/store" method="POST">
                    @csrf
                    @if ($errors->any())
                        <script>
                            alert("data tidak terkirim");
                        </script>
                    @endif
                    <div class="mb-2">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                        {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="saran">Saran</label>
                        <textarea name="saran" class="form-control @error('saran') is-invalid @enderror" id="saran" cols="10" rows="2"></textarea>
                    </div>
                    @error('saran')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end saran -->

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
    html{
        scroll-behavior: smooth;
    }
    .navbar{
        background-color: #4b0082;
    }
    #gambarhotel{
        background-image: url('gambarhotel/halamanhotel2.jpg');
        background-repeat: no-repeat;
        /* background-size: auto; */
        background-size: 100% 100%;
    }
    .about{
        padding-top: 3.5em;
        padding-bottom: 3.5em;
    }
    #buttontop{
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
    scroll-behavior: smooth;
    }
    .facility{
        padding-top: 3.5em;
        padding-bottom: 3.5em;
    }
    .faq{
        padding-top: 3.5em;
        padding-bottom: 3.5em;
    }
    .room{
        padding-top: 3.5em;
        padding-bottom: 3.5em;
    }
    .saran{
        padding-top: 3.5em;
        padding-bottom: 3.5em;
    }
    .footer{
        height: 100px;
        background-color: #4b0082;
    }
    .card-header{
        background-color: #4b0082;
        color: whitesmoke;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    // alert("test")
    var mybutton = document.getElementById("buttontop");
    window.onscroll = function(){scrollfunction()};
    function scrollfunction(){
        if (document.body.scrolltop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    function topFunction(){
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    $(document).ready(function() {
        $("#pencarian").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var toggle = false;
        $("#objekpencarian h5").each(function() {
        var toggle = $(this).text().toLowerCase().indexOf(value) > -1;
        console.log($(this).text().toLowerCase().indexOf(value))
        $(this).closest('#objekpencarian').toggle(toggle);
        $('#error').toggle(!toggle);
        });
    });
});
</script>
<!-- end js -->