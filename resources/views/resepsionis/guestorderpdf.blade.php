@extends('template.master')

@section('title', 'Halaman Khusus untuk user yang tidak memliki akun')

@section('active','Halaman Guest / user yg tidak memiliki akun')

@section('content')
<h2>Cetak PDF Guest</h2>
    <div class="alert alert-info">Cetak PDF khusus guest/tamu yang tidak memiliki akun dan sudah memesan</div>
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
        </div>
    @endif
    @if (session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif
    {{-- <div class="alert alert-danger"><strong style="text-transform: capitalize;">note</strong>: untuk yang tidak memiliki akun</div> --}}
    <div class="row">
        <div class="col-sm-6">
            <div class="alert alert-info">Jika Terjadi Kecurangan dalam pemesanan Tolong Sampaikan/Adukan Ke Pihak Hotel silahkan hubungi melalui nomor ini : <strong>081878156894</strong> dan Sertakan bukti berupa vidio ataupun ss </div>
        </div>
        <div class="col-sm-6">
            <div class="alert alert-warning" style="text-transform: capitalize;">Jika anda sudah memilih kamar anda silahkan cetak pdfnya disini dan selalu ingat kodebooking anda untuk mencetak pdfnya dan yakin ketika ingin mengisi kodebookingnya dikarenakan hanya ada 1 kali kesempatan</div>
        </div>
    </div>
    <div style="overflow-x:auto">
        @php
        // error_reporting(0);
        $dataisi = $pdfs->keyBy('id');
        @endphp
<table class="table table-bordered table table-striped table table-hover" id="example">
    <thead>
        <tr>
        <td>No</td>

        <td>Nama Pemesan</td>
        <td style="text-transform:capitalize">Kamar yang di pesan</td>
        <td>KodeBooking</td>
        <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($pdf as $p)
        <tr>
            <td>{{$loop->iteration}}</td>

            <td>
                @php
                    $hasil_split = explode(',',$p->guest_bookings_id);
                @endphp
                @foreach ($hasil_split as $item)
                    {{$dataisi[$item]->nama}}
                @endforeach
            </td>
            <td>
                @foreach ($hasil_split as $item)
                    {{$dataisi[$item]->kamar->tipe_kamar->tipe_kamar}}
                @endforeach
            </td>
            {{-- <td>
                <input type="text" class="form-control" name="kodeupdate" value="{{$p->guest->kodebooking}}">
            </td> --}}
            <form action="/updatekb/update/{{$p->id}}" method="post" class="d-inline-block">
                @csrf
                @method('PUT')
            <td>
                @if ($p->kodebooking == NULL)
                <input type="number" class="form-control" name="kodebooking" id="kodebooking">
                @else
                sudah di pesan
                {{-- <input type="number" class="form-control" name="kodebooking" value="" id="kodebooking"> --}}
                @endif
            </td>
            <td>
                    @if ($p->kodebooking == null)
                    <button type="submit" class="btn btn-success">Update KodeBooking</button>
                    @endif
                </form>
                @if ($p->kodebooking == NULL)
                @foreach ($hasil_split as $item)
                <span class="badge bg-danger">Laporan PDF</span>
                @endforeach
                @else
                @foreach ($hasil_split as $item)
                <a href="/laporanpdf/guest/{{$p->id}}" target="_blank" class="btn btn-danger w-100">Laporan PDF</a>
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });
    </script>
@endsection