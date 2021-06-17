<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.name') }}</label>
        <input type="text" class="form-control"
               placeholder="{{ __('label.name') }}" value="{{ $data->name  }}" disabled>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        <label class="col-form-label">{{ __('label.slug') }}</label>
        <input type="text" class="form-control"
               placeholder="{{ __('label.slug') }}" value="{{ $data->slug  }}" disabled>
    </div>
</div>
<div class="col-lg-12">
    <div class="form-group">
        {!! $menuRoles !!}
    </div>
</div>
