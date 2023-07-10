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
                            <h1>Tambah Product</h1>
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
                                <form id="quickForm" action="{{ route('product.update.post', ['id' => $product->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="supplier">supplier</label>
                                            <select name="supplier" id="supplier"
                                                class="form-control @error('supplier')
                                                is-invalid
                                            @enderror">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $key => $supplier)
                                                    <option @selected(old('supplier', $product->supplier->id) == $supplier->id) value="{{ $supplier->id }}">
                                                        {{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('supplier')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category_product">category product</label>
                                            <select name="category_product" id="category_product"
                                                class="form-control @error('category_product')
                                                is-invalid
                                            @enderror">
                                                <option value="">Select category product</option>
                                                @foreach ($categoryProducts as $key => $categoryProduct)
                                                    <option @selected(old('category_product', $product->categoryProduct->id) == $categoryProduct->id) value="{{ $categoryProduct->id }}">
                                                        {{ $categoryProduct->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_product')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">name product</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                                id="name" placeholder="Masukan Nama product"
                                                value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="selling_price">harga jual</label>
                                            <input type="text" name="selling_price"
                                                class="form-control @error('selling_price')
                                                is-invalid
                                            @enderror"
                                                id="rupiah" placeholder="Masukan harga jual karyawan"
                                                value="{{ old('selling_price', $product->selling_price) }}">
                                            @error('selling_price')
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
                                                value="{{ old('stock_product', $product->stock_product) }}">
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
                                        <div class="form-group">
                                            <label for="image">image product</label>
                                            </br>
                                            <input type="file"
                                                class="@error('image')
                                                is-invalid
                                            @enderror"
                                                name="image" id="image">
                                            @error('image')
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
