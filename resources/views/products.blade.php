@extends('layouts.app')

@section('content')

    <section class="listing mb-4">

        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item text-capitalize">@lang('site.products')</li>
                            <li class="breadcrumb-item text-capitalize"
                                aria-current="page">({{ $products->total() }})
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">

                @if ($products->count() > 0)

                    @foreach ($products as $product)

                        <div class="product col-12 my-2 col-md-3">

                            <img src="{{ $product->image_path }}" class="img-thumbnail" alt=""
                                 style="height: 227px;width: 100%">

                            <div class="d-flex">

                                <p class="product__name mb-0 text-capitalize">{{ $product->name }}</p>

                            </div>

                            <div class="d-flex">

                                <p class="product__price mb-0 text-capitalize">{{ $product->sale_price }}</p>

                            </div>

                            <div class="d-flex justify-content-between align-items-center">

                                @guest
                                    <a
                                        href="{{ route('login') }}"
                                        class="product__details-button btn btn-outline-primary text-capitalize text-primary flex-fill mr-1"
                                    >
                                        <span
                                            class="fas fa-shopping-cart"></span>
                                        @lang('site.add_to_cart')
                                    </a>

                                @else

                                    <a
                                        class="btn {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? 'btn-danger disabled text-white' : 'btn-outline-primary add-product-btn text-primary' }} product__details-button text-capitalize flex-fill mr-1"
                                        data-id="{{ $product->id }}"
                                        data-cart="{{ Auth::user()->cart()->id }}"
                                        data-route="{{ route('carts.add') }}">
                                                                                <span
                                                                                    class="fas fa-shopping-cart"></span>
                                        {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? Lang::get('site.added_to_cart') : Lang::get('site.add_to_cart') }}
                                    </a>

                                @endguest

                                <a href="{{ route('product', $product->id) }}"
                                   class="product__details-button btn btn-primary text-capitalize"><span
                                        class="fas fa-info"></span>
                                    @lang('site.info')
                                </a>

                            </div><!--end of movie details-->


                        </div><!--end of col-->

                    @endforeach

                    <div class="col-12 mt-4  d-flex justify-content-center">

                        {{ $products->appends(request()->query())->links() }}

                    </div>

                @else
                    <div class="col-md-12 my-md-2"
                         id="empty">

                        <h6 class="text-center text-capitalize my-2">@lang('site.no_products')</h6>

                    </div>

                @endif

            </div><!--end of owl slides-->

        </div><!--end of container-->

    </section><!--end of products section-->

@endsection
