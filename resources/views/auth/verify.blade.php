@extends('layouts.website')

@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h2 class="text-lg text-white">{{ __('Verify Your Email Address') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <section class="bg-white p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5 text-center">

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif


                    <h3 class="text-center mb-3">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </h3>


                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline text-genix">{{ __('click here to request another') }}</button>.
                    </form>

                    <div class="mt-2">
                        <a class="nav-link" href="javascript:void(0)"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-in-left menu-icon"></i>
                            <span class="menu-title">{{ trans('general.logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
