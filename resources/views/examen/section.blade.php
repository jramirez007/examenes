@extends('menu_examen')
@section('contenido')
    <!-- Page Header -->

    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">

        <h1 class="page-title fw-medium fs-18 mb-0">SECTION {{ $section }}
        </h1>

    </div>

    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h5 class="mb-3">
                    @isset($title)
                        {{ $title }}
                    @endisset
                </h5>
            </div>
        </div>
        <div class="card-body">
            <h6>
                @isset($title)
                    {!! $description !!}
                @endisset
            </h6>
        </div>

    </div>

    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row">
        <form method="POST" id="formExamen" action="{{ url('curso/examen/section') }}">
            @csrf
            <input type="hidden" value="{{ $section }}" name="section">
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
                                        <input type="radio" name="respuesta_{{ $pregunta->id }}"
                                            value="{{ $respuesta->id }}"
                                            {{ $pregunta->getRespuesta($respuesta->id) == $respuesta->id ? 'checked' : '' }}>
                                        <span class="custom-radio"></span>
                                        {{ $respuesta->descripcion }}
                                    </label>
                                </div>
                            @endforeach
                            @if ($pregunta->id == 77)
                                <div id="audio-container"><audio controls>
                                        <source src = "https://cursos.coopweb.info/public/assets/audio/audio77.mp3"
                                            type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                    </audio>
                                </div>
                            @elseif($pregunta->id == 78)
                                <div id="audio-container"><audio controls>
                                        <source src = "https://cursos.coopweb.info/public/assets/audio/audio78.mp3"
                                            type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                    </audio>
                                </div>
                            @elseif($pregunta->id == 79)
                                <div id="audio-container"><audio controls>
                                        <source src = "https://cursos.coopweb.info/public/assets/audio/audio79.mp3"
                                            type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                    </audio>
                                </div>
                            @endif
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

            <div style="display: flex; justify-content: space-between; align-items: center;">

                <a href="{{ url('curso/examen/section') }}/{{ $section - 1 }}" {{ $section == 1 ? 'disabled' : '' }}>
                    <button type="button"
                        class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Preview&nbsp;&nbsp;</button></a>


                <button type="button" class="btn btn-primary btn-lg btn-wave"
                    onclick="validarFormulario()">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
            </div>
            <br>
        </form>

    </div>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.js"></script>

    <script>
        function validarFormulario() {
            let valido = true;
            let radios = document.querySelectorAll('input[type="radio"]');
            let preguntas = new Set(); // Usamos un Set para evitar duplicados

            // Ocultamos todos los mensajes de error
            document.querySelectorAll('.error-message').forEach(errorDiv => {
                errorDiv.style.display = 'none';
            });

            // Recorremos todos los botones de radio y marcamos las preguntas respondidas
            radios.forEach(radio => {
                if (radio.checked) {
                    preguntas.add(radio.name);
                }
            });

            // Verificamos que todas las preguntas tengan al menos una respuesta seleccionada
            document.querySelectorAll('.card').forEach(card => {
                let inputRadio = card.querySelector('input[type="radio"]');
                if (inputRadio) { // Verificamos si existe un input[type="radio"]
                    let preguntaId = inputRadio.name;
                    if (!preguntas.has(preguntaId)) {
                        valido = false;
                        // Mostramos el mensaje de error
                        const errorDiv = card.querySelector('.error-message');
                        if (errorDiv) {
                            errorDiv.style.display = 'block';
                        }
                    }
                }
            });

            // Si todo está bien, enviamos el formulario
            if (valido) {
                document.getElementById("formExamen").submit();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Faltan respuestas',
                    text: 'Por favor, selecciona una respuesta para todas las preguntas antes de continuar.',
                    confirmButtonText: 'Entendido',
                    timer: 3000 // Opcional: tiempo en milisegundos para cerrar automáticamente
                });
            }
        }
    </script>
@endsection
