@extends('menu_examen')
@section('contenido')
    <style>

    </style>
    <br>
    <div class="container-fluid d-flex align-items-center justify-content-center card">
        <br>
        <div class="row w-100">
            <div class="d-none d-md-block col-md-3 text-center">
                &nbsp;
            </div>
            <div class="col-12 col-md-6 text-center d-flex justify-content-center"
                style="min-height: 50vh; padding-top: 10vh; padding-bottom: 10vh;">
                <div class="w-70">

                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none"
                        stroke="#00A6BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
                        <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
                        <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
                        <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
                        <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
                        <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
                        <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
                        <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
                        <path d="M9 12l2 2l4 -4" />
                    </svg>
                    <br><br>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                        @if (session('id') == '1')
                            <p class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);">Congratulations</p>
                        @else
                            <p class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);">Felicidades</p>
                        @endif

                    </div>



                    @if (session('id') == '1')
                        <p class="fs-2 fw-bold m-0">Your exam has been <b>sent</b> successfully.

                            <br>
                        @else
                        <p class="fs-2 fw-bold m-0">Tu examen ha sido <b>enviado</b> satisfactoriamente.

                            <br>
                    @endif


                    <span class="fs-2 fw-bold m-0"> </span> <br>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-2">
                        @if (session('id') == '1')
                            <p class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);"> Exam completed on</p>
                        @else
                            <p class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);"> Examen completado en</p>
                        @endif

                    </div>



                    <p class="fs-2 fw-bold m-0">{{ $fecha_formateada }} </b>.

                        @if (session('id') == '1')
                            <p class="fs-3">
                                <br> We will give you your result.
                                <br>
                                <br>
                                Thank you.
                            </p>
                        @else
                            <p class="fs-3">
                                <br> Nosotros te enviaremos tu resultado.
                                <br>
                                <br>
                                Gracias.
                            </p>
                        @endif





                        <br><br>

                    <div class="justify-content-center align-items-center">
                        <form action="{{ url('curso/examen') }}" method="GET">
                            @csrf

                            <input type="hidden" name="mensaje" value="fin" readonly />

                            <button aria-label="Iniciar" class="btn btn-outline-info text-white text-xl btn-sm"
                                type="submit"
                                style="border-radius: 1.5rem; background-color: #1A365E; padding: 0.5rem 2rem; font-size: 1rem; border: 0;">
                                <strong>
                                    {{ session('id') == '1' ? 'Finish' : 'Finalizar' }}
                                </strong>
                            </button>

                            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#modal-test"
                                class="btn btn-info shadow btn sharp me-1">
                                <i class="bi bi-arrow-left-right"></i>test
                            </a> --}}
                        </form>

                    </div>
                </div>

            </div>
            {{-- <p class="fs-6 text-center"><small><b>v18.9d</b></small> </p> --}}
        </div>

    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                window.history.go(1);
            };
        });
    </script> --}}

    <div class="modal fade" id="modal-test">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('cerrar_sesion') }}">
                @method('post')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-base text-slate-900 dark:text-white leading-6">
                            Confirme si desea dehabilitar al Usuario
                        </h6>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Aceptar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
