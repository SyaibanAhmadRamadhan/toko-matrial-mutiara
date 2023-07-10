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
                            <h1>Data Pemblian Product</h1>
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
                                                <th>name product</th>
                                                <th>jumlah pembelian product</th>
                                                <th>harga beli</th>
                                                <th>total pembelian</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spendingProducts as $key => $spendingProduct)
                                                <tr>
                                                    <td>{{ $spendingProduct->product->name }}</td>
                                                    <td>{{ $spendingProduct->purchase_total }} pcs</td>
                                                    <td>@currency($spendingProduct->purchase_price)</td>
                                                    <td>@currency($spendingProduct->total_spending_money)</td>
                                                    <td>{{ $spendingProduct->status }}</td>
                                                    <td>
                                                        <div class="d-flex flex-row mb-3">
                                                            <div><button type="button"
                                                                    onclick="location.href='{{ route('pembelian-product.update', ['id' => $spendingProduct->id]) }}'"
                                                                    class="btn">
                                                                    <i class="material-icons text-warning">edit</i>
                                                                </button></div>
                                                            <div>
                                                                <form class="form-button-action"
                                                                    action="{{ route('pembelian-product.delete.post', $spendingProduct->id) }}"
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
