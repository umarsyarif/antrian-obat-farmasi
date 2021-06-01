<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('logors.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminty\files\bower_components\bootstrap\css\bootstrap.min.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\icon\icofont\css\icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\icon\feather\css\feather.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\assets\css\style.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminty\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>

<body>

    <!-- Pre-loader start -->
    @include('partials.loader')
    <!-- Pre-loader end -->

    <div id="app">
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <!-- Navbar start -->

                <!-- Navbar end-->

                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">

                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div id="app" class="containers">
                                        <div class="row" style="width:100%; height:100%;">
                                            <div class="col-md-12 col-md-offset-2">
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h1 class="text-center">
                                                            Antrian Obat @{{ date }}
                                                        </h1>
                                                    </div>

                                                    <div class="card-body">
                                                        <antrian-list :pasien="pasien">
                                                        </antrian-list>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\jquery\js\jquery.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\jquery-ui\js\jquery-ui.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\popper.js\js\popper.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap\js\bootstrap.min.js') }}">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('adminty\files\assets\js\script.min.js') }}"></script>
    @stack('script')
</body>

</html>
