@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('label.edit') . ' ' . $menu }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route($route.'.update', $data->id) }}" enctype="multipart/form-data">
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
                                        <label class="col-form-label">{{ __('label.username') }}</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                               placeholder="{{ __('label.username') }}" value="{{ old('username') ? old('username') : $data->username  }}">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <button type="submit" class="btn btn-primary">{!! __('icon.save') !!}</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('label.edit') . ' ' . __('label.password') }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route($route.'.password') }}">
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('label.password_old') }}</label>
                                        <input type="password" name="password_old" class="form-control @error('password_old') is-invalid @enderror"
                                               placeholder="{{ __('label.password_old') }}">
                                        @error('password_old')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('label.password_new') }}</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="{{ __('label.password_new') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('label.password_confirmation') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="{{ __('label.password_confirmation') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <button type="submit" class="btn btn-primary">{!! __('icon.save') !!}</button>
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

@push('styles')
    <style>
        .image-preview {
            border-radius: 100px;
            object-fit: cover;
            width: 200px;
            height: 200px;
        }
        .image-overlay {
            display: none;
            background-color: #000000;
            opacity: 0.5;
            position: absolute;
            width: 200px;
            height: 200px;
            top: 0;
            border-radius: 100px;
            font-size: 50px;
            align-items: center;
            justify-content: center;
        }
        .image-preview:hover ~ .image-overlay {
            display: flex;
        }
        .image-overlay:hover {
            display: flex;
        }
        .image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).on('click', '.image-wrapper', function () {
            $('.image-file').click();
        });

        $(document).on('change', '.image-file', function () {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
