@extends('menu')
@section('contenido')
    <link href="{{ asset('assets/js/select2/select2.min.css') }}" rel="stylesheet" />
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Modificar curso
                    </div>
                    <div class="prism-toggle">
                        <a href="{{ url('catalogo/curso') }}">
                            <button class="btn btn-outline-dark btn-wave">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z" />
                                </svg>
                            </button>
                        </a>
                    </div>
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

                <div class="card-body">
                    <form method="POST" action="{{ route('curso.update', $curso->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" value="{{ $curso->nombre }}" required
                                    class="form-control" onblur="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="institucion_id" class="form-label">Categoria</label>
                                <div class="select-container">
                                    <select name="categoria_id" class="js-example-basic-multiple" required>
                                        @foreach ($categorias as $obj)
                                            <option value="{{ $obj->id }}"
                                                {{ $curso->categoria_id == $obj->id ? 'selected' : '' }}>
                                                {{ $obj->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="adjunto" class="form-label">Imagen</label>
                                <input type="file" name="adjunto" class="form-control">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" required class="form-control" onblur="this.value = this.value.toUpperCase()">{{ $curso->descripcion }}</textarea>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="text-center">
                                    <img src="{{ asset('images/cursos') }}/{{ $curso->imagen }}"
                                        class="img-fluid rounded-pill" style="max-width: 100px" alt="...">
                                </div>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="institucion_id" class="form-label">Estado</label>
                                <div class="select-container">
                                    <select name="estado_id" class="js-example-basic-multiple" required>
                                        @foreach ($estados as $obj)
                                            <option value="{{ $obj->id }}"
                                                {{ $curso->estado_id == $obj->id ? 'selected' : '' }}>
                                                {{ $obj->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">&nbsp;&nbsp;Aceptar&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Selecccione",
                allowClear: true
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            expandMenuAndHighlightOption("solicitudMenu", "solicitudOption");
        });

        function onlyLetters(event) {
            var char = String.fromCharCode(event.which);
            if (!/[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]/.test(char)) {
                event.preventDefault();
            }
        }
    </script>
@endsection
