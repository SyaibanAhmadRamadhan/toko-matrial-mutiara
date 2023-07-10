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
                            <h1>Data Supplier</h1>
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
                                                <th>Name supplier</th>
                                                <th>email supplier</th>
                                                <th>phone supplier</th>
                                                <th>addess supplier</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suppliers as $key => $supplier)
                                                <tr>
                                                    <td>{{ $supplier->name }}</td>
                                                    <td>{{ $supplier->email }}</td>
                                                    <td>{{ $supplier->phone }}</td>
                                                    <td>{{ $supplier->address }}</td>
                                                    <td>
                                                        <div class="d-flex flex-row mb-3">
                                                            <div><button type="button"
                                                                    onclick="location.href='{{ route('supplier.update', ['id' => $supplier->id]) }}'"
                                                                    class="btn">
                                                                    <i class="material-icons text-warning">edit</i>
                                                                </button></div>
                                                            <div>
                                                                <form class="form-button-action"
                                                                    action="{{ route('supplier.delete.post', $supplier->id) }}"
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
