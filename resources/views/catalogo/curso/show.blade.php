@extends('menu')
@section('contenido')
    <link href="{{ asset('assets/js/select2/select2.min.css') }}" rel="stylesheet" />
    <!-- Start::row-1 -->

    <style>
        table.dataTable td {
            white-space: normal;
            word-wrap: break-word;
            max-width: 50px;
            /* Ajusta el ancho máximo según tus necesidades */
        }
    </style>
    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <div class="card-title">
                        {{ $curso->nombre }}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td><span class="fw-medium">Categoria</span></td>
                                    <td>{{ $curso->categoria->nombre ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><span class="fw-medium">Estado</span></td>
                                    <td>{{ $curso->estado->nombre ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <div class="text-center">
                                            <img src="{{ asset('images/cursos') }}/{{ $curso->imagen }}"
                                                class="img-fluid rounded-pill" style="max-width: 100px" alt="...">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="card-footer text-muted">
                    <p class="card-text">{{ $curso->descripcion }}</p>
                </div>
            </div>
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <div class="card-title">
                        LISTADO DE TEMAS


                    </div>
                    <a href="javascript:void(0);" class="btn btn-success-light ms-auto btn-sm mt-1" data-bs-toggle="modal"
                        data-bs-target="#modalCreateTema"> Agregar</a>
                </div>
                @if (count($errors) > 0)
                    <br>
                    <div class="mb-3 col-md-12 col-sm-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($curso->temas as $tema)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center flex-wrap gap-2">

                                    <div class="flex-fill">
                                        <a href="javascript:void(0);"><span
                                                class="d-block fw-medium">{{ $tema->nombre }}</span></a>
                                    </div>
                                    <div class="btn-list">
                                        <button type="button" aria-label="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-update-tema-{{ $tema->id }}"
                                            class="btn btn-sm btn-icon btn-info-light btn-wave"><i
                                                class="ri-edit-line"></i></button>
                                        <button type="button" aria-label="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-delete-tema-{{ $tema->id }}"
                                            class="btn btn-sm btn-icon btn-danger-light btn-wave"><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </li>
                            @include('catalogo.curso.modal_tema_edit')
                            @include('catalogo.curso.modal_tema_delete')
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-header justify-content-between align-items-center">
                    <div class="card-title">Temas</div>
                    {{-- <div class="btn-list">
                        <button type="button" class="btn btn-primary btn-sm btn-wave me-0"><i
                                class="ri-edit-line me-1 align-middle"></i>Edit Task</button>
                    </div> --}}
                </div>
                <div class="card-body">

                    <div class="row gy-4">


                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            @foreach ($curso->temas as $tema)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-{{ $tema->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $tema->id }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $tema->id }}">
                                            {{ $tema->nombre }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $tema->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-{{ $tema->id }}"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <div class="row">

                                                <div class="col-xxl-6 col-xl-6">
                                                    <div class="card custom-card overflow-hidden">

                                                        <div class="card-body">
                                                            <p class="card-text">{{ $tema->descripcion }}</p>

                                                        </div>

                                                    </div>
                                                </div>





                                                <div class="col-xxl-6 col-xl-6">
                                                    <div class="card custom-card overflow-hidden">
                                                        <div class="card-header justify-content-between">
                                                            <div class="card-title">
                                                                Archivos
                                                            </div>

                                                            <button class="btn bg-outline-success btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                                onclick="setTemaId({{ $tema->id }})"><i
                                                                    class="ti ti-plus"></i></button>

                                                        </div>
                                                        <div class="card-body p-0 pb-1">
                                                            <div class="table-responsive">
                                                                <table class="table text-nowrap">
                                                                    {{-- <thead>
                                                                        <tr>
                                                                            <th>N</th>
                                                                            <th>Price</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead> --}}
                                                                    <tbody>
                                                                        @foreach ($tema->archivos as $archivo)
                                                                            @php
                                                                                $extension = pathinfo(
                                                                                    $archivo->nombre,
                                                                                    PATHINFO_EXTENSION,
                                                                                );
                                                                            @endphp
                                                                            <tr>
                                                                                <td>
                                                                                    <div
                                                                                        class="d-flex align-items-center gap-2">
                                                                                        <div class="lh-1">

                                                                                            @if ($extension == 'pdf')
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="48"
                                                                                                    height="48"
                                                                                                    viewBox="0 0 16 16">
                                                                                                    <g fill="currentColor">
                                                                                                        <path
                                                                                                            d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36c.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05a12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064a.44.44 0 0 1-.06.2a.3.3 0 0 1-.094.124a.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822c.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                                                                                                        <path
                                                                                                            fill-rule="evenodd"
                                                                                                            d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419c.207.075.412.04.58-.03c.318-.13.635-.436.926-.786c.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95c.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416c.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05a11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794c.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538a.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077c-.377.15-.576.47-.651.823c-.073.34-.04.736.046 1.136c.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227a7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787c-.21.326-.275.714-.08 1.103" />
                                                                                                    </g>
                                                                                                </svg>
                                                                                            @elseif($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="32"
                                                                                                    height="32"
                                                                                                    fill="currentColor"
                                                                                                    class="bi bi-card-image"
                                                                                                    viewBox="0 0 16 16">
                                                                                                    <path
                                                                                                        d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                                                                    <path
                                                                                                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                                                                                </svg>
                                                                                            @endif

                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex gap-1">
                                                                                        <div class="btn-list">
                                                                                            <a aria-label="anchor"
                                                                                                href="{{ asset('archivos') }}/{{ $archivo->nombre }}"
                                                                                                target="_blank"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-placement="top"
                                                                                                data-bs-title="View"
                                                                                                class="btn  btn-icon btn-secondary-light"><i
                                                                                                    class="ti ti-eye"></i></a>
                                                                                            {{-- <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" class="btn  btn-icon btn-info-light"><i class="ti ti-pencil"></i></a> --}}
                                                                                            <a aria-label="anchor"
                                                                                                href="#"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#modalDelete"
                                                                                                onclick="setArchivoId({{ $archivo->id }})"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-placement="top"
                                                                                                data-bs-title="Delete"
                                                                                                class="btn  btn-icon  btn-primary2-light"><i
                                                                                                    class="ti ti-trash"></i></a>
                                                                                        </div>
                                                                                    </div>
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach





                        </div>








                    </div>

                </div>


            </div>





            <div class="card custom-card">
                <div class="card-header justify-content-between align-items-center">
                    <div class="card-title">Examenes</div>
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary btn-sm btn-wave me-0" data-bs-toggle="modal"
                        data-bs-target="#modalCreateExamen"><i
                                class="ri-plus-line me-1 align-middle"></i>Agregar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>fecha inicio</th>
                                    <th>fecha final</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($curso->examenes as $examen)
                                    <tr>
                                        <td>{{ $examen->id }}</td>
                                        <td>{{ $examen->descripcion }}</td>
                                        <td>{{ $examen->fecha_inicio }}</td>
                                        <td>{{ $examen->fecha_final }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ url('catalogo/curso') }}/{{ $examen->id }}/edit"
                                                    class="btn btn-icon  btn-success"><i
                                                        class="bi bi-pencil-square"></i></a>



                                                <a href="{{ url('catalogo/curso/show_examen') }}/{{ $examen->id }}"
                                                    class="btn btn-icon  btn-info"><i class="bi bi-eye"></i></a>


                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-{{ $examen->id }}"
                                                    class="btn btn-icon  btn-danger"><i class="bi bi-trash"></i></a>

                                            </div>
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

    <!--End::row-1 -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ url('catalogo/curso/upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Agregar archivo
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="tema_id" id="tema_id" required class="form-control">
                        <input type="file" name="nombre" required class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ url('catalogo/curso/delete_upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Agregar archivo
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="archivo_id" required class="form-control">

                        <p>¿Desea eliminar el archivo?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" id="modalCreateTema" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ url('catalogo/curso/add_tema') }}">
                @csrf
                <div class="modal-content  gy-4">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Agregar tema
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body gy-4">
                        <input type="hidden" name="curso_id" value="{{ $curso->id }}" required
                            class="form-control">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                required onblur="this.value = this.value.toUpperCase()">
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required onblur="this.value = this.value.toUpperCase()">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" id="modalCreateExamen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ url('catalogo/curso/add_examen') }}">
                @csrf
                <div class="modal-content  gy-4">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Agregar examen
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body gy-4">
                        <input type="hidden" name="curso_id" value="{{ $curso->id }}" required
                            class="form-control">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required onblur="this.value = this.value.toUpperCase()">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="adjunto" class="form-label">Fecha inicio</label>
                            <input type="datetime-local" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="form-control" required>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="adjunto" class="form-label">Fecha final</label>
                            <input type="datetime-local" name="fecha_final" value="{{ old('fecha_final') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>









    <script>
        document.addEventListener('DOMContentLoaded', function() {
            expandMenuAndHighlightOption("solicitudMenu", "solicitudOption");
        });


        function setTemaId(id) {
            document.getElementById('tema_id').value = id;
        }

        function setArchivoId(id) {
            document.getElementById('archivo_id').value = id;
        }
    </script>
@endsection
