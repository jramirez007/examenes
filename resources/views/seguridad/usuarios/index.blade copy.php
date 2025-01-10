@extends('menu')
@section('contenido')

    <link rel="stylesheet" href="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.css') }}">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])




    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            /* Cambiado de 60px a 40px */
            height: 20px;
            /* Cambiado de 34px a 20px */
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            /* Cambiado de 26px a 16px */
            width: 16px;
            /* Cambiado de 26px a 16px */
            left: 2px;
            /* Cambiado de 4px a 2px */
            bottom: 2px;
            /* Cambiado de 4px a 2px */
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(20px);
            /* Cambiado de 26px a 20px */
            -ms-transform: translateX(20px);
            /* Cambiado de 26px a 20px */
            transform: translateX(20px);
            /* Cambiado de 26px a 20px */
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 20px;
            /* Cambiado de 34px a 20px */
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>




    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Usuarios
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-outline-dark btn-wave" data-bs-toggle="modal" data-bs-target="#modal-create">
                            Nuevo
                        </button>
                        @include('seguridad.usuarios.modal_create')
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
                                    <th>Roles</th>
                                    <th>Activo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $obj)
                                    <tr>
                                        <td>{{ $obj->id }}</td>
                                        <td>{{ $obj->name }}</td>
                                        <!-- <td>{{ $obj->username }}</td> -->
                                        <td>{{ $obj->email }}</td>
                                        <td>{{ $obj->roles }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" {{ $obj->activo > 0 ? 'checked' : '' }}
                                                    onchange="update_estado('{{ $obj->id }}')">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url('seguridad/usuario') }}/{{ $obj->id }}/edit"
                                                    class="btn btn-primary shadow btn sharp me-1">
                                                    <i class="bi bi-pencil-fill"></i></a> &nbsp;

                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-clave-{{ $obj->id }}"
                                                    class="btn btn-info shadow btn sharp me-1">
                                                    <i class="bi bi-arrow-left-right"></i>
                                                </a>
                                                {{-- &nbsp;
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-{{ $obj->id }}"
                                                    class="btn btn-danger shadow btn sharp"><i class="bi bi-trash"></i></a> --}}

                                            </div>
                                        </td>
                                    </tr>
                                    @include('seguridad.usuarios.cambiar_clave')
                                    @include('seguridad.usuarios.modal')
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


    <script>
        $(document).ready(function() {
            $('#datatable-basic').DataTable({
                destroy: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });


        function update_estado(usuario_id) {

            console.log(usuario_id);
            $.ajax({
                url: "{{ url('seguridad/usuario/update_estado') }}/" + usuario_id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {

                    //ballpark_up
                    console.log(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud POST:', error);
                }
            });

        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            expandMenuAndHighlightOption("seguridadMenu", "usuarios_Option");
        });

        function onlyLetters(event) {
            var char = String.fromCharCode(event.which);
            if (!/[a-zA-ZñÑ\s]/.test(char)) {
                event.preventDefault();
            }
        }
    </script>





@endsection
