@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.products') <small>({{ $products->total() }})</small></h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item">@lang('site.products')</li>
            </ul>
        </div>

        <div class="tile">
            <div class="tile-body m-0">

                <section class="content-header">
                    <form action="" method="GET">

                        <div class="row">

                            <div class="col-12 mb-2 mb-md-0 col-md-4">
                                <input type="text" name="search" class="form-control"
                                       placeholder="@lang('site.search')"
                                       value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4 d-flex mb-2 mb-md-0 px-md-0">

                                <select name="category_id" value="" class="form-control mr-1">

                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected':'' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                                <select name="supplier_id" value="" class="form-control">

                                    <option value="">@lang('site.all_suppliers')</option>
                                    @foreach ($suppliers as $supplier)
                                        <option
                                            value="{{ $supplier->id }}" {{ request()->supplier_id == $supplier->id ? 'selected':'' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-4 d-flex justify-content-between">

                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-search"></i>@lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_products'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>@lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i
                                            class="fa fa-plus"></i>@lang('site.add')</a>
                                @endif

                            </div>

                        </div>

                    </form>
                </section>

                <section class="content my-2">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h5 class="box-title text-capitalize"
                                style="margin-bottom: 15px">@lang('site.products')</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if ($products->count() > 0)

                                <div class="table-responsive">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>@lang('site.name')</th>
                                            <th>@lang('site.description')</th>
                                            <th>@lang('site.category')</th>
                                            <th>@lang('site.supplier')</th>
                                            <th>@lang('site.image')</th>
                                            <th>@lang('site.purchase_price')</th>
                                            <th>@lang('site.sale_price')</th>
                                            <th>@lang('site.profit_percent') %</th>
                                            <th>@lang('site.stock')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($products as $index=>$product)

                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{!! $product->description !!}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->supplier->name }}</td>
                                                <td><img src="{{ $product->image_path }}" style="width: 100px"
                                                         class="img-thumbnail"></td>
                                                <td>{{ $product->purchase_price }}</td>
                                                <td>{{ $product->sale_price }}</td>
                                                <td>{{ $product->profit_percent }} %</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (auth()->user()->hasPermission('update_products'))
                                                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                               class="btn btn-info btn-sm mx-1"><i
                                                                    class="fa fa-edit"></i>@lang('site.edit')</a>
                                                        @else
                                                            <a href="#" class="btn btn-info btn-sm mx-1 disabled"><i
                                                                    class="fa fa-edit"></i>@lang('site.edit')</a>
                                                        @endif

                                                        @if (auth()->user()->hasPermission('delete_products'))
                                                            <form
                                                                action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                                method="POST" style="display: inline">
                                                                {{ csrf_field() }}
                                                                {{ method_field('delete') }}
                                                                <button type="submit"
                                                                        class="btn btn-danger delete btn-sm">
                                                                    <i class="fa fa-trash"></i>@lang('site.delete')
                                                                </button>
                                                            </form>
                                                        @else

                                                            <button class="btn btn-danger btn-sm disabled"><i
                                                                    class="fa fa-trash"></i>@lang('site.delete')
                                                            </button>

                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                    {{ $products->appends(request()->query())->links() }}

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


    </main>



@endsection
