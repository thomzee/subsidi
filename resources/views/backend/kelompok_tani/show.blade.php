<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.name') }}</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               placeholder="{{ __('label.name') }}" value="{{ old('name') ? old('name') : $data->name  }}" disabled>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
