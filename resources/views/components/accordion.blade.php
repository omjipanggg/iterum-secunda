<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav my-12">
            {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
            <a class="nav-link @if(url()->current() == route('home.lounge') || url()->current() == route('dashboard.index')) active @endif" href="{{ route('dashboard.index') }}">
                <div class="sb-nav-link-icon"><i class="bi bi-speedometer"></i></div>
                Dashboard
            </a>
            @if (menu()->count() > 0 && !auth()->user()->hasRole(2))
            @foreach (menu() as $menu)
                @if($menu->has_child)
                    <a class="nav-link collapsed" href="{{ route($menu->route) }}" data-bs-toggle="collapse" data-bs-target="#menu{{ $menu->id }}" aria-expanded="false" aria-controls="menu{{ $menu->id }}">
                        <div class="sb-nav-link-icon">
                            <i class="bi {{ $menu->icon }}"></i>
                        </div>

                        {{ $menu->name }}

                        <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
                    </a>
                    <div class="collapse" id="menu{{ $menu->id }}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        @foreach(menu() as $sub)
                            @if($sub->parent_id == $menu->id)
                            <nav class="sb-sidenav-menu-nested nav">
                                @if(isset($sub->model))
                                    <a class="{{ (url()->current() == route($sub->route, $sub->model)) ? 'active' : '' }} nav-link @if(!$sub->active) disabled @endif" href="#" >
                                @else
                                    <a class="{{ (url()->current() == route($sub->route)) ? 'active' : '' }} nav-link @if(!$sub->active) disabled @endif" href="{{ route($sub->route) }}" >
                                @endif
                                <div class="sb-nav-link-icon me-3"><i class="bi {{ $sub->icon }}"></i></div>
                                {{ $sub->name }}
                                </a>
                            </nav>
                            @endif
                        @endforeach
                    </div>
                @else
                    @if($menu->parent_id == 0)
                        @if(isset($menu->model))
                            <a class="{{ (url()->current() == route($menu->route, $menu->model)) ? 'active' : '' }} nav-link @if(!$menu->active) disabled @endif" href="#" >
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
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="bi bi-newspaper"></i></div>
                Portal
            </a>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="bi bi-question-circle-fill"></i></div>
                FAQ
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="d-flex gap-2">
        <img src="{{ asset('img/default.webp') }}" alt="Avatar" class="img-fluid img-avatar-small">
        <div class="d-flex flex-column align-items-start">
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