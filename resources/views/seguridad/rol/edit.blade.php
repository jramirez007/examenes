@extends ('menu')
@section('contenido')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            /* Ajusta el ancho según tu preferencia */
            height: 24px;
            /* Ajusta la altura según tu preferencia */
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
            border-radius: 30px;
            /* Ajusta el radio según tu preferencia */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            /* Ajusta la altura según tu preferencia */
            width: 20px;
            /* Ajusta el ancho según tu preferencia */
            left: 2px;
            /* Ajusta la posición según tu preferencia */
            bottom: 2px;
            /* Ajusta la posición según tu preferencia */
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(24px);
            /* Ajusta la posición según tu preferencia */
            -ms-transform: translateX(24px);
            /* Ajusta la posición según tu preferencia */
            transform: translateX(24px);
            /* Ajusta la posición según tu preferencia */
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 30px;
            /* Ajusta el radio según tu preferencia */
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .columnas {
            margin: 1.5%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .item {
            background-color: #f0f0f0;
            color: #452b90;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>




    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Rol
                    </div>
                    <div class="prism-toggle">
                        <a href="{{url('seguridad/rol')}}">
                        <button class="btn btn-outline-dark btn-wave">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-corner-up-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4" />
                            </svg>
                        </button>
                    </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label for="input-label" class="form-label">Descripción</label>
                            <input type="text" value="{{ $rol->name }}" class="form-control" id="input-label" required onkeypress="return onlyLetters(event)">
                        </div>


                        {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                            <button class="btn btn-dark">Aceptar</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Permisos
                    </div>
                    <div class="row col-xl-12">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects">
                                <div class="columnas">
                                    @foreach ($permisos as $permiso)
                                        <div class="item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>{{ $permiso->name }}</label>
                                                </div>
                                                <div class="col-md-6" style="text-align: right;">
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            {{ $permiso->permissions_has_role->where('id', $rol->id)->count() > 0 ? 'checked' : '' }}
                                                            onchange="update_permission('{{ $permiso->id }}', '{{ $rol->id }}')">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>



    <script type="text/javascript">
        $(document).ready(function() {

        });


        function update_permission(permiso_id, role_id) {

            console.log(permiso_id, role_id);
            $.ajax({

                url: "{{ url('seguridad/roles/update_permission') }}/",
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    'permiso_id': permiso_id,
                    'role_id': role_id
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
            expandMenuAndHighlightOption("seguridadMenu", "rol_Option");
        });

        function onlyLetters(event) {
    var char = String.fromCharCode(event.which);
    if (!/[a-zA-ZñÑ\s]/.test(char)) {
        event.preventDefault();
    }}
    </script>
@endsection
