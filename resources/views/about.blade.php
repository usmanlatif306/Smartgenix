@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    <p>{!! __(setting('about-us')) !!}</p>
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
        <div class="container">
            <div class="row justify-content-center">
                @livewire('about-tab')
            </div>
        </div>
    </section>
    <!-- tabs end -->
@endsection
