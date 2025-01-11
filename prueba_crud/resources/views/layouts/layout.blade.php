<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header')
    <style>
        .contenido-cuerpo {
            width:100%;
            /* margin-left: auto; */
            /* margin-right: auto; */
            margin-bottom: 18em;
        }
        .contenido-row {
            display: block;
        }
    </style>
</head>
<body>
    <div class="contenido-cuerpo">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="logo-box">
                    <a href="{{route('home')}}">
                        <img src="{{asset('img/logo.jpg')}}" alt="logo" class="logo logo-img">
                    </a>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    @include('layouts.footer')
</body>
</html>
