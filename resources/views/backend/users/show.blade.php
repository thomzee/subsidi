<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.username') }}</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
               placeholder="{{ __('label.username') }}" value="{{ old('username') ? old('username') : $data->username  }}" disabled>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.name') }}</label>
        <input type="text" class="form-control"
               placeholder="{{ __('label.name') }}" value="{{ $data->name  }}" disabled>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.role') }}</label>
        <select name="role" class="select2 form-control" data-placeholder="{{ __('label.role') }}" disabled>
            <option></option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role') ? (old('role') == $role->id ? 'selected' : '') : ($role->id == $data->roles()->first()->id ? 'selected' : '') }}>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.status') }}</label>
        <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} class="bs-toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" disabled>
    </div>
</div>

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
        .image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
