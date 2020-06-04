@extends('layouts.app')

@section('content')

    <section id="login" class="container">


        <div class="login">

            <div class="container">
                <div class="row">
                    <div class="col-10 mx-auto col-md-6 bg-white mx-auto">

                        <h2 class="text-center text-capitalize text-primary">@lang('site.register')</h2>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <!--first name-->
                                    <div class="form-group{{ $errors->has('first_name') ? ' is-invalid' : '' }}">
                                        <label for="first_name">@lang('site.first_name')</label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                                               autofocus
                                               class="form-control" id="first_name">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!--last name-->
                                    <div class="form-group{{ $errors->has('last_name') ? ' is-invalid' : '' }}">
                                        <label for="last_name">@lang('site.last_name')</label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                                               autofocus
                                               class="form-control" id="last_name">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <!--email-->
                            <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                <label for="email">@lang('site.email')</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--password-->
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                <label for="password">@lang('site.password')</label>
                                <input type="password" name="password" class="form-control" id="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!--confirm password-->
                            <div class="form-group">
                                <label for="password-confirm">@lang('site.password_confirmation')</label>
                                <input type="password" class="form-control" id="password-confirm"
                                       name="password_confirmation">
                            </div>

                            <!--remember me-->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                           name="example1">
                                    <label class="custom-control-label"
                                           for="customCheck">@lang('site.agree_terms')</label>
                                </div>
                            </div>

                            <!--submit-->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">@lang('site.register')</button>
                            </div>

                            <p class="text-center">@lang('site.already_have_an_account') <a
                                    href="{{ route('login') }}">@lang('site.login') !</a></p>

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


    </section><!--end of register-->

@endsection
