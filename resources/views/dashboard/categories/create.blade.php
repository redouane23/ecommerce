@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.categories')</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{ route('dashboard.categories.index') }}">@lang('site.categories')</a>
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

                            <form action="{{ route('dashboard.categories.store') }}" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                <div class="form-group">

                                    <label>@lang('site.name')</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name') }}">

                                </div>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')
                                    </button>

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
