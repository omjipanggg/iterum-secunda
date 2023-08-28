<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav mb-4">
            {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
            @if (auth()->user()->hasRole(1))
            <a class="nav-link pt-32 @if (url()->current() == route('master.index')) active @endif" href="{{ route('master.index') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-house-exclamation"></i></div>
                Master
            </a>
            @else
            <a class="nav-link pt-32 @if(url()->current() == route('home.lounge') || url()->current() == route('partner.index') || url()->current() == route('dashboard.index')) active @endif" href="{{ route('dashboard.index') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                Dashboard
            </a>
            @endif
            @if (menu()->count() > 0 && !auth()->user()->hasRole(2))
            @foreach (menu() as $menu)
                @if($menu->has_child)
                    @if ($menu->parent_id == 0)
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu{{ $menu->id }}" aria-expanded="false" aria-controls="menu{{ $menu->id }}">
                        <div class="sb-nav-link-icon">
                            <i class="bi {{ $menu->icon }}"></i>
                        </div>
                        {{ $menu->name }}
                        <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
                    </a>
                    <div class="collapse" id="menu{{ $menu->id }}" aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#sidenavAccordion">
                        @foreach(menu() as $sub)
                            @if($sub->has_child)
                                @if($sub->parent_id != 0)
                                <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionChild">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#sub{{ $sub->id }}" aria-expanded="false" aria-controls="sub{{ $sub->id }}">
                                        <div class="sb-nav-link-icon">
                                            <i class="bi {{ $sub->icon }}"></i>
                                        </div>
                                        {{ $sub->name }}
                                        <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
                                    </a>
                                    <div class="collapse" id="sub{{ $sub->id }}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionChild">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            @foreach (menu() as $grand)
                                                @if ($sub->id == $grand->parent_id)
                                                    <a class="{{ (url()->current() == route($grand->route)) ? 'active' : '' }} nav-link @if(!$grand->active) disabled @endif" href="{{ route($grand->route) }}">
                                                        <div class="sb-nav-link-icon">
                                                            <i class="bi bi-dot"></i>
                                                            {{-- <i class="bi {{ $grand->icon }}"></i> --}}
                                                        </div>
                                                        {{ $grand->name }}
                                                    </a>
                                                @else
                                                @endif
                                            @endforeach
                                        </nav>
                                    </div>
                                </nav>
                                @endif
                            @else
                                @if($sub->parent_id == $menu->id)
                                <nav class="sb-sidenav-menu-nested nav">
                                    @if(isset($sub->model))
                                        <a class="{{ (url()->current() == route($sub->route, $sub->model)) ? 'active' : '' }} nav-link @if(!$sub->active) disabled @endif" href="#">
                                    @else
                                        <a class="{{ (url()->current() == route($sub->route)) ? 'active' : '' }} nav-link @if(!$sub->active) disabled @endif" href="{{ route($sub->route) }}" >
                                    @endif
                                    <div class="sb-nav-link-icon"><i class="bi {{ $sub->icon }}"></i></div>
                                    {{ $sub->name }}
                                    </a>
                                </nav>
                                @else
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @else
                    @endif
                @else
                    @if($menu->parent_id == 0)
                        @if(isset($menu->model))
                            <a class="{{ (url()->current() == route($menu->route, $menu->model)) ? 'active' : '' }} nav-link @if(!$menu->active) disabled @endif" href="#">
                        @else
                            <a class="{{ (url()->current() == route($menu->route)) ? 'active' : '' }} nav-link @if(!$menu->active) disabled @endif" href="{{ route($menu->route) }}" >
                        @endif
                        <div class="sb-nav-link-icon"><i class="bi {{ $menu->icon }}"></i></div>
                        {{ $menu->name }}
                        </a>
                    @endif
                @endif
            @endforeach
            @endif
            @if (auth()->user()->hasRole(1))
            @if(table_has_generated())
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#config" aria-expanded="false" aria-controls="config">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    Konfigurasi
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
                </a>
                <div class="collapse" id="config" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    @foreach(list_of_table() as $table)
                        @if ($table->name == 'personal_access_tokens' || $table->name == 'password_reset_tokens')
                            @continue
                        @endif
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="{{ (url()->current() == route('master.fetch', $table->code)) ? 'active' : '' }} nav-link" href="{{ route('master.fetch', $table->code) }}" >
                                <div class="sb-nav-link-icon"><i class="bi bi-database"></i></div>
                                @if (Str::contains($table->label, ['and', 'And']))
                                {{ Str::singular(Str::of($table->label)->explode(' ')->first()) }}***
                                @else
                                {{ Str::singular($table->label) }}
                                @endif
                            </a>
                        </nav>
                    @endforeach
                </div>
            @else
            <a class="nav-link @if(table_has_generated()) disabled @endif" href="{{ route('master.generateTable') }}" onclick="plsConfirm(event)">
                <div class="sb-nav-link-icon"><i class="bi bi-sliders"></i></div>
                Konfigurasi
            </a>
            @endif
            <a class="nav-link @if (url()->current() == route('user.index')) active @endif" href="{{ route('user.index') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
                Akun Terdaftar
            </a>
            <a class="nav-link @if (url()->current() == route('master.createMenu')) active @endif" href="{{ route('master.createMenu') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-menu-button-fill"></i></div>
                Hak Akses
            </a>
            @endif
            <a class="nav-link" href="{{ route('portal.index') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-newspaper"></i></div>
                Portal
            </a>
            <a class="nav-link @if(url()->current() == route('dashboard.faq')) active @endif" href="{{ route('dashboard.faq') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-question-circle"></i></div>
                FAQ
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="d-flex gap-2">
        <img src="{{ asset('img/default.webp') }}" alt="Avatar" class="img-fluid img-avatar-small">
        <div class="d-flex flex-column align-items-start justify-content-end">
            <small class="text-smaller">
                @foreach (auth()->user()->roles as $element)
                    @php($position=$element->name)
                @endforeach
                {{ $position }}
            </small>
            <span class="d-inline-block text-truncate w-90">
                {{ Str::headline(auth()->user()->name) }}
            </span>
        </div>
        </div>
    </div>
</nav>
</div>