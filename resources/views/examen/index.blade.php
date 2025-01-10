@extends('menu_examen')
@section('contenido')

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>

            <h1 class="page-title fw-medium fs-18 mb-0">Click on the best word or phrase (a, b, c or d) to fill each blank.
            </h1>
        </div>

    </div>
    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row">
        <form method="POST" id="formExamen" action="{{url('curso/examen')}}">
            @csrf
            @foreach ($preguntas->sortBy('id') as $pregunta)
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                <h5 class="mb-3">
                                    {{ $pregunta->descripcion }}
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                <div class="radio-container">
                                    <label class="radio-label">
                                        <input type="radio" name="respuesta_{{$pregunta->id}}" value="{{ $respuesta->id }}" {{ $pregunta->getRespuesta($respuesta->id) == $respuesta->id  ? 'checked':''}}>
                                        <span class="custom-radio"></span>
                                        {{ $respuesta->descripcion }}
                                    </label>
                                </div>
                            @endforeach
                            <!-- Aquí se agregará el mensaje de error en caso de no seleccionar una respuesta -->
                            <div class="error-message" style="display:none;">
                                <div class="alert alert-danger" role="alert">
                                    Por favor, selecciona una respuesta para esta pregunta.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div style="text-align: right;">
                <button type="button" class="btn btn-primary btn-lg btn-wave" onclick="validarFormulario()">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
            </div>
            <br>
        </form>

    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <script>
        function validarFormulario() {
            let valido = true;
            let radios = document.querySelectorAll('input[type="radio"]');
            let preguntas = new Set(); // Usamos un Set para asegurarnos de contar cada pregunta solo una vez

            // Primero, ocultamos todos los mensajes de error
            document.querySelectorAll('.error-message').forEach(errorDiv => {
                errorDiv.style.display = 'none';
            });

            // Recorremos todos los botones de radio
            radios.forEach(radio => {
                // Si el radio es seleccionado, marcamos la pregunta correspondiente como validada
                if (radio.checked) {
                    preguntas.add(radio.name); // Agregamos el nombre del grupo (de la pregunta)
                }
            });

            // Verificamos que todas las preguntas tengan al menos un radio seleccionado
            document.querySelectorAll('.card').forEach(card => {
                let preguntaId = card.querySelector('input[type="radio"]').name; // Obtener el nombre del grupo de radios
                if (!preguntas.has(preguntaId)) {
                    valido = false;
                    // Mostramos el mensaje de error en la tarjeta correspondiente
                    const errorDiv = card.querySelector('.error-message');
                    if (errorDiv) {
                        errorDiv.style.display = 'block';
                    }
                    return false; // Detiene la validación si alguna pregunta no tiene respuesta
                }
            });

            // Si todo está bien, el formulario se puede enviar
            if (valido) {
                document.getElementById("formExamen").submit();
            }
        }
    </script>
@endsection
