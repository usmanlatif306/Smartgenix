<nav class="navbar navbar-expand-lg bg-genix text-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('company.dashboard') }}">
            <img src="{{ file_url(setting('small_logo')) }}" alt="{{ setting('app_name') }}" width="50" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto text-white">
                <!-- genreral routes -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('company.dashboard') }}">{{ __('general.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white"
                        href="{{ route('company.billing.index') }}">{{ __('general.billing') }}</a>
                </li>
                @if (request()->user()->active_subscription())
                    <li class="nav-item">
                        <a class="nav-link text-white"
                            href="{{ route('company.supports.index') }}">{{ __('general.support_tickets') }}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-white"
                        href="{{ route('company.account') }}">{{ __('general.account') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="javascript:void(0)"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('general.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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
        </div>
    </div>
</nav>
