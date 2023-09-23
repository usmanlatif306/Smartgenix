@extends('layouts.app')

@section('content')
    <div class="container page-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-header bg-genix text-white">
                        {{-- <h4>Payment</h4> --}}
                        <h5 class="p-0 m-0">
                            {{ request()->type === 'quote' ? trans('general.quote_payment') : trans('general.package_renewal') }}
                        </h5>
                    </div>
                    <div class="card-body">

                        <form id="paymentForm" action="{{ route('company.payment.save') }}" method="POST">
                            @csrf
                            <div class="row">
                                @if (request()->package === 'renewal')
                                    <input type="hidden" name="package" value="{{ $data['package_id'] }}">
                                    {{-- <div class="col-md-12 mb-3">
                                        @foreach ($data['packages'] as $package)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="package"
                                                    id="{{ $package->name }}" value="{{ $package->id }}"
                                                    {{ $package->name ===auth()->user()->active_subscription()->package->name? 'checked': '' }}>
                                                <label id="price{{ $package->id }}" class="form-check-label"
                                                    for="{{ $package->name }}"
                                                    data-price="{{ $package->price }}">{{ $package->name }}</label>
                                            </div>
                                        @endforeach
                                    </div> --}}
                                @elseif (request()->type === 'package')
                                    <input type="hidden" name="payment_id" value="{{ request()->package }}">
                                @elseif (request()->type === 'quote')
                                    <input type="hidden" name="quote_id" value="{{ request()->quote }}">
                                @else
                                    <div class="col-md-12 mb-3">
                                        @foreach ($data['packages'] as $package)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="buy_package"
                                                    id="{{ $package->name }}" value="{{ $package->id }}"
                                                    {{ $loop->first ? 'checked' : '' }}>
                                                <label id="price{{ $package->id }}" class="form-check-label"
                                                    for="{{ $package->name }}"
                                                    data-price="{{ $package->total }}">{{ $package->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </form>
                        <div id="card-errors" class='alert alert-danger d-none'></div>
                        <div class="row">
                            <div class="col-12">
                                @if (request()->package === 'renewal' || request()->type === 'package')
                                    <p>{{ trans('general.package_expired_date', ['date' => $data['new_date']->format('d/m/Y')]) }}
                                    </p>
                                    <p><span class="fw-semibold">{{ trans('general.package') }}:</span>
                                        {{ request()->package === 'renewal' ? $data['package']?->name : $data['package']?->package->name }}
                                    </p>
                                @endif

                                @if (request()->type === 'quote')
                                    <p><span class="fw-semibold">{{ trans('general.quote') }}:</span>
                                        {{ $data['quote']?->quote->name }}</p>
                                    <p><span class="fw-semibold">{{ trans('general.description') }}:</span>
                                        {{ $data['quote']?->quote->description }}</p>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="cardNumber" class="fw-normal">{{ trans('general.card_number') }}</label>
                                    <input type="number" class="form-control" id="cardNumber"
                                        placeholder="Credit Card Number"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="16" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="mmNumber" class="fw-normal">{{ trans('general.card_month') }}</label>
                                    <input type="number" class="form-control" id="cardMonth" placeholder="MM"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="2" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="cardYear" class="fw-normal">{{ trans('general.card_year') }}</label>
                                    <input type="number" class="form-control" id="cardYear" placeholder="Year"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="4" />
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="cardCVC" class="fw-normal">{{ trans('general.card_cvc') }}</label>
                                    <input type="number" class="form-control" id="cardCVC" placeholder="CVC"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="3" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"
                                        id="basic-addon1">{{ setting('currency_symbol') }}</span>
                                    <input type="text" class="form-control" id="convert_price"
                                        value="{{ convert_price($data['price']) }}" disabled />
                                    <input type="hidden" class="form-control" id="price"
                                        value="{{ $data['price'] }}" />
                                </div>

                            </div>
                            <div class="col-12 text-center">
                                <button id="card-button" type="submit" class="btn btn-genix" data-cc-on-file="false"
                                    data-stripe-publishable-key="{{ setting('stripe_key') }}">
                                    {{ __('general.complete_payment') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        // change package
        $("input[name='package']").on('change', function(e) {
            $('#price').val($(`#price${e.target.value}`).data('price'));
        });

        $('#card-button').on('click', function(e) {
            e.preventDefault();
            $('#card-errors').addClass('d-none')
            disabledButtons();
            Stripe.setPublishableKey($(this).data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('#cardNumber').val(),
                cvc: $('#cardCVC').val(),
                exp_month: $('#cardMonth').val(),
                exp_year: $('#cardYear').val()
            }, stripeHandleResponse);
        });

        // stripeHandlerResponse Function
        function stripeHandleResponse(status, response) {
            if (response.error) {
                enabledButtons()
                $('#card-errors').removeClass('d-none')
                    .text(response.error.message);
            } else {
                // let form = $('#paymentForm');
                $('#paymentForm').append($('<input>').attr({
                    type: 'hidden',
                    name: 'stripeToken',
                    value: response.id
                })).submit();
                // $.ajax({
                //     url: "{{ route('company.payment.save') }}",
                //     type: "POST",
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         stripeToken: response.id
                //     },
                //     success: function(res) {
                //         console.log(res);
                //         changeButtonsText();

                //     },
                //     error: function(error) {
                //         console.log(error);
                //         enabledButtons()
                //     }
                // });
            }
        }

        // disabled buttons
        function disabledButtons() {
            $('#card-button').html("{{ trans('general.please_wait') }} <i class='fas fa-circle-notch fa-spin'></i>");
            $("#card-button").prop("disabled", true);
        }

        // changeButton Text
        function changeButtonsText() {
            $('#card-button').text("{{ __('general.payment_completed') }}");
        }
        // enabled buttons
        function enabledButtons() {
            $('#card-button').text("{{ __('general.complete_payment') }}");
            $("#card-button").prop("disabled", false);
        }
    </script>
@endpush
