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
            background-color: #f4f4f4;
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

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
        }

        .header p {
            font-size: 10px;
            margin: 0;
            text-transform: capitalize;
        }

        .header .btn {
            font-size: 12px;
            margin-left: 15px;
        }

        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 15px;
        }

        .card-title h5 {
            font-size: 16px;
            margin: 0;
            font-weight: normal;
        }

        .radio-container {
            margin-bottom: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
        }

        .radio-label input[type="radio"] {
            margin-right: 10px;
        }

        .answer-text {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="d-flex align-items-center">
                <div class="me-2 d-flex flex-column justify-content-center">
                    <p>
                        <strong>{{ auth()->user()->name }}</strong> <br>
                    </p>
                </div>
                <div>
                    <i class="bi bi-person-circle" style="font-size: 24px;"></i>
                </div>
                <a class="ms-3 btn btn-primary" href="{{ route('cerrar_sesion') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
            </div>
        </div>

        <!-- Logout form -->
        <form id="logout-form" action="{{ route('cerrar_sesion') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Usuario -->
        <div class="page-header">
            <h5>{{ $examen->usuario->name ?? 'Nombre del Usuario' }}</h5>
        </div>

        <!-- Preguntas -->
        @foreach ($preguntas as $pregunta)
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
                                <input type="radio" name="respuesta_{{ $pregunta->id }}" value="{{ $respuesta->id }}"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @elseif($pregunta->id == 85)
                        <div id="audio-container">
                            <audio controls>
                                <source src="{{ $respuesta85 }}" type="audio/mp3">
                                Tu navegador no soporta el elemento de audio.
                            </audio>
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
