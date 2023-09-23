<div class="row">
    <div class="col-md-12">
        @include('partials.message')
    </div>
    {{-- billing --}}
    <div class="col-md-12 mb-3">
        <div class="card border-0">
            <div class="card-header bg-genix text-white">
                <h5 class="p-0 m-0">{{ trans('general.billing') }}</h5>
            </div>
            @php
                $currency = setting('currency_symbol');
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('general.invoice') }}</th>
                                <th scope="col">{{ trans('general.invoice_date') }}</th>
                                <th scope="col">{{ trans('general.due_date') }}</th>
                                <th scope="col">{{ trans('general.type') }}</th>
                                <th scope="col">{{ trans('general.name') }}</th>
                                <th scope="col">{{ trans('general.total') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($billings as $billing)
                                <tr>
                                    <td class="text-capitalize">{{ $billing->id }}</td>
                                    <td>{{ $billing->created_at->format('d/m/Y') }}</td>
                                    <td class="text-capitalize">{{ $billing->due_date->format('d/m/Y') }}</td>
                                    <td>{{ $billing->package_id ? trans('general.package') : ($billing->quote_id ? trans('general.quote') : trans('general.tier_upgrade')) }}
                                    </td>
                                    <td>{{ $billing->package_id ? $billing->package?->name : ($billing->quote_id ? $billing->quote?->name : $billing->tier?->name) }}
                                    </td>
                                    <td>{{ $currency }}{{ convert_price($billing->total) }}</td>
                                    <td>
                                        <span class="text-success text-capitalize">{{ $billing->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ trans('general.no_record') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $billings->links() }}
                </div>
            </div>
        </div>
    </div>


    {{-- quotes --}}
    <div class="col-md-12 mb-3">
        <div class="card border-0">
            <div class="card-header bg-genix text-white">
                <h5 class="p-0 m-0">{{ trans('general.quote') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('general.invoice') }}</th>
                                <th scope="col">{{ trans('general.invoice_date') }}</th>
                                <th scope="col">{{ trans('general.due_date') }}</th>
                                <th scope="col">{{ trans('general.total') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quotes as $quote)
                                <tr>
                                    <td class="text-capitalize">{{ $quote->id }}</td>
                                    <td>{{ $quote->created_at->format('d/m/Y') }}</td>
                                    <td class="text-capitalize">{{ $quote->due_date->format('d/m/Y') }}</td>
                                    <td>{{ setting('currency_symbol') }}{{ convert_price($quote->total) }}
                                    </td>
                                    <td>
                                        <span
                                            class="@if ($quote->status === 'paid') text-success @else text-danger @endif text-capitalize">{{ $quote->status }}
                                            <button class="btn btn-sm btn-genix ms-2" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $quote->id }}">View</button>
                                            @if ($quote->status === 'unpaid')
                                                @if ($quote->type === 'package')
                                                    <a href="{{ route('company.payment.index', ['type' => 'package', 'package' => $quote->id]) }}"
                                                        class="btn btn-sm btn-genix ms-2">Pay</a>
                                                @else
                                                    <a href="{{ route('company.payment.index', ['type' => 'quote', 'quote' => $quote->id]) }}"
                                                        class="btn btn-sm btn-genix ms-2">Pay</a>
                                                @endif
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="detailModal{{ $quote->id }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($quote->type === 'package')
                                                    <h4>{{ $quote->package?->name }}</h4>
                                                    <h5>{{ __('general.package_specification') }}</h5>
                                                    <ul>
                                                        @foreach ($quote->package->specifications as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <span>{{ __('general.price') }}:
                                                        {{ setting('currency_symbol') }}{{ convert_price($quote->total) }}
                                                    </span>
                                                @else
                                                    <h4>{{ $quote->quote?->name }}</h4>
                                                    <p class="m-0 p-0 mb-2">{{ $quote->quote->description }}</p>
                                                    <span>{{ __('general.price') }}:
                                                        {{ setting('currency_symbol') }}{{ convert_price($quote->total) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5">No record found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $quotes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
