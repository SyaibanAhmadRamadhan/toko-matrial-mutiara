@extends('layouts.main')

@section('container')
    <div class="wrapper">
        <!-- Navbar -->
        @include('partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('partials.sidebar')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Cetak Gaji Karyawan</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-primary">
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
                                <form id="quickForm" action="{{ route('slipgaji.cetak') }}" method="GET"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">nama karyawan</label>
                                            <select name="name" id="name" required
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror">
                                                <option value="">Select karyawan</option>
                                                @foreach ($employes as $key => $employe)
                                                    <option @selected(old('name') == $employe->id) value="{{ $employe->id }}">
                                                        {{ $employe->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="name">tanggal</label>
                                            <input type="date" name="date"
                                                class="form-control @error('date')
                                                is-invalid
                                            @enderror"
                                                id="date" value="{{ old('date') }}">
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="cetak" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
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
