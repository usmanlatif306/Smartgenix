<nav class="navbar navbar-expand-lg navbar-light bg-genix">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}
            <img src="{{ file_url(setting('small_logo')) }}" alt="{{ setting('app_name') }}" width="50" height="40">
        </a>
        <button class="navbar-toggler text-white shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Middle Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <!-- Websites Links -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('homepage') }}">{{ __('general.home') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('about') }}">{{ __('general.about_us') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="javascript:void(0)" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('general.products') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"
                                href="{{ route('products') }}">{{ __('general.all_products') }}</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('products.independent') }}">{{ __('general.independent_garage') }}</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('products.recovery') }}">{{ __('general.recovery') }}</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('products.enterprise') }}">{{ __('general.enterprise') }}</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('features') }}">{{ __('Features') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('pricing') }}">{{ __('general.pricing') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('contact') }}">{{ __('general.contact_us') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="javascript:void(0)" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->getLocale() }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($languages as $code => $name)
                            <li><a class="dropdown-item" href="{{ route('lang', $code) }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mb-2 mb-xl-0">
                    <a class="btn btn-sm btn-outline-secondary text-white me-2"
                        href="http://dashboard.smartgenix.co.uk/"
                        target="_blank">{{ __('general.login_as_staff') }}</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-outline-secondary text-white" href="http://users.smartgenix.co.uk/"
                        target="_blank">{{ __('general.login_as_user') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
