@extends('menu')
@section('contenido')




    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Examenes
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
                                    <th>Nombre</th>
                                    <!-- <th>usuario</th> -->
                                    <th>correo</th>
                                    <th>Questions ok</th>
                                    <th>Questions bad</th>
                                    <th>Audio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examenes as $obj)
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

                                            <a href="{{url('curso/examen')}}/{{$obj->id}}?exportar=0" target="_blank" class="btn btn-success shadow btn sharp me-1">
                                                <i class="bi bi-eye"></i>

                                            </a>

                                            <a href="{{url('curso/examen')}}/{{$obj->id}}?exportar=1" target="_blank" class="btn btn-warning shadow btn sharp me-1">
                                                <i class="bi bi-file-earmark-pdf"></i>

                                            </a>
                                        </td>
                                    </tr>
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
