@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('label.detail') . ' ' . $menu }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include($view.'.show')
                            <div class="col-lg-12">
                                <center>
                                    <a href="{{ route($route.'.index') }}" class="btn btn-default">{!! __('icon.back') !!}</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    @include($view.'.scripts')
@endpush
