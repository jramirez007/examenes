@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.css') }}">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            /* Smaller width */
            height: 20px;
            /* Smaller height */
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

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
            /* Smaller knob */
            width: 16px;
            /* Smaller knob */
            left: 2px;
            /* Adjusted position */
            bottom: 2px;
            /* Adjusted position */
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
            -webkit-transform: translateX(18px);
            /* Adjusted distance */
            -ms-transform: translateX(18px);
            /* Adjusted distance */
            transform: translateX(18px);
            /* Adjusted distance */
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 20px;
            /* Rounded smaller slider */
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <style>
        table.dataTable td {
            white-space: normal;
            word-wrap: break-word;
            max-width: 300px;
            /* Ajusta el ancho máximo según tus necesidades */
        }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Cursos
                    </div>
                    <div class="prism-toggle">
                        <a href="{{ url('catalogo/curso/create') }}">
                            <button class="btn btn-outline-dark btn-wave">
                                Nuevo
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
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $obj)
                                    <tr>
                                        <td>{{ $obj->id }}</td>
                                        <td>{{ $obj->nombre }}</td>
                                        <td>{{ $obj->categoria->nombre ?? '' }}</td>
                                        <td>{{ $obj->descripcion }}</td>
                                        <td>{{ $obj->estado->nombre ?? '' }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ url('catalogo/curso') }}/{{ $obj->id }}/edit"
                                                    class="btn btn-icon  btn-success"><i
                                                        class="bi bi-pencil-square"></i></a>



                                                <a href="{{ url('catalogo/curso') }}/{{ $obj->id }}"
                                                    class="btn btn-icon  btn-info"><i class="bi bi-eye"></i></a>


                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-{{ $obj->id }}"
                                                    class="btn btn-icon  btn-danger"><i class="bi bi-trash"></i></a>

                                            </div>
                                        </td>
                                    </tr>

                                    @include('catalogo.curso.modal')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('categoria.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Nuevo registro
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  gy-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required
                                onblur="this.value = this.value.toUpperCase()">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Aceptar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
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

        function active(id) {
            // Obtener el estado del checkbox
            const checkbox = document.getElementById(`switch-${id}`);
            const isActive = checkbox.checked ? 1 : 0;

            // Enviar solicitud DELETE para cambiar el estado
            fetch(`{{ url('/catalogo/categoria') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "_token": "{{ csrf_token() }}", // Token CSRF
                        activo: isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert("Estado de categoría actualizado correctamente.");
                    } else {
                        alert("Error al actualizar el estado de la categoría.");
                        checkbox.checked = !isActive; // Revertir el estado si falla
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    checkbox.checked = !isActive; // Revertir el estado si hay error
                });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            expandMenuAndHighlightOption("catalogoMenu", "departamentoOption");
        });
    </script>
@endsection
