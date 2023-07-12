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
                            <h1>update kasbon</h1>
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
                                <form id="quickForm" action="{{ route('kasbon.update.post', ['id' => $kasbon->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tanggal_kasbon">tanggal kasbon</label>
                                            <input type="date" name="tanggal_kasbon"
                                                class="form-control @error('tanggal_kasbon')
                                                is-invalid
                                            @enderror"
                                                value="{{ old('tanggal_kasbon', $kasbon->tanggal_kasbon) }}">
                                            @error('tanggal_kasbon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="uang_kasbon">uang kasbon</label>
                                            <input type="text" name="uang_kasbon"
                                                class="form-control @error('uang_kasbon')
                                                is-invalid
                                            @enderror"
                                                id="rupiah" placeholder="Masukan uang kasbon"
                                                value="{{ old('uang_kasbon', $kasbon->uang_kasbon) }}">
                                            @error('uang_kasbon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">nama</label>
                                            <input type="text" name="nama"
                                                class="form-control @error('nama')
                                                is-invalid
                                            @enderror"
                                                placeholder="Masukan nama" value="{{ old('nama', $kasbon->nama) }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">no telepon</label>
                                            <input type="text" name="no_telepon"
                                                class="form-control @error('no_telepon')
                                                is-invalid
                                            @enderror"
                                                placeholder="Masukan no_telepon"
                                                value="{{ old('no_telepon', $kasbon->no_telepon) }}">
                                            @error('no_telepon')
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
                                                id="keterangan" placeholder="Masukan keterangan">{{ old('keterangan', $kasbon->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
