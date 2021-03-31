<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>San Antonio | Training</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('css/select2-boostrap.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="{{ asset('css/datepicker3.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .onlyprint {
            display: none;
        }
    </style>

    <style media="print">
        .onlyview {
            display: none;
        }

        .onlyprint {
            display: table;
        }

        @page {
            margin: 0.5cm 0.5cm 0.5cm 0.5cm;
        }
    </style>

    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>San Antonio</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->

                                @if(!is_null(Auth::user()->persona->foto) && Auth::user()->persona->foto !== "")
                                    <img src="{{ asset( 'user_photos/' . Auth::user()->persona->foto) }}"
                                     class="user-image" alt="User Image"/>
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->persona->nombre_completo }}"
                                         class="user-image  " alt="User Image"/>
                                @endif

                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->persona->nombre_completo }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                @if(!is_null(Auth::user()->persona->foto))
                                    <img src="{{ asset('images/logo.png') }}"
                                         class="img-circle" alt="User Image"/>
                                    @endif
                                    <p>
                                        {{ Auth::user()->email }}
                                        <small>Nivel: {{ Auth::user()->nivel }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route("empleados.show", [auth()->user()->persona->id]) }}"
                                           class="btn btn-default btn-flat">Perfil de usuario</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer onlyview" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2020 <a href="#" target="_blank">Juan Pablo Cabero</a>.</strong>
            Todos los derechos reservado
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    San Antonio
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Principal</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Ingresar al sistema</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endif

<!-- jQuery 3.1.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://adminlte.io/themes/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>

<script src="{{ asset('js/vue.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

{{--<script src="{{ asset('js/jquery.form.js') }}"></script>--}}

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie-polyfills.js"></script>
<![endif]-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->

<script src="{{ asset('js/summernote-es-ES.js') }}"></script>

<script type="text/javascript">
    function formarListaDeErrores(json) {
        var res = 'Errores:\n\n';
        dataError = json;
        $.each(dataError, function (i, item) {
            res += item + "\n";
        });
        return res;
    }

    function aMayuscula() {
        $(".upper").on("keypress", function () {
            $input = $(this);
            setTimeout(function () {
                $input.val($input.val().toUpperCase());
            }, 50);
        })
    }

    function cargarDatePickerInicial() {
        var fechaInicial = "{!! \App\Patrones\Fachada::getDateTime() !!}";
        $('.datepickerInicial').datepicker({
            //useCurrent: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            locale: 'es',
            startDate: fechaInicial,
        });
    }

    function cargarDatePicker() {
        var fechaFinal = "{!! \App\Patrones\Fachada::getDateTime() !!}";
        $('.datepicker').datepicker({
            //useCurrent: false,
            autoclose: true,
            format: 'dd/mm/yyyy',
            locale: 'es',
            //startDate: fechaInicial,
            // endDate: fechaFinal
        });
    }

    function validarTamanoArchivo() {
        $("input:file").change(function () {
            var sizeMax = 2000;
            var sizeFile = this.files[0].size;
            var sizeKB = parseInt(sizeFile / 1024);
            if (sizeKB > sizeMax) {
                alert("Error!!!\nEl tamaño del archivo supera el limite establecido\nSolo puede subir archivos de un máximo de 2 MB");
                $(this).val('');
            }
        });
    }

    //select2
    function iniciar_select() {
        $(".select2").select2({
            escapeMarkup: function (markup) {
                return markup;
            },
            width: null,
        });
    }

    function preVisualizarImagen(input, idImagenDestino) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(idImagenDestino).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        cargarDatePicker();
        cargarDatePickerInicial();
        validarTamanoArchivo();

        // previsualizacion de las fotos
        $("#foto_input").change(function () {
            preVisualizarImagen(this, '#img_destino');
        });

        //selected 2
        $.fn.select2.defaults.set("theme", "bootstrap");
        iniciar_select();

        //upper
        aMayuscula();

        iniciar_note();
        iniciar_note_pregunta();
    });

    //note text
    function iniciar_note() {
        $('.summernote').summernote({
            lang: 'es-ES',
            height: 300,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['paragraph']],
            ]
        });
    }

    function iniciar_note_pregunta() {
        $('.summernotepregunta').summernote({
            lang: 'es-ES',
            height: 250,
        });
    }
</script>

@stack('scripts')
</body>
</html>
