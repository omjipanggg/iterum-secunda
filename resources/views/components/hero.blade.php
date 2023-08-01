<div class="container my-5 px-4">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-start rounded-3 shadow-lg">
        <div class="col-lg-6 p-0 pb-4 p-lg-5 pt-lg-3">
        <p class="m-0 mb-2"><i class="bi bi-clock me-2"></i><span id="clock">{{ date('F d, Y H:i:s') }}</span></p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        @endif

        @auth
        <h3 class="fw-bold lh-1">Welcome back, {{ Str::headline(Auth::user()->name) }}!</h3>
        @if (Auth::user()->hasRole(1))
        <p class="mt-4 mb-1">Please select one of the available routes:</p>
        <ul class="m-0 px-3 square">
            <li>Dashboard&mdash;<a href="{{ route('admin.index') }}" class="dotted">{{ route('admin.index') }}</a></li>
            <li>Lounge&mdash;<a href="{{ route('home.index') }}" class="dotted">{{ url()->current() }}/lounge</a></li>
            <li>Ngodeng&mdash;<a href="{{ route('home.ngodengIndex') }}" class="dotted">{{ route('home.ngodengIndex') }}</a></li>
            <li>Rock, Paper, Scissor&mdash;<a href="{{ route('home.index') }}" class="dotted">{{ url()->current() }}/rps</a></li>
            <li>Terms &amp; Conditions&mdash;<a href="{{ route('home.index') }}" class="dotted">{{ url()->current() }}/faq</a></li>
        </ul>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
            <a href="{{ route('home.emailTest', Auth::user()->email) }}" class="btn btn-color px-4 me-md-1">Reminder<i class="bi bi-send-exclamation-fill ms-2"></i></a>
            <a href="#" onclick="event.preventDefault();" class="btn btn-outline-color px-4 fw-bold">Download<i class="bi bi-cloud-fog-fill ms-2"></i></a>
        </div>
        @else
        <p class="lead mt-4 mb-0">Lorem, ipsum dolor, sit amet consectetur adipisicing elit. Rerum, fuga veniam sapiente eligendi quas dolore reiciendis, provident vitae odit distinctio labore laborum quod eos quis maxime et, molestiae quos laboriosam in ab voluptatum deleniti. Earum id quas a doloribus praesentium aliquam dignissimos.</p>
        @endif
        @else
        <a href="{{ route('login') }}" class="dotted">Login/Register</a> to start using this application.
        @endauth

        </div>
        <div class="col-lg-6 p-0 overflow-hidden img-hero-container">
            <img class="rounded-top" src="{{ asset('img/hero.png') }}" alt="Hero">
        </div>
    </div>
</div>