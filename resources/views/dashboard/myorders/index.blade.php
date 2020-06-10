@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.my_orders') <small>({{ $orders->total() }})</small></h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item">@lang('site.my_orders')</li>
            </ul>
        </div>

        <div class="row">

            <div class="col-md-8 p-0">

                <div class="tile">
                    <div class="tile-body m-0">

                        <section class="content-header">
                            <form action="" method="GET">

                                <div class="row">

                                    {{--                                    <div class="col-12 mb-2 mb-md-0 col-md-6">--}}
                                    {{--                                        <input type="text" name="search" class="form-control"--}}
                                    {{--                                               placeholder="@lang('site.search')"--}}
                                    {{--                                               value="{{ request()->search }}">--}}
                                    {{--                                    </div>--}}

                                    <div class="col-6 mb-2 mb-md-0 col-md-6">
                                        <select name="paid" value="" class="form-control mr-1">

                                            <option value="">@lang('site.all_orders')</option>
                                            <option
                                                value="0" {{ request()->paid == '0' ? 'selected':'' }}>
                                                @lang('site.pending')
                                            </option>
                                            <option
                                                value="1" {{ request()->paid == '1' ? 'selected':'' }}>
                                                @lang('site.confirmed')
                                            </option>


                                        </select>
                                    </div>

                                    <div class="col-6 col-md-3">

                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-search"></i>@lang('site.search')</button>
                                    </div>

                                </div>

                            </form>
                        </section>

                        <section class="content my-2">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h5 class="box-title text-capitalize"
                                        style="margin-bottom: 15px">@lang('site.my_orders')</h5>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @if ($orders->count() > 0)

                                        <div class="box-body table-responsive">

                                            <table class="table table-hover">
                                                <tr>
                                                    {{--                                                    <th>@lang('site.client_name')</th>--}}
                                                    <th>@lang('site.price')</th>
                                                    {{--                                        <th>@lang('site.status')</th>--}}
                                                    <th>@lang('site.created_at')</th>
                                                    <th>@lang('site.action')</th>
                                                </tr>

                                                @foreach ($orders as $order)
                                                    <tr class="{{ $order->paid ? '' : 'table-warning' }}">
                                                        {{--                                                        <td>{{ $order->user->first_name }}  {{ $order->user->last_name }}</td>--}}
                                                        <td>{{ number_format($order->total_price, 2) }}</td>
                                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                        <td class="px-0">
                                                            <button class="btn btn-primary btn-sm order-products"
                                                                    data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                                    data-method="get"
                                                            >
                                                                <i class="fa fa-list"></i>
                                                                @lang('site.show')
                                                            </button>
                                                            @if(!$order->paid)
                                                                <a href="{{ route('dashboard.myorders.edit', ['order' => $order->id]) }}"
                                                                   class="btn btn-info btn-sm my-2 my-md-0"><i
                                                                        class="fa fa-pencil"></i> @lang('site.edit')</a>
                                                                <form
                                                                    action="{{ route('dashboard.myorders.destroy', $order->id) }}"
                                                                    method="post" style="display: inline-block;">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('delete') }}
                                                                    <button type="submit"
                                                                            class="btn btn-danger btn-sm delete">
                                                                        <i class="fa fa-trash"></i> @lang('site.delete')
                                                                    </button>
                                                                </form>
                                                            @endif


                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </table><!-- end of table -->

                                            {{ $orders->appends(request()->query())->links() }}

                                        </div>

                                    @else

                                        <h4>@lang('site.no_data_found')</h4>

                                    @endif


                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>

                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="tile">
                    <div class="tile-body m-0">

                        <div class="box box-primary">

                            <div class="box-header">
                                <h5 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h5>
                            </div><!-- end of box header -->

                            <div class="box-body">

                                <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                    <div class="loader"></div>
                                    <p style="margin-top: 10px">@lang('site.loading')</p>
                                </div>

                                <div id="order-product-list">

                                </div><!-- end of order product list -->

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    </div>
                </div>

            </div>

        </div>


    </main>



@endsection
