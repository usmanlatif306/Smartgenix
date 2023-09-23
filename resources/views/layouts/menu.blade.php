<ul class="nav">
    <li class="nav-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('company.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('company.billing.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('company.billing.index') }}">
            <i class="bi bi-receipt menu-icon"></i>
            <span class="menu-title">Billing</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('company.supports.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('company.supports.index') }}">
            <i class="bi bi-ticket menu-icon"></i>
            <span class="menu-title">Supports</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('account') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('account') }}">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Account</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-in-left menu-icon"></i>
            <span class="menu-title">{{ trans('general.logout') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
