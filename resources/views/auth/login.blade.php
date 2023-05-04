<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="https://templates.iqonic.design/lite/posdash/html/assets/images/favicon.ico" /> --}}
    <link rel="stylesheet" href="{{ asset('css/backend-plugin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backende209.css?v=1.0.0') }}" />
    <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('lib/remixicon/remixicon.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href={{ asset('icons/css/all.css') }}>
    <link rel="stylesheet" href="{{ asset('css/finance.css') }}">
</head>

<body class="bg-light ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center height-self-center">
                    <div class="col-lg-8">
                        <div class="cardl auth-card">
                            <div class="card-body p-0" style="background-color: #fff; box-shadow: 3px solid;">
                                <div class="d-flex align-items-center auth-content">
                                    <div class="col-lg-7 align-self-center">
                                        <div class="p-3">
                                            <h2 class="mb-2" style="color:#02501c;">Connexion</h2>
                                            @include('layouts.partials.messages')
                                            <p style="color:#02501c;">Connectez-vous pour commencer a travailler.</p>
                                            <form method="post" action="{{ route('login.perform') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <input autocomplete="off"
                                                                class="floating-input form-control" name="username"
                                                                value="{{ old('username') }}" type="text"
                                                                placeholder=" " required="required" autofocus>
                                                            <label style="color:#02501c;" for="floatingName"> Email ou
                                                                Nom d'utilisateur</label>
                                                            @if ($errors->has('username'))
                                                                <span
                                                                    class="text-danger text-left">{{ $errors->first('username') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input autocomplete="off"
                                                                class="floating-input form-control" name="password"
                                                                type="password" placeholder=" "
                                                                value="{{ old('password') }}" required="required">
                                                            <label style="color:#02501c;" for="floatingPassword">Mot de
                                                                passe</label>
                                                            @if ($errors->has('password'))
                                                                <span
                                                                    class="text-danger text-left">{{ $errors->first('password') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input name="remember" type="checkbox"
                                                                class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label control-label-1"
                                                                for="customCheck1" style="color:#02501c;">Se souvenir de
                                                                moi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('login')
                                                    <div class="my-2 alert alert-danger" role="alert">
                                                        <div class="iq-alert-text">
                                                            <h5 class="alert-heading">Echec de connexion!</h5>
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close"><i class="ri-close-line"></i></button>
                                                    </div>
                                                @enderror
                                                <button type="submit" class="btn btn-success">Se
                                                    connecter</button>
                                                {{-- @include('auth.partials.copy') --}}
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 content-right">
                                        <img src="{{ asset('../img-side/09.png') }}" class="img-fluid image-right"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('js/podash.js') }}"></script>
</body>

</html>













{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
