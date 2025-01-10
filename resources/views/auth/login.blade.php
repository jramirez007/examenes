@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
            <div class="card custom-card my-4 mt-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body p-5">

                        <div class="mb-3 d-flex justify-content-center">
                            <p class="h5 mb-2 text-center">Placement test</p>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <div id="1" style="display: flex; justify-content: center; align-items: center;">
                                <img src="{{ asset('images/cursos/logo.png') }}" alt="">

                            </div>

                        </div>

                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signin-username" class="form-label text-default">email<sup class="fs-12 text-danger">*</sup></label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Password<sup class="fs-12 text-danger">*</sup>
                                <!-- <a href="reset-password-basic.html" class="float-end fw-normal text-muted">Olvide mi contraseña ?</a> -->
                            </label>
                                <div class="position-relative">

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <!-- <a href="index.html" class="btn btn-primary">Inicio de Sesión</a> -->
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>

                            <br>

                            <a href="{{ route('register') }}">
                                <button type="button" class="btn btn-primary w-100">
                                    Register
                                </button>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
