@extends('layouts.app')

@section('content')

    <section id="show" class="container py-2">

        <div class="container">

            <div class="row">

                <div class="col-md-12 p-0 mb-md-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item text-capitalize"><a
                                    href="{{ route('products', ['category_id' => $product->category->id]) }}">
                                    {{ $product->category->name }}</a>
                            </li>
                            <li class="breadcrumb-item text-capitalize active"
                                aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">

                <div class="col-12 px-0 pb-2 col-md-5">

                    <img src="{{ $product->imagePath }}" class="img-thumbnail" alt="" style="height: 440px;width: 100%">

                </div><!--end of col-->

                <div class="col-12 col-md-7 pr-0">

                    <div class="product__details d-flex justify-content-between">

                        <p class="product__name text-capitalize align-self-center m-0">{{ $product->name }}</p>

                        @guest
                            <a
                                href="{{ route('login') }}"
                                class="product__details-button btn btn-outline-primary btn-sm text-capitalize text-primary align-self-center"
                            >
                                        <span
                                            class="fas fa-shopping-cart"></span>
                                @lang('site.add_to_cart')
                            </a>

                        @else

                            <a
                                class="btn {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? 'btn-danger disabled text-white' : 'btn-outline-primary add-product-btn text-primary' }} product__details-button text-capitalize btn-sm mr-1"
                                data-id="{{ $product->id }}"
                                data-cart="{{ Auth::user()->cart()->id }}"
                                data-route="{{ route('carts.add') }}">
                                                                                <span
                                                                                    class="fas fa-shopping-cart"></span>
                                {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? Lang::get('site.added_to_cart') : Lang::get('site.add_to_cart') }}
                            </a>

                        @endguest
                    </div>

                    {{--                    <div class="d-flex">--}}

                    {{--                        <h6 class="mb-0 text-capitalize fw-300">nombre de vues: 300</h6>--}}

                    {{--                    </div>--}}

                    <div class="d-flex mb-md-2">

                        <p class="product__price mb-0 text-capitalize fw-700">{{ $product->sale_price }} DZD</p>

                    </div>

                    <div>
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>

                    <hr>

                </div><!--end of col-->

            </div><!--end of row -->

        </div><!--end of container-->


    </section>

    @if ($product->category->products->count() > 0)

        <section class="listing mb-4">

            <div class="container">

                <div class="row  my-2">

                    <div class="col-12 d-flex justify-content-between">

                        <h3 class="listing__title text-dark fw-500 text-capitalize">@lang('site.related_products')</h3>

                    </div>

                </div><!--end of row-->

                <div class="row">

                    @foreach ($product->category->products->slice(0, in_array($product->id, $product->category->products->slice(0, 4)->pluck('id')->toArray()) ? '5' : '4') as $pro)

                        @if($pro->id != $product->id)

                            <div class="product col-12 my-2 col-md-3">

                                <img src="{{ $pro->image_path }}" class="img-thumbnail" alt=""
                                     style="height: 227px;width: 100%">

                                <div class="d-flex">

                                    <p class="product__name mb-0 text-capitalize">{{ $pro->name }}</p>

                                </div>

                                <div class="d-flex">

                                    <p class="product__price mb-0 text-capitalize">{{ $pro->sale_price }}</p>

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
                                            class="btn {{ in_array($pro->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? 'btn-danger disabled text-white' : 'btn-outline-primary add-product-btn text-primary' }} product__details-button text-capitalize flex-fill mr-1"
                                            data-id="{{ $pro->id }}"
                                            data-cart="{{ Auth::user()->cart()->id }}"
                                            data-route="{{ route('carts.add') }}">
                                                                                <span
                                                                                    class="fas fa-shopping-cart"></span>
                                            {{ in_array($pro->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? Lang::get('site.added_to_cart') : Lang::get('site.add_to_cart') }}
                                        </a>

                                    @endguest

                                    <a href="{{ route('product', $pro->id) }}"
                                       class="product__details-button btn btn-primary text-capitalize"><span
                                            class="fas fa-info"></span>
                                        @lang('site.info')
                                    </a>

                                </div><!--end of movie details-->


                            </div><!--end of col-->

                        @endif

                    @endforeach

                </div><!--end of owl slides-->

            </div><!--end of container-->

        </section><!--end of products section-->

    @endif

@endsection
