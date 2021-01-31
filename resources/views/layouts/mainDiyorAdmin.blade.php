<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/bootstrap.css')}}">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/diyor/fonts/font-awesome.min.css')}}">
    <title>Talim</title>
</head>
<body style="background: #FAFDFF">
<div class="page-body">
<div class="nav-panel">
    @include('layouts.parts.leftDiyor')
</div>

    <div class="body-main">
        <div class="panel-top">
        @include('layouts.parts.headerDiyor')
        </div>
        @if($errors->any())
            <div class="alert alert-danger ml-2">
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
</div>

<script src="{{asset('/assets/diyor/js/jQuery.min.js')}}"></script>
<script src="{{asset('/assets/diyor/js/popper.js')}}"></script>
<script src="{{asset('/assets/diyor/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('/assets/diyor/js/bootstrap.js')}}"></script>
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