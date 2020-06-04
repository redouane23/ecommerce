@extends('layouts.app')

@section('content')

    <section id="login" class="container">


        <div class="login">

            <div class="container">
                <div class="row">
                    <div class="col-10 mx-auto col-md-6 bg-white mx-auto pb-0">

                        <h2 class="text-center text-capitalize text-primary">@lang('site.login')</h2>

                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!--email-->
                            <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                <label for="email">@lang('site.email')</label>
                                <input type="text" name="email" class="form-control" id="email"
                                       value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--password-->
                            <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                <label for="password">@lang('site.password')</label>
                                <input type="password" name="password" class="form-control" id="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--remember me-->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                           for="customCheck">@lang('site.remember_me')</label>
                                </div>
                            </div>

                            <!--submit-->
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">@lang('site.login')</button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('site.forgot_password')
                                    </a>
                                @endif

                            </div>

                            <p class="text-center">Create a New Account <a
                                    href="{{ route('register') }}">@lang('site.register') !</a>
                            </p>

                        </form><!--end of form-->


                        <div style="display: none">

                            <hr>
                            <button class="btn btn-block btn-primary" style="background: #3b5998">
                                <span class="fab fa-facebook-f"></span>
                                Login by facebook
                            </button>
                            <button class="btn btn-block btn-primary" style="background: #dd4b39">
                                <span class="fab fa-google"></span>
                                Login by google+
                            </button>

                        </div>

                    </div>
                </div>
            </div>

        </div>


    </section><!--end of login-->

@endsection
