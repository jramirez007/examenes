@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('assets/js/datatable/dataTables.bootstrap5.min.css') }}">
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Permisos
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-outline-dark btn-wave" data-bs-toggle="modal" data-bs-target="#modal-nuevo">
                            Nuevo
                        </button>
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
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $obj)
                                    <tr>
                                        <td>{{ $obj->id }}</td>
                                        <td>{{ $obj->name }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-{{ $obj->id }}" class="btn btn-icon  btn-info"><i class="bi bi-pencil-square"></i></a>

                                                <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $obj->id }}" class="btn btn-icon  btn-danger"><i class="bi bi-trash"></i></a>

                                            </div>
                                        </td>
                                    </tr>

                                    @include('seguridad.permission.modal_edit')
                                    @include('seguridad.permission.modal')
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
                <form method="POST" action="{{ route('permission.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Nuevo registro
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  gy-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"  required onkeypress="return onlyLetters(event)" >
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Aceptar</button>
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
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        expandMenuAndHighlightOption("seguridadMenu", "permisso_Option");
    });
    function onlyLetters(event) {
    var char = String.fromCharCode(event.which);
    if (!/[a-zA-ZñÑ\s]/.test(char)) {
        event.preventDefault();
    }}
</script>
@endsection
