<div class="row">
    <div class="col-md-6 form-group mb-3">
        <label for="country">{{ trans('general.country') }}</label>
        <select class="form-select @error('country') is-invalid @enderror" wire:model="country" name="country">
            <option value="">{{ trans('general.select_country') }}</option>
            @foreach ($countries as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6 form-group mb-3">
        <label for="city">{{ trans('general.city') }}</label>
        <select id="" class="form-select @error('city') is-invalid @enderror" wire:model="city"
            {{ !$is_country ? 'disabled' : '' }} name="city">
            <option value="">{{ trans('general.select_city') }}</option>
            @foreach ($cities as $city)
                <option value="{{ $city->name }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
