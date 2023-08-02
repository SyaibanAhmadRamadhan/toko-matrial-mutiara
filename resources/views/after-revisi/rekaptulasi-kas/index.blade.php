@extends('layouts.main')

@section('container')
    <div class="wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>data rekaptulasi kas</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row pl-0 flex-column flex-md-row justify-content-between">
                                        <div class="mb-3 mb-md-0 col-12 col-md-6">
                                            <span>Export : </span>
                                            <div class="btn-group">
                                                <a class="btn btn-danger dropdown-toggle btn-sm"
                                                    href="/rekaptulasi/export/pdf?dari={{ isset($_GET['dari']) ? $_GET['dari'] : '' }}&sampai={{ isset($_GET['sampai']) ? $_GET['sampai'] : '' }}">Pdf</a>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-success dropdown-toggle btn-sm"
                                                    href="/rekaptulasi/export/excel?dari={{ isset($_GET['dari']) ? $_GET['dari'] : '' }}&sampai={{ isset($_GET['sampai']) ? $_GET['sampai'] : '' }}">Excel</a>
                                            </div>
                                        </div>

                                        <form action="" method="get" class="col-12 col-md-6 w-100">
                                            <div class="input-group mb-3">
                                                <label for="" class="p-2">dari</label>
                                                <input type="date" required class="form-control " name="dari"
                                                    value="{{ isset($_GET['dari']) ? $_GET['dari'] : $data[0]['tanggal'] }}">
                                                <label for="" class="p-2">sampai</label>
                                                <input type="date" required class="form-control " name="sampai"
                                                    value="{{ isset($_GET['sampai']) ? $_GET['sampai'] : $data[count($data) - 1]['tanggal'] }}">
                                                <button class="btn btn-success" type="submit"
                                                    id="button-addon2">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="text-align: center">tanggal</th>
                                                <th rowspan="2" style="text-align: center">deskripsi</th>
                                                <th rowspan="2" style="text-align: center">keterangan</th>
                                                <th colspan="2" style="text-align: center">jenis</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center">pemasukan</th>
                                                <th style="text-align: center">pengeluaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $k => $p)
                                                <tr>
                                                    <td>{{ $p['tanggal'] }}</td>
                                                    <td>{{ $p['deskripsi'] }}</td>
                                                    <td>{{ $p['keterangan'] }}</td>
                                                    @isset($p['uang_masuk'])
                                                        <td style="text-align: center">@currency($p['uang_masuk'])</td>
                                                        <td style="text-align: center;color: red;"><strong>-</strong></td>
                                                    @endisset
                                                    @isset($p['uang_keluar'])
                                                        <td style="text-align: center;color: red;"><strong>-</strong></td>
                                                        <td style="text-align: center">@currency($p['uang_keluar'])</td>
                                                    @endisset
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th colspan="3" style="text-align: right">total</th>
                                                <th colspan="1" style="text-align: center">@currency($totalPemasukan)</th>
                                                <th colspan="1" style="text-align: center">@currency($totalPengeluaran)</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="text-align: right">SALDO</th>
                                                <th colspan="2" style="text-align: center">@currency($totalPemasukan - $totalPengeluaran)</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
