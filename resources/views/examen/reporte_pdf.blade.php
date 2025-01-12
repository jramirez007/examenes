<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Examen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffffff; /* Fondo blanco */
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h5 {
            font-size: 20px;
            margin: 0;
            color: #333;
        }

        .card {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .card-header {
            background-color: #12498F;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: white ;
        }

        .card-body {
            padding: 10px;
        }

        .card-title h5 {
            font-size: 14px;
            margin: 0;
            font-weight: normal;
        }

        .radio-container {
            margin-bottom: 5px;
        }

        .radio-label {
            display: flex;
            align-items: center;
        }

        .radio-label input[type="radio"] {
            margin-right: 10px;
        }

        .answer-text {
            font-size: 12px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h5>{{ $examen->usuario->name ?? '' }} <br> {{ $examen->usuario->email ?? '' }}</h5>
        </div>
        <div >
            <h3>SECTION 1</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion1 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach


        <div class="page-header">
            <h5>SECTION 2</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion2 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach




        <div class="page-header">
            <h5>SECTION 3</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion3 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach



        <div class="page-header">
            <h5>SECTION 4</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion4 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach


        <div class="page-header">
            <h5>SECTION 5</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion5 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach


        <div class="page-header">
            <h5>SECTION 6</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion6 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach



        <div class="page-header">
            <h5>SECTION 7</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion7 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach





        <div class="page-header">
            <h5>SECTION 8</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas_seccion8 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }} {{$respuesta->id }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
        @endforeach


    </div>
</body>
</html>
