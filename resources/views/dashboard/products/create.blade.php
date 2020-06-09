@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.products')</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{ route('dashboard.products.index') }}">@lang('site.products')</a>
                </li>
                <li class="breadcrumb-item">@lang('site.add')</li>
            </ul>
        </div>

        <div class="tile">
            <div class="tile-body m-0">

                <section class="content">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title">@lang('site.add')</h3>
                        </div>

                        <div class="box-body">

                            @include('partials._errors')

                            <form action="{{ route('dashboard.products.store') }}" method="POST"
                                  enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="container p-0">

                                    <div class="row">

                                        <div class="form-group col-md-6">

                                            <label>@lang('site.category')</label>
                                            <select name="category_id" value="" class="form-control">

                                                <option value="">@lang('site.all_categories')</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':'' }} >
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label>@lang('site.supplier')</label>
                                            <select name="supplier_id" value="" class="form-control">

                                                <option value="">@lang('site.all_suppliers')</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option
                                                        value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected':'' }} >
                                                        {{ $supplier->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">

                                    <label>@lang('site.name')</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name') }}">

                                </div>

                                <div class="container p-0">

                                    <div class="row">

                                        <div class="form-group col-md-4">

                                            <label>@lang('site.purchase_price')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">DZD</span></div>
                                                <input type="number" step="0.01" name="purchase_price"
                                                       class="form-control"
                                                       placeholder="@lang('site.amount')"
                                                       value="{{ old('purchase_price') }}">
                                                <div class="input-group-append"><span
                                                        class="input-group-text">.00</span></div>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-4">

                                            <label>@lang('site.sale_price')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">DZD</span></div>
                                                <input type="number" step="0.01" name="sale_price" class="form-control"
                                                       placeholder="@lang('site.amount')"
                                                       value="{{ old('sale_price') }}">
                                                <div class="input-group-append"><span
                                                        class="input-group-text">.00</span></div>
                                            </div>


                                        </div>

                                        {{--                                        <div class="form-group col-md-4">--}}

                                        {{--                                            <label>@lang('site.stock')</label>--}}
                                        {{--                                            <div class="input-group">--}}
                                        {{--                                                <div class="input-group-prepend"><span--}}
                                        {{--                                                        class="input-group-text"></span></div>--}}
                                        {{--                                                <input type="number" name="stock" class="form-control"--}}
                                        {{--                                                       placeholder="@lang('site.quantity')" value="{{ old('stock') }}">--}}
                                        {{--                                                <div class="input-group-append"><span--}}
                                        {{--                                                        class="input-group-text"></span></div>--}}
                                        {{--                                            </div>--}}

                                        {{--                                        </div>--}}

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image">

                                </div>

                                <div class="form-group">

                                    <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px"
                                         class="img-thumbnail image-preview">

                                </div>

                                <div class="form-group">

                                    <label>@lang('site.description')</label>
                                    <textarea name="description"
                                              class="form-control ckeditor">{{ old('description') }}</textarea>

                                </div>


                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')</button>

                                </div>

                            </form>

                        </div>


                    </div>
                    <!-- /.box -->
                </section>

            </div>
        </div>


    </main>


@endsection
