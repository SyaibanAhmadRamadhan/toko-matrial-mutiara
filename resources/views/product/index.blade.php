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
                            <h1>Data Product</h1>
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
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Harga jual</th>
                                                <th>Stock</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key => $product)
                                                <tr>
                                                    <td>{{ $product->supplier->name }}</td>
                                                    <td>{{ $product->categoryProduct->name }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->selling_price }}</td>
                                                    <td>{{ $product->stock_product }}</td>
                                                    <td><img src="{{ asset('images/' . $product->image) }}" alt=""
                                                            border=3 height=100 width=100 style="object-fit: contain"></img>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-row mb-3">
                                                            <div><button type="button"
                                                                    onclick="location.href='{{ route('product.update', ['id' => $product->id]) }}'"
                                                                    class="btn">
                                                                    <i class="material-icons text-warning">edit</i>
                                                                </button></div>
                                                            <div>
                                                                <form class="form-button-action"
                                                                    action="{{ route('product.delete.post', $product->id) }}"
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
