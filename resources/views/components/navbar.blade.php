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
            <ul class="navbar-nav ms-auto gap-1">
                @guest
                {{--
                <li class="nav-item">
                <div class="input-group">
                  <a class="btn btn-outline-color px-3 rounded-0" href="{{ route('register') }}">Daftar</a>
                  <button type="button" class="btn btn-outline-color rounded-0 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('register.createPartner') }}">Pemberi kerja</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Pencari kerja</a></li>
                  </ul>
                </div>
                </li>
                --}}
                @if (Route::has('register'))
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="btn btn-outline-color px-3 rounded-0 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('Register') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="registerItem">
                        <a class="dropdown-item" href="{{ route('register') }}"><i class="bi bi-person-plus me-2"></i>Pencari kerja</a>
                        <a class="dropdown-item" href="{{ route('register.createPartner') }}"><i class="bi bi-briefcase me-2"></i>Pemberi kerja</a>
                    </div>
                </li>
                @endif
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="btn btn-dual-color px-3 rounded-0" href="{{ route('login') }}">Masuk<i class="bi bi-box-arrow-in-right ms-1"></i></a>
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
                                <a class="dropdown-item" href="{{ route('master.index') }}">Dashboard</a>
                            @elseif(auth()->user()->hasRole(7))
                                <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                            @elseif(auth()->user()->hasRole(8))
                                <a class="dropdown-item" href="{{ route('partner.index') }}">Dashboard</a>
                            @else
                                <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                            @endif
                            <a href="{{ route('home.settings') }}" class="dropdown-item">Pengaturan</a>
                            <hr class="navbar-divider my-1">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
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