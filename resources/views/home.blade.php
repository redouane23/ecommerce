@extends('layouts.app')

@section('content')

    {{--    <section id="slide" class="container mb-2 py-2">--}}

    {{--        <div class="slides owl-carousel owl-theme">--}}


    {{--            <div class="slide text-white d-flex justify-content-center align-items-center">--}}

    {{--                <img src="dist/images/support.jpg" class="img-fluid" alt="" style="height: 400px;width: 100%">--}}


    {{--            </div><!--end of slide-->--}}

    {{--            <div class="slide text-white d-flex justify-content-center align-items-center">--}}

    {{--                <img src="dist/images/support.jpg" class="img-fluid" alt="" style="height: 400px;width: 100%">--}}


    {{--            </div><!--end of slide-->--}}

    {{--        </div><!--end of slides-->--}}

    {{--    </section><!--end of slide section-->--}}

    {{--    <div class="container mt-2 p-0">--}}

    {{--        <div class="row">--}}

    {{--            <div class="col-md-12 text-secondary d-flex justify-content-center align-items-center">--}}

    {{--                <h3 class="text-capitalize text-primary fw-300">@lang('site.our_products')</h3>--}}

    {{--            </div>--}}

    {{--        </div><!--end of row-->--}}


    {{--    </div><!--end of container-->--}}

    {{--    @foreach ($categories as $category)--}}

    {{--        @if ($category->limitProducts->count() > 0)--}}

    {{--            <section class="listing mb-4">--}}

    {{--                <div class="container">--}}

    {{--                    <div class="row  my-2">--}}

    {{--                        <div class="col-12 d-flex justify-content-between">--}}

    {{--                            <h3 class="listing__title text-dark fw-500 text-capitalize">{{ $category->name }}</h3>--}}
    {{--                            <a href="" class="align-self-center text-primary text-capitalize">@lang('site.see_all')</a>--}}

    {{--                        </div>--}}

    {{--                    </div><!--end of row-->--}}

    {{--                    <div class="row">--}}

    {{--                        @foreach ($category->limitProducts as $product)--}}

    {{--                            <div class="product col-12 my-2 col-md-3">--}}

    {{--                                <img src="{{ $product->image_path }}" class="img-thumbnail" alt=""--}}
    {{--                                     style="height: 227px;width: 100%">--}}

    {{--                                <div class="d-flex">--}}

    {{--                                    <p class="product__name mb-0 text-capitalize">{{ $product->name }}</p>--}}

    {{--                                </div>--}}

    {{--                                <div class="d-flex">--}}

    {{--                                    <p class="product__price mb-0 text-capitalize">{{ $product->sale_price }}</p>--}}

    {{--                                </div>--}}

    {{--                                <div class="d-flex justify-content-between align-items-center">--}}

    {{--                                    @guest--}}
    {{--                                        <a--}}
    {{--                                            href="{{ route('login') }}"--}}
    {{--                                            class="product__details-button btn btn-outline-primary text-capitalize text-primary flex-fill mr-1"--}}
    {{--                                        >--}}
    {{--                                        <span--}}
    {{--                                            class="fas fa-shopping-cart"></span>--}}
    {{--                                            @lang('site.add_to_cart')--}}
    {{--                                        </a>--}}

    {{--                                    @else--}}

    {{--                                        <a--}}
    {{--                                            class="btn {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? 'btn-danger disabled text-white' : 'btn-outline-primary add-product-btn text-primary' }} product__details-button text-capitalize flex-fill mr-1"--}}
    {{--                                            data-id="{{ $product->id }}"--}}
    {{--                                            data-cart="{{ Auth::user()->cart()->id }}">--}}
    {{--                                                                                <span--}}
    {{--                                                                                    class="fas fa-shopping-cart"></span>--}}
    {{--                                            {{ in_array($product->id, Auth::user()->cart()->products->pluck('id')->toArray()) ? Lang::get('site.added_to_cart') : Lang::get('site.add_to_cart') }}--}}
    {{--                                        </a>--}}

    {{--                                    @endguest--}}

    {{--                                    <a href="{{ route('product', $product->id) }}"--}}
    {{--                                       class="product__details-button btn btn-primary text-capitalize"><span--}}
    {{--                                            class="fas fa-info"></span>--}}
    {{--                                        @lang('site.info')--}}
    {{--                                    </a>--}}

    {{--                                </div><!--end of movie details-->--}}


    {{--                            </div><!--end of col-->--}}

    {{--                        @endforeach--}}

    {{--                    </div><!--end of owl slides-->--}}

    {{--                </div><!--end of container-->--}}

    {{--            </section><!--end of products section-->--}}

    {{--        @endif--}}

    {{--    @endforeach--}}


@endsection
