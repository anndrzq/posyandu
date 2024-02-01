<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>

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
        </ul>
    </aside>
</div>
