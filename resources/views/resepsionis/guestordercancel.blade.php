@extends('template.master')

@section('title', 'Halaman Guest yang membatalkan pesanan')

@section('active','Halaman Guest yang membatalkan pesanan')

@section('content')
<h2>Cetak PDF Guest Cancel</h2>
    <div class="alert alert-info">pemesan yang membatalkan pesanannya</div>
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