<nav class="sb-topnav navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid px-12">
        <div class="wrap d-flex align-items-center">
            <button class="btn btn-sm btn-link ps-0" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        </div>
        <ul class="navbar-nav me-auto d-none d-md-block">
            <span class="navbar-text ms-2" id="clock">{{ date_time_indo_format(date('Y-m-d H:i:s')) }}</span>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person d-inline-block d-lg-none"></i>
                    <span class="d-none d-lg-inline-block">{{ Str::lower(auth()->user()->email) }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        @if (auth()->user()->hasRole(1))
                            <a class="dropdown-item" href="{{ route('master.index') }}">Dashboard</a>
                        @elseif(auth()->user()->hasRole(7))
                            <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                        @elseif(auth()->user()->hasRole(8))
                            <a class="dropdown-item" href="{{ route('partner.index') }}">Dashboard</a>
                        @else
                            <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                        @endif
                    </li>
                    <li><a class="dropdown-item" href="{{ route('home.settings') }}">Pengaturan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</nav>
