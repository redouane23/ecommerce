@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.suppliers') <small>({{ $suppliers->total() }})</small></h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item">@lang('site.suppliers')</li>
            </ul>
        </div>

        <div class="tile">
            <div class="tile-body m-0">

                <section class="content-header">
                    <form action="" method="GET">

                        <div class="row">

                            <div class="col-12 mb-2 mb-md-0 col-md-6">
                                <input type="text" name="search" class="form-control"
                                       placeholder="@lang('site.search')"
                                       value="{{ request()->search }}">
                            </div>

                            <div class="col-md-6 d-flex justify-content-between">

                                <button type="submit" class="btn btn-primary"><i
                                        class="fa fa-search"></i>@lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_suppliers'))
                                    <a href="{{ route('dashboard.suppliers.create') }}" class="btn btn-primary"><i
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
                                style="margin-bottom: 15px">@lang('site.suppliers')</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if ($suppliers->count() > 0)

                                <div class="table-responsive">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>@lang('site.name')</th>
                                            <th>@lang('site.phone')</th>
                                            <th>@lang('site.address')</th>
                                            <th>@lang('site.related_products')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($suppliers as $index=>$supplier)

                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $supplier->name }}</td>
                                                {{--                                                <td>{{ implode(array_filter($supplier->phone),'-') }}</td>--}}
                                                <td>{{ $supplier->phone[0] }}</td>
                                                <td>{!! $supplier->address !!}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.products.index', ['supplier_id' => $supplier->id]) }}"
                                                       class="btn btn-info btn-sm">@lang('site.related_products')</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex">

                                                        @if (auth()->user()->hasPermission('update_suppliers'))
                                                            <a href="{{ route('dashboard.suppliers.edit', $supplier->id) }}"
                                                               class="btn btn-warning btn-sm mx-1"><i
                                                                    class="fa fa-edit"></i>@lang('site.edit')</a>
                                                        @else
                                                            <a href="#" class="btn btn-warning btn-sm mx-1 disabled"><i
                                                                    class="fa fa-edit"></i>@lang('site.edit')</a>
                                                        @endif

                                                        @if (auth()->user()->hasPermission('delete_suppliers'))
                                                            <form
                                                                action="{{ route('dashboard.suppliers.destroy', $supplier->id) }}"
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

                                    {{ $suppliers->appends(request()->query())->links() }}

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
