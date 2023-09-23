@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    {!! setting(request()->segment(2)) !!}
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
                @if ($type !== 'enterprise')
                    <div class="col-12 text-center mt-3 mb-3">
                        <a href="{{ route('register', ['package' => $type]) }}" class="btn btn-sm btn-genix">Sign Up Now</a>
                    </div>
                @endif

                @if ($type === 'enterprise')
                    <div class="col-12 mt-2 mb-5">
                        <h3 class="mb-4">How we offer you as a company</h3>
                        <div class="row">
                            @foreach ($features->where('category', 'benefits_as_company') as $feature)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                        <div class="card-body">
                                            <h5 class="text-sm card-title">{{ $feature->title }}</h5>
                                            <p class="card-text fs-14 text-justify">{{ $feature->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4">How we benefits you</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_you') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title">{{ $feature->title }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 mt-2 mb-5">
                    <h3 class="mb-4">How we benefits your customers</h3>
                    <div class="row">
                        @foreach ($features->where('category', 'benefits_for_customers') as $feature)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm bg-genix text-white equal-height">
                                    <div class="card-body">
                                        <h5 class="text-sm card-title">{{ $feature->title }}</h5>
                                        <p class="card-text fs-14 text-justify">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- pricing --}}
                @if ($type !== 'enterprise')
                    <div class="col-12 mt-2 mb-5">
                        <h3 class="mb-4 text-center">Pricing</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <h4 class="mb-3">{{ $type === 'individual' ? 'Indipendent' : 'Recovery' }} Package
                                        </h4>
                                        <ul>
                                            @foreach ($package->specifications as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                        <h3 class="ms-5">
                                            {{ setting('currency_symbol') }}{{ $package->price + $package->setup_fee }}
                                        </h3>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4 class="mb-3">Addons</h4>
                                        <ul>
                                            @foreach ($package->addons as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center mt-3 mb-3">
                                <a href="{{ route('register', ['package' => $type]) }}" class="btn btn-sm btn-genix">Sign
                                    Up Now</a>
                            </div>
                        @else
                            <div class="col-12 mt-2 mb-5 text-center">
                                <h3 class="mb-4">Pricing</h3>
                                <p>Pricing depends on how many garage you have, hoe many staff should be able to login to
                                    portal</p>
                                <a href="#" class="btn btn-sm btn-genix mb-2">Contact us for <br /> a quote</a>
                                <p>We will ask for some details to better serve you.</p>
                            </div>
                @endif
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- tabs end -->
@endsection
