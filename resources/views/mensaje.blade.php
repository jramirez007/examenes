@extends('menu_student')
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
        <div class="col-12 col-md-6 text-center d-flex justify-content-center" style="min-height: 50vh; padding-top: 10vh; padding-bottom: 10vh;">
            <div class="w-70">

                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#00A6BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check">
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
                    <p class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);">ENGLISH ONLINE</p>





                </div>

                <div class="fs-2">
                <img src="{{ asset('images/cursos/level.png') }}" alt="">
                </div>
                <p class="fs-2"><b>Result:</b></p>

                <p class="fs-2 fw-bold m-0">Your score is <span class="fs-2 fw-bold m-0" style="color: rgb(0, 186, 208);">{{ $count_ok }}</span> ({{ $count_ok }} of {{ $onCount }})</p>


                <p class="fs-3">Your current level is</p>

                <?php
if (isset($count_ok) && $count_ok >= 0 && $count_ok <= 50) {
    echo '<img src="http://154.12.255.170/cursos/public/images/cursos/starter.png" alt="Level Image">';
}

if (isset($count_ok) && $count_ok >= 51 && $count_ok <= 60) {
    echo '<img src="http://154.12.255.170/cursos/public/images/cursos/premium1.png" alt="Level Image">';
}

if (isset($count_ok) && $count_ok >= 61 && $count_ok <= 70) {
    echo '<img src="http://154.12.255.170/cursos/public/images/cursos/premium2.png" alt="Level Image">';
}

if (isset($count_ok) && $count_ok >= 71 && $count_ok <= 76) {
    echo '<img src="http://154.12.255.170/cursos/public/images/cursos/premium3.png" alt="Level Image">';
}

if (isset($count_ok) && $count_ok >= 77 && $count_ok <= 85) {
    echo '<img src="http://154.12.255.170/cursos/public/images/cursos/advanced.png" alt="Level Image">';
}


?>



<br><br>
                <div class="justify-content-center align-items-center">
                    <form action="{{ route('cerrar_sesion')}}" method="POST">
                        @csrf

                        <button aria-label="Iniciar" class="btn btn-outline-info text-white text-xl btn-sm" type="submit"
                            style="border-radius: 1.5rem; background-color: #1A365E; padding-left: 2rem !important; padding-right: 2rem !important;  font-size: 1rem; border:0"><strong>
                                Finalizar test
                            </strong>

                        </button>
                    </form>
                </div>
            </div>

        </div>
        {{-- <p class="fs-6 text-center"><small><b>v18.9d</b></small> </p> --}}
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.go(1);
        };
    });
</script>
@endsection
