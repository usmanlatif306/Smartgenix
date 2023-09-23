@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 register-content">
                    {!! __(setting('search-garage')) !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <section class="bg-white p-5">
        <div class="container">
            @livewire('services')
        </div>
    </section>
@endsection
