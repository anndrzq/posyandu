<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Posyandu</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">Ps</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">General</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>

            @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'employee'))
                <li class="menu-header">Data Master</li>
                <li class="{{ Request::is('parent-data*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('parent-data') }}"><i class="fa-solid fa-person-breastfeeding"></i>
                        <span>Data
                            Keluarga</span></a>
                </li>
                <li class="{{ Request::is('children-data*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('children-data') }}"><i class="fa-solid fa-children"></i><span>Data Anak</span></a>
                </li>
                <li class="{{ Request::is('officer-data*') ? 'active' : '' }}"><a href="{{ url('officer-data') }}"
                        class="nav-link"><i class="fa-solid fa-building"></i><span>Data Petugas</span></a></li>
                <li class="{{ Request::is('midwife-data*') ? 'active' : '' }}"><a href="{{ url('midwife-data') }}"
                        class="nav-link"><i class="fa-solid fa-user-nurse"></i><span>Data Bidan</span></a></li>
            @endif

            @if (
                (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'employee')) ||
                    auth()->user()->role == 'midwife')
                <li class="menu-header">Data Pelayanan</li>
                <li class="{{ Request::is('DataImmunization*') ? 'active' : '' }}"><a
                        href="{{ url('DataImmunization') }}" class="nav-link"><i
                            class="fa-solid fa-person-breastfeeding"></i><span>Data Imunisasi</span></a>
                </li>
                <li class="{{ Request::is('DataWeighing*') ? 'active' : '' }}"><a href="{{ url('DataWeighing') }}"
                        class="nav-link"><i class="fa-solid fa-scale-unbalanced-flip"></i><span>Data
                            Penimbangan</span></a>
                </li>
            @endif

            @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'employee'))
                <li class="menu-header">Persediaan</li>
                <li class="{{ Request::is('immunization*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('immunization') }}"><i class="fa-solid fa-suitcase-medical"></i>
                        <span>Vaksin</span></a>
                </li>
                <li class="{{ Request::is('vitamins*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('vitamins') }}"><i class="fa-solid fa-pills"></i><span>Vitamin</span></a>
                </li>
            @endif

            @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'midwife'))
                <li class="menu-header">Layanan</li>
                <li class="{{ Request::is('weighing-children*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('weighing-children') }}"><i class="fa-solid fa-hands-holding-child"></i>
                        <span>Penimbangan Anak</span></a>
                </li>
                <li class="{{ Request::is('child-immunization*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('child-immunization') }}"><i class="fa-solid fa-syringe"></i><span>Imunisasi
                            Anak</span></a>
                </li>
            @endif

            <li class="menu-header">Pengaduan</li>
            @if (auth()->check() && (auth()->user()->role == 'parents' || auth()->user()->role == 'admin'))
                <li class="{{ Request::is('my-complaint*') && !Request::is('my-complaint/create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('my-complaint') }}">
                        <i class="fa-solid fa-book-journal-whills"></i>
                        <span>Pengaduan Saya</span>
                    </a>
                </li>

                <li class="{{ Request::is('my-complaint/create') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('my-complaint/create') }}"><i class="fa-solid fa-file-circle-plus"></i><span>Buat
                            Pengaduan</span></a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->role != 'parents')
                <li class="{{ Request::is('complaint-message*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('complaint-message') }}"><i class="fa-solid fa-square-envelope"></i><span>Daftar
                            Pengaduan</span></a>
                </li>
            @endif
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            {{-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a> --}}
        </div>
    </aside>
</div>
