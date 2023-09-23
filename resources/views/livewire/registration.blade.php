<div class="row">
    @php
        $currency = setting('currency_symbol');
    @endphp
    @if (session('invalidAddress'))
        <div class="alert alert-danger" role="alert">
            {{ session('invalidAddress') }}
        </div>
    @endif
    @if ($step === 'company')
        <div class="form-group mb-3">
            <h5 class="">{{ trans('general.choose_package') }}</h5>
            <div class="mt-2">
                @foreach ($packages as $item)
                    <input type="radio" name="package" class="btn-check" value="{{ $item->id }}"
                        id="{{ $item->name }}" wire:model="package" autocomplete="off">
                    <label class="btn btn-outline-genix" for="{{ $item->name }}">{{ $item->name }} <br />
                        {{ $currency }}{{ convert_price($item->price + $item->setup_fee) }}
                    </label>
                @endforeach
            </div>
        </div>


        {{-- company information --}}
        <div class="col-md-12 pt-2">
            <h5 class="fw-semibold">{{ trans('general.tell_us_about_company') }}</h5>
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="company_name">{{ trans('general.company_name') }}</label>
            <input id="" class="form-control @error('company_name') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.company_name') }}" wire:model="company_name"
                value="{{ old('company_name') }}">
            @error('company_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="company_address">{{ trans('general.company_address') }}</label>
            <input class="form-control @error('company_address') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.company_address') }}" wire:model="company_address"
                value="{{ old('company_address') }}">
            @error('company_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="country">{{ trans('general.country') }}</label>
            <select class="form-select @error('country') is-invalid @enderror" wire:model="country">
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
                {{ !$is_country ? 'disabled' : '' }}>
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
        <div class="col-md-6 form-group mb-3">
            <label for="company_postcode">{{ trans('general.company_postcode') }}</label>
            <input id="" class="form-control @error('company_postcode') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.company_postcode') }}" wire:model="company_postcode"
                value="{{ old('company_postcode') }}">
            @error('company_postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="company_telephone">{{ trans('general.company_telephone') }}</label>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ $is_country ? $selectedCountry->code : '-' }}</span>
                <input id="" class="form-control @error('company_telephone') is-invalid @enderror"
                    type="number" placeholder="{{ trans('general.company_telephone') }}"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="13" minlength="4" wire:model="company_telephone"
                    value="{{ old('company_telephone') }}">
                @error('company_telephone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="opening">{{ trans('general.company_opening') }}</label>
            <select id="opening" class="form-control @error('opening') is-invalid @enderror" wire:model="opening">
                <option value="">{{ trans('general.company_opening') }}</option>
                @foreach (hours() as $key => $value)
                    <option @selected(old('opening') === $key) value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('opening')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="closing">{{ trans('general.company_closing') }}</label>
            <select id="closing" class="form-control @error('closing') is-invalid @enderror" wire:model="closing">
                <option value="">{{ trans('general.company_closing') }}</option>
                @foreach (hours() as $key => $value)
                    <option @selected(old('closing') === $key) value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('closing')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6 form-group mb-3">
            <label for="response" class="d-block">{{ trans('general.out_of_hour_response') }}</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="out_of_hour_response" id="yes"
                    value="yes" wire:model="out_of_hour_response">
                <label class="form-check-label" for="yes">{{ trans('general.yes') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="out_of_hour_response" id="no"
                    value="no" wire:model="out_of_hour_response">
                <label class="form-check-label" for="no">{{ trans('general.no') }}</label>
            </div>
        </div>
    @elseif ($step === 'about')
        {{-- user information  --}}
        <div class="col-md-12 pt-2">
            <h5 class="fw-semibold">{{ trans('general.tell_us_about_you') }}</h5>
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="first_name">{{ trans('general.first_name') }}</label>
            <input id="" class="form-control @error('first_name') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.first_name') }}" wire:model="first_name"
                value="{{ old('first_name') }}">
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="last_name">{{ trans('general.last_name') }}</label>
            <input id="" class="form-control @error('last_name') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.last_name') }}" wire:model="last_name"
                value="{{ old('last_name') }}">
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="telephone">{{ trans('general.telephone_number') }}</label>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ $is_country ? $selectedCountry->code : '-' }}</span>
                <input id="" class="form-control @error('telephone') is-invalid @enderror" type="number"
                    placeholder="{{ trans('general.telephone_number') }}"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="13" minlength="4" wire:model="telephone" value="{{ old('telephone') }}">
                @error('telephone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="col-md-6 form-group">
            <label for="mobile">{{ trans('general.mobile_number') }}</label>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ $is_country ? $selectedCountry->code : '-' }}</span>
                <input id="" class="form-control @error('mobile') is-invalid @enderror" type="number"
                    placeholder="{{ trans('general.mobile_number') }}"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="13" minlength="4" wire:model="mobile" value="{{ old('mobile') }}">
                @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="role">{{ trans('general.company_role') }}</label>
            <input id="" class="form-control @error('role') is-invalid @enderror" type="text"
                placeholder="{{ trans('general.company_role') }}" wire:model="role" value="{{ old('role') }}">
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @elseif ($step === 'last')
        {{-- create an account  --}}
        <div class="col-md-12 pt-2">
            <h5 class="fw-semibold">{{ trans('general.create_account') }}</h5>
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="email">{{ trans('general.email_address') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                name="email" placeholder="{{ trans('general.email_address') }}" value="{{ old('email') }}"
                wire:model="email" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="password">{{ trans('general.password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                wire:model="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 form-group mb-3">
            <label for="password_confirmation">{{ trans('general.confirm_password') }}</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                wire:model="password_confirmation">
        </div>
    @endif

    <div class="col-12 text-center mt-5">
        <span id="totalPrice" class="d-none"
            data-price="{{ convert_price($selected->price + $selected->setup_fee) }}">{{ trans('general.total_amount') }}:
            {{ $currency }}{{ convert_price($selected->price + $selected->setup_fee) }}</span>
        @if ($step !== 'company')
            <button type="button" class="btn btn-genix me-3" wire:click="backStep" wire:loading.attr="disabled"
                wire:target="validateInputs" {{ $disable ? 'disabled' : '' }}>{{ __('Back') }}</button>
        @endif
        <button type="button" class="btn btn-genix" wire:click="validateInputs" wire:loading.attr="disabled"
            {{ $disable ? 'disabled' : '' }}>{{ $step === 'company' ? __('general.add_personal_info') : ($step === 'last' ? __('general.continue_payment') : __('general.add_email')) }}</button>
    </div>
</div>
