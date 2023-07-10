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
                            <h1>tambah pengeluaran kas</h1>
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
                                <form id="quickForm" action="{{ route('pengeluaran.create.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">tanggal keluar</label>
                                            <input type="date" name="tanggal_keluar"
                                                class="form-control @error('tanggal_keluar')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('tanggal_keluar') }}">
                                            @error('tanggal_keluar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="uang_keluar">uang keluar</label>
                                            <input type="text" name="uang_keluar"
                                                class="form-control @error('uang_keluar')
                                                is-invalid
                                            @enderror"
                                                id="rupiah" placeholder="Masukan uang masuk"
                                                value="{{ old('uang_keluar') }}">
                                            @error('uang_keluar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">deskripsi</label>
                                            <input type="text" name="deskripsi"
                                                class="form-control @error('deskripsi')
                                                is-invalid
                                            @enderror"
                                                id="deskripsi" placeholder="Masukan deskripsi"
                                                value="{{ old('deskripsi') }}">
                                            @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">keterangan</label>
                                            <textarea type="text" name="keterangan"
                                                class="form-control @error('keterangan')
                                                is-invalid
                                            @enderror"
                                                id="keterangan" placeholder="Masukan keterangan">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="stock_product">stock product</label>
                                            <input type="number" name="stock_product"
                                                class="form-control @error('stock_product')
                                                is-invalid
                                            @enderror"
                                                id="rupiah" placeholder="Masukan stock product"
                                                value="{{ old('stock_product') }}">
                                            @error('stock_product')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="status">status karyawan</label>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Karyawan Tetap" type="radio"
                                                    name="status"checked @checked(old('status'))>
                                                <label class="form-check-label">Karyawan Tetap</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Karyawan Tidak Tetap" type="radio"
                                                    name="status" @checked(old('status'))>
                                                <label class="form-check-label">Karyawan Tidak Tetap</label>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript">
        var dengan_rupiah = document.getElementById('rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        dengan_rupiah.value = formatRupiah(dengan_rupiah.value, 'Rp. ');

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
