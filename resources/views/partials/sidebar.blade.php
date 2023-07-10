<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">Toko Matrial Mutiara</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pemasukan*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('pemasukan*') ? 'active' : '' }}">

                        <p>
                            pemasukan kas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pemasukan.index') }}"
                                class="nav-link {{ Request::is('pemasukan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pemasukan.create') }}"
                                class="nav-link {{ Request::is('pemasukan/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('pengeluaran*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('pengeluaran*') ? 'active' : '' }}">

                        <p>
                            pengeluaran kas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pengeluaran.index') }}"
                                class="nav-link {{ Request::is('pengeluaran') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                            {{-- <a href="#" class="nav-link {{ Request::is('pengeluaran') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a> --}}
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengeluaran.create') }}"
                                class="nav-link {{ Request::is('pengeluaran/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah</p>
                            </a>
                            {{-- <a href="#" class="nav-link {{ Request::is('pengeluaran/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah</p>
                            </a> --}}
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item {{ Request::is('supplier*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('supplier*') ? 'active' : '' }}">

                        <p>
                            Supplier
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}"
                                class="nav-link {{ Request::is('supplier') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.create') }}"
                                class="nav-link {{ Request::is('supplier/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Supplier</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('product*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('product*') ? 'active' : '' }}">

                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ Request::is('product') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}"
                                class="nav-link {{ Request::is('product/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('pembelian-product*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('pembelian-product*') ? 'active' : '' }}">

                        <p>
                            pembelian product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pembelian-product.index') }}"
                                class="nav-link {{ Request::is('pembelian-product') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data pembelian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pembelian-product.create') }}"
                                class="nav-link {{ Request::is('pembelian-product/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah pembelian </p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="{{ route('slipgaji.index') }}" class="nav-link">

                        <p>
                            Slip Gaji supplier
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
