@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('label.delete') . ' ' . $menu }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route($route.'.destroy', $data->id) }}">
                            <div class="row">
                                @method('DELETE')
                                @include($view.'.show')
                                <div class="col-lg-12">
                                    <center>
                                        <button type="submit" class="btn btn-danger">{!! __('icon.destroy') !!}</button>
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
