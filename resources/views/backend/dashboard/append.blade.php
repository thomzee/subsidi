<tr class="item-rows" data-id="{{ $data->id }}">
    <td>
        <input type="text" name="orders[{{$uuid}}][qty]" class="form-control mask-qty item-qty" placeholder="{{ __('label.qty') }}" value="1">
        <input type="hidden" name="orders[{{$uuid}}][product_id]" value="{{ $data->id }}">
    </td>
    <td>
        <select name="orders[{{$uuid}}][unit]" class="select2-unit item-unit form-control @error('unit') is-invalid @enderror" data-placeholder="{{ __('label.unit') }}">
            @foreach ($data->units()->get() as $unit)
                <option value="{{ $unit->unit_id }}" {{ old('unit') ? (old('unit') == $unit->unit_id ? 'selected' : '') : '' }}>{{ $unit->unit_name }}</option>
            @endforeach
        </select>
    </td>
    <td>{{ $data->name }}</td>
    <td><input type="text" name="orders[{{$uuid}}][price]" class="form-control mask-price item-price" placeholder="{{ __('label.price') }}" value="0"></td>
    <td><input type="text" name="orders[{{$uuid}}][sub_total]" class="form-control mask-price item-sub-total" placeholder="{{ __('label.sub_total') }}" value="0" readonly></td>
    <td><button class="btn btn-danger item-delete"><i class="fa fa-trash"></i></button></td>
</tr>
