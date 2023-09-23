@extends('layouts.app')

@section('content')
    <div class="container page-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- support ticket start -->
                <div class="card">
                    <div class="card-header text-center bg-genix text-white">
                        <a href="{{ route('company.supports.index') }}" class="float-start fs-20 text-white">
                            <i class="bi bi-arrow-left-short"></i>
                        </a>
                        <h5 class="p-0 m-0 pt-1">{{ trans('general.open_support_ticket') }}</h5>
                    </div>
                    <div class="card-body">
                        @livewire('create-ticket')
                    </div>
                </div>
                <!-- support ticket start -->
            </div>
        </div>


    </div>
@endsection
