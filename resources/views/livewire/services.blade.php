<div class="row justify-content-center">
    <div class="col-md-8 d-flex align-items-center border rounded position-relative">
        <input type="text" class="form-control shadow-none bg-transparent border-0"
            placeholder="{{ trans('general.search_garage') }}" wire:model="search">
        <span>
            <i class="bi bi-search"></i>
        </span>
    </div>
    @if ($search)
        <div class="col-12 d-flex justify-content-center p-0">
            <div class="border rounded p-2 s-width">
                @forelse ($garages as $item)
                    <div class="cursor-pointer mb-2 search ps-3" wire:click="SelectGarage({{ $item->id }})">
                        <span class="fs-6">{{ $item->name }} ({{ $item->city . ', ' . $item->country }})</span>
                    </div>
                @empty
                    <div class="cursor-pointer mb-2 ps-3">
                        <span class="fs-6">{{ trans('general.no_garage') }}</span>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    @if ($garage)
        <div class="col-md-8 my-3">
            <span class="h4">{{ $garage?->name }}</span>
            <div class="row mt-2">
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.address') }}: </span>
                    <span class="">{{ $garage?->address }}</span>
                </div>
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.city') }}: </span>
                    <span class="">{{ $garage?->city }}</span>
                </div>
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.country') }}: </span>
                    <span class="">{{ $garage?->country }}</span>
                </div>
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.telephone') }}: </span>
                    <span class="">{{ $garage?->telephone }}</span>
                </div>
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.total_reviews') }}: </span>
                    <span class="">{{ $garage?->reviews_count }}</span>
                </div>
                <div class="col-sm-6 col-lg-4 mb-2">
                    <span class="fw-semibold">{{ trans('general.ratings') }}: </span>

                    <span
                        class="">{{ $garage?->reviews_avg_overall ? round($garage?->reviews_avg_overall, 1) : 0 }}
                        / 5</span>
                </div>
            </div>
        </div>


        <div class="col-md-8 d-flex justify-content-center flex-wrap gap-3">
            @foreach ($types as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" wire:model="type" value="{{ $item }}"
                        id="type-{{ $item }}">
                    <label class="form-check-label" for="type-{{ $item }}">
                        {{ trans('general.' . $item) }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 mt-3">
            <h5 class="fw-semibold">{{ trans('general.' . $type) }}</h5>
            @if ($is_service)
                <p>{{ trans('general.offer_service', ['service' => trans('general.' . $type)]) }}</p>
            @else
                <p>{{ trans('general.offer_not_service', ['service' => trans('general.' . $type)]) }}</p>
            @endif

            @if ($type !== 'memberships')
                @if ($is_service)
                    <h5 class="fw-semibold">{{ trans('general.how_long_take') }}</h5>
                    <p>{{ $duration }}</p>
                    <h5 class="fw-semibold">{{ trans('general.cost') }}</h5>
                    @if ($type === 'repair')
                        <p>{{ trans('general.price_depending') }}</p>
                    @elseif ($type === 'service')
                        <p>{{ trans('general.interm_service_price', ['price' => $currency . $cost]) }}
                        </p>
                        <p>{{ trans('general.full_service_price', ['price' => $currency . $full_cost]) }}
                        </p>
                        <p>{{ trans('general.major_service_price', ['price' => $currency . $major_cost]) }}
                        </p>
                    @else
                        <p>{{ trans('general.cost_value', ['service' => trans('general.' . $type), 'price' => $currency . $cost]) }}
                        </p>
                    @endif
                    <h5 class="fw-semibold">{{ trans('general.additional_cost') }}</h5>
                    <p>{{ trans('general.price_depending') }}</p>
                @endif
            @else
                @if ($is_service)
                    <h5 class="fw-semibold">{{ trans('general.packages') }}</h5>
                    @foreach ($memberships as $package)
                        <div>
                            <p class="mb-1">
                                <span class="fw-semibold">{{ trans('general.package_name') }}: &nbsp;</span>
                                <span>{{ $package->name }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="fw-semibold">{{ trans('general.mots') }}: &nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span>{{ $package->mots }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="fw-semibold">{{ trans('general.services') }}: &nbsp;</span>
                                <span>{{ $package->services }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="fw-semibold">{{ trans('general.repairs') }}: &nbsp;&nbsp;</span>
                                <span>{{ $package->repairs }}</span>
                            </p>
                            <p class="mb-1">
                                <span class="fw-semibold">{{ trans('general.cost') }}:
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span>{{ $currency }}{{ $package->price }}</span>
                            </p>
                        </div>
                    @endforeach
                @endif
            @endif

        </div>
    @else
        <p class="text-center pt-3 pb-5">{{ trans('general.what_search_include') }}</p>
    @endif

</div>
