<footer class="bg-genix pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-2">
                <h5 class="text-white">{{ trans('general.sitemap') }}</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('homepage') }}"
                            class="nav-link p-0 text-white">{{ trans('general.home') }}</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('about') }}"
                            class="nav-link p-0 text-white">{{ trans('general.about_us') }}</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('about', ['type' => 'team']) }}"
                            class="nav-link p-0 text-white">{{ trans('general.meet_our_team') }}</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('blog') }}"
                            class="nav-link p-0 text-white">{{ trans('general.blog') }}</a>
                    </li>
                    @foreach ($pages as $page)
                        <li class="nav-item mb-2"><a href="{{ route('page', $page->slug) }}"
                                class="nav-link p-0 text-white">{{ __($page->name) }}</a></li>
                    @endforeach
                    <li class="nav-item mb-2"><a href="{{ route('pricing') }}"
                            class="nav-link p-0 text-white">{{ trans('general.pricing') }}</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('contact') }}"
                            class="nav-link p-0 text-white">{{ trans('general.contact_us') }}</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('careers') }}"
                            class="nav-link p-0 text-white">{{ trans('general.careers') }}</a>
                    </li>
                    <li class="nav-item mb-2"><a href="{{ route('services') }}"
                            class="nav-link p-0 text-white">{{ trans('general.company_offering') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-md-2">
                <h5 class="text-white">{{ trans('general.customer_area') }}</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="http://dashboard.smartgenix.co.uk/" target="_blank"
                            class="nav-link p-0 text-white">{{ trans('general.login_as_dashboard') }}</a></li>
                    <li class="nav-item mb-2"><a href="http://users.smartgenix.co.uk/"
                            class="nav-link p-0 text-white">{{ trans('general.login_as_customer') }}</a>
                    </li>
                    <li class="nav-item mb-2"><a href="http://recovery.smartgenix.co.uk"
                            class="nav-link p-0 text-white">{{ trans('general.login_as_recovery') }}</a>
                    </li>
                </ul>
                <h5 class="mt-2 text-white">{{ trans('general.company_area') }}</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('login') }}" class="nav-link p-0 text-white"
                            target="_blank">{{ trans('general.manage_account') }}</a></li>
                </ul>
            </div>

            <div class="col-md-4 offset-md-2 text-white">
                <h5>{{ trans('general.subscribe_newsletter') }}</h5>
                <p>{{ trans('general.newsletter_title') }}</p>
                <form action="{{ route('subscription') }}" method="post">
                    @csrf
                    <div class="d-flex w-100 gap-2">
                        <label for="email" class="visually-hidden">{{ trans('general.email_address') }}</label>
                        <input id="email" name="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="{{ trans('general.email_address') }}" required>
                        <button type="submit"
                            class="btn text-black btn-black border-black rounded bg-white">{{ trans('general.subscribe') }}</button>
                    </div>
                </form>
                <h5 class="mt-3">{{ trans('general.follow_us') }}</h5>
                <ul class="list-unstyled d-flex">
                    @if (setting('facebook'))
                        <li class=""><a class="text-white fs-16" href="{{ setting('facebook') }}"><i
                                    class="bi bi-facebook"></i></a></li>
                    @endif
                    @if (setting('twitter'))
                        <li class="ms-3"><a class="text-white fs-16" href="{{ setting('twitter') }}"><i
                                    class="bi bi-twitter"></i></a></li>
                    @endif
                    @if (setting('instagram'))
                        <li class="ms-3"><a class="text-white fs-16" href="{{ setting('instagram') }}"><i
                                    class="bi bi-instagram"></i></a></li>
                    @endif
                    @if (setting('youtube'))
                        <li class="ms-3"><a class="text-white fs-16" href="{{ setting('youtube') }}"><i
                                    class="bi bi-youtube"></i></a></li>
                    @endif
                    @if (setting('linkedin'))
                        <li class="ms-3"><a class="text-white fs-16" href="{{ setting('linkedin') }}"><i
                                    class="bi bi-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-center pt-4 mt-4 border-top text-white">
            <p>&copy; {{ now()->format('Y') }} {{ setting('app_name') }}. {{ trans('general.all_right_reserved') }}
            </p>
        </div>
    </div>
</footer>
