<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('active')</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Dashboard {{Auth::user()->role}}</h6>
    </nav>
    <!-- Example split danger button -->
    <div class="btn-group">
        <div class="container">
    <button type="button" class="btn btn-danger">{{Auth::user()->name}}</button>
    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
        <ul class="dropdown-menu">
            <li class="nav-item dropdown">
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
    </div>
    </div>
    <li class="nav-item d-xl-none ps-4 d-flex align-items-center">
        {{-- <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav"> --}}
            <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Menu Open
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item mt-3 mb-3">
                        <a href="/admin.admin/" class="dropdown-item" style="{{ request()->is('admin.admin') ? 'border: 1px solid #cb0c9f;' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/kamar.index/" class="dropdown-item" style="{{ request()->is('kamar.index') ? 'border: 1px solid #32a887;' : '' }}">Kamar</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/tipe_kamars" class="dropdown-item" style="{{ request()->is('tipe_kamars') ? 'border: 1px solid #37dedb;' : '' }}">Tipe Kamar</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/fasilitasumum" class="dropdown-item" style="{{ request()->is('fasilitasumum') ? 'border: 1px solid #358ca6;' : '' }}">Fasilitas Umum</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/saran" class="dropdown-item" style="{{ request()->is('saran') ? 'border: 1px solid #7135a6;' : '' }}">Saran</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/fasilitas" class="dropdown-item" style="{{ request()->is('fasilitas') ? 'border: 1px solid #88a635;' : '' }}">Fasilitas</a>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="/fasilitas_kamars" class="dropdown-item" style="{{ request()->is('fasilitas_kamars') ? 'border: 1px solid #de8d37;' : '' }}">Fasilitas Kamar</a>
                    </li>
                @endif
                @if (Auth::user()->role == 'resepsionis')
                <li class="nav-item mt-3 mb-3">
                    <a href="/resepsionis.resepsionis/" class="dropdown-item" style="{{ request()->is('resepsionis.resepsionis') ? 'border: 1px solid #eaea;' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item mt-3 mb-3">
                    <a href="/resepsionis.datatamu/" class="dropdown-item" style="{{ request()->is('resepsionis.datatamu') ? 'border: 1px solid #fcba03;' : '' }}">Data Tamu</a>
                </li>
                <li class="nav-item mt-3 mb-3">
                    <a href="/resepsionis.pembayaran/" class="dropdown-item" style="{{ request()->is('resepsionis.pembayaran') ? 'border: 1px solid #313e54;' : '' }}">Pembayaran</a>
                </li>
                @endif
                @if (Auth::user()->role == 'tamu')
                <li class="nav-item">
                    <a href="/tamu.home/" class="dropdown-item">Dashboard</a>
                </li>
                @endif
            </ul>
            </div>
        </a>
    </li>
</nav>