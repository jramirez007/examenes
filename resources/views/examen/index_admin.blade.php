@extends('menu')
@section('contenido')

    <style>
        .audio-container {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            /* align-items: center;     */
            /*height: 60vh;*/
            /* Set the height to full viewport height */
            width: 100%;
            /* Full width */
        }
    </style>


    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Responses
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
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <!-- <th>usuario</th> -->
                                    <th>Email</th>
                                    <th>Good Responses</th>
                                    <th>Bad Responses</th>
                                    <th>Audio</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examenes as $obj)
                                    @if (!isset($obj->usuario->impreso) || !isset($obj->usuario->calificado))
                                        <tr>
                                            <td>{{ $obj->id }}</td>
                                            <td>{{ $obj->usuario->name ?? '' }}</td>
                                            <td>{{ $obj->usuario->email ?? '' }}</td>
                                            <td>{{ $obj->number_questions_ok }}</td>
                                            <td>{{ $obj->number_questions_bad }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <audio controls>
                                                        <source src="{{ $obj->getAudio() }}" type="audio/mp3">
                                                        Tu navegador no soporta el elemento de audio.
                                                    </audio>

                                                </div>
                                            </td>
                                            <td>
                                                @if ($obj->usuario->calificado == 0)
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#modal-calificar-{{ $obj->id }}"
                                                        class="btn btn-primary shadow btn sharp me-1">
                                                        <i class="bi bi-pencil"></i>

                                                    </a>
                                                @endif

                                                @if ($obj->usuario->calificado == 1)
                                                    <a href="{{ url('curso/examen') }}/{{ $obj->id }}?exportar=1"
                                                        target="_blank" class="btn btn-warning shadow btn sharp me-1">
                                                        <i class="bi bi-file-earmark-pdf"></i>

                                                    </a>
                                                @endif

                                                @if ($obj->usuario->impreso == 1)
                                                <a href="{{ url('curso/examen') }}/{{ $obj->id }}?exportar=2"
                                                    target="_blank" class="btn btn-warning shadow btn sharp me-1">
                                                    <i class="bi bi-archive"></i>

                                                </a>
                                            @endif


                                                {{-- <button onclick="load_sections89({{ $obj->id }})"
                                                            class="btn btn-primary shadow btn sharp me-1">
                                                            <i class="bi bi-pencil"></i>

                                                        </button> --}}

                                                {{-- <a href="{{ url('curso/reporte') }}/{{ $obj->id }}?exportar=0"
                                                            target="_blank" class="btn btn-success shadow btn sharp me-1">
                                                            <i class="bi bi-eye"></i>

                                                        </a> --}}





                                            </td>
                                        </tr>
                                    @else
                                    @endif


                                    @include('examen.modal_calificar')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>


    <script src="{{ asset('assets/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/dataTables.responsive.min.js') }}"></script>


    <!-- Internal Datatables JS -->
    <script src="{{ asset('assets/js/datatables.js') }}"></script>







@endsection
