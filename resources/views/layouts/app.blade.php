<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <!--font awesome-->
    <link rel="stylesheet" href="{{ asset('dist/css/font-awesome5.11.2.min.css') }}">

    <!--bootstrap-->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">

    <!--vendor css-->
    <link rel="stylesheet" href="{{ asset('dist/css/vendor.min.css') }}">


    <!--main styles -->
    <link rel="stylesheet" href="{{ asset('dist/css/main.min.css') }}">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/js/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/js/plugins/noty/noty.min.js') }}"></script>

</head>
<body>

<section id="banner" class="container mb-2 py-2">


    <header>

        <div class="container fw-100 text-center">

            <div class="row">
                <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown1" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-language"></i> english
                </a>
                <div class="dropdown-menu fw-100" aria-labelledby="navbarDropdown1">
                    <a class="dropdown-item text-secondary" href="#">arabic</a>
                    <a class="dropdown-item text-secondary" href="#">english</a>
                </div>

                <a class="nav-link text-capitalize text-secondary">
                    <i class="fa fa-phone"></i> 027 27 27 27
                </a>

                <a class="nav-link text-capitalize text-secondary">
                    <i class="fa fa-mobile"></i> 07 70 70 70 / 05 50 50 50 50
                </a>

            </div>

        </div><!--end of container-->


    </header><!--end of header-->

    <nav class="navbar navbar-expand-lg navbar-dark text-primary p-0">

        <div class="container bg-light d-flex justify-content-center align-items-center">

            <button class="navbar-toggler mb-2 mx-2 align-self-center" type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""><i class="fa fa-bars text-primary"></i></span>
            </button>

            <a class="navbar-brand text-primary" href="{{ route('home') }}">
                <h2 class="fw-700 m-0 p-0">
                    Sarl<span class="h5 fw-300 ">AK</span>
                </h2>
                <h2 class="text-center fw-100 text-secondary m-0 p-0">maintenance</h2>
            </a>

            <div class="collapse in navbar-collapse" id="navbarSupportedContent">

                <form action="" class="col-12 p-2 col-md-5 mt-1 mt-md-1 ml-0 mr-2 mr-md-0">
                    <div class="input-group">
                        <input class="form-control py-2 border-right-0 border search"
                               placeholder="@lang('site.search')"
                               type="search" name="search" id="example-search-input" value="{{ request()->search }}">
                        <span class="input-group-append">
                    <div class="input-group-text bg-white text-primary search__icon"><i class="fa fa-search">
                    </i>
                    </div>
                </span>
                    </div>
                </form>


                <ul class="navbar-nav ml-auto fw-500 text-center">
                    <li class="nav-item">
                        <a class="nav-link text-capitalize text-primary mr-2"
                           href="{{ route('home') }}">@lang('site.home')<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize text-primary mr-2" href="#">@lang('site.about_us')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize text-primary mr-2" href="#">@lang('site.contact_us')</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item dropdown text-capitalize">
                            <a class="nav-link dropdown-toggle text-primary mr-2" href="#" id="navbarDropdown2"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> @lang('site.my_space')
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="{{ route('login') }}">@lang('site.login')</a>
                                <a class="dropdown-item" href="{{ route('register') }}">@lang('site.register')</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown text-capitalize">
                            <a class="nav-link dropdown-toggle text-primary mr-2" href="#" id="navbarDropdown2"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->first_name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="{{ route('dashboard.welcome') }}"><i
                                        class="fa fa-tachometer-alt fa-lg"></i> @lang('site.dashboard')</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-out-alt fa-lg"></i>
                                    @lang('site.logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>

                <ul class="navbar-nav ml-md-4 text-center">
                    <li class="nav-item">
                        <!-- Authentication Links -->
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-shopping-cart text-center text-primary align-self-center">
                                </i><span class="badge badge-danger cart-count">0</span>
                            </a>
                        @else
                            <a class="nav-link" href="{{ route('cart') }}">
                                <i class="fa fa-shopping-cart text-center text-primary align-self-center">
                                </i><span
                                    class="badge badge-danger cart-count">
                                    {{ Auth::user()->cart()->products->count() }}
                                </span>
                            </a>
                        @endguest
                    </li>
                </ul>

            </div>


        </div><!--end of container-->


    </nav><!--end of navbar 2-->


</section><!--end of banner section-->

@yield('content')

<footer id="footer" class="py-3 bg-primary text-center text-white">

    <p class="text-capitalize mb-0">Copyright © SARL-KA 2020 </p>

    <div class="social_icons">

        <a href="" class="text-white mr-2"><i class="fab fa-facebook"></i></a>
        <a href="" class="text-white mr-2"><i class="fab fa-youtube mr-2"></i></a>
        <a href="" class="text-white mr-2"><i class="fab fa-twitter mr-2"></i></a>

    </div>

</footer><!--end of footer-->

<!--jquery-->
<script src="{{ asset('dist/js/jquery-3.4.0.min.js') }}"></script>

<!--bootstrap-->
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/popper.min.js') }}"></script>

<!--vendor js-->
<script src="{{ asset('dist/js/vendor.min.js') }}"></script>

<!--main scripts-->
<script src="{{ asset('dist/js/main.min.js') }}"></script>

{{--jquery number--}}
<script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>
{{--custom js--}}
<script src="{{ asset('dist/js/custom/cart.js') }}"></script>

<!-- Page specific javascripts-->
<script src="{{ asset('dashboard_files/js/plugins/bootstrap-notify.min.js') }}"></script>

<!--owl slides scripts-->
<script>
    $(document).ready(function () {
        $("#slide .slides").owlCarousel({
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            loop: true,
            nav: false,
            items: 1,
            dots: false,
            margin: 20,
            //autoWidth:true,
            //autoHeight:true,
        });

        $(".listing .products").owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            nav: false,
            dots: false,
            margin: 20,
            height: 100,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                900: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

    });
</script>
</body>
</html>
