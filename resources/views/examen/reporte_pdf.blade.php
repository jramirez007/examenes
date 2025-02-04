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
            background-color: #ffffff;
            /* Fondo blanco */
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
            color: white;
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



        /* Centering the table */
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            /* Adjust the width as needed */
        }

        /* Card Styling for td */
        td {
            padding: 10px 20px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* .card-header {
        background-color: #f7f7f7;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
    } */

        .card-header {
            background-color: #12498F;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: white;
        }


        .card-title h5 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .card-body {
            padding: 15px;
            font-size: 14px;
            color: #555;
        }

        /* Bold styling for total row */
        .card-header b {
            font-weight: bold;
            color: #000;
        }

        /* Optional: Center content within table cells */
        td {
            text-align: center;
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="page-header">
            <h5>Student: <b>{{ $examen->usuario->name ?? '' }}</b> <br> email:
                <b>{{ $examen->usuario->email ?? '' }}</b>
            </h5>
        </div>
        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 1</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 1)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion1 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->

                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)


                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt="" width="16px"
                                            height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt="" width="16px"
                                            height="16px">
                                    @endif
                                @else
                                @endif

                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    {{-- @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif --}}

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach


        @php($j--)

        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 1</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section1 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section1 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section1 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>

        {{-- <div>
            <h5>
                cuenta_ok = @php(echo $cuenta_ok);
                <br>
                cuenta_bad = @php(echo $cuenta_bad);
                <br>
                cuenta_total = @php(echo $i);
            </h5>
        </div> --}}

        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 2</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>


        <!-- Preguntas -->
        @php($i = 21)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion2 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)


                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt="" width="16px"
                                            height="16px">
                                    @endif
                                @else
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach

        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 2</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section2 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section2 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section2 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>


        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 3</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 26)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion3 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)

                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt="" width="16px"
                                            height="16px">
                                    @endif
                                @else
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach


        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 3</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section3 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section3 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section3 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>






        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 4</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 46)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion4 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)

                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt="" width="16px"
                                            height="16px">
                                    @endif
                                @else
                                @endif

                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach

        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 4</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section4 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section4 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section4 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>






        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 5</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 51)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion5 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)

                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt=""
                                            width="16px" height="16px">
                                    @endif
                                @else
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach

        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 5</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section5 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section5 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section5 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>





        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 6</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 71)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion6 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)

                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt=""
                                            width="16px" height="16px">
                                    @endif
                                @else
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
            @php($j++)
        @endforeach

        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 6</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section6 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section6 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section6 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>




        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 7</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 77)
        @php($j = 1)
        @php($cuenta_ok = 0)
        @php($cuenta_bad = 0)
        @foreach ($preguntas_seccion7 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        @if ($pregunta->id == 79)
                            @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? ($cuenta_ok = $cuenta_ok + 2) : ($cuenta_bad = $cuenta_bad + 2))
                        @else
                            @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)
                        @endif



                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}

                                @if ($pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id)
                                    @if ($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1')
                                        <img src="{{ asset('assets/audio/success.png') }}" alt=""
                                            width="16px" height="16px">
                                    @else
                                        <img src="{{ asset('assets/audio/error.png') }}" alt=""
                                            width="16px" height="16px">
                                    @endif
                                @else
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @if ($pregunta->id == 79)
                @php($i = $i + 2)
                @php($j = $j + 2)
                @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? ($cuenta_ok = $cuenta_ok + 2) : ($cuenta_bad = $cuenta_bad + 2))
            @else
                @php($i++)
                @php($j++)
                @php($pregunta->getRespuestaEvaluarAdmin($respuesta->id, $examen->id) == '1' ? $cuenta_ok++ : $cuenta_bad++)
            @endif
        @endforeach

        @php($j--)
        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 7</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    Correct answers

                </td>
                <td>
                    @php($total_points_ok_section7 = $cuenta_ok)
                    {{ $cuenta_ok }}

                </td>
            </tr>
            <tr>
                <td>
                    Bad answers
                </td>
                <td>
                    @php($total_points_bad_section7 = $j - $cuenta_ok)
                    {{ $j - $cuenta_ok }}
                </td>
            </tr>
            <tr>
                <td>

                    <b> Total answers</b>

                </td>
                <td>
                    @php($total_points_section7 = $j)
                    <b>{{ $j }}</b>

                </td>
            </tr>
        </table>






        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 8</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 80)
        @foreach ($preguntas_seccion8 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->
                    @if ($pregunta->id == 80)
                        <div class="answer-text">{{ $respuesta80 }}</div>
                    @endif

                </div>
            </div>
            @php($i++)
        @endforeach

        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 8</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    <b>Observation</b>

                </td>
                <td>

                    <b>points</b>

                </td>
            </tr>
            <tr>
                <td>

                    {{ $observacion_seccion8 }}

                </td>
                <td>

                    {{ $puntos_seccion8 }}

                </td>
            </tr>
        </table>










        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>SECTION 9</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>

        <!-- Preguntas -->
        @php($i = 81)
        @foreach ($preguntas_seccion9 as $pregunta)
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>{{ $i }} - {{ $pregunta->descripcion }}</h5>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Respuestas -->
                    @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio"
                                    {{ $pregunta->getRespuestaAdmin($respuesta->id, $examen->id) == $respuesta->id ? 'checked' : '' }}>
                                {{ $respuesta->descripcion }}
                            </label>
                        </div>
                    @endforeach

                    <!-- Respuesta Textual para Pregunta 80 -->


                </div>
            </div>
            @php($i++)
        @endforeach


        <table>
            <tr>
                <td colspan="2">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>SUMMARY SECTION 9</b>
                            </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                    <b>Observation</b>

                </td>
                <td>

                    <b>points</b>

                </td>
            </tr>
            <tr>
                <td>

                    {{ $observacion_seccion9 }}

                </td>
                <td>

                    {{ $puntos_seccion9 }}

                </td>
            </tr>
        </table>


        <br>
        <hr>
        <br>



        <div class="card-header">
            <div class="card-title" style="text-align: center;">
                <h5>GENERAL SUMMARY</b>
                </h5>
            </div>
        </div>

        <br>
        <hr>
        <br>


        <table>
            <tr style="background-color: #12498F">
                <td>
                    <div class="card-header">
                        <div class="card-title">
                            <h5> SECTION NUMBER </h5>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card-header">
                        <div class="card-title">
                            <h5> OK POINTS </h5>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="card-header">
                        <div class="card-title">
                            <h5> BAD POINTS </h5>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card-header">
                        <div class="card-title">
                            <h5> TOTAL POINTS </h5>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    1
                </td>
                <td>
                    {{ $total_points_ok_section1 }}
                </td>
                <td>
                    {{ $total_points_bad_section1 }}
                </td>
                <td>
                    {{ $total_points_section1 }}
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td>
                    {{ $total_points_ok_section2 }}
                </td>
                <td>
                    {{ $total_points_bad_section2 }}
                </td>
                <td>
                    {{ $total_points_section2 }}
                </td>
            </tr>
            <tr>
                <td>
                    3
                </td>
                <td>
                    {{ $total_points_ok_section3 }}
                </td>
                <td>
                    {{ $total_points_bad_section3 }}
                </td>
                <td>
                    {{ $total_points_section3 }}
                </td>
            </tr>
            <tr>
                <td>
                    4
                </td>
                <td>
                    {{ $total_points_ok_section4 }}
                </td>
                <td>
                    {{ $total_points_bad_section4 }}
                </td>
                <td>
                    {{ $total_points_section4 }}
                </td>
            </tr>
            <tr>
                <td>
                    5
                </td>
                <td>
                    {{ $total_points_ok_section5 }}
                </td>
                <td>
                    {{ $total_points_bad_section5 }}
                </td>
                <td>
                    {{ $total_points_section5 }}
                </td>
            </tr>
            <tr>
                <td>
                    6
                </td>
                <td>
                    {{ $total_points_ok_section6 }}
                </td>
                <td>
                    {{ $total_points_bad_section6 }}
                </td>
                <td>
                    {{ $total_points_section6 }}
                </td>
            </tr>
            <tr>
                <td>
                    7
                </td>
                <td>
                    {{ $total_points_ok_section7 }}
                </td>
                <td>
                    {{ $total_points_bad_section7 }}
                </td>
                <td>
                    {{ $total_points_section7 }}
                </td>
            </tr>
            <tr>
                <td>
                    8
                </td>
                <td>
                    {{ $puntos_seccion8 }}
                </td>
                <td>
                    {{ 5 - $puntos_seccion8 }}
                </td>
                <td>
                    5
                </td>
            </tr>
            <tr>
                <td>
                    9
                </td>
                <td>
                    {{ $puntos_seccion9 }}
                </td>
                <td>
                    {{ 5 - $puntos_seccion9 }}
                </td>
                <td>
                    5
                </td>
            </tr>
            <tr>
                <td>
                    <b>GENERAL TOTAL</b>
                </td>
                <td>
                    <b>{{ $total_points_ok_section1 + $total_points_ok_section2 + $total_points_ok_section3 + $total_points_ok_section4 +
                            $total_points_ok_section5 + $total_points_ok_section6 + $total_points_ok_section7 + $puntos_seccion8 + $puntos_seccion9 }}</b>
                </td>
                <td>
                    <b>{{ $total_points_bad_section1 + $total_points_bad_section2 + $total_points_bad_section3 + $total_points_bad_section4 +
                            $total_points_bad_section5 + $total_points_bad_section6 + $total_points_bad_section7 + (5 - $puntos_seccion8) + (5 - $puntos_seccion9) }}</b>
                </td>
                <td>
                    <b>{{ $total_points_section1 + $total_points_section2 + $total_points_section3 + $total_points_section4 +
                            $total_points_section5 + $total_points_section6 + $total_points_section7 + 5 + 5 }}</b>
                </td>
            </tr>
        </table>









    </div>
</body>

</html>
