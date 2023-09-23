@extends('layouts.website')
@section('content')
    <!-- Hero Section start -->
    <section class="bg-genix p-5 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 register-content">
                    {!! setting('register') !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- sending message start -->
    <section class="bg-white p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5">
                    <h3 class="text-center mb-3">{{ trans('general.step_away') }}</h3>
                    @include('partials.message')

                    <form action="{{ route('register') }}" method="POST" id="registration">
                        @csrf

                        <input type="hidden" id="price">
                        <input type="hidden" name="package" id="package">
                        <input type="hidden" name="company_name" id="company_name">
                        <input type="hidden" name="company_address" id="company_address">
                        <input type="hidden" name="country" id="country">
                        <input type="hidden" name="city" id="city">
                        <input type="hidden" name="company_postcode" id="company_postcode">
                        <input type="hidden" name="company_telephone" id="company_telephone">
                        <input type="hidden" name="opening" id="opening">
                        <input type="hidden" name="closing" id="closing">
                        <input type="hidden" name="out_of_hour_response" id="out_of_hour_response">
                        <input type="hidden" name="first_name" id="first_name">
                        <input type="hidden" name="last_name" id="last_name">
                        <input type="hidden" name="telephone" id="telephone">
                        <input type="hidden" name="mobile" id="mobile">
                        <input type="hidden" name="role" id="role">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        @livewire('registration')
                        <div class="text-center mt-5">
                            {{-- <button type="submit" id="submitForm" class="btn btn-genix">Complete
                                Registration</button> --}}
                            <input type="submit" id="submitForm" class="btn btn-genix d-none"
                                value="{{ __('Continue to payment') }}" data-key="{{ setting('stripe_key') }}"
                                data-amount="" data-currency="{{ setting('currency_name') }}" data-locale="auto"
                                data-name="{{ config('app.name') }}"
                                data-description="Pay with credit card for registraion" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- sending message end -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
        window.addEventListener('validated', event => {
            document.getElementById("package").value = event.detail.package;
            document.getElementById("company_name").value = event.detail.company_name;
            document.getElementById("company_address").value = event.detail.company_address;
            document.getElementById("country").value = event.detail.country;
            document.getElementById("city").value = event.detail.city;
            document.getElementById("company_postcode").value = event.detail.company_postcode;
            document.getElementById("company_telephone").value = event.detail.company_telephone;
            document.getElementById("opening").value = event.detail.opening;
            document.getElementById("closing").value = event.detail.closing;
            document.getElementById("out_of_hour_response").value = event.detail.out_of_hour_response;
            document.getElementById("first_name").value = event.detail.first_name;
            document.getElementById("last_name").value = event.detail.last_name;
            document.getElementById("telephone").value = event.detail.telephone;
            document.getElementById("mobile").value = event.detail.mobile;
            document.getElementById("role").value = event.detail.role;
            document.getElementById("latitude").value = event.detail.latitude;
            document.getElementById("longitude").value = event.detail.longitude;
            document.getElementById("submitForm").click();
        })

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('element.updated', (el, component) => {
                let price = document.getElementById('totalPrice').dataset.price;
                document.getElementById('price').value = price;
            });
        });
        $(':submit').on('click', function(event) {
            event.preventDefault();
            let dataPrice = document.getElementById('totalPrice').dataset.price;
            let price = $('#price').val();
            if (dataPrice === price) {
                $(this).data('amount', price * 100);
            } else {
                $(this).data('amount', dataPrice * 100);
            }

            var $button = $(this);
            $form = $button.parents('form');
            var opts = $.extend({}, $button.data(), {
                email: $('#email').val(),
                token: function(result) {
                    $form.append($('<input>').attr({
                        type: 'hidden',
                        name: 'stripeToken',
                        value: result.id
                    })).submit();
                }
            });
            StripeCheckout.open(opts);
        });

        $(document).on("DOMNodeRemoved", ".stripe_checkout_app", close);

        function close() {
            document.getElementById("validation").dataset.validated = 'false';
        }
    </script>
@endpush
