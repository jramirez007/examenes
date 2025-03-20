<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> EM</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="html, html and css templates, html css and javascript, html css, html javascript, html css bootstrap, admin, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, admin panel template, dashboard panel, bootstrap admin, dashboard, template admin, html admin template">

    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon"> --}}

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Using JQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>


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


    <!-- noioslider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/nouislider/nouislider.min.css') }}">




    <style>
        .app-content {
            margin-inline-start: 0 !important;
        }

        .app-header {
            padding-inline-start: 0 !important;
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
                            <a href="index.html" class="header-logo">
                                <iconify-icon icon="material-symbols:login" width="48"
                                    height="48"></iconify-icon>
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        @auth
                            <a href="{{ url('/home') }}">
                                <button type="button" class="btn btn-info-ghost btn-wave"> <i class="bi bi-house"
                                        style="font-size: 16px; margin-right: 8px;"></i>
                                    Home </button>
                            </a>
                        @else
                            <a href="{{ url('/login') }}">
                                <button type="button" class="btn btn-info-ghost btn-wave"> <i
                                        class="bi bi-box-arrow-in-right" style="font-size: 16px; margin-right: 8px;"></i>
                                    Login</button>
                            </a>

                            <a href="{{ url('/register') }}">
                                <button type="button" class="btn btn-info-ghost btn-wave"> <i
                                        class="bi bi-box-arrow-in-right" style="font-size: 16px; margin-right: 8px;"></i>
                                    Register </button>
                            </a>

                            @endif
                        </div>

                    </div>
                    <!-- End::header-content-left -->



                </div>
                <!-- End::main-header-container -->

            </header>


            <!-- Start::app-content -->
            <div class="main-content app-content">
                <div class="container-fluid">

                    <!-- Page Header -->
                    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                        <div>

                            <h1 class="page-title fw-medium fs-18 mb-0">Examen</h1>
                        </div>

                    </div>
                    <!-- Page Header Close -->

                    <!-- Start:: Row-1 -->

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="row">

                            You are about to take our placement test.
There are questions from all 4 skills (Reading, Listening, Writing and Speaking)
Test instructions:
1. Answer all questions: There are 81 questions in total.
2. Be conscious of time: You have 45 minutes, try not to overthink each answer. This will help you get a more precise result
3. Read questions carefully: Don’t rush when you read the questions and make sure you understand them before answering.
This test is Just Part of Your Master Plan. Good Luck.
                            </div>
                        </div>

                    </div>
                    <!-- End:: Row-1 -->

                </div>
            </div>
            <!-- End::app-content -->

            <!-- Footer Start -->
            <footer class="footer mt-auto py-3 bg-white text-center">
                <div class="container">
                    <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                            class="text-dark fw-medium">Xintra</a>.
                        Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                            <span class="fw-medium text-primary">Spruko</span>
                        </a> All
                        rights
                        reserved
                    </span>
                </div>
            </footer>
            <!-- Footer End -->


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


        <!-- Node Waves JS-->
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>



        <!-- Auto Complete JS -->
        <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

        <!-- Color Picker JS -->
        <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

        <!-- Date & Time Picker JS -->
        <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>



        <!-- noUiSlider JS -->
        <script src="{{ asset('assets/libs/nouislider/nouislider.min.js') }}"></script>
        <script src="{{ asset('assets/libs/wnumb/wNumb.min.js') }}"></script>
        <script src="{{ asset('assets/js/ecommerce-price-range.js') }}"></script>


        <script>
            function load_exams(id, control) {
                $('#modal-examenes').modal('show');

                // alert(id);
                // alert(control);

                if (id > 0) {
                    var selector = "#" + control;
                    //console.log(selector);
                    $.get("{{ url('get_examenes') }}" + '/' + id, function(data) {
                        //alert(data.length);

                        var _table = '<div class="table-responsive">';

                        _table +=
                            '<table class="table"><thead><tr><td>id</td><td>descripcion</td><td>fecha_inicio</td><td>fecha_final</td></tr></thead><tbody>';


                        for (var i = 0; i < data.length; i++) {
                            const examenId = data[i].id;
                            _table += '<tr class="table-active">' +
                                '<td><a href="/cursos/public/catalogo/curso/show_examen_student/' +
                                examenId + '">' + examenId + '</a></td>' +
                                '<td>' + data[i].descripcion + '</td>' +
                                '<td>' + data[i].fecha_inicio + '</td>' +
                                '<td>' + data[i].fecha_final + '</td>' +
                                '</tr>';
                        }
                        _table += '</tbody></table></div>';

                        //document.getElementById('examenLink').href = '';

                        //alert(_table);

                        $(selector).html(_table);
                    });
                }
            }
        </script>


    </body>

    </html>
