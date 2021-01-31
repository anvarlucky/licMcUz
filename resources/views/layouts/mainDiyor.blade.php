<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/bootstrap.css')}}">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/diyor/fonts/font-awesome.min.css')}}">
    <title>Litsenziya</title>
</head>
<body style="background: #FAFDFF">
<div class="full-page">
    @if(Auth::user())
        <div class="panel-top">
        @include('layouts.PartForClient.topPanel')
        </div>
        @endif
        <div class="panel-top">
            <div class="panel-top-fixed d-flex align-items-center justify-content-between py-2 px-5">
                <a href="/"><p class="darkblue-color font-weight-bold text-nowrap mb-0">Litsenziya berish Tizimi</p></a>
                <div class="panel-top-items-box">
                    <img src="{{asset('/assets/diyor/images/notification-icon.svg')}}" alt="svg">
                    <div type="button" class="dropdown show user-cabinet dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">{{--{{Auth::user()->name}}--}}</a>
                            <a class="dropdown-item" href="#">Sozlamalar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item log-out" :href="{{route('logout')}}">Chiqish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
        @endif
    @yield('content')
</div>
<script src="{{asset('/assets/diyor/js/jQuery.min.js')}}"></script>
<script src="{{asset('/assets/diyor/js/popper.js')}}"></script>
<script src="{{asset('/assets/diyor/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('/assets/diyor/js/bootstrap.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.log-out').one('click', function () {
            window.location.pathname='/logout'
        })
    })
</script>
</body>
</html>