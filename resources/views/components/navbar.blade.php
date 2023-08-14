<nav class="navbar navbar-expand-lg navbar-bg-color" id="capitis">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" data-bs-theme="dark">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- <ul class="navbar-nav me-auto"></ul> --}}
            <ul class="navbar-nav ms-auto">
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Masuk<i class="bi bi-box-arrow-in-right ms-1"></i></a>
                </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{-- {{ '@' . Str::lower(Str::of(auth()->user()->name)->explode(' ')->first()) }} --}}
                            {{ Str::lower(auth()->user()->email) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->hasRole(1))
                                <a class="dropdown-item text-start text-lg-end" href="{{ route('master.index') }}">Konfigurasi</a>
                            @elseif(auth()->user()->hasRole(7))
                                <a class="dropdown-item text-start text-lg-end" href="{{ route('candidate.index') }}">Profil</a>
                            @else
                                <a class="dropdown-item text-start text-lg-end" href="{{ route('dashboard.index') }}">Dashboard</a>
                            @endif
                            <a href="{{ route('home.settings') }}" class="dropdown-item text-start text-lg-end">Pengaturan</a>
                            <hr class="navbar-divider my-1">
                            <a class="dropdown-item text-start text-lg-end" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="mb-12"></div>