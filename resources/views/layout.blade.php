<!DOCTYPE html>
<html lang="es" ng-app="appData">

<head>
    <title>{{ env('APP_NAME') }}<?php if(isset($this->opcion)) echo ' :: ' . $this->opcion; ?></title>

    <meta charset="{{ env('CODIFICACION_WEB') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="author" content="Santiago Ruiz Espitia">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css"
        href="/lib/bower_components/jquery-ui/themes/south-street/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/lib/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" type="text/css" --}}
    {{-- href="/lib/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" /> --}}
    <link rel="stylesheet" type="text/css"
        href="{!! asset('lib/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') !!}" />
    <link rel="stylesheet" type="text/css"
        href="{!! asset('lib/bower_components/bootstrap-toggle/css/bootstrap2-toggle.min.css') !!}" />
    <link rel="stylesheet" type="text/css"
        href="{!! asset('lib/bower_components/footable/compiled/footable.bootstrap.min.css') !!}" />

    <link rel="stylesheet" type="text/css"
        href="/lib/bower_components/datatables-bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.data.css" />
    <link rel="stylesheet" type="text/css" href="/lib/bower_components/nprogress/nprogress.css" />
    <link rel="stylesheet" type="text/css" href="/lib/bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/lib/jquery-file-upload/css/uploadfile.css" />
    <link rel="stylesheet" type="text/css" href="/css/app.css" />

    <script type="text/javascript" src="/js/fontOpenSans.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery/dist/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="/lib/bower_components/angular/angular.min.js"></script>
    <script type="text/javascript">
        var appData = angular.module('appData', []);
    </script> --}}

    <noscript>Tu navegador no soporta JavaScript!</noscript>
</head>

<body ng-controller="bodyController">

    <div class="navbar navbar-app" role="navigation" ng-controller="NavController">
        <div class="container-fluid">
            <div class="navbar-header" style="height: 48px;">
                @if (Auth::check())
                <div class="absolute right navbar-toggle-group">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="btn-group">
                        <a class="user-menu-dropdown" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a>
                                    <span class="glyphicon glyphicon-user"></span>&nbsp;
                                    {{Auth::user()->nombre_usuario}}
                                </a>
                            </li><?php
                                    if (trim(Session::get('nombrePerfil')) != '') {?>
                            <li class="divider"></li>
                            <li>
                                <span class="glyphicon glyphicon-wrench"></span>&nbsp;
                                <?php echo Session::get('nombrePerfil');?>
                            </li><?php
                                    }
                                    if (trim(Session::get('nombreSedeOperativa')) != '') {?>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><span
                                        class="glyphicon glyphicon-home"></span>&nbsp;<?php echo Session::get('nombreSedeOperativa');?></a>
                            </li><?php
                                    }?>
                            <li class="divider"></li>
                            <li>
                                <a href="/logout"><span class="glyphicon glyphicon-off"></span>&nbsp;Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
                <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
                <div class="logoProducto"></div>
                <div class="logoCliente"></div>
                {{-- <div class="logoCliente">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </div>
                </div> --}}
            </div>
            @if (Auth::check())
            <div id="menu" class="navbar-collapse collapse" ng-class="collapse">
                <ul class="nav navbar-nav">

                    @foreach ($menu as $item)

                    <li id="li_module" class="dropdown li_module_mobile" ng-repeat="modulo in modulos">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ $item->nombre_menu }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <div ng-repeat="fila_submodulo in modulo.filas_submodulos">
                                    <div ng-repeat="submodulo in fila_submodulo.submodulos">
                                        <ul class="multi-column-dropdown">
                                            @foreach ($item->children as $child)
                                            <li class="dropdown-header">
                                                <a href="#{{$child->ruta_menu}}">{{ $child->nombre_menu }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    @if (Auth::check())
    <div id="breadcrumb"></div>
    @endif

    <div id="dvConfirmacion" title="{{ env('APP_NAME') }}"></div>
    <div id="dvModal1"></div>
    <div id="dvModal2"></div>
    <div id="dvOpacidad"></div>

    <input type="hidden" id="BASE_URL" name="BASE_URL" value="/" />
    <input type="hidden" id="DEFAULT_LAYOUT" name="DEFAULT_LAYOUT" value="/" />
    <input type="hidden" id="session_id" name="session_id" value="aaaaaa" />

    {{-- <div class="container-fluid contenedor-ppal"> --}}

    <div id="main-content" class="container-fluid">
        @yield('content')
    </div>

    <div class="footer">
        <!--<div class="logoEmpresa"></div>-->
        <div class="copyright">
            <p class="text-muted"><?php echo date('Y')?></p>
        </div>
    </div>

    <script type="text/javascript" src="/lib/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    {{-- <script type="text/javascript" src="/lib/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> --}}
    <script type="text/javascript"
        src="{!! asset('lib/bower_components/bootstrap-toggle/js/bootstrap2-toggle.min.js') !!}"></script>
    <script type="text/javascript"
        src="{!! asset('lib/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('lib/bower_components/footable/compiled/footable.min.js') !!}">
    </script>
    <script type="text/javascript" src="/lib/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/datatables-bootstrap/3/dataTables.bootstrap.min.js">
    </script>
    <script type="text/javascript" src="lib/jquery-file-upload/js/jquery.uploadfile.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery-validation/dist/additional-methods.min.js">
    </script>

    <script type="text/javascript" src="/lib/bower_components/nprogress/nprogress.js"></script>
    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

    <script type="text/javascript" src="/css/bootstrap.data.css.js"></script>
    {{-- <script type="text/javascript" src="/lib/@ckeditor/ckeditor5-build-decoupled-document/build/ckeditor.js"></script>
		<script type="text/javascript" src="/lib/@ckeditor/ckeditor5-build-decoupled-document/build/translations/es.js"></script> --}}
    {{-- <script type="text/javascript" src="/core/js/Menu.js"></script> --}}
    {{-- <script type="text/javascript" src="/core/js/Datatables.js"></script> --}}
    <script type="text/javascript" src="/core/js/Date.js"></script>
    <script type="text/javascript" src="/core/js/Message.js"></script>
    <script type="text/javascript" src="/core/js/State.js"></script>
    <script type="text/javascript" src="/core/js/Type.js"></script>
    <script type="text/javascript" src="/core/js/Strings.js"></script>
    <script type="text/javascript" src="/core/js/Config.js"></script>
    @yield('scripts')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

</body>

</html>
