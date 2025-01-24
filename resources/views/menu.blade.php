<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Agenda </title>
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
                            <!-- <a href="index.html" class="header-logo" >
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

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <ul class="header-content-right">




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
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                            data-popper-placement="none">

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
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-2 d-flex flex-column justify-content-center">
                                    <p style="font-size: 10px; margin: 0; text-transform: capitalize;">
                                        <strong>{{ auth()->user()->name }}</strong> <br>
                                        {{ auth()->user()->getRoleNames()->first() }} <br>
                                        {{ date('H:i d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    <i class="bi bi-person-circle" style="font-size: 24px;"></i>
                                </div>
                            </div>



                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="dropdown-item text-center border-bottom">
                                    <p style="font-size: 10px; margin: 0; text-transform: capitalize;">
                                        <strong>{{ auth()->user()->name }}</strong> <br>
                                        {{ auth()->user()->getRoleNames()->first() }} <br>
                                        {{ date('H:i d/m/Y') }}
                                    </p>

                                </div>
                            </li>

                            <li><a class="dropdown-item d-flex align-items-center" href="#"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                        class="fe fe-lock p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i>Cerrar
                                    sesión</a></li>



                            <form id="logout-form" action="{{ route('cerrar_session') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    <!-- End::header-element -->


                </ul>
                <!-- End::header-content-right -->

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
                    <ul class="main-menu">

<<<<<<< HEAD
                        @can('seguridad')
                        {{-- <li class="slide has-sub" id="seguridadMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
=======

                        <li class="slide">
                            <a href="{{url('curso/examen/admin')}}" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
>>>>>>> 823cd6853ec766480b90da50900ad33bbb97e958
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 2.75A2.25 2.25 0 0 0 3.75 5v14A2.25 2.25 0 0 0 6 21.25h12A2.25 2.25 0 0 0 20.25 19V9.5a.75.75 0 0 0-.22-.53l-5.5-5.5a.75.75 0 0 0-.53-.22H6Zm.75 14.5h10.5m-10.5-4h10.5M13.5 2.75v4.25a1 1 0 0 0 1 1h4.25" />
                                </svg>

                                <span class="side-menu__label">Examenes</span>
                            </a>
<<<<<<< HEAD
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Seguridad</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('seguridad/usuario') }}" id="usuarios_Option"
                                        class="side-menu__item">Usuario</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ url('seguridad/rol') }}" id="rol_Option"
                                        class="side-menu__item">Rol</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ url('seguridad/permission') }}" id="permisso_Option"
                                        class="side-menu__item">Permisos</a>
                                </li>


                            </ul>
                        </li> --}}
                        @endcan

                        @can('encargado direccion')
                        <li class="slide has-sub" id="seguridadMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z">
                                    </path>
                                </svg>
                                <span class="side-menu__label">Seguridad</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Seguridad</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('seguridad/usuarios') }}" id="usuarios_Option"
                                        class="side-menu__item">Usuario</a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('administracion')
                        <li class="slide has-sub" id="administracionMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z">
                                    </path>
                                </svg>
                                <span class="side-menu__label">Administracion</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Usuarios</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('administracion/empleados') }}" id="empleado_Option"
                                        class="side-menu__item">Empleados</a>
                                </li>




                            </ul>
                        </li>

                        @endcan


                        @can('catalogos')
                        <!-- Start::slide -->
                        {{-- <li class="slide has-sub" id="catalogoMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                </svg>
                                <span class="side-menu__label">Catalogos</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide">
                                    <a href="{{ url('catalogo/categoria') }}" id="departamentoOption"
                                        class="side-menu__item">Categoria</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('catalogo/curso') }}" id="cursoOption"
                                        class="side-menu__item">Curso</a>
                                </li>


                            </ul>

                        </li> --}}
                        @endcan
                        <!-- End::slide -->












                        @can('agenda')
                        <li class="slide has-sub" id="solicitudMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <span class="side-menu__label">Agenda</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1" id="appsSubmenu">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Apps</a>
                                </li>
                                @can('read solicitud')
                                <li class="slide">
                                    <a href="{{ url('solicitud') }}" class="side-menu__item"
                                        id="solicitudOption">Lista de Solicitudes Ingresadas Por la Dirección</a>
                                </li>
                                @endcan
                                @can('complete sesion')
                                <li class="slide">
                                    <a href="{{ url('sesion') }}" id="sesionOption"
                                        class="side-menu__item">Sesiones</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
=======
                        </li>

>>>>>>> 823cd6853ec766480b90da50900ad33bbb97e958




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

</body>

</html>
