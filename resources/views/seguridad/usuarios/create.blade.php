@extends('menu')
@section('contenido')



<div class="2xl:col-span-12 lg:col-span-12 col-span-12">
    <div class="card">
        <div class="card-header flex-wrap d-flex justify-content-between">
            <div>
                <h4 class="card-title">Crear Usuario</h4>
                </p>


            </div>
            <ul class="nav nav-tabs dzm-tabs" id="myTab-six" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ url('seguridad/usuario') }}">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-create"
                            type="button" role="tab" aria-selected="true">Salir</button></a>
                </li>

            </ul>
        </div>

        @if (count($errors) > 0)
        <br>
        <div class="mb-3 col-md-6 col-sm-12" style="margin-left: 20px">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="card-body flex flex-col p-6">
            <form method="POST" action="{{ url('seguridad/usuario') }}">

                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="largeInput" class="inline-inputLabel">Nombre</label>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="largeInput" class="inline-inputLabel">Usuario</label>
                        <input type="text" name="username" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="largeInput" class="inline-inputLabel">Email</label>
                        <input type="text" name="email" required class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="largeInput" class="inline-inputLabel">Contraseña</label>
                        <input type="password" name="password" required class="form-control">
                    </div>


                    &nbsp;
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"></h4>
                            </p>
                        </div>
                        <ul class="nav nav-tabs dzm-tabs" id="myTab-six" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-primary btn-sm" type="submit" role="tab"
                                    aria-selected="true">Aceptar</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('template/js/jquery-3.6.0.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        expandMenuAndHighlightOption("seguridadMenu", "usuarios_Option");
    });
</script>
<script>
    // Usando jQuery para evitar la entrada de números
    $('#name').on('keypress', function(event) {


        var charCode = event.which ? event.which : event.keyCode;
        console.console.log(charCode);
        // Permitir solo letras y espacio (a-z, A-Z, y 32 para espacio)
        if ((charCode >= 48 && charCode <= 57)) {
            event.preventDefault(); // Bloquea la entrada de números
        }
    });
</script>


@endsection