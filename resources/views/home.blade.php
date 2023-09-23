@extends('layouts.website')
@push('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
@endpush
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        @php
            $slides = json_decode(setting('slides'), true);
        @endphp
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($slides as $slide)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                            aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($slides as $slide)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 style="font-size: 2.5rem !important;line-height: 1.5 !important;">
                                        {{ __($slide['heading']) }}</h4>
                                    <p class="">{{ __($slide['description']) }}</p>
                                    <div class="">
                                        @if ($slide['button_1_text'] && $slide['button_1_url'])
                                            <a href="{{ $slide['button_1_url'] }}"
                                                class="btn btn-sm btn-outline-secondary text-white">{{ __($slide['button_1_text']) }}</a>
                                        @endif
                                        @if ($slide['button_2_text'] && $slide['button_2_url'])
                                            <a href="{{ $slide['button_2_url'] }}"
                                                class="btn btn-sm btn-outline-secondary text-white">{{ __($slide['button_2_text']) }}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ file_url($slide['image']) }}" class="img-fluid"
                                        alt="{{ $slide['heading'] }}" loading="lazy">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- Feagure start -->
    <section class="pt-4 pb-5 px-5">
        <div class="container">
            <!-- feagures and benefits -->
            <h2 class="text-center mb-2 fw-semibold text-md">{{ __(setting('figure_heading')) }}</h2>
            <h6 class="text-center mb-4 fw-semibold">{{ __(setting('figure_sub_heading')) }}</h6>
            <div class="row justify-content-center">
                @foreach ($data['feagures'] as $feagure => $value)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-2">
                        <div class="card card-hover border-0 bg-genix shadow-sm text-white equal-height">
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <h5 class="text-xs card-title">{!! __($feagure) !!}</h5>
                                <p class="card-text fw-bold text-md">{{ $value }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feagure end -->

    <!---- Benefits we offer start ---->
    <section class="p-5 pb-4 bg-genix text-white">
        <div class="container">
            <h2 class="text-center mb-4 fw-semibold text-white">{{ __(setting('benefit_heading')) }}</h2>
            <p class="card-text fs-14">{{ __(setting('benifit_content')) }}</p>
            <span class="text-center d-block fs-20">{{ trans('general.keep_scrolling') }}</span>
            <a href="#features" class="text-center d-block fs-25 text-white text-decoration-none"><i
                    class="bi bi-arrow-down-circle"></i></a>
        </div>
    </section>
    <!---- Benefits we offer end ---->


    <!-- Features start -->
    <section class="pt-4 pb-5 px-5" id="features">
        <div class="container">
            <div class="row mt-4">
                @foreach ($data['products'] as $product)
                    <div class="col-md-12 mb-2">
                        <div class="center-between mb-3">
                            <span class="fw-semibold text-md text-genix">{{ __($product['name']) }}</span>
                            <a href="{{ route('products.' . $product['route']) }}"
                                class="text-genix text-xs text-decoration-none view-more center">
                                <span>{{ __(trans('general.view_more')) }}</span>
                                <i class="bi bi-arrow-right-short fs-22"></i>
                            </a>
                        </div>
                        <div class="row">
                            @foreach ($product['features'] as $feature)
                                <div class="col-sm-6 col-md-3 mb-3">
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
                @endforeach

            </div>
        </div>
    </section>
    <!-- Features end -->

    <!-- Feature section start -->
    {{-- <section class="p-5">
        <div class="container">
            <!-- for garage -->
            <h2 class="text-md text-center mb-4">Your Garage</h2>
            <div class="row">
                @foreach ($data['your_features'] as $feature)
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <div class="card border-0 shadow-sm bg-transparent">
                            <div class="card-body">
                                <h5 class="text-sm card-title">{{ $feature->title }}</h5>
                                <p class="card-text fs-14">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="text-center mt-3 mb-5">
                <a href="{{ route('features') }}" class="btn btn-sm btn-genix">See More Features</a>
            </div>
            <!-- for customer -->
            <h2 class="text-md text-center mb-4">Your Customers</h2>
            <div class="row">
                @foreach ($data['customer_features'] as $feature)
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <div class="card border-0 shadow-sm bg-transparent">
                            <div class="card-body">
                                <h5 class="text-sm card-title">{{ $feature->title }}</h5>
                                <p class="card-text fs-14">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center my-3">
                <a href="{{ route('features') }}" class="btn btn-sm btn-genix">See More Features</a>
            </div>
        </div>
    </section> --}}
    <!-- Feature section end -->

    <!-- trusted clients start -->
    <section class="p-5 bg-genix text-white">
        <div class="container">
            <h2 class="text-center mb-4 text-white">{{ __(setting('trusted_heading')) }}</h2>
            <div class="row">
                <section class="logo-carousel slider" data-arrows="true">
                    @foreach (json_decode(setting('trusted-garages'), true) as $image)
                        <div class="slide"><img src="{{ file_url($image) }}" alt="Trusted Garage" loading="lazy">
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </section>
    <!-- trusted clients end -->

    <!-- faqs section -->
    <section class="bg-white p-5">
        <div class="container">
            <h2 class="text-md text-center mb-4">{{ trans('general.faqs') }}</h2>
            <div class="row">
                <div class="col-12">
                    <!-- faqs start -->
                    @foreach ($data['faqs'] as $name => $faqs)
                        @if (count($faqs) > 0)
                            <h4
                                class="bg-genix p-1 text-white rounded-1 ps-2 @if ($name !== 'General') mt-4 @endif">
                                {{ $name }}</h4>
                            <div class="accordion" id="accordionExample">
                                @foreach ($faqs as $faq)
                                    <div class="accordion-item">
                                        <h5 class="accordion-header" id="heading{{ $faq->id }}">
                                            <button class="accordion-button collapsed shadow-none bg-white" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                                aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                                {{ __($faq->question) }}
                                            </button>
                                        </h5>
                                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $faq->id }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body bg-white">
                                                {{ __($faq->answer) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                    <!--faqs end -->
                </div>
            </div>
        </div>
    </section>
    <!-- faqs section end -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // window.navigator.geolocation.getCurrentPosition((position) => {
            //     console.log(position.coords.latitude);
            // });
            $('.logo-carousel').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
                arrows: true,
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        });
    </script>
@endpush
