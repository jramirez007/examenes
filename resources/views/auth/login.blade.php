@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-4 mt-1">
                    <form method="POST" action="{{ route('process_login') }}">
                        @csrf
                        <div class="card-body p-5">

                            <div class="mb-3 d-flex justify-content-center">
                                @if ($id == 1)
                                <p class="h5 mb-2 text-center">Placement test</p>
                                @else
                                <p class="h5 mb-2 text-center">Vocacional test</p>
                                @endif

                                <input type="hidden" value="{{ $id }}" name="id" id="id" readonly />

                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <div id="1" style="display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('images/cursos/logo.png') }}" alt="">

                                </div>

                            </div>

                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signin-username" class="form-label text-default">email<sup
                                            class="fs-12 text-danger">*</sup></label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-password" class="form-label text-default d-block">Password<sup
                                            class="fs-12 text-danger">*</sup>
                                        <!-- <a href="reset-password-basic.html" class="float-end fw-normal text-muted">Olvide mi contraseña ?</a> -->
                                    </label>
                                    <div class="position-relative">

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

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
                                    <button type="button" class="btn btn-primary w-100" onclick="setearExamen()">
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

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <script>
        // Ejecutar la función al cargar el DOM
        document.addEventListener('DOMContentLoaded', initializeCountdown);

        // Función para inicializar el tiempo en el localStorage
        function initializeCountdown() {
            // Comprobar si ya existe un valor en el localStorage
            let timeRemaining = localStorage.getItem('timeRemaining');

            // Si no existe, asignar un valor predeterminado (45 minutos = 2700 segundos)
            if (!timeRemaining) {
                timeRemaining = 2700; // Valor predeterminado: 45 minutos (2700 segundos)
                localStorage.setItem('timeRemaining', timeRemaining); // Guardar el valor en el localStorage
            } else {
                localStorage.setItem('timeRemaining', 2700); // Actualizar el valor en el localStorage
            }

            // Obtener el valor actualizado de localStorage
            timeRemaining = localStorage.getItem('timeRemaining');
            console.log(timeRemaining); // Mostrar el valor actualizado
        }

        function setearExamen(){
            localStorage.setItem('id', document.getElementById('id').value);
        }
    </script>
@endsection
