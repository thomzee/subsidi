@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('label.edit') . ' ' . $menu }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route($route.'.update', $data->id) }}">
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('label.name') }}</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               placeholder="{{ __('label.name') }}" value="{{ old('name') ? old('name') : $data->name  }}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! $menuRoles !!}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <button type="submit" class="btn btn-primary">{!! __('icon.save') !!}</button>
                                        <a href="{{ route($route.'.index') }}" class="btn btn-default">{!! __('icon.back') !!}</a>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    @include($view.'.scripts')
@endpush
