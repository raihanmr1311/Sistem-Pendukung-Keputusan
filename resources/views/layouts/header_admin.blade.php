<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pendukung Keputusan Metode AHP TOPSIS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/chicken.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/chicken.png') }}" type="image/x-icon">
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('Dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-database"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">SPK AHP TOPSIS</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $page == 'Dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            @if(session('log.id_user_level') == '1')
            <li class="nav-item {{ $page == 'Kriteria' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Kriteria') }}">
                    <i class="fas fa-fw fa-cube"></i>
                    <span>Data Kriteria</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Sub Kriteria' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('SubKriteria') }}">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Data Sub Kriteria</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Alternatif' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Alternatif') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Alternatif</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Penilaian' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Penilaian') }}">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Data Penilaian</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Perhitungan' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Perhitungan') }}">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Data Perhitungan</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Hasil' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Hasil') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Hasil Akhir</span>
                </a>
            </li>
            @endif

            @if(session('log.id_user_level') == '2')
            <li class="nav-item {{ $page == 'Kriteria' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Kriteria') }}">
                    <i class="fas fa-fw fa-cube"></i>
                    <span>Data Kriteria</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Sub Kriteria' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('SubKriteria') }}">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Data Sub Kriteria</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Alternatif' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Alternatif') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Alternatif</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Penilaian' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Penilaian') }}">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Data Penilaian</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Perhitungan' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Perhitungan') }}">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Data Perhitungan</span>
                </a>
            </li>

            <li class="nav-item {{ $page == 'Hasil' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Hasil') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Hasil Akhir</span>
                </a>
            </li>
            @endif
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            @if(session('log.id_user_level') == '1')
            <li class="nav-item {{ $page == 'User' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('User') }}">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Data User</span>
                </a>
            </li>
            @endif

            <li class="nav-item {{ $page == 'Profile' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('Profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Profile</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn text-info d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
                                        {{ session('log.nama') }}
                                    </span>
                                    <img src="{{ asset('img/user.png') }}" class="img-profile rounded-circle">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ url('Profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <div class="container-fluid">