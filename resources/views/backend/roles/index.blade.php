@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $menu . ' ' . __('label.table') }}</h6>
                            </div>
{{--                            @if(check_access('create', $slug))--}}
{{--                            <div class="col-md-6">--}}
{{--                                <a href="{{ route($route.'.create') }}" class="btn btn-primary float-right">{!! __('icon.create') !!}</a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                    <div class="card-body">
                        @include($view.'.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    @include($view.'.scripts')
@endpush
