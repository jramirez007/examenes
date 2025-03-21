@extends('menu_examen')
@section('contenido')
    <style>
        .linea {
            display: inline-block;
            width: 100px;
            /* Ajusta el ancho de la línea según sea necesario */
            border-bottom: 2px solid #000;
            /* Crea una línea continua */
            margin-left: 5px;
            /* Espacio a la izquierda si lo necesitas */
        }
    </style>
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">

        <h1 class="page-title fw-medium fs-18 mb-0">SECTION {{ $section }}
        </h1>

    </div>

    <div class="card custom-card">
        <div class="card-header justify-content-between"
            style="background-color:  #12498F !important; color: white  !important;">
            <div class="card-title">
                <h5 class="mb-3" style="color: inherit !important;">
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
                        <div class="card-header d-flex align-items-center">
                            <!-- Círculo azul con el id a la izquierda -->
                            <div class="circle-container">
                                @if (session('id') == 1)
                                    <span class="circle-text">
                                        {{ $pregunta->id }}
                                    </span>
                                @else
                                    <span class="circle-text">
                                        {{ $pregunta->id - 81 }}
                                    </span>
                                @endif

                            </div>

                            <!-- Título de la pregunta, centrado verticalmente con el círculo -->
                            <div class="card-title ml-2">
                                <h5 class="mb-0">
                                    {!! preg_replace('/_+/', '<span class="linea"></span>', $pregunta->descripcion) !!}
                                </h5>
                            </div>
                        </div>



                        <div class="card-body">
                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                <div class="radio-container" id="container-{{ $respuesta->id }}">
                                    <label class="radio-label">
                                        <input type="radio" name="respuesta_{{ $pregunta->id }}"
                                            value="{{ $respuesta->id }}"
                                            {{ $pregunta->getRespuesta($respuesta->id) == $respuesta->id ? 'checked' : '' }}
                                            onclick="handleRadioClick({{ json_encode($pregunta->respuestasArray()) }}, this)">
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

                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-xl-6">
                    @if ($section > 1)
                        <a href="{{ url('curso/examen/section') }}/{{ $section - 1 }}">
                            <button type="button" class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Preview
                                &nbsp;&nbsp;</button></a>
                    @endif
                </div>
                <div class="col-xl-6 text-end">
                    @if ($section == 7 && session('id') == 2)
                        <button type="submit" class="btn btn-success btn-lg btn-wave">&nbsp;&nbsp;Submit&nbsp;&nbsp;</button>
                    @else
                        <button type="submit" class="btn btn-primary btn-lg btn-wave">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                    @endif

                </div>
            </div>
            <br>
        </form>

    </div>
@endsection
