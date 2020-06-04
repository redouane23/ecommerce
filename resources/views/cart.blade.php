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

                <div class="col-md-12 p-0">

                    @if(Auth::user()->cart()->products->count() > 0)

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
                                    <td style="text-align: right">{{ $product->sale_price }} DZD</td>
                                    <td>
                                        <div class="form-control input-sm cart__table-input text-center mb-2">
                                            {{ $product->pivot->quantity }}
                                        </div>
                                        <div class="d-flex justify-content-between">

                                            <a class="btn btn-outline-primary text-primary btn-sm"><i
                                                    class="fa fa-caret-down"></i>
                                            </a>

                                            <a class="btn btn-outline-primary text-primary btn-sm"><i
                                                    class="fa fa-caret-up"></i>
                                            </a>

                                        </div>
                                    </td>
                                    <td style="text-align: right">{{ $product->sale_price }} DZD</td>

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
                                <td class="text-capitalize">total</td>
                                <td colspan="2" class="text-capitalize">7000 DZD</td>
                            </tr>
                            </tfoot>

                        </table><!--end of table-->

                        <a class="btn btn-primary text-white text-capitalize fa-pull-right cart__cnf mb-2">confirmer
                            votre
                            commande</a>

                    @else

                        <div class="d-flex justify-content-center align-items-center my-3">

                            <img src="dist/images/emptycart.png" class="img-fluid" alt=""
                                 style="height: 207px;width: 210px">

                        </div>

                        <h2 class="text-center text-capitalize my-2">@lang('site.empty_cart')</h2>

                    @endif

                </div><!--end of col-->

            </div><!--end of row -->

        </div><!--end of container-->


    </section>

@endsection
