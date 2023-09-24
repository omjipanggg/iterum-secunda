<section id="patria">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 offset-lg-1 d-flex flex-column align-items-center justify-content-center order-lg-1 order-2 mb-lg-31">
                <h4 class="fw-bold display-6 text-center">Wujudkan Pekerjaan Impianmu Bersama <abbr class="text-color" title="Selection &amp; Recruitment Alihdaya">{{ config('app.name', 'SELENA') }}</abbr></h4>
                {{-- <p class="text-center">Kirimkan CV Anda, dan lamar pekerjaan di sini!</p> --}}
                <form action="{{ route('portal.index') }}" method="GET" class="w-100 mt-lg-31">
                    <div class="filter w-100 d-flex flex-column flex-sm-row">
                        <div class="position-relative flex-fill">
                            <i class="bi bi-briefcase icon-floating position-absolute"></i>
                            <input type="text" class="form-control py-3" name="keyword" autocomplete="off" placeholder="Pencarian" id="query">
                            <label for="query" class="visually-hidden">Pencarian</label>
                        </div>
                        <button type="submit" class="btn btn-color px-4">
                            {{ __('Telusuri') }}
                            <i class="bi bi-search ms-2"></i>
                        </button>
                    </div>
                </form>
                <a href="#" class="underlined mt-2">Kirim CV Anda</a>
            </div>
            <div class="col-lg-6 d-flex align-items-center order-lg-2 order-1">
                <img src="{{ asset('img/observe.webp') }}" alt="Browse" class="img-fluid">
            </div>
        </div>
    </div>
</section>