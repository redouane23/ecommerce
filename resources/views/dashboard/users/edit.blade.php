@extends('layouts.dashboard.app')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="text-capitalize">@lang('site.users')</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"><a
                            href="{{ route('dashboard.welcome') }}">@lang('site.dashboard')</a></i>
                </li>
                <li class="breadcrumb-item"><a
                        href="{{ route('dashboard.users.index') }}">@lang('site.users')</a>
                </li>
                <li class="breadcrumb-item">@lang('site.edit')</li>
            </ul>
        </div>

        <div class="tile">
            <div class="tile-body m-0">

                <section class="content">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title">@lang('site.edit')</h3>
                        </div>

                        <div class="box-body">

                            @include('partials._errors')

                            <form action="{{ route('dashboard.users.update',$user->id) }}" method="POST"
                                  enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                <div class="container p-0">

                                    <div class="row">

                                        <div class="form-group col-md-6">

                                            <label>@lang('site.first_name')</label>
                                            <input type="text" name="first_name" class="form-control"
                                                   value="{{ $user->first_name }}">

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label>@lang('site.last_name')</label>
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ $user->last_name }}">

                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label>@lang('site.email')</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">

                                </div>

                                <div class="form-group">

                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image">

                                </div>

                                <div class="form-group">

                                    {{--                                    <img src="{{ $user->image_path }}" style="width: 100px"--}}
                                    {{--                                         class="img-thumbnail image-preview">--}}

                                    <img src="{{ URL::to('/') }}/uploads/user_images/{{ $user->image }}"
                                         style="width: 100px"
                                         class="img-thumbnail image-preview">

                                </div>

                                <div class="form-group">
                                    <label>@lang('site.permissions')</label>
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">

                                        @php

                                            $models = ['users','categories','products','clients','orders'];
                                            $maps = ['create','read','update','delete'];

                                        @endphp


                                        <ul class="nav nav-tabs text-capitalize mb-2">

                                            @foreach ($models as $index=>$model)
                                                <li class="nav-item {{$index == 0 ? 'active' : ''}}"><a
                                                        class="nav-link {{$index == 0 ? 'active' : ''}}"
                                                        href="#{{$model}}"
                                                        data-toggle="tab">@lang('site.'.$model)</a>
                                                </li>
                                            @endforeach


                                        </ul>
                                        <div class="tab-content">

                                            @foreach ($models as $index=>$model)

                                                <div class="tab-pane fade {{$index == 0 ? 'active show' : ''}}"
                                                     id="{{ $model }}">

                                                    <div class="animated-checkbox">
                                                        @foreach ($maps as $index=>$map)
                                                            <label class="mr-2"><input type="checkbox"
                                                                                       name="permissions[]"

                                                                                       {{ $user->hasPermission($map.'_'.$model) ? 'checked' : '' }} value="{{ $map .'_'. $model }}"><span
                                                                    class="label-text">@lang('site.'.$map)</span>
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>

                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-edit"></i> @lang('site.edit')
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
