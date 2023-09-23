@extends('layouts.website')
@push('styles')
    <style>
        .card {
            border: none;
            padding: 10px 20px;
        }

        .card::after {
            position: absolute;
            z-index: -1;
            opacity: 0;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card:hover {
            transform: scale(1.02, 1.02);
            -webkit-transform: scale(1.02, 1.02);
            backface-visibility: hidden;
            will-change: transform;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .75) !important;
        }

        .card:hover::after {
            opacity: 1;
        }

        .card:hover .btn-outline-primary {
            color: white;
            background: #007bff;
        }
    </style>
@endpush
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    <p>{!! __(setting('pricing')) !!}</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/car1.png') }}" class="img-fluid" alt="Heading 1">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- tabs start -->
    <section class="bg-white p-md-5">
        <div class="container">
            <h2 class="text-center mb-4 text-lg">{{ trans('general.packages') }}</h2>
            <p class="text-center p-0 m-0 text-sm">{{ trans('general.packages_below') }}</p>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="row p-md-5">
                        @foreach ($packages as $package)
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <div class="card h-100 shadow-lg">
                                    <div class="card-body p-3" style="flex:0 1 auto;">
                                        <h5 class="card-title m-0 text-center">{{ __($package->name) }}</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($package->specifications as $item)
                                            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-check"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                </svg> {{ __($item) }}</li>
                                        @endforeach
                                    </ul>
                                    @if ($package->name !== 'Enterprise')
                                        <div class="text-center p-3">
                                            <span
                                                class="h2">{{ setting('currency_symbol') }}{{ convert_price($package->price, true) }}</span>/{{ trans('general.month') }}

                                        </div>
                                        <div class="card-body text-center d-flex align-items-end justify-content-center">
                                            <a href="{{ route('register', ['package' => $package->name]) }}"
                                                class="btn btn-genix"
                                                style="border-radius:30px">{{ trans('general.buy_now') }}</a>
                                        </div>
                                        <span class="d-block pt-1 pb-2 text-center">{{ trans('general.setup_fee') }}
                                            {{ setting('currency_symbol') }}{{ convert_price($package->setup_fee) }}</span>
                                    @else
                                        <div class="text-center p-3">
                                            <span class="h2">{{ trans('general.custom') }}</span>
                                        </div>
                                        <div class="ps-3">
                                            <span class="h6 fw-semibold d-block">{{ trans('general.flexible') }}</span>
                                            <span class="d-block">{{ trans('general.sky_limit') }}</span>
                                        </div>
                                        <div class="card-body text-center d-flex align-items-end justify-content-center">
                                            <button class="btn btn-genix" style="border-radius:30px" data-bs-toggle="modal"
                                                data-bs-target="#enterpriseModel">{{ trans('general.contact_us') }}</button>
                                        </div>
                                        {{-- For Quote --}}
                                    @endif

                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 mt-3">
                            {!! __(setting('package_information')) !!}
                        </div>
                        @include('partials.enterprise')
                    </div>
                </div>
            </div>
    </section>
    <!-- tabs end -->
@endsection
