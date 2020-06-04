@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.dashboard')</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"> @lang('site.dashboard')</i></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-th fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.categories')</h4>
                        <p><b>{{ $categories->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.suppliers')</h4>
                        <p><b>{{ $suppliers->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-th fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.products')</h4>
                        <p><b>{{ $products->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.clients')</h4>
                        <p><b>{{ $clients->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.users')</h4>
                        <p><b>{{ $users->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-file-text fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.pending_orders')</h4>
                        <p><b>{{ $orders->count() }}</b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                    <div class="info">
                        <h4>@lang('site.orders_received')</h4>
                        <p><b>{{ $orders->count() }}</b></p>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
