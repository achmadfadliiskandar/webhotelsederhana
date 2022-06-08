@extends('template.master')

@section('title', 'Halaman Khusus untuk user yang tidak memliki akun')

@section('active','Halaman Guest / user yg tidak memiliki akun')

@section('content')
<h2>Guest Order</h2>
    <div class="alert alert-info">Order Khusus Pengguna yang tidak memiliki akun</div>
<div class="container">
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
        <div class="row">
            <div class="col-sm-4">
                <div class="alert alert-info">Jika Terjadi Kecurangan dalam pemesanan Tolong Sampaikan/Adukan Ke Pihak Hotel silahkan hubungi melalui nomor ini : <strong>081878156894</strong> dan Sertakan bukti berupa vidio ataupun ss </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-warning" style="text-transform: capitalize;">jika sudah berhasil terpesan maka pesanan kamar yang anda inputkan disarankan langsung pilih nama kamar yang anda pesan atau nama anda dan tolong jangan beritahu kode booking anda kepada siapapun!!</div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-secondary" style="text-transform: capitalize;">dan disarankan ketika sudah yakin silahkan pilih melalui checkbox dan langsung klik Cetak Pdf</div>
            </div>
        </div>
        <div style="overflow-x:auto">
            <form action="/insertpdf/store" method="post">
                @csrf
            <table id="example" class="table table-striped table table-hover table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Checlist</th>
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
                    @forelse ($guests as $guest)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <input class="form-check-input mt-0" type="checkbox" value="{{$guest->id}}" name="guest_bookings_id[]">
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
                                <button type="button" class="btn btn-danger cancelorder" value="{{$guest->id}}">
                                    Batalkan
                                </button>
                            </td>
                        @empty
                            <td colspan="8" class="text-danger text-center text-capitalize">tidak ada data</td>
                        @endforelse
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Checlist</th>
                        <th>Nama</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Kamar</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-primary my-3 w-100" style="background-color: #123456;">Cetak Pdf</button>
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
</div>
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
        });
    </script>
@endsection