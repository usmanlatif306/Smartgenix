@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container p-5">
            <h1 class="text-capitalize text-lg text-center">{{ __($page->name) }}</h1>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- content start -->
    <section class="p-5">
        <div class="container">
            {{-- <h2 class="text-center mb-4 text-lg">{{ $page->name }}</h2> --}}
            {!! __($page->content) !!}
        </div>
    </section>
    <!-- content end -->
@endsection
