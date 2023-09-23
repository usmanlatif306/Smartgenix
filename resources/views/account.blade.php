@extends('layouts.app')

@section('content')
    <div class="container page-container">
        <div class="row justify-content-center">
            {{-- account fields --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-genix text-white">
                        <h5 class="m-0 p-0">{{ trans('general.my_account') }}</h5>
                    </div>
                    <div class="card-body">
                        @include('partials.message')
                        {{-- @include('partials.errors') --}}

                        <form action="{{ route('company.account.update') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                @if ($is_garage)
                                    <div class="col-12 mt-2">
                                        <h4>{{ trans('general.company_information') }}</h4>
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <label for="company_name">{{ trans('general.company_name') }}</label>
                                        <input id="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror" type="text"
                                            name="company_name"
                                            value="{{ old('company_name', auth()->user()->company?->name) }}">
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <label for="company_address">{{ trans('general.company_address') }}</label>
                                        <input id="company_address"
                                            class="form-control @error('company_address') is-invalid @enderror"
                                            type="text" name="company_address"
                                            value="{{ old('company_address', auth()->user()->company?->address) }}">
                                        @error('company_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        @livewire('account-country')
                                    </div>

                                    <div class="form-group mb-2 col-md-6">
                                        <label for="company_telephone">{{ trans('general.company_telephone') }}</label>
                                        <input id="company_telephone"
                                            class="form-control @error('company_telephone') is-invalid @enderror"
                                            type="tel" name="company_telephone"
                                            value="{{ old('company_telephone', auth()->user()->company?->telephone) }}">
                                        @error('company_telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2 col-md-6">
                                        <label for="postcode">{{ trans('general.company_postcode') }}</label>
                                        <input id="postcode" class="form-control @error('postcode') is-invalid @enderror"
                                            type="text" name="postcode"
                                            value="{{ old('postcode', auth()->user()->company?->postcode) }}">
                                        @error('postcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="opening">{{ trans('general.company_opening') }}</label>
                                        <select id="opening" class="form-select @error('opening') is-invalid @enderror"
                                            wire:model="opening" name="opening">
                                            <option value="">{{ trans('general.company_opening') }}</option>
                                            @foreach (hours() as $key => $value)
                                                <option @selected(old('opening', auth()->user()->company?->opening) === $key) value="{{ $key }}">
                                                    {{ $value }}</option>
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
                                        <select id="closing" class="form-select @error('closing') is-invalid @enderror"
                                            wire:model="closing" name="closing">
                                            <option value="">{{ trans('general.company_closing') }}</option>
                                            @foreach (hours() as $key => $value)
                                                <option @selected(old('closing', auth()->user()->company?->closing) === $key) value="{{ $key }}">
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('closing')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="company_address">{{ trans('general.allowed_vehicles') }}</label>
                                        <div class="d-flex gap-5 flex-wrap mt-4">
                                            @foreach ($vehicles_list as $vehicle)
                                                <div class="mb-3">
                                                    <div class="mb-2 text-center">
                                                        <img src="{{ file_url($vehicle->image) }}"
                                                            alt="{{ $vehicle->name }}" class="img-circle-sm">
                                                    </div>
                                                    <div class="text-center">
                                                        <input type="checkbox" value="{{ $vehicle->name }}"
                                                            class="btn-check" id="{{ $vehicle->name }}" name="vehicles[]"
                                                            {{ in_array($vehicle->name, auth()->user()->setup?->vehicles) ? 'checked' : '' }}>
                                                        <label class="btn btn-sm btn-outline-genix"
                                                            for="{{ $vehicle->name }}">{{ $vehicle->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @error('vehicles')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-4 form-group mb-3">
                                        <label for="response"
                                            class="d-block">{{ trans('general.offer_type', ['type' => 'MOT']) }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_mot" id="mot_yes"
                                                value="yes" {{ auth()->user()->setup?->is_mot ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="mot_yes">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_mot" id="mot_no"
                                                value="no" {{ !auth()->user()->setup?->is_mot ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="mot_no">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 form-group mb-3">
                                        <label for="response"
                                            class="d-block">{{ trans('general.offer_type', ['type' => 'Service']) }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_services"
                                                id="service_yes" value="yes"
                                                {{ auth()->user()->setup?->is_services ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="service_yes">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_services"
                                                id="service_no" value="no"
                                                {{ !auth()->user()->setup?->is_services ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="service_no">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 form-group mb-3">
                                        <label for="response"
                                            class="d-block">{{ trans('general.offer_type', ['type' => 'Repairs']) }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_repairs"
                                                id="repair_yes" value="yes"
                                                {{ auth()->user()->setup?->is_repairs ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="repair_yes">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_repairs"
                                                id="repair_no" value="no"
                                                {{ !auth()->user()->setup?->is_repairs ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="repair_no">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 form-group mb-3">
                                        <label for="response"
                                            class="d-block">{{ trans('general.offer_type', ['type' => 'Recoveries']) }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_recovery"
                                                id="recovery_yes" value="yes"
                                                {{ auth()->user()->setup?->is_recovery ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="recovery_yes">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_recovery"
                                                id="recovery_no" value="no"
                                                {{ !auth()->user()->setup?->is_recovery ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="recovery_no">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 form-group mb-2">
                                        <label for="response"
                                            class="d-block mb-2">{{ trans('general.out_of_hour_response') }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="out_of_hour_response"
                                                id="yes" value="yes"
                                                {{ old('out_of_hour_response', auth()->user()->company?->out_of_hour_response) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="yes">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="out_of_hour_response"
                                                id="no" value="no"
                                                {{ old('out_of_hour_response', !auth()->user()->company?->out_of_hour_response) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="no">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                @endif


                                <div class="col-12 mt-2">
                                    <h4>{{ trans('general.user_information') }}</h4>
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label for="first_name">{{ trans('general.first_name') }}</label>
                                    <input id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                        type="text" name="first_name"
                                        value="{{ old('first_name', auth()->user()->first_name) }}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label for="last_name">{{ trans('general.last_name') }}</label>
                                    <input id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                        type="text" name="last_name"
                                        value="{{ old('last_name', auth()->user()->last_name) }}">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label for="email">{{ trans('general.email_address') }}</label>
                                    <input id="email" class="form-control @error('email') is-invalid @enderror"
                                        type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                        disabled>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label for="mobile">{{ trans('general.mobile_number') }}</label>
                                    <input id="mobile" class="form-control @error('mobile') is-invalid @enderror"
                                        type="tel" name="mobile"
                                        value="{{ old('mobile', auth()->user()->mobile) }}">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label for="telephone">{{ trans('general.telephone_number') }}</label>
                                    <input id="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                        type="phone" name="telephone"
                                        value="{{ old('telephone', auth()->user()->telephone) }}">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if ($is_garage)
                                    <div class="form-group mb-2 col-md-6">
                                        <label for="user_role">{{ trans('general.company_role') }}</label>
                                        <input id="user_role"
                                            class="form-control @error('user_role') is-invalid @enderror" type="text"
                                            name="user_role"
                                            value="{{ old('user_role', auth()->user()->company?->user_role) }}">
                                        @error('user_role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-12 mt-2">
                                    <h4>{{ trans('general.update_password') }}</h4>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group mb-2 col-md-6">
                                            <label for="password">{{ trans('general.password') }}</label>
                                            <input id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                type="password" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                            <small class="text-genix">{{ trans('general.password_keep') }}</small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-2 col-md-6">
                                            <label
                                                for="password_confirmation">{{ trans('general.confirm_password') }}</label>
                                            <input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-genix">{{ trans('general.update', ['type' => '']) }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
