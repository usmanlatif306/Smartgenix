@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="text-capitalize text-md">{{ trans('general.features') }}</h1>
                    <p>{!! __(setting('features')) !!}</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/car1.png') }}" class="img-fluid" alt="Heading 1">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- Feature section start -->
    <section class="p-5">
        <div class="container">
            <!-- for garage -->
            <h2 class="text-center mb-4 text-md">{{ trans('general.your_garage') }}</h2>
            <div class="row pb-4">
                @foreach ($data['your_features'] as $feature)
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <div class="card border-0 shadow-sm bg-transparent">
                            <div class="card-body">
                                <h5 class="text-sm card-title">{{ __($feature->title) }}</h5>
                                <p class="card-text fs-14">{{ __($feature->description) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center mt-4">
                    <a href="{{ route('pricing') }}" class="btn btn-sm btn-genix">{{ trans('general.view_pricing') }}</a>
                </div>
            </div>
            <!-- for customer -->
            <h2 class="text-center my-4 text-md">{{ trans('general.your_customer') }}</h2>
            <div class="row pb-4">
                @foreach ($data['customer_features'] as $feature)
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <div class="card border-0 shadow-sm bg-transparent">
                            <div class="card-body">
                                <h5 class="text-sm card-title">{{ __($feature->title) }}</h5>
                                <p class="card-text fs-14">{{ __($feature->description) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center mt-4">
                    <a href="{{ route('pricing') }}" class="btn btn-sm btn-genix">{{ trans('general.view_pricing') }}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature section end -->
@endsection
