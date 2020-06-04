@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.clients')</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item">@lang('site.clients')</li>
            </ul>
        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="tile">
                    <div class="tile-body m-0">

                        <section class="content my-2">

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h4 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h4>

                                </div><!-- end of box header -->

                                <div class="box-body">

                                    <!--Accordion wrapper-->
                                    <div class="accordion" id="accordionEx" role="tablist"
                                         aria-multiselectable="false">

                                    @foreach ($categories as $category)

                                        <!-- Accordion card -->
                                            <div class="card mb-2">

                                                <!-- Card header -->
                                                <div class="card-header  bg-light" role="tab" id="headingOne1">
                                                    <h4 data-toggle="collapse" data-parent="#accordionEx"
                                                        class="d-flex justify-content-between"
                                                        href="#{{ str_replace(' ', '-', $category->name) }}">

                                                        {{ $category->name }}
                                                        <i class="fa fa-angle-down"></i>

                                                    </h4>
                                                </div>

                                                <!-- Card body -->
                                                <div id="{{ str_replace(' ', '-', $category->name) }}"
                                                     class="collapse" role="tabpanel"
                                                     aria-labelledby="headingOne1" data-parent="#accordionEx">
                                                    <div class="card-body">
                                                        @if ($category->products->count() > 0)

                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>@lang('site.name')</th>
                                                                    <th>@lang('site.stock')</th>
                                                                    <th>@lang('site.price')</th>
                                                                    <th>@lang('site.add')</th>
                                                                </tr>

                                                                @foreach ($category->products as $product)
                                                                    <tr>
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->stock }}</td>
                                                                        <td>{{ $product->sale_price }}</td>
                                                                        <td>
                                                                            <a href=""
                                                                               id="product-{{ $product->id }}"
                                                                               data-name="{{ $product->name }}"
                                                                               data-id="{{ $product->id }}"
                                                                               data-price="{{ $product->sale_price }}"
                                                                               class="btn btn-success btn-sm add-product-btn">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table><!-- end of table -->

                                                        @else
                                                            <h5>@lang('site.no_records')</h5>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Accordion card -->

                                        @endforeach


                                    </div>

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                            <!-- /.box -->
                        </section>

                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="tile">
                    <div class="tile-body m-0">

                        <section class="content my-2">

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h4 class="box-title">@lang('site.orders')</h4>

                                </div><!-- end of box header -->

                                <div class="box-body">

                                    <form action="{{ route('dashboard.clients.orders.store', $client->id) }}"
                                          method="post">

                                        {{ csrf_field() }}
                                        {{ method_field('post') }}

                                        @include('partials._errors')

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>@lang('site.product')</th>
                                                <th>@lang('site.quantity')</th>
                                                <th>@lang('site.price')</th>
                                            </tr>
                                            </thead>

                                            <tbody class="order-list">


                                            </tbody>

                                        </table><!-- end of table -->

                                        <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                                        <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i
                                                class="fa fa-plus"></i> @lang('site.add_order')</button>

                                    </form>

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                            @if ($client->orders->count() > 0)

                                <div class="box box-primary mt-2">

                                    <div class="box-header">

                                        <h5 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                                            <small>{{ $orders->total() }}</small>
                                        </h5>

                                    </div><!-- end of box header -->

                                    <div class="box-body">

                                        @foreach ($orders as $index=>$order)

                                            <div class="panel-group">

                                                <div class="panel panel-success">

                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a data-toggle="collapse" class="h5"
                                                               href="#id{{ $index }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                        </h5>
                                                    </div>

                                                    <div id="id{{ $index }}"
                                                         class="panel-collapse collapse">

                                                        <div class="panel-body">

                                                            <ul class="list-group">
                                                                @foreach ($order->products as $product)
                                                                    <li class="list-group-item">{{ $product->name }}</li>
                                                                @endforeach
                                                            </ul>

                                                        </div><!-- end of panel body -->

                                                    </div><!-- end of panel collapse -->

                                                </div><!-- end of panel primary -->

                                            </div><!-- end of panel group -->

                                        @endforeach

                                        {{ $orders->links() }}

                                    </div><!-- end of box body -->

                                </div><!-- end of box -->

                        @endif


                        <!-- /.box -->
                        </section>

                    </div>
                </div>

            </div>

        </div>


    </main>



@endsection
