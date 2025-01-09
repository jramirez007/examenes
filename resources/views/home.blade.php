}@extends('menu_student')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <head>
        <style>
            body {
                background-color: #BBCBDF;
            }
        </style>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script> --}}
    </head>
    <div class="row">

        {{-- <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ $examen->descripcion }}
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
                    <form id="form_examen">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="nombre" class="form-label">Pregunta</label>
                                <input type="hidden" name="examen_id" value="{{ $examen->id }}">
                                <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                                    required class="form-control" onblur="this.value = this.value.toUpperCase()">
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="adjunto" class="form-label">Tipo</label>
                                <select name="tipo_pregunta_id" id="tipo_pregunta_id" class="form-select"
                                    onchange="get_tipo(this.value)">
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" id="div_respuesta">
                            </div>


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                                <button type="button" onclick="saveRespuesta()"
                                    class="btn btn-info">&nbsp;&nbsp;Aceptar&nbsp;&nbsp;</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> --}}


        <div class="col-xl-12">
            <div>
                <div>
                    <div>
                        <div class="text-center">


                            {{-- {{ $curso->nombre }} --}}
                        </div>

                    </div>
                    <div class="prism-toggle">

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

                <form method="POST" action="{{ route('examen_evaluar') }}">
                    @csrf




                    <div class="card-body">

                        @php($i = 1)

                        <div id="seccion1">

                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 1 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>


                                <div class="card text-black mb-3" style="max-width: 100rem;">
                                    <div class="card-header">
                                        <div class="card-text d-flex justify-content-left">
                                            <h5
                                                style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                <span style="color: white">Structure</span>
                                            </h5>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <h5 class="card-text">
                                            Click on the best word or phrase (a, b, c or d) to fill each blank.
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            @foreach ($preguntas_seccion1->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="center">
                                            <button type="button" onclick="mostrarSeccion2()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 1 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 5%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">5%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 95%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">95%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <br>

                            </div>
                            <br>


                        </div>

                        <div id="seccion2" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 2 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text d-flex justify-content-center">
                                        <label for="nombre" class="form-check-label">


                                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                                <div class="card-header">
                                                    <div class="card-text d-flex justify-content-left">
                                                        <h5
                                                            style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                            <span style="color: white">Reading</span>
                                                        </h5>

                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    <h5 class="card-text">
                                                        Read the text below. For questions 21 to 25, choose the best answer
                                                        (a, b, c or d).
                                                        In 1895, the well-known scientist Lord Kelvin said, "Heavier than
                                                        air flying machines are impossible." Kelvin was wrong. In 1943,
                                                        Thomas Watson, the chairman of International Business Machines (IBM)
                                                        was also wrong when he said that he thought there would be a world
                                                        market for only five or so computers. Predictions can be wrong, and
                                                        it is very difficult to predict what the world will be like in 100,
                                                        50, or even 20 years. But this is something that scientists and
                                                        politicians often do. They do so because they invent things and make
                                                        decisions that shape the future of the world that we live in. In the
                                                        past they didn’t have to think too much about the impact that their
                                                        decisions had on the natural world. But that is now changing. More
                                                        and more people believe that we should live within the rules set by
                                                        nature. In other words, they think that in a world of fixed and
                                                        limited resources, what is used up today will no longer be available
                                                        for our children. We need to look at each human activity and try to
                                                        change it or create alternatives if it is not sustainable. The rules
                                                        for this are set by nature, not by man.<br>
                                                    </h5>
                                                </div>
                                            </div>




                                        </label>
                                    </h5>
                                </div>
                            </div>

                            @foreach ($preguntas_seccion2->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion1()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion3()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 2 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 24%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">24%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 76%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">76%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>






                        </div>

                        <div id="seccion3" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 3 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card text-black mb-3" style="max-width: 100rem;">
                                    <div class="card-header">
                                        <div class="card-text d-flex justify-content-left">
                                            <h5
                                                style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                <span style="color: white">Structure</span>
                                            </h5>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <h5 class="card-text">
                                            Click on the best word or phrase (a, b, c or d) to fill each blank.
                                        </h5>
                                    </div>
                                </div>
                            </div>


                            @foreach ($preguntas_seccion3->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion2()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion4()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 3 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 29%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">29%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 71%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">71%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>

                        </div>

                        <div id="seccion4" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 4 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text d-flex justify-content-center">
                                        <label for="nombre" class="form-check-label">

                                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                                <div class="card-header">
                                                    <div class="card-text d-flex justify-content-left">
                                                        <h5
                                                            style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                            <span style="color: white">Reading</span>
                                                        </h5>

                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    <h5 class="card-text">
                                                        Read the text below. For questions 46 to 50, choose the best answer
                                                        (a, b, c or d).
                                                        Many hotel chains and tour operators say that they take their
                                                        environmental commitments seriously, but often they do not respect
                                                        their social and economic responsibilities to the local community.
                                                        So is it possible for travellers to help improve the lives of locals
                                                        and still have a good holiday?

                                                        The charity, Tourism Concern, thinks so. It has pioneered the
                                                        concept of the fair-trade holiday. The philosophy behind fair-trade
                                                        travel is to make sure that local people get a fair share of the
                                                        income from tourism. The objectives are simple: employing local
                                                        people wherever possible; offering fair wages and treatment; showing
                                                        cultural respect; involving communities in deciding how tourism is
                                                        developed; and making sure that visitors have minimal environmental
                                                        impact.

                                                        Although there is currently no official fair-trade accreditation for
                                                        holidays, the Association of Independent Tour Operators has worked
                                                        hard to produce responsible tourism guidelines for its members. Some
                                                        new companies, operated as much by principles as profits, offer a
                                                        fantastic range of holidays for responsible and adventurous
                                                        travellers.
                                                        <br>
                                                    </h5>
                                                </div>
                                            </div>

                                        </label>
                                    </h5>
                                </div>
                            </div>

                            @foreach ($preguntas_seccion4->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion3()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion5()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 4 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 53%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">53%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 47%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">47%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>

                        </div>

                        <div id="seccion5" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 5 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card text-black mb-3" style="max-width: 100rem;">
                                    <div class="card-header">
                                        <div class="card-text d-flex justify-content-left">
                                            <h5
                                                style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                <span style="color: white">Structure</span>
                                            </h5>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <h5 class="card-text">
                                            Click on the best word or phrase (a, b, c or d) to fill each blank.
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            @foreach ($preguntas_seccion5->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion4()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion6()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 5 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 59%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">59%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 41%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">41%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>

                        </div>

                        <div id="seccion6" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 6 </label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text d-flex justify-content-center">
                                        <label for="nombre" class="form-check-label">

                                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                                <div class="card-header">
                                                    <div class="card-text d-flex justify-content-left">
                                                        <h5
                                                            style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                            <span style="color: white">Reading</span>
                                                        </h5>

                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    <h5 class="card-text">
                                                        Read the text below. For questions 71 to 76, choose the best answer
                                                        (a, b, c or d).
                                                        Standards of spelling and grammar among an entire generation of
                                                        English-speaking university students are now so poor that there is
                                                        ‘a degree of crises in their written use of the language, the
                                                        publisher of a new dictionary has warned. Its research revealed that
                                                        students have only a limited grasp of the most basic rules of
                                                        spelling, punctuation and meaning, blamed in part on an increasing
                                                        dependence on ‘automatic tools’ such as computer spellcheckers and
                                                        unprecedented access to rapid communication using e-mail and the
                                                        Internet. The problem is not confined to the US, but applies also to
                                                        students in Australia, Canada and Britain.
                                                        Students were regularly found to be producing incomplete or
                                                        rambling, poorly connected sentences, mixing metaphors ‘with gusto’
                                                        and overusing dull, devalued words such as ‘interesting’ and ‘good’.
                                                        Overall they were unclear about appropriate punctuation, especially
                                                        the use of commas, and failed to understand the basic rules of
                                                        subject/verb agreement and the difference between ‘there’, ‘their’
                                                        and ‘they’re’.
                                                        Kathy Rooney, editor-in-chief of the dictionary, said, ‘We need to
                                                        be very concerned at the extent of the problems with basic spelling
                                                        and usage that our research has revealed. This has significant
                                                        implications for the future, especially for young people. We thought
                                                        it would be useful to get in touch with teachers and academics to
                                                        find out what problems their students were having with their writing
                                                        and what extra help they might need from a dictionary. The results
                                                        were quite shocking. We are sure that the use of computers has
                                                        played a part. People rely increasingly on automatic tools such as
                                                        spellcheckers that are much more passive than going to a dictionary
                                                        and looking something up. That can lull them into a false sense of
                                                        security.’
                                                        Beth Marshall, an English professor, said, ‘The type of student
                                                        we’re getting now is very different from what we were seeing 10
                                                        years ago and it is often worrying to find out how little students
                                                        know. There are as many as 800 commonly misspelled words,
                                                        particularly pairs of words that are pronounced similarly but
                                                        spelled differently and that have different meanings – for example,
                                                        “faze” and “phase”, and “pray” and “prey”.’
                                                        <br>
                                                    </h5>
                                                </div>
                                            </div>

                                        </label>
                                    </h5>
                                </div>
                            </div>

                            @foreach ($preguntas_seccion6->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion5()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion7()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 6 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 82%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">82%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 18%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">18%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>

                        </div>

                        <div id="seccion7" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 7</label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>

                                <div class="card text-black mb-3" style="max-width: 100rem;">
                                    <div class="card-header">
                                        <div class="card-text d-flex justify-content-left">
                                            <h5
                                                style="background-color: #1D5294; width: 100%; height: 80px; display: flex; align-items: center; justify-content: left; padding-left: 30px;">
                                                <span style="color: white">Listening</span>
                                            </h5>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <h5 class="card-text">
                                            <b>Listening part.</b>
                                            <br><br>
                                            For each question, you will hear a short sentence. The sentence will be spoken
                                            just one time. The sentences you hear will not be written out for you. After you
                                            hear each sentence, read the 4 choices on the screen and decide which
                                            one is closest in meaning to the sentence you heard. Then select the best answer
                                            by clicking on it.
                                        </h5>
                                    </div>
                                </div>

                            </div>


                            @foreach ($preguntas_seccion7->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    @if ($pregunta->id == 77)
                                        <div id="audio-container"><audio controls>
                                                <source src = "https://cursos.coopweb.info/public/assets/audio/audio77.mp3"
                                                    type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                            </audio>
                                        </div>
                                        <br>
                                    @endif

                                    @if ($pregunta->id == 78)
                                        <div id="audio-container"><audio controls>
                                                <source src = "https://cursos.coopweb.info/public/assets/audio/audio78.mp3"
                                                    type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                            </audio>
                                        </div>
                                        <br>
                                    @endif

                                    @if ($pregunta->id == 79)
                                        <div id="audio-container"><audio controls>
                                                <source src = "https://cursos.coopweb.info/public/assets/audio/audio79.mp3"
                                                    type = "audio/wav">Tu navegador no soporta el elemento de audio.
                                            </audio>
                                        </div>
                                        <br>
                                    @endif
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h5 class="card-text">
                                                @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                    <div class="form-check">
                                                        <input type="radio" style="background-color: #202947"
                                                            onclick="setResponse('test{{ $respuesta->id }}','{{ $respuesta->id }}')"
                                                            name="respuesta{{ $i }}" class="form-check-input">

                                                        <label
                                                            class="form-check-label">{{ $respuesta->descripcion }}</label>


                                                        <input type="hidden" id="test{{ $respuesta->id }}"
                                                            name="test{{ $respuesta->id }}" readonly />
                                                    </div>
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion6()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion8()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 7 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 89%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">89%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 11%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">11%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>

                        </div>

                        <div id="seccion8" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 8</label>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text d-flex justify-content-center">
                                        <label for="nombre" class="form-check-label">
                                            <b>
                                                <center>Writing</center>
                                            </b>
                                            <br>
                                            <br>
                                            Global warming has become a serious threat to our planet.
                                            Explain what we can do as citizens to reduce the effects of global warming. You
                                            may want to consider factors, such as:
                                            <ul>
                                                <li>Recycling</li>
                                                <li>The impact of fossil fuels (oil, gas and coal)</li>
                                                <li>The impact of consumerism (buying things).</li>
                                            </ul>

                                        </label>
                                    </h5>
                                </div>
                            </div>


                            @foreach ($preguntas_seccion8->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <div class="card-text d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </h5>
                                                <h5 class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">


                                            <h5 class="card-text">

                                                <center>
                                                    <div id="contador">Words: 0 of 125</div>
                                                    <br>
                                                    <textarea name="miTextarea" id="miTextarea" cols="98" rows="10">
                                                        Write here
                                                    </textarea>
                                                </center>
                                            </h5>
                                        </div>
                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion7()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="mostrarSeccion9()"
                                                class="btn btn-info">&nbsp;&nbsp;Next&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <div class="card-header justify-content-center">
                                                    <p>Section 8 of 9</p>
                                                </div>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 94%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">94%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 6%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">6%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>



                        </div>

                        <div id="seccion9" style="display:none;">
                            <div class="card text-black mb-3" style="max-width: 100rem;">
                                <div class="card-header">
                                    <div class="card-text d-flex justify-content-center">
                                        <h5 class="card-title">
                                            <label for="nombre" class="form-check-label">
                                                SECTION 9</label>
                                            <input type="hidden" id="user_id" value="{{ auth()->user()->id }}"
                                                readonly>
                                        </h5>
                                        <h5 class="card-title">

                                        </h5>
                                    </div>
                                </div>
                                <h5 class="card-body">
                                    <div class="card-text d-flex justify-content-center">
                                        <label for="nombre" class="form-check-label">
                                            <b>
                                                <center>Speaking</center>
                                            </b>
                                            <br>
                                            <br>

                                            You have 20 seconds to prepare and 45 seconds to answer.
                                            <br>
                                            <br>
                                            Read the following question and record your answer.


                                        </label>
                                    </div>
                                </h5>
                            </div>


                            @foreach ($preguntas_seccion9->sortBy('id') as $pregunta)
                                @if ($pregunta->tipo_pregunta_id == 1)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <input type="text" name="pregunta{{ $i }}" class="form-control"
                                            readonly>
                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 2)
                                    <div class="card text-black mb-3" style="max-width: 100rem;">
                                        <div class="card-header">
                                            <h5 class="card-text d-flex justify-content-between">
                                                <div class="card-title">
                                                    <label for="nombre"
                                                        class="form-check-label">{{ $pregunta->descripcion }}</label>
                                                </div>
                                                <div class="card-title">
                                                    <label for="nombre" class="form-check-label"
                                                        style="color: #8c8c8c"></label>
                                                </div>
                                            </h5>
                                        </div>

                                        <br>
                                        <div class="card-body" id="div_test_record">


                                            <div class="card-text">

                                                <center>
                                                    <h5 class="card-title">
                                                        <label>
                                                            When you press this button a microphone will be enabled so you
                                                            can talk for 45 seconds
                                                        </label>
                                                    </h5>

                                                    <br>
                                                    <br>


                                                    {{-- <div id="div_lottie">
                                                        <!-- Contenedor para la animación Lottie -->
                                                        <div id="lottie-container" style="width: 400px; height: 400px;">
                                                        </div>
                                                    </div> --}}

                                                    <input type="hidden" name="audioData"  id="audioData">


                                                    <div>


                                                        <button type="button" id="startButton"
                                                            class="btn btn-info">&nbsp;&nbsp;Start speaking
                                                            test&nbsp;&nbsp;
                                                        </button>

                                                        <button type="button" id="stopButton" style="display: none"
                                                            class="btn btn-danger">&nbsp;&nbsp;Stop speaking
                                                            test&nbsp;&nbsp;
                                                        </button>
                                                        <br><br>
                                                        <audio id="audioPreview" controls></audio>

                                                    </div>


                                                </center>
                                            </div>
                                        </div>

                                        <br>




                                        <div class="card-body" id="div_play_record" style="display:none;">


                                            <div class="card-text">

                                                <center>
                                                    <div class="card-title">


                                                        <!-- Reproductor de audio en la página -->


                                                        <div id="audio_html"></div>

                                                        <br>




                                                        <button type="button" id="addAudioBtn"
                                                            class="btn btn-info">&nbsp;&nbsp;Test my audio
                                                            file&nbsp;&nbsp;</button>

                                                        <button type="button" id="removeAudioBtn"
                                                            class="btn btn-danger">&nbsp;&nbsp;Repeat another speaking
                                                            test&nbsp;&nbsp;</button>

                                                    </div>



                                                </center>
                                            </div>
                                        </div>

                                        <br>


                                    </div>
                                @elseif ($pregunta->tipo_pregunta_id == 3)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        <select class="form-select">
                                            @foreach ($pregunta->respuestas->sortBy('id') as $respuesta)
                                                <option value="{{ $respuesta->id }}">{{ $respuesta->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <br>
                                @elseif ($pregunta->tipo_pregunta_id == 4)
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="nombre" class="form-label">{{ $pregunta->descripcion }}</label>
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="form-check">
                                                <input type="checkbox" name="pregunta{{ $pregunta->id }}"
                                                    class="form-check-input">
                                                <label class="form-check-label">{{ $respuesta->descripcion }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif
                                @php($i++)
                            @endforeach

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <table width='100%'>
                                    <tr>
                                        <td align="right">
                                            <button type="button" onclick="mostrarSeccion8()"
                                                class="btn btn-info">&nbsp;&nbsp;Previous&nbsp;&nbsp;</button>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                class="btn btn-primary">&nbsp;&nbsp;Submit&nbsp;&nbsp;</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="card custom-card">
                                                <h5 class="card-header justify-content-center">
                                                    <p>Section 9 of 9</p>
                                                </h5>
                                                <div class="card-body">

                                                    <div class="progress-stacked progress-xl mb-5">
                                                        <div class="progress-bar  bg-success" role="progressbar"
                                                            style="width: 97%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">97%</div>

                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 3%" aria-valuenow="35" aria-valuemin="0"
                                                            aria-valuemax="100">3%</div>

                                                    </div>

                                                </div>
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                            </div>
                            <br>



                        </div>

                    </div>


                </form>



                {{-- <form id="form_audio" action="{{ route('upload_audio') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="audioFile">Selecciona un archivo de audio:</label>
                    <input type="file" name="audioFile" accept="audio/*" required>
                    <button type="submit">Subir
                        archivo</button>
                </form> --}}
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            //alert("ready!");
            //mostrarSeccion9();


            //startStopTimer();


        });
    </script>



    <script>
        function get_tipo(id) {
            const url = `{{ url('curso/examen') }}/${id}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.text(); // Cambiar a response.text() para manejar HTML
                })
                .then(html => {
                    document.getElementById('div_respuesta').innerHTML = html; // Insertar HTML en el div
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>

    <script>
        function saveRespuesta() {
            const form = document.getElementById('form_examen');
            let formData = new FormData(form);

            //alert(JSON.stringify(formData));

            let valid = true;

            Array.from(form.elements).forEach(element => {
                if (element.name) {

                    var x = element.name;
                    var index = x.search(/\d/); // Find the index of the first digit
                    var word = x.substring(0, index); // Extract the part before the number


                    if (!element.value.trim()) {
                        valid = false;
                        element.classList.add('is-invalid');
                    } else {
                        element.classList.remove('is-invalid');
                    }
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Por favor, rellena todos los campos.',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ url('curso/examen') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la red: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        console.log(data);
                        window.location.href = "{{ url('catalogo/curso/show_examen/') }}/{{ $examen->id }}";

                        // Swal.fire({
                        //      icon: 'success',
                        //      title: 'Éxito',
                        //      text: data.message,
                        //      confirmButtonText: 'Aceptar'
                        //  });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al enviar el formulario.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al enviar el formulario.',
                        confirmButtonText: 'Aceptar'
                    });
                });
        }

        function setResponse(name, response) {
            var codigo = response;

            // alert(name);
            // alert(response);

            $.ajax({
                //url: 'http://154.12.255.170/cursos/public/get_correcta/' + codigo, // The URL to call the route
                url: 'http://localhost:8000/get_correcta/' + codigo, // The URL to call the route
                type: 'GET', // Using GET request
                success: function(response) {

                    // Handle the successful response
                    console.log('Correcta: ', response);
                    document.getElementById(name).value = response;

                    // You can display the result somewhere on the page
                    //$('#result').text('Correcta: ' + response.correcta);
                },
                error: function(xhr, status, error) {
                    // Handle errors (e.g., record not found)
                    console.error('Error: ' + error);
                    document.getElementById(name).value = 'Error: Respuesta no encontrada';
                    //$('#result').text('Error: Respuesta no encontrada');
                }
            });


        }
    </script>

    <script>
        let counter = 1; // Contador inicial para los nombres de los inputs

        function addInput() {
            // Crear un nuevo elemento div
            const newDiv = document.createElement('div');
            newDiv.classList.add('col-xl-8', 'col-lg-8', 'col-md-8', 'col-sm-8', 'mb-2', 'd-flex',
                'align-items-center');
            newDiv.setAttribute('data-id', counter); // Establecer un atributo data-id único

            // Crear un nuevo botón de basurero
            const trashButton = document.createElement('button');
            trashButton.type = 'button';
            trashButton.classList.add('btn', 'btn-danger', 'me-2');
            trashButton.innerHTML = '<i class="bi bi-trash"></i>'; // Icono de Bootstrap

            // Añadir evento para eliminar el input al presionar el botón de basurero
            trashButton.onclick = function() {
                newDiv.remove();
                updateInputNames(); // Actualizar los nombres de los inputs restantes
            };

            // Crear un nuevo input
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'respuesta' + counter; // Asignar nombre incremental
            newInput.classList.add('form-control');
            newInput.placeholder = 'Respuesta ' + counter; // Placeholder

            const newDiv2 = document.createElement('div');
            newDiv2.classList.add('col-xl-4', 'col-lg-4', 'col-md-4', 'col-sm-4', 'mb-2', 'd-flex',
                'align-items-center');


            // Create a new checkbox element
            const newCheckbox = document.createElement('input');
            newCheckbox.type = 'checkbox';
            newCheckbox.name = 'option' + counter; // Assign an incremental name
            newCheckbox.id = 'checkbox' + counter; // Optional: Assign an ID
            newCheckbox.value = 'Option ' + counter; // Assign a value

            // Create a label for the checkbox
            const newLabel = document.createElement('label');
            newLabel.htmlFor = newCheckbox.id; // Associate label with checkbox
            newLabel.textContent = 'Es correcta? '; // Label text


            // Añadir el botón de basurero y el input al div
            newDiv.appendChild(trashButton);
            newDiv.appendChild(newInput);


            newDiv.appendChild(newCheckbox);
            newDiv.appendChild(newLabel);

            // Añadir el nuevo div al div principal
            document.getElementById('div_option').appendChild(newDiv);

            // Incrementar el contador
            counter++;
        }

        function updateInputNames() {
            // Obtener todos los divs hijos en el contenedor principal
            const inputs = document.querySelectorAll('#div_option > div');
            counter = 1; // Reiniciar el contador

            // Recorrer los divs y actualizar los nombres de los inputs
            inputs.forEach(div => {
                const input = div.querySelector('input');
                input.name = 'respuesta' + counter; // Asignar nuevo nombre basado en el contador
                input.placeholder = 'Respuesta ' + counter; // Actualizar el placeholder
                counter++; // Incrementar el contador
            });
        }
    </script>

    <script>
        function mostrarSeccion1() {
            ocultarSecciones();

            var div_show_seccion1 = document.getElementById("seccion1");
            div_show_seccion1.style.display = "block";
        }

        function mostrarSeccion2() {
            ocultarSecciones();

            var div_show_seccion2 = document.getElementById("seccion2");
            div_show_seccion2.style.display = "block";
        }

        function mostrarSeccion3() {
            ocultarSecciones();

            var div_show_seccion3 = document.getElementById("seccion3");
            div_show_seccion3.style.display = "block";
        }

        function mostrarSeccion4() {
            ocultarSecciones();

            var div_show_seccion4 = document.getElementById("seccion4");
            div_show_seccion4.style.display = "block";
        }

        function mostrarSeccion5() {
            ocultarSecciones();

            var div_show_seccion5 = document.getElementById("seccion5");
            div_show_seccion5.style.display = "block";
        }

        function mostrarSeccion6() {
            ocultarSecciones();

            var div_show_seccion6 = document.getElementById("seccion6");
            div_show_seccion6.style.display = "block";
        }

        function mostrarSeccion7() {
            ocultarSecciones();

            var div_show_seccion7 = document.getElementById("seccion7");
            div_show_seccion7.style.display = "block";
        }

        function mostrarSeccion8() {
            ocultarSecciones();

            var div_show_seccion8 = document.getElementById("seccion8");
            div_show_seccion8.style.display = "block";
        }

        function mostrarSeccion9() {
            ocultarSecciones();

            var div_show_seccion9 = document.getElementById("seccion9");
            div_show_seccion9.style.display = "block";
        }


        function ocultarSecciones() {
            var div_seccion1 = document.getElementById("seccion1");
            var div_seccion2 = document.getElementById("seccion2");
            var div_seccion3 = document.getElementById("seccion3");
            var div_seccion4 = document.getElementById("seccion4");
            var div_seccion5 = document.getElementById("seccion5");
            var div_seccion6 = document.getElementById("seccion6");
            var div_seccion7 = document.getElementById("seccion7");
            var div_seccion8 = document.getElementById("seccion8");
            var div_seccion9 = document.getElementById("seccion9");

            div_seccion1.style.display = "none";
            div_seccion2.style.display = "none";
            div_seccion3.style.display = "none";
            div_seccion4.style.display = "none";
            div_seccion5.style.display = "none";
            div_seccion6.style.display = "none";
            div_seccion7.style.display = "none";
            div_seccion8.style.display = "none";
            div_seccion9.style.display = "none";

        }
    </script>

    <script>
        // Obtener el textarea y el div del contador
        const textarea = document.getElementById("miTextarea");
        const contador = document.getElementById("contador");

        // Añadir un evento 'input' para contar las palabras mientras escribes
        textarea.addEventListener("input", function() {
            // Obtener el texto escrito
            const texto = textarea.value;

            // Dividir el texto en palabras (considerando los espacios como delimitadores)
            const palabras = texto.trim().split(
                /\s+/); // La expresión regular /\s+/ maneja los espacios y saltos de línea

            // Si el contenido del textarea está vacío, no contamos palabras
            const numPalabras = texto.trim() === "" ? 0 : palabras.length;

            // Actualizar el texto del contador
            contador.textContent = "Words: " + numPalabras + " of 125";
        });
    </script>



    <script>
        // Inicializar la animación Lottie
        // var animation = bodymovin.loadAnimation({
        //     container: document.getElementById('lottie-container'), // Contenedor donde se renderiza la animación
        //     path: 'http://localhost/cursos/public/assets/audio/numbers_animate_json.json', // Ruta al archivo Lottie JSON
        //     renderer: 'svg', // Tipo de renderizado (svg, canvas, o html)
        //     loop: true, // Si la animación debe repetirse
        //     autoplay: true, // Si la animación comienza automáticamente
        // });
    </script>

    {{-- <script type="text/javascript">
function abrirPopup() {
    //testRecord();

    // Definir el tamaño de la ventana
    var ancho = 600;
    var alto = 800;

    // Obtener la posición centrada en la pantalla
    var x = (window.innerWidth / 2) - (ancho / 2);
    var y = (window.innerHeight / 2) - (alto / 2);

    // Abrir la ventana popup
    var ventana = window.open(
        'test.html?user_id='+document.getElementById('user_id').value,  // URL a abrir
        'Popup',      // Nombre de la ventana
        'width=' + ancho + ',height=' + alto + ',left=' + x + ',top=' + y + ',scrollbars=yes'
    );
}
</script> --}}

    <script>
        let mediaRecorder;
        let audioChunks = [];

        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const audioPreview = document.getElementById('audioPreview');
        const audioDataInput = document.getElementById('audioData');
        //const submitButton = document.getElementById('submitButton');

        startButton.addEventListener('click', async () => {

            if (startButton) {
                startButton.style.display = 'none';
            }

            if (stopButton) {
                stopButton.style.display = 'block';
            }
            // Solicitar permiso para usar el micrófono
            const stream = await navigator.mediaDevices.getUserMedia({
                audio: true
            });

            // Crear el MediaRecorder
            mediaRecorder = new MediaRecorder(stream);

            // Manejar los datos de audio grabados
            mediaRecorder.ondataavailable = (event) => {
                audioChunks.push(event.data);
            };

            // Manejar el fin de la grabación
            mediaRecorder.onstop = () => {
                const audioBlob = new Blob(audioChunks, {
                    type: 'audio/webm'
                });
                audioChunks = [];

                // Crear una URL para previsualizar el audio grabado
                 const audioURL = URL.createObjectURL(audioBlob);
                 audioPreview.src = audioURL;

                // Convertir el Blob a Base64 para enviarlo en el formulario
                const reader = new FileReader();
                reader.onloadend = () => {
                    audioDataInput.value = reader.result; // Guardar Base64 en el campo oculto
                    //submitButton.disabled = false; // Habilitar el botón de envío
                };
                reader.readAsDataURL(audioBlob);
            };

            // Iniciar la grabación
            mediaRecorder.start();
            startButton.disabled = true;
            stopButton.disabled = false;
        });

        stopButton.addEventListener('click', () => {
            // Detener la grabación
            mediaRecorder.stop();
            startButton.disabled = false;
            stopButton.disabled = true;

            if (startButton) {
                startButton.style.display = 'block';
            }

            if (stopButton) {
                stopButton.style.display = 'none';
            }
        });
    </script>


@endsection
