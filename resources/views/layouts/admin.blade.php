<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        /* Styles pour la sidebar */
        .sidebar {
            background-color: #1d2b36; /* Couleur de fond sombre */
            color: #ffffff; /* Couleur du texte */
        }

        .sidebar-nav .nav-item .nav-link {
            color: #f8f9fa; /* Couleur des liens de navigation */
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav .nav-item .nav-link:hover,
        .sidebar-nav .nav-item .nav-link.active {
            color: #ffffff; /* Couleur des liens au survol et actifs */
            background-color: rgba(255, 255, 255, 0.1); /* Effet de survol */
        }

        .sidebar-nav .nav-item .nav-link i {
            color: #f8f9fa; /* Couleur des icônes */
            transition: color 0.3s;
        }

        .sidebar-nav .nav-item .nav-link:hover i,
        .sidebar-nav .nav-item .nav-link.active i {
            color: #ffffff; /* Couleur des icônes au survol et actifs */
        }

        .sidebar-minimizer {
            background-color: #1d2b36; /* Couleur de fond du bouton de réduction */
            color: #ffffff; /* Couleur de l'icône du bouton */
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-minimizer:hover {
            background-color: #007bff; /* Couleur de fond du bouton au survol */
            color: #ffffff; /* Couleur de l'icône au survol */
        }

        /* Styles généraux pour le corps */
        body {
            background-color: #ffffff; /* Fond sombre pour le corps */
            color: #ffffff; /* Texte clair */
        }

        i {
            color: #ffffff; /* Couleur des icônes */
        }
    </style>
</head>

<body class="dark-mode app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="{{ asset('frontend/assets/images/G__5_-removebg-preview.png') }}" alt="" width="200">
            <span class="navbar-brand-minimized">Panel</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            @if(count(config('panel.available_languages', [])) > 1)
            <li class="nav-item dropdown d-md-down-none">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                    <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                    @endforeach
                </div>
            </li>
            @endif
        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">
            <div style="padding-top: 20px" class="container-fluid">
                @if(session('message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
                @endif
                @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @yield('content')
            </div>
        </main>
        <form id="logoutform" action="" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('script-alt')
</body>

</html>
