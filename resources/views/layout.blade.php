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
    <link rel="stylesheet" type="text/css"
        href="/lib/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/lib/bower_components/datatables-bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.data.css" />
    <link rel="stylesheet" type="text/css" href="/lib/bower_components/nprogress/nprogress.css" />
    <link rel="stylesheet" type="text/css" href="/lib/bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/lib/jquery-file-upload/css/uploadfile.css" />
    <link rel="stylesheet" type="text/css" href="/css/app.css" />

    <script type="text/javascript" src="/js/fontOpenSans.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/angular/angular.min.js"></script>
    <script type="text/javascript">
        var appData = angular.module('appData', []);
    </script>

    <noscript>Tu navegador no soporta JavaScript!</noscript>
</head>

<body ng-controller="bodyController">

    <div class="navbar navbar-app" role="navigation" ng-controller="NavController">
        <div class="container-fluid">
            <div class="navbar-header">
                @if (Auth::check())
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @endif
                <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
                <div class="logoProducto"></div>
                <div class="logoCliente"></div>
            </div>
            @if (Auth::check())
            <div id="menu" class="navbar-collapse" ng-class="isCollapsed ? 'in' : 'collapse'">
                <ul class="nav navbar-nav">
                    <li id="li_module" class="dropdown" ng-repeat="modulo in modulos">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Nombre modulo <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <div class="row" ng-repeat="fila_submodulo in modulo.filas_submodulos">
                                    <div ng-repeat="submodulo in fila_submodulo.submodulos">
                                        <ul class="multi-column-dropdown">
                                            <li class="dropdown-header">submodulo nombre</li>
                                            <li class="divider"></li>
                                            <li ng-repeat="opcion in submodulo.opciones">
                                                <a ng-href="/rutaopcion">NOmbre opcion</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
    @if (Auth::check())
    <ol class="breadcrumb"><?php
				if (isset($this->modulo) && trim($this->modulo) != '') {?>
        <li><?php echo $this->modulo;?></li><?php
				}
				if (isset($this->submodulo) && trim($this->submodulo) != '') {?>
        <li><?php echo $this->submodulo;?></li><?php
				}
				if (isset($this->opcion) && trim($this->opcion) != '') {?>
        <li class="negrita"><?php echo $this->opcion;?></li><?php
				}?>
        <li class="infoUsuario navbar-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <span class="glyphicon glyphicon-user"></span>&nbsp;
                        <?php echo Session::get('nombreUsuario');?>
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
                        <span class="glyphicon glyphicon-home"></span>&nbsp;
                        <?php echo Session::get('nombreSedeOperativa');?>
                    </li><?php
							}?>
                    <li class="divider"></li>
                    <li>
                        <span class="glyphicon glyphicon-off"></span>&nbsp;
                        <span><a href="/logout">Cerrar sesión</a></span>
                    </li>
                </ul>
            </div>
        </li>
    </ol>
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
    <script type="text/javascript" src="/lib/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js">
    </script>
    <script type="text/javascript" src="/lib/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/datatables-bootstrap/3/dataTables.bootstrap.min.js">
    </script>
    <script type="text/javascript" src="lib/jquery-file-upload/js/jquery.uploadfile.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/lib/bower_components/jquery-validation/dist/additional-methods.min.js"></script>

    <script type="text/javascript" src="/lib/bower_components/nprogress/nprogress.js"></script>
    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

    <script type="text/javascript" src="/css/bootstrap.data.css.js"></script>
    {{-- <script type="text/javascript" src="/lib/@ckeditor/ckeditor5-build-decoupled-document/build/ckeditor.js"></script>
		<script type="text/javascript" src="/lib/@ckeditor/ckeditor5-build-decoupled-document/build/translations/es.js"></script> --}}
    <script type="text/javascript" src="/core/js/Menu.js"></script>
    <script type="text/javascript" src="/core/js/Datatables.js"></script>
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
