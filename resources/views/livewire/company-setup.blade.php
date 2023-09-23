<div class="container page-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-genix">{{ trans('general.hello') }} {{ auth()->user()->name }}</h4>
            <hr />
        </div>
    </div>
    @include('partials.message')
    {{-- car information --}}
    <div class="card mb-2 border-0">
        <div class="card-body">
            {{-- choose vehicles --}}
            @if ($step === 'vehicles')
                <div class="mt-3">
                    <h4 class="text-center text-genix">{{ trans('general.choose_vehicles') }}</h4>
                    <div class="d-flex justify-content-center gap-5 flex-wrap mt-4">
                        @foreach ($vehicles_list as $vehicle)
                            <div class="mb-3">
                                <div class="mb-2 text-center">
                                    <img src="{{ file_url($vehicle->image) }}" alt="{{ $vehicle->name }}"
                                        class="img-circle-sm">
                                </div>
                                <div class="text-center">
                                    <input type="checkbox" value="{{ $vehicle->name }}" class="btn-check"
                                        id="{{ $vehicle->name }}" wire:model="vehicles">
                                    <label class="btn btn-sm btn-outline-genix"
                                        for="{{ $vehicle->name }}">{{ $vehicle->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4 pb-4">
                        <button class="btn btn-genix"
                            wire:click="moveSetup('vehicles','services')">{{ trans('general.next') }}</button>
                    </div>
                </div>
            @elseif ($step === 'services')
                {{-- choose service type --}}
                <div class="mt-3">
                    <div id="serviceSetup" wire:target="moveSetup('services')" wire:loading.class="d-none">
                        <h4 class="text-center text-genix">{{ trans('general.choose_services') }}</h4>
                        <div class="d-flex justify-content-center gap-5 flex-wrap mt-4">
                            @foreach ($services_list as $service)
                                <div class="mb-1">
                                    <div class="mb-2 text-center">
                                        <img src="{{ file_url($service->image) }}" alt="services"
                                            class="img-circle-md">
                                    </div>
                                    <div class="text-center">
                                        <input type="checkbox" wire:model="services" value="{{ $service->value }}"
                                            class="btn-check" id="{{ $service->value }}">
                                        <label class="btn btn-sm btn-outline-genix"
                                            for="{{ $service->value }}">{{ $service->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4 pb-4">
                            <button class="btn btn-genix" wire:click="moveSetup('services')"
                                wire:loading.attr="disabled">{{ trans('general.next') }}</button>
                        </div>
                    </div>
                    {{-- @endif --}}

                    {{-- installation --}}
                    <div id="installation" wire:loading wire:target="moveSetup('services')"
                        wire:loading.class="d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/importing.svg') }}" alt="importing" class="img-fluid">
                        <p class="text-center text-genix pt-4">{{ trans('general.wait_installing') }}<br /> <span
                                class="text-danger">{{ trans('general.do_not_refresh') }}</span></p>
                    </div>

                </div>
            @else
                {{-- fully signup --}}
                <div class="mt-3 pb-3" style="height: 65vh">
                    <canvas height='1' id='confetti' width='1'></canvas>
                    <div class="d-flex justify-content-center align-items-center h-100 z-100">
                        <div class="">
                            <h4 class="text-center text-genix">{{ trans('general.fully_signed_up') }}</h4>
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25"
                                    fill="none" />
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                            </svg>
                            <div class="mt-4 text-center">
                                <div class="mb-2 center gap-2">
                                    <a href="{{ route('company.dashboard') }}"
                                        class="btn btn-genix z-100">{{ trans('general.view_account') }}</a>
                                    <i class="fas fa-info-circle fs-18 text-genix curser-pointer z-100"
                                        data-bs-toggle="modal" data-bs-target="#accountModal"></i>
                                </div>
                                <div class="center gap-2">
                                    <a href="http://dashboard.smartgenix.co.uk/"
                                        class="btn btn-genix z-100">{{ trans('general.view_dashboard') }}</a>
                                    <i class="fas fa-info-circle fs-18 text-genix curser-pointer z-100"
                                        data-bs-toggle="modal" data-bs-target="#dashboardModal"></i>
                                </div>

                                {{-- view account model --}}
                                <div class="modal fade" id="accountModal" tabindex="-1"
                                    aria-labelledby="accountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title m-0 p-0">{{ trans('general.account_info') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!! setting('account-setup-content') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- view dashboard model --}}
                                <div class="modal fade" id="dashboardModal" tabindex="-1"
                                    aria-labelledby="dashboardModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title m-0 p-0">{{ trans('general.dashboard_info') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!! setting('dashboard-setup-content') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- </div> --}}

            @endif

        </div>
    </div>
</div>
@push('styles')
    <style>
        #confetti {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/confetti.js') }}"></script>
@endpush
