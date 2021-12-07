<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/bootstrap.css')}}">
    <link rel="stylesheet"  href="{{asset('/assets/diyor/css/main.css')}}">
    <title>Litsenziya</title>
</head>
<body class="login-body">
<header class="d-flex justify-content-center align-items-center flex-column min-vh-100" >
    <img src="{{asset('/assets/diyor/images/Logo-center2.png')}}" alt="svg">

    <!-- Login Title Top block-section-->
    <div class="col-md-4 text-center px-5 pb-5">
        <p class="login-title-text darkblue-color mb-5">Qurilish sohasida litsenziyaga ega korxona va tashkilotlar reestri</p>
    </div>
    <!-- Form Center block-section-->
    <div class="pt-4 pb-5 mb-5 px-4 align-items-center justify-content-center bg-white login-box">

        <div class="d-flex justify-content-center flex-column h-100">
            <form method="POST" action="{{ route('login') }}" class="login-form px-3">
                @csrf
                <div class="form-group w-100">
                    <label for="login" class="mb-0 text-left font-weight-bolder darkblue-color">Login</label>
                    <input class="login-input form-control" placeholder="Loginni kiriting" id="login" type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group w-100">
                    <label for="password" class="mb-0 text-left font-weight-bolder darkblue-color">Parol</label>
                    <input class="login-input form-control" placeholder="Parolni kiriting" id="password" type="password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button class="login-button">
                    Kirish
                </button>
            </form>
        </div>

    </div>

    <!-- Footer Login Socials Bottom block-section-->

    <ul class="text-center mt-5 pt-5">
        <li>
            <p class="login-help-texts darkblue-color number-title mb-0">Texnik Qo'llab-quvvatlash:</p>
        </li>
        <li>
            <p class="login-help-texts darkblue-color number-login">(+998 71) 123-45-67</p>
        </li>
        <li class="d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none mx-3">
                <img src="{{asset('/assets/diyor/images/tg-logo.svg')}}" alt="svg">

            </a>
            <a href="#" class="text-decoration-none mx-3">
                <img src="{{asset('/assets/diyor/images/social-icon.svg')}}" alt="svg">
            </a>
        </li>
    </ul>

</header>


<script src="js/jQuery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>