@extends('layouts.app')

@section('content')

    <section id="cart" class="container py-2">

        <div class="container">


            <div class="row">

                <div class="col-md-12 p-0 mb-md-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item text-capitalize"><a
                                    href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li class="breadcrumb-item text-capitalize active"
                                aria-current="page">@lang('site.cart')</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12 p-0"
                     id="non-empty"
                     style="display: {{ Auth::user()->cart()->products->count() > 0 ? 'block' : 'none' }};">

                    <table class="table table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th style="width: 150px">@lang('site.product')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.price')</th>
                            <th style="width: 100px">@lang('site.quantity')</th>
                            <th>@lang('site.total')</th>
                            <th style="width: 80px"
                                class="action text-center text-capitalize">@lang('site.delete')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach (Auth::user()->cart()->products as $product)

                            <tr>
                                <td><img src="{{ $product->image_path }}" class="img-fluid" alt=""
                                         style="height: 130px;width: 100%">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td style="text-align: right"
                                    id="price{{ $product->id }}">{{ number_format($product->sale_price , 0) }} DZD
                                </td>
                                <td>
                                    <div class="form-control input-sm cart__table-input text-center mb-2"
                                         id="quantity{{ $product->id }}"
                                    >
                                        {{ $product->pivot->quantity }}
                                    </div>
                                    <div class="d-flex justify-content-between">

                                        <a class="btn btn-outline-primary text-primary btn-sm  update-product-btn"
                                           data-value="down"
                                           data-id="{{ $product->id }}"
                                           data-cart="{{ Auth::user()->cart()->id }}"
                                        >
                                            <i class="fa fa-caret-down"></i>
                                        </a>

                                        <a class="btn btn-outline-primary text-primary btn-sm update-product-btn"
                                           data-value="up"
                                           data-id="{{ $product->id }}"
                                           data-cart="{{ Auth::user()->cart()->id }}">
                                            <i class="fa fa-caret-up"></i>
                                        </a>

                                    </div>
                                </td>
                                <td style="text-align: right">
                                        <span
                                            id="total_price{{ $product->id }}">{{ number_format($product->sale_price * $product->pivot->quantity, 0) }}</span>
                                    DZD
                                </td>

                                <td class="text-center"><i class="fa fa-trash-alt text-danger remove-product-btn"
                                                           id="id{{ $product->id }}"
                                                           data-id="{{ $product->id }}"
                                                           data-cart="{{ Auth::user()->cart()->id }}"></i>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                        <tfoot class="bg-light">
                        <tr>

                            <td colspan="3"></td>
                            <td class="text-capitalize"><h6>@lang('site.total')</h6></td>
                            <td colspan="2"
                                class="text-capitalize">
                                <h6><b class="total-price">{{ number_format(Auth::user()->cart()->total_price, 0) }}
                                    </b> DZD</h6>
                            </td>
                        </tr>
                        </tfoot>

                    </table><!--end of table-->

                    <a class="btn btn-primary text-white text-capitalize fa-pull-right cart__cnf">
                        @lang('site.confirm_your_order')
                    </a>

                </div><!--end of col-->

                <div class="col-md-12 p-0"
                     id="empty"
                     style="display: {{ Auth::user()->cart()->products->count() > 0 ? 'none' : 'block' }};">

                    <div class="d-flex justify-content-center align-items-center my-3">

                        <img src="dist/images/emptycart.png" class="img-fluid" alt=""
                             style="height: 207px;width: 210px">

                    </div>

                    <h2 class="text-center text-capitalize my-2">@lang('site.empty_cart')</h2>

                </div>

            </div><!--end of row -->

        </div><!--end of container-->


    </section>

@endsection
