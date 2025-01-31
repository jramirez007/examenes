<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<style>
    #chronometer {
        font-size: 1rem;
        margin-top: 20px;
    }

    app-header {
        margin-bottom: 600px;
    }






    .v-line {
        border: none;
        border-left: 1px solid hsla(200, 10%, 50%, 100);
        height: 100%;
        width: 1px;
        color: #BDBDC7
    }

    .box {
        padding-top: -10px;
        padding-right: 10px;
        padding-bottom: 10px;
        padding-left: 10px;

        height: 88px;
        /*width: 270px;*/

        background: #2763FF;
        border-radius: 20px;
    }

    .big_letter {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 10px;
        color: #FFFFFF;
    }

    .small_letter {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 700;
        font-size: 10px;
        line-height: 70px;
        color: #FFFFFF;
    }

    td {
        padding-top: 7px;
        padding-right: 7px;
        padding-bottom: 7px;
        padding-left: 7px;
    }
</style>

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> English Exam
    </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="html, html and css templates, html css and javascript, html css, html javascript, html css bootstrap, admin, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, admin panel template, dashboard panel, bootstrap admin, dashboard, template admin, html admin template">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">

    <style>
        /* Para mostrar el submenú expandido */
        .has-sub.is-expanded .slide-menu {
            display: block;
        }

        /* Para resaltar la opción activa */
        .side-menu__item.active {
            background-color: #f0f0f0;
            /* Cambia este color según tu diseño */
            font-weight: bold;
        }
    </style>

</head>

<body>





    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header sticky" id="header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <img src="{{ asset('images/cursos/logo.png') }}" alt="">
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element header-search d-md-block d-none my-auto auto-complete-search">
                        <!-- Start::header-link -->
                        <input type="hidden" class="header-search-bar form-control" id="header-search"
                            placeholder="Search anything here ..." spellcheck=false autocomplete="off"
                            autocapitalize="off">

                    </div>
                    <!-- End::header-element -->


                    <div>
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <div class="card-text d-flex justify-content-between" style="width: 80%;">

                                <!-- Centered div 1 -->


                                <!-- Centered div 2 -->
                                <div id="2"
                                    style="display: flex; justify-content: center; align-items: center;">
                                    <table>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <center></center>
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>
                        </div>





                        {{-- <button id="startStopButton">Start</button>
                        <button id="resetButton">Reset</button> --}}

                    </div>


                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <ul class="header-content-right">


                    <li><a class="dropdown-item d-flex align-items-center" href="#"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i
                            class="fe fe-lock p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i>Log
                        out</a></li>



                <form id="logout-form" action="{{ route('cerrar_sesion') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>

                    <!-- Start::header-element -->
                    <li class="header-element header-theme-mode">
                        <!-- Start::header-link|layout-setting -->
                        <a href="javascript:void(0);" class="header-link layout-setting">
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element cart-dropdown dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside"
                            data-bs-toggle="dropdown">

                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">

                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-cart-items-scroll">
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center cart-dropdown-item gap-3">
                                        <div class="lh-1">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <img src="{{ asset('assets/images/ecommerce/png/30.png') }}"
                                                    alt="Wireless Headphones">
                                            </span>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                        <!-- End::main-header-dropdown -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element notifications-dropdown d-xl-block d-none dropdown">

                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">

                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll">

                            </ul>

                        </div>
                        <!-- End::main-header-dropdown -->
                    </li>
                    <!-- End::header-element -->



                    <!-- Start::header-element -->
                    <li class="header-element dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        {{-- <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-2 d-flex flex-column justify-content-center">
                                    <p style="font-size: 10px; margin: 0; text-transform: capitalize;">
                                        <strong>{{ auth()->user()->name }}</strong> <br>
                                        {{ auth()->user()->getRoleNames()->first() }} <br>
                                        {{ date('H:i d/m/Y')}}
                                    </p>
                                </div>
                                <div>
                                    <i class="bi bi-person-circle" style="font-size: 24px;"></i>
                                </div>
                            </div>



                        </a> --}}
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            {{-- <li>
                                <div class="dropdown-item text-center border-bottom">
                                    <p style="font-size: 10px; margin: 0; text-transform: capitalize;">
                                        <strong>{{ auth()->user()->name }}</strong> <br>
                                        {{ auth()->user()->getRoleNames()->first() }} <br>
                                        {{ date('H:i d/m/Y')}}
                                    </p>

                                </div>
                            </li> --}}
                            {{-- <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i
                                        class="fe fe-user p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>Profile</a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i
                                        class="fe fe-mail p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>Mail
                                    Inbox</a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="file-manager.html"><i
                                        class="fe fe-database p-1 rounded-circle bg-primary-transparent klist me-2 fs-16"></i>File
                                    Manger<span class="badge bg-primary1 text-fixed-white ms-auto fs-9">2</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail-settings.html"><i
                                        class="fe fe-settings p-1 rounded-circle bg-primary-transparent ings me-2 fs-16"></i>Settings</a>
                            </li>
                            <li class="border-top bg-light"><a class="dropdown-item d-flex align-items-center"
                                    href="chat.html"><i
                                        class="fe fe-help-circle p-1 rounded-circle bg-primary-transparent set me-2 fs-16"></i>Help</a>
                            </li> --}}
                            {{-- <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                        class="fe fe-lock p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i>Cerrar
                                    sesión</a></li>



                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form> --}}
                        </ul>
                    </li>
                    <!-- End::header-element -->

                    <div>



                        {{-- <div class="card-body" style="display: flex; justify-content: left;">
                            <div class="card-text d-flex justify-content-center" style="width: 100%;">


                                <!-- Centered div 3 -->
                                <div class="card-title" id="3"
                                    style="display: flex; justify-content: left; align-items: left;">

                                    <div id="chronometer">
                                        <table width='100%'>
                                            <tr>
                                                <td align="center">
                                                    Remaining Time
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    50:59
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div> --}}





                        {{-- <button id="startStopButton">Start</button>
                        <button id="resetButton">Reset</button> --}}

                    </div>


                </ul>
                <!-- End::header-content-right -->

                <br>
                <br>



                <br>
                <br>



            </div>
            <!-- End::main-header-container -->



        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <!-- <a href="index.html" class="header-logo">
                    <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo"
                        class="desktop-logo">
                    <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}" alt="logo"
                        class="toggle-dark">
                    <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}" alt="logo"
                        class="desktop-dark">
                    <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}" alt="logo"
                        class="toggle-logo">
                    <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}" alt="logo"
                        class="toggle-white">
                    <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}" alt="logo"
                        class="desktop-white">
                </a> -->

            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu" style="color: white; padding: 25px">

                        <li>
                            <div id="1" style="display: flex; justify-content: center; align-items: center;">
                                <img src="{{ asset('images/cursos/logo.png') }}" alt="">
                            </div>
                        </li>

                        <li>
                            email:
                        </li>

                        <li>
                            {{ session('user_email') }}
                        </li>

                        <br>

                        <li>
                            nombre:
                        </li>

                        <li>
                        {{ session('user_name') }}
                        </li>

                        <br>
                        <br>


                        <div id="chronometer">
                            <center>
                                <div style="margin-left: -20px">
                                    Remaining Time
                                </div>
                            </center>
                            <div class="col-md-12" style="text-align: center; display: flex; margi">
                                <div class="col-md-2"></div>


                                <div class="col-md-8 col-sm-12 row box" style="margin-top: 0px;">
                                    <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 12px;">

                                    </div>

                                    <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 2px;">
                                        <div class="big_letter"
                                            style="margin-top: 20px; margin-left: -40px; font-weight: bold;">
                                            <div id="minutes">45</div>
                                        </div><br>
                                        <span
                                            style="color: white; padding: 10px; margin-left: -40px; font-weight: bold;">MIN.</span>
                                    </div>

                                    <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 2px;">
                                        <div class="big_letter" style="margin-top: 20px; font-weight: bold;">
                                            <div id="seconds">59</div>
                                        </div><br>
                                        <span
                                            style="color: white; padding: 10px;  margin-top: -10px; margin-left: -10px; font-weight: bold;">SEC.</span>
                                    </div>



                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>




                        <br>
                        <br>
                        You are about to take our placement test.
                        <br>
                        There are questions from all 4 skills (Reading, Listening, Writing and Speaking)
                        <br>
                        Test instructions:
                        <br>
                        1. Answer all questions: There are 81 questions in total. <br>
                        2. Be conscious of time: You have 45 minutes, try not to overthink each answer. This will help
                        you get a more precise result <br>
                        3. Read questions carefully: Don’t rush when you read the questions and make sure you understand
                        them before answering. <br>
                        This test is Just Part of Your Master Plan. Good Luck. <br>
                        <br>

                        <!-- End::slide -->















                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg>
                    </div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="page-header-breadcrumb flex-wrap gap-2">
                </div>
                @yield('contenido')
            </div>
        </div>
        <!-- End::app-content -->


        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted" style="display: none"> Copyright © <span id="year"></span> <a
                        href="javascript:void(0);" class="text-dark fw-medium">Xintra</a>.
                    Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                        <span class="fw-medium text-primary">Spruko</span>
                    </a> All
                    rights
                    reserved
                </span>
            </div>
        </footer>
        <!-- Footer End -->
        <div class="modal fade" id="header-responsive-search" tabindex="-1"
            aria-labelledby="header-responsive-search" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                aria-label="Search Anything ..." aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            //alert("ready!");
            startStopTimer();
        });
    </script>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>




    <!-- Gallery JS -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/gallery.js') }}"></script>



    <script>
        function expandMenuAndHighlightOption(menuId, optionId) {
            // Obtener el elemento del menú por su ID
            const menuElement = document.getElementById(menuId);
            // Obtener el elemento de la opción por su ID
            const optionElement = document.getElementById(optionId);

            // Desplegar el submenú
            if (menuElement) {
                menuElement.classList.add('is-expanded');
            }

            // Resaltar la opción seleccionada
            if (optionElement) {
                optionElement.classList.add('active');
            }
        }
    </script>

    <script>
        let timer;
        let minutes = 45;
        let seconds = 59;
        let isRunning = false;

        // Function to update the chronometer display
        function updateChronometer() {
            // Format minutes and seconds to be always two digits
            const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
            const formattedSeconds = seconds < 10 ? '0' + seconds : seconds;
            //document.getElementById('chronometer').textContent = `Remaining Time: ${formattedMinutes}:${formattedSeconds}`;

            //document.getElementById('chronometer').innerHTML =
            //    `<table width='100%'><tr><td align="center">Remaining Time</td></tr><tr><td align="center">${formattedMinutes}:${formattedSeconds}</td></tr></table>`;



            document.getElementById('chronometer').innerHTML =
                '<center><div style="margin-left: -20px">Remaining Time</div></center>' +
                '<div class="col-md-12" style="text-align: center; display: flex;">' +
                '<div class="col-md-2"></div>' +
                '<div class="col-md-8 col-sm-12 row box" style="margin-top: 0px;">' +
                '<div class="col-md-3 col-sm-12" style="text-align: center; margin-top: 12px;"></div>' +
                '<div class="col-md-3 col-sm-12" style="text-align: center; margin-top: 2px;">' +
                '<div class="big_letter" style="margin-top: 20px; margin-left: -40px; font-weight: bold;">' +
                '<div id="minutes">' + formattedMinutes + '</div>' + // Dynamic minute value
                '</div><br><span style="color: white; padding: 10px; margin-left: -40px; font-weight: bold;">MIN.</span>' +
                '</div>' +
                '<div class="col-md-3 col-sm-12" style="text-align: center; margin-top: 2px;">' +
                '<div class="big_letter" style="margin-top: 20px; font-weight: bold;">' +
                '<div id="seconds">' + formattedSeconds + '</div>' + // Dynamic second value
                '</div><br><span style="color: white; padding: 10px; margin-top: -10px; margin-left: -10px; font-weight: bold;">SEC.</span>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2"></div>' +
                '</div>';



        }

        // Function to start/stop the timer
        function startStopTimer() {
            if (isRunning) {
                clearInterval(timer);
                document.getElementById('startStopButton').textContent = 'Start';
            } else {
                timer = setInterval(() => {
                    seconds--;
                    if (seconds === 00) {
                        seconds = 59;
                        minutes--;
                    }
                    updateChronometer();
                }, 1000);
                document.getElementById('startStopButton').textContent = 'Stop';
            }
            isRunning = !isRunning;
        }

        // Function to reset the timer
        function resetTimer() {
            clearInterval(timer);
            minutes = 0;
            seconds = 0;
            updateChronometer();
            document.getElementById('startStopButton').textContent = 'Start';
            isRunning = false;
        }

        // Add event listeners to buttons
        document.getElementById('startStopButton').addEventListener('click', startStopTimer);
        document.getElementById('resetButton').addEventListener('click', resetTimer);
    </script>

</body>

</html>
