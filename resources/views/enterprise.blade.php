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
    <section class="bg-white p-5">
        <div class="container">
            <div class="row">

                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4">{{ trans('general.how_offer_you') }}</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_as_company') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title">{{ __($feature->title) }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4">{{ trans('general.how_offer_your_garage') }}</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_you') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title">{{ __($feature->title) }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4">{{ trans('general.how_offer_your_customer') }}</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_customers') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title">{{ __($feature->title) }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ __($feature->description) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- pricing --}}
                <div class="col-12 mt-2 mb-5 text-center">
                    <h3 class="mb-4">{{ trans('general.pricing') }}</h3>
                    <p>{{ trans('general.pricing_depend') }}</p>
                    <a href="#" class="btn btn-sm btn-genix mb-2">{!! trans('general.contact_quote') !!}</a>
                    <p>{{ trans('general.will_ask') }}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- tabs end -->
@endsection
