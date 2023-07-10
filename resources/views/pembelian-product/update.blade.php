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
                            <h1>update Pembelian Product</h1>
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
                                <form id="quickForm"
                                    action="{{ route('pembelian-product.update.post', ['id' => $spendingProduct->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="product">product</label>
                                            <select name="product" id="product"
                                                class="form-control @error('product')
                                                is-invalid
                                            @enderror">
                                                <option value="">Select product</option>
                                                @foreach ($products as $key => $product)
                                                    <option @selected(old('product', $spendingProduct->id_product) == $product->id) value="{{ $product->id }}">
                                                        {{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase_total">total pembelian product</label>
                                            <input type="number" name="purchase_total"
                                                class="form-control @error('purchase_total')
                                                is-invalid
                                            @enderror"
                                                id="purchase_total" placeholder="Masukan Total Pembelian Product"
                                                value="{{ old('purchase_total', $spendingProduct->purchase_total) }}">
                                            @error('purchase_total')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase_price">harga product</label>
                                            <input type="text" name="purchase_price"
                                                class="form-control @error('purchase_price')
                                                is-invalid
                                            @enderror"
                                                id="rupiah" placeholder="Masukan harga jual karyawan"
                                                value="{{ old('purchase_price', $spendingProduct->purchase_price) }}">
                                            @error('purchase_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">status pembelian</label>
                                            <div class="form-check">
                                                <input class="form-check-input" value="pending" type="radio"
                                                    name="status"
                                                    {{ old('status', $spendingProduct->status) == 'pending' ? 'checked' : '' }}>
                                                <label class="form-check-label">pending</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="paid" type="radio" name="status"
                                                    {{ old('status', $spendingProduct->status) == 'paid' ? 'checked' : '' }}>
                                                <label class="form-check-label">paid</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="unpaid" type="radio" name="status"
                                                    {{ old('status', $spendingProduct->status) == 'unpaid' ? 'checked' : '' }}>
                                                <label class="form-check-label">unpaid</label>
                                            </div>
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
