@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    {!! __(setting('products')) !!}
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/car1.png') }}" class="img-fluid" alt="Heading 1" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- tabs start -->
    <section class="bg-white p-5">
        <div class="container pb-5">
            <div class="row pb-5">
                <div class="col-12 text-center">
                    <h2 class="mb-2 fw-semibold text-md">{{ __('general.all_product_heading') }}</h2>
                    <p class="lead">{{ __('general.all_product_sub_heading') }}</p>
                </div>
                <div class="col-12 mt-4 text-center d-flex gap-5 justify-content-center flex-wrap pb-5">
                    <a href="{{ route('products.independent') }}" class="text-genix text-decoration-none text-center">
                        <img src="{{ file_url(package_image('individual garage')) }}" alt="Independent Garage"
                            class="img-circle" loading="lazy">
                        <span class="d-block pt-2 fs-16 fw-semibold">{{ trans('general.independent_garage') }}</span>
                    </a>
                    <a href="{{ route('products.recovery') }}" class="text-genix text-decoration-none text-center">
                        <img src="{{ file_url(package_image('recovery')) }}" alt="Recovery garage" class="img-circle"
                            loading="lazy">
                        <span class="d-block pt-2 fs-16 fw-semibold">{{ trans('general.recovery_garage') }}</span>
                    </a>
                    <a href="{{ route('products.enterprise') }}" class="text-genix text-decoration-none text-center">
                        <img src="{{ file_url(package_image('enterprise')) }}" alt="Enterprise" class="img-circle"
                            loading="lazy">
                        <span class="d-block pt-2 fs-16 fw-semibold">{{ trans('general.enterprise') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- tabs end -->
@endsection
