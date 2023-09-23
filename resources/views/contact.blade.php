@extends('layouts.website')
@push('recaptcha')
    {!! RecaptchaV3::initJs() !!}
@endpush
@section('content')
    @php
        $billing = json_decode(setting('billing'), true);
        $sales = json_decode(setting('sales'), true);
        $offices = json_decode(setting('offices'), true);
    @endphp
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h2 class="text-lg text-white">{{ trans('general.how_can_we_help') }}</h2>
                    <div class="row mt-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="card">
                                <div class="card-body text-genix">
                                    <h4>{{ trans('general.billing_enquiry') }}</h4>
                                    <strong class="d-block">{{ $billing['days'] }}</strong>
                                    <span class="fw-semibold">{{ $billing['timings'] }}</span>
                                    <div class="border my-2 fw-semibold">
                                        <a href="mailto:{{ $billing['emial'] }}"
                                            class="text-genix text-decoration-none">{{ $billing['emial'] }}</a>
                                    </div>
                                    <span class="fw-semibold">{{ trans('general.tel') }}: {{ $billing['mobile'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-genix">
                                    <h4>{{ trans('general.sales_enquiry') }}</h4>
                                    <strong class="d-block">{{ $sales['days'] }}</strong>
                                    <span class="fw-semibold">{{ $sales['timings'] }}</span>
                                    <div class="border my-2 fw-semibold">
                                        <a href="mailto:{{ $sales['emial'] }}"
                                            class="text-genix text-decoration-none">{{ $sales['emial'] }}</a>
                                    </div>
                                    <span class="fw-semibold">{{ trans('general.tel') }}: {{ $sales['mobile'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- sending message start -->
    <section class="bg-white p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-5">
                    <h3 class="text-center mb-3">{{ trans('general.send_quick_message') }}</h3>
                    <form action="{{ route('message.save') }}" class="border rounded p-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="first_name">{{ trans('general.first_name') }}</label>
                                    <input id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                        type="text" name="first_name" placeholder="{{ trans('general.first_name') }}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="last_name">{{ trans('general.last_name') }}</label>
                                    <input id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                        type="text" name="last_name" placeholder="{{ trans('general.last_name') }}">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">{{ trans('general.email_address') }}</label>
                                    <input id="email" class="form-control @error('email') is-invalid @enderror"
                                        type="email" name="email" placeholder="{{ trans('general.email_address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="subject">{{ trans('general.subject') }}</label>
                                    <input id="subject" class="form-control @error('subject') is-invalid @enderror"
                                        type="text" name="subject" placeholder="{{ trans('general.subject') }}">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="message">{{ trans('general.message') }}</label>
                                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                                        placeholder="{{ trans('general.message_placeholder') }}" rows="3"></textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' is-invalid' : '' }}">
                                    <div class="col-md-6">
                                        {!! RecaptchaV3::field('register') !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="website">Recaptcha</label>
                                    <input id="website" class="form-control" type="url" name="website"
                                        placeholder="Website Url">
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <button class="btn btn-genix">{{ trans('general.send_enquiry') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 ps-0 ps-md-5">
                    <h3 class="mb-3">{{ trans('general.our_office') }}</h3>
                    @foreach ($offices as $office)
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <span class="d-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-building" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path
                                        d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                            </span>
                            <span>{{ $office['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- sending message end -->

    <!-- join section start -->
    <section class="p-5 shadow-sm">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 d-md-flex justify-content-md-between">
                    <h4 class="text-center">{{ trans('general.join_community') }}</h4>
                    <div class="d-flex gap-2 justify-content-center">
                        <a class="btn btn-sm btn-genix text-white me-2"
                            href="{{ route('pricing') }}">{{ __('general.view_packages') }}</a>
                        <a class="btn btn-sm btn-genix text-white"
                            href="{{ route('login') }}">{{ __('general.staff_demo') }}</a>
                        <a class="btn btn-sm btn-genix text-white"
                            href="http://users.smartgenix.co.uk/">{{ __('general.user_demo') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- join section start -->
@endsection
