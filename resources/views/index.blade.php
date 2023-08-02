@extends('layouts.main')

@section('container')
    <div class="wrapper">

        <!-- Navbar -->
        @include('partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">DASHBOARD</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        {{-- <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ count($kasbon) }}</h3>
                                    <h5>TOTAL KASBON</h5>
                                    <p>@currency($totalKasbon)</p>
                                </div>
                                <a href="{{ route('kasbon.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    {{-- <h3>{{ count($pengeluaran) }}</h3> --}}
                                    <h5>TOTAL PENGELUARAN</h5>
                                    <p>@currency($totalPengeluaran)</p>
                                </div>
                                <a href="{{ route('pengeluaran.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    {{-- <h3>{{ count($pemasukan) }}</h3> --}}
                                    <h5>TOTAL PEMASUKAN</h5>
                                    <p>@currency($totalPemasukan)</p>
                                </div>
                                <a href="{{ route('pemasukan.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-fuchsia">
                                <div class="inner">
                                    {{-- <h3>{{ count($pemasukan) + count($pengeluaran) }}</h3> --}}
                                    <h5>SALDO AKHIR</h5>
                                    <p>@currency($totalPemasukan - $totalPengeluaran)</p>
                                </div>
                                <a href="{{ route('rekaptulasi.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
@endsection
