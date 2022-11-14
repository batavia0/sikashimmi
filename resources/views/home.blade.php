@extends('dashboard')
@section('content')
    @auth
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Kelola Uang Kas</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('password') }}">Change Password</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile Settings</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="return confirm('Tekan OK untuk Logout')">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <div class="container">
                                <nav class="navbar-expand-lg navbar-light bg-success">
                                    @if ($contoh == 0)
                                        <p class="text text-light">Sisa Uang Kas Rp{{ number_format($contoh - $substract) }}</p>
                                    @else
                                        <p class="text text-light">Sisa Uang Kas Rp{{ number_format($contoh - $substract) }}</p>
                                    @endif
                                </nav>
                            </div>
                            <a class="nav-link" href="{{ route('home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">MENU</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                @if (Auth::user()->id_jabatan == '1')
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Kelola
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('uang_kas') }}">Kas Masuk</a>
                                    <a class="nav-link" href="{{ route('anggota') }}">Anggota</a>
                                    <!-- <a class="nav-link" href="#">Jabatan</a> -->
                                    <a class="nav-link" href="{{ route('pengeluaran') }}">Kas Keluar</a>
                                </nav>
                            </div>
                        @else
                            <a class="nav-link" href="{{ route('uang_kas') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Kas Masuk
                            </a>
                            <a class="nav-link" href="{{ route('pengeluaran') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kas Keluar
                            </a>
                            <a class="nav-link" href="{{ route('payment') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Bayar Kas
                            </a>
                            @endif
                            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('password')}}">Change Password</a>
                                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div> --}}
                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <a class="nav-link" href="{{ route('riwayatpemasukkan') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                                Riwayat Pemasukkan
                            </a>
                            <a class="nav-link" href="{{ route('riwayatpengeluaran') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                                Riwayat Pengeluaran
                            </a>
                            <a class="nav-link" href="{{ route('laporan') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Laporan
                            </a>
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="return confirm('Apakah anda yakin ingin Logout?')">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                                Logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        @if (Auth::user()->id_jabatan == '1')
                            <div class="small">Logged in as: {{ Auth::user()->name }} - <span class="text-info"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Level Bendahara mempunyai hak akses penuh terhadap perubahan jika dikehendaki">Bendahara<span
                                        class="text-muted"><small>[READ/W]</small></span></span>
                            @else
                                <div class="small">Logged in as : {{ Auth::user()->name }} - <span class="text-info"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Level User Anggota merupakan tingkat level terakhir setelah Bendahara dengan hak akses hanya Baca Saja">Anggota<span
                                            class="text-muted"><small>[READONLY]
                                            </small></span></span>
                        @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light-shadow text-primary mb-4">
                                    <div class="card-body">
                                        <h5><i class=" text-success fa-solid fa-rupiah-sign"></i><i
                                                class="text-success fas fa-fw fa-caret-up"> </i>Kas Masuk</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-secondary">Jumlah Uang Kas: Rp{{ number_format($contoh - $substract) }}
                                        </p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-dark stretched-link" href="{{ route('uang_kas') }}">View
                                            Details</a>
                                        <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light-shadow text-primary mb-4">
                                    <div class="card-body">
                                        <h5><i class=" text-danger fa-solid fa-rupiah-sign"></i><i
                                                class="text-danger fas fa-fw fa-caret-down"></i> Pengeluaran</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-secondary">Jumlah Pengeluaran: Rp{{ number_format($substract) }}</p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-dark stretched-link" href="{{ route('pengeluaran') }}">View
                                            Details</a>
                                        <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->id_jabatan == '1')
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-light-shadow text-primary mb-4">
                                        <div class="card-body">
                                            <h5><i class="text-dark fas fa-fw fa-user-tie text-muted"></i> Anggota</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-secondary">Jumlah Anggota: {{ $countAnggota }}</p>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-dark stretched-link" href="{{ route('anggota') }}">View
                                                Details</a>
                                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!--<div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        -->
                        </div>

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy @php echo date("Y"); @endphp Kelompok 02</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    @endauth

    {{-- Jika user belum login maka muncul login terlebih dahulu --}}
    @guest
        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
        <a class="btn btn-info" href="{{ route('register') }}">Register</a>
    @endguest
@endsection
