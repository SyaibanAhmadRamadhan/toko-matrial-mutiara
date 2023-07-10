@extends('layouts.main')

@section('container')
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <b>toko matrial mutiara</b>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to toko matrial mutiara</p>
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('auth.login.post') }}" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email"
                                class="form-control  @error('email')
                                    is-invalid
                                @enderror"
                                name="email" placeholder="Email" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password"
                                class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                name="password" placeholder="Password" value="{{ old('password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
@endsection
