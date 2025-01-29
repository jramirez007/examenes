@extends('menu')
@section('contenido')

    <link rel="stylesheet" href="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.css') }}">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])





    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Students
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
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <!-- <th>usuario</th> -->
                                    <th>correo</th>
                                    <th>Questions ok</th>
                                    <th>Questions bad</th>
                                    <th>Audio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $obj)
                                    @if ($obj->id > 1)
                                        <tr>
                                            <td>{{ $obj->id }}</td>
                                            <td>{{ $obj->name }}</td>
                                            <td>{{ $obj->email }}</td>
                                            <td>{{ $obj->number_questions_ok }}</td>
                                            <td>{{ $obj->number_questions_bad }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <audio controls>
                                                        <source src="{{ $obj->audio_section9 }}" type="audio/mp3">
                                                        Tu navegador no soporta el elemento de audio.
                                                    </audio>

                                                </div>
                                            </td>
                                            <td> <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-paragraph-{{ $obj->id }}"
                                                    class="btn btn-info shadow btn sharp me-1">
                                                    <i class="bi bi-file-text"></i>
                                                </a></td>
                                        </tr>
                                        @include('seguridad.usuarios.modal_paragraph')
                                    @endif
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
