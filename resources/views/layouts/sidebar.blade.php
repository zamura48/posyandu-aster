<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-grey elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('disk/logo_posyandu.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b> Posyandu Aster</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}"
                        class="nav-link {{ $activePage == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('ketua')
                    {{-- <li class="nav-header">Balita</li>
                    <li class="nav-item {{ $activePage == 'Penimbangan Balita' || $activePage == 'Pemberian Vitamin' || $activePage == 'Penimbangan dan Vitamin' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $activePage == 'Penimbangan Balita' || $activePage == 'Pemberian Vitamin' || $activePage == 'Penimbangan dan Vitamin' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Penimbangan dan Vitamin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pemberian_vitamin.create') }}" class="nav-link {{ $activePage == 'Penimbangan dan Vitamin' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penimbangan.index') }}" class="nav-link {{ $activePage == 'Penimbangan Balita' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penimbangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pemberian_vitamin.index') }}" class="nav-link {{ $activePage == 'Pemberian Vitamin' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pemberian Vitamin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('imunisasi') }}"
                            class="nav-link {{ $activePage == 'Imunisasi' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Imunisasi</p>
                        </a>
                    </li> --}}
                    <li class="nav-header">Pengguna</li>
                    {{-- KADER --}}
                    <li class="nav-item">
                        <a href="{{ url('kader') }}" class="nav-link {{ $activePage == 'Kader' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Kader
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('ibu_balita.index') }}"
                            class="nav-link {{ $activePage == 'Ibu Balita' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Verifikasi Ibu Balita
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-header">Pengumuman</li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal_kegiatan.index') }}"
                            class="nav-link {{ $activePage == 'Jadwal Kegiatan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Jadwal Kegiatan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('keuangan_pmt.index') }}"
                            class="nav-link {{ $activePage == 'Keuangan PMT' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Keuangan PMT
                            </p>
                        </a>
                    </li>
                @endcan
                @can('kader')
                    <li class="nav-header">Balita</li>
                    <li class="nav-item">
                        <a href="{{ url('balita') }}" class="nav-link {{ $activePage == 'Balita' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Balita
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('verifikasi_update_balita.index') }}" class="nav-link {{ $activePage == 'Verifikasi Update Balita' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Verifikasi Perubahan Balita
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-item {{ $activePage == 'Penimbangan Balita' || $activePage == 'Pemberian Vitamin' || $activePage == 'Penimbangan dan Vitamin' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $activePage == 'Penimbangan Balita' || $activePage == 'Pemberian Vitamin' || $activePage == 'Penimbangan dan Vitamin' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Penimbangan dan Vitamin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pemberian_vitamin.create') }}" class="nav-link {{ $activePage == 'Penimbangan dan Vitamin' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penimbangan.index') }}" class="nav-link {{ $activePage == 'Penimbangan Balita' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penimbangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pemberian_vitamin.index') }}" class="nav-link {{ $activePage == 'Pemberian Vitamin' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pemberian Vitamin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('imunisasi') }}"
                            class="nav-link {{ $activePage == 'Imunisasi' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Imunisasi</p>
                        </a>
                    </li>

                    {{-- <li class="nav-header">Orang Tua</li>
                    <li class="nav-item">
                        <a href="{{ url('ibu_hamil') }}"
                            class="nav-link {{ $activePage == 'Ibu Hamil' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Ibu Hamil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('ibu_kb') }}" class="nav-link {{ $activePage == 'Ibu KB' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Ibu KB
                            </p>
                        </a>
                    </li> --}}
                @endcan
                @can('ibu_balita')
                    <li class="nav-item">
                        <a href="{{ url('anak') }}" class="nav-link {{ $activePage == 'Balita' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Balita</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
