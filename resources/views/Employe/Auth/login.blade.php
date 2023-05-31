<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets2/images/features-first-icon.png') }}">
    <title>Employe Login</title>

    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ asset('assets2/images/big/slide-01.jpg') }}) no-repeat center center;">


            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img"
                    style="background-image: url({{ asset('assets2/images/big/third-trainer.jpg') }});">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">

                            {{-- Message section --}}

                            @if (session('login_error_message'))
                                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                    role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ session('login_error_message') }}
                                </div>
                            @endif

                            {{-- End message section --}}

                            <img src="{{ asset('assets2/images/big/features-first-icon.png') }}" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Enter your email address and password to access Employe Page.</p>
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form method="POST" action="{{ route('employe.store.login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <label class="text-dark" for="email" :value="__('Email')">Email</label>
                                        <input class="form-control" type="email" name="email" :value="old('email')"
                                            placeholder="enter your email" id="email" required autofocus>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="password" :value="__('Password')">Password</label>
                                        <input class="form-control" id="password" type="password" name="password"
                                            placeholder="enter your password" required autocomplete="current-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>


                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="{{ asset('assets2/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('assets2/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
