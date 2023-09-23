@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    {!! __(setting(request()->segment(2))) !!}
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/car1.png') }}" class="img-fluid" alt="Heading 1">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- tabs start -->
    <section class="p-5 pb-4">
        <div class="container">
            <h2 class="text-center mb-4 text-lg">{{ __($type) }} {{ trans('general.package') }}</h2>
            <div class="row">
                @if ($type !== 'enterprise')
                    <div class="col-12 text-center mb-3">
                        <a href="{{ route('register', ['package' => $type]) }}"
                            class="btn btn-genix">{{ trans('general.sign_up_now') }}</a>
                    </div>
                @endif

                @if ($type === 'enterprise')
                    <div class="col-12 mt-2 mb-5">
                        <h3 class="mb-4 fw-semibold text-start text-genix">{{ __('general.benefit_customer_heading') }}
                        </h3>

                        <div class="row">
                            @foreach ($features->where('category', 'benefits_as_company') as $feature)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card card-hover border-0 shadow-sm bg-transparent  equal-height">
                                        <div class="card-body">
                                            <h5 class="text-sm card-title fw-semibold">{{ __($feature->title) }}</h5>
                                            <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-12 mt-2 mb-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="mb-4 fw-semibold text-start text-genix">{{ __('general.benefit_you_heading') }}</h3>
                        <a href="{{ route('services') }}" class="text-genix">{{ __('general.what_company_offers') }}</a>
                    </div>

                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_you') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card card-hover border-0 shadow-sm bg-transparent equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title fw-semibold">{{ __($feature->title) }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4 fw-semibold text-start text-genix">{{ __('general.benefit_customer') }}</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_customers') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card card-hover border-0 shadow-sm bg-transparent equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title fw-semibold">{{ __($feature->title) }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- tabs end -->

    <section class="pb-5">
        <div class="container">
            <h2 class="text-center fw-semibold">{{ __('general.product_pricing_heading') }}</h2>
            <h6 class="text-center text-genix mb-4 fw-semibold @if ($type !== 'enterprise') mb-5 @else mb-1 @endif">
                {{ __('general.product_pricing_sub_heading') }}
            </h6>
            <div class="row justify-content-center">
                @if ($type !== 'enterprise')
                    <div class="col-md-6 col-lg-3 mb-3 mb-md-0 pricing">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">
                                    {{ request()->segment(2) === 'independent' ? trans('general.independent') : trans('general.recovery') }}
                                    {{ trans('general.package') }}</h5>
                                <h6 class="card-price text-center">
                                    {{ setting('currency_symbol') }}{{ convert_price($package->total, true) }}<span
                                        class="period">/{{ trans('general.month') }}</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    @foreach ($package->specifications as $item)
                                        <li><span class="fa-li"><i class="fas fa-check"></i></span>{{ __($item) }}
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="d-grid mt-4">
                                    <a href="{{ route('register', ['package' => $type]) }}"
                                        class="btn btn-genix text-uppercase">{{ trans('general.sign_up_now') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-3 mb-md-0 pricing">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center opacity-0">
                                    {{ trans('general.addons') }}</h5>
                                <h6 class="card-price text-center">{{ trans('general.addons') }}</h6>
                                <hr>
                                <ul class="fa-ul">
                                    @foreach ($package->addons as $item)
                                        <li><span class="fa-li"><i class="fas fa-check"></i></span>{{ __($item) }}
                                        </li>
                                    @endforeach
                                </ul>
                                <small>{{ trans('general.require_addon') }}</small>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 mt-2 mb-5 text-center">
                        {{-- <h3 class="mb-4">Pricing</h3> --}}
                        <p class="lead fw-semibold">{{ trans('general.pricing_depend') }}</p>
                        <button class="btn btn-sm btn-genix mb-2" data-bs-toggle="modal"
                            data-bs-target="#enterpriseModel">{!! trans('general.contact_quote') !!}</button>
                        <p>{{ trans('general.will_ask') }}</p>
                    </div>
                    @include('partials.enterprise')
                @endif
            </div>
        </div>
    </section>
@endsection
