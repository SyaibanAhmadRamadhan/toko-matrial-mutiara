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
                            <h1>DATA PENGELUARAN KAS</h1>
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
                                                    href="/pengeluaran/export/pdf?dari={{ isset($_GET['dari']) ? $_GET['dari'] : '' }}&sampai={{ isset($_GET['sampai']) ? $_GET['sampai'] : '' }}">Pdf</a>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-success dropdown-toggle btn-sm"
                                                    href="/pengeluaran/export/excel?dari={{ isset($_GET['dari']) ? $_GET['dari'] : '' }}&sampai={{ isset($_GET['sampai']) ? $_GET['sampai'] : '' }}">Excel</a>
                                            </div>
                                        </div>
                                        <form action="" method="get" class="col-12 col-md-6 w-100">
                                            <div class="input-group mb-3">
                                                <label for="" class="p-2">Dari</label>
                                                <input type="date" required class="form-control " name="dari"
                                                    value="{{ isset($_GET['dari']) ? $_GET['dari'] : $pengeluaran[0]->tanggal_keluar }}">
                                                <label for="" class="p-2">Sampai</label>
                                                <input type="date" required class="form-control " name="sampai"
                                                    value="{{ isset($_GET['sampai']) ? $_GET['sampai'] : $pengeluaran[count($pengeluaran) - 1]->tanggal_keluar }}">
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
                                    <div class="alert-success" style="padding: 0.5em; margin-bottom: 1em">
                                        <center>
                                            TOTAL PENGELUARAN
                                            <h6>@currency($total)</h6>
                                        </center>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL</th>
                                                <th>UANG KELUAR</th>
                                                <th>DESKRIPSI</th>
                                                <th>KETERANGAN</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengeluaran as $key => $p)
                                                <tr>
                                                    <td>{{ $p->tanggal_keluar }}</td>
                                                    <td>@currency($p->uang_keluar)</td>
                                                    <td>{{ $p->deskripsi }}</td>
                                                    <td>{{ $p->keterangan }}</td>
                                                    <td>
                                                        <div class="d-flex flex-row mb-3">
                                                            <div><button type="button"
                                                                    onclick="location.href='{{ route('pengeluaran.update', ['id' => $p->id]) }}'"
                                                                    class="btn">
                                                                    <i class="material-icons text-warning">edit</i>
                                                                </button></div>
                                                            <div>
                                                                <form class="form-button-action"
                                                                    action="{{ route('pengeluaran.delete.post', $p->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn">
                                                                        <i class="material-icons text-danger">delete</i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
