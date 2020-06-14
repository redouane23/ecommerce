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
                                aria-current="page">@lang('site.contact_us')</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <div class="row">


            </div><!--end of row -->

        </div><!--end of container-->


    </section>

@endsection
