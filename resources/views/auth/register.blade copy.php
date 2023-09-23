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
                <div class="col-md-6 mb-5">
                    <h3 class="text-center mb-3">Steps away from starting your journey</h3>
                    <form action="{{ route('register') }}" method="POST" id="registration">
                        @csrf

                        {{-- company name --}}
                        <div class="form-group mb-3">
                            <label for="name">Company Name</label>
                            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text"
                                name="name" placeholder="Company Name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- company address --}}
                        <div class="form-group mb-3">
                            <label for="address">Company Address</label>
                            <input id="address" class="form-control @error('address') is-invalid @enderror" type="text"
                                name="address" placeholder="Company Address" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- company postcode --}}
                        <div class="form-group mb-3">
                            <label for="postcode">Company Postcode</label>
                            <input id="postcode" class="form-control @error('postcode') is-invalid @enderror"
                                type="text" name="postcode" placeholder="Company Postcode" value="{{ old('postcode') }}"
                                required>
                            @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- company mobile --}}
                        <div class="form-group mb-3">
                            <label for="mobile">Company Mobile</label>
                            <input id="mobile" class="form-control @error('mobile') is-invalid @enderror" type="phone"
                                name="mobile" placeholder="Company Mobile" value="{{ old('mobile') }}"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="19" required>
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- company email --}}
                        <div class="form-group mb-3">
                            <label for="email">Company Email</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                                name="email" placeholder="Company Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- company password --}}
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror"
                                type="password" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- company password confirmation --}}
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" id="price">

                        @livewire('registration')
                        <div class="text-center mt-5">
                            {{-- <button type="submit" class="btn btn-genix">Complete Registration</button> --}}
                            {{-- style="border-radius: 30px;" --}}
                            <input type="submit" id="submitForm" class="btn btn-genix"
                                value="{{ __('Continue Registraion') }}" data-key="{{ setting('stripe_key') }}"
                                data-amount="" data-currency="{{ setting('currency_name') }}" data-locale="auto"
                                data-name="{{ config('app.name') }}" data-description="Pay with Stripe for registraion" />
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
        // $(document).ready(function() {
        //     $('#submitForm').click();
        // });
    </script>
    <script>
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

            // $(this).data('amount', 10 * 100);
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
    </script>
@endpush
