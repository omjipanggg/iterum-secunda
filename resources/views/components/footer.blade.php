<div class="mb-12-on"></div>
<footer class="mt-auto pt-5 text-bg-color">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-2 mb-3">
        <h5>Menu</h5>
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 dotted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 dotted">Portal</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 dotted">Tutorial</a></li>
        </ul>
      </div>
      <div class="col-12 col-md-2 mb-3">
        <h5>Permalink</h5>
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 dotted">Bantuan</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 dotted">Peta situs</a></li>
        </ul>
      </div>
      <div class="col-xl-4 col-lg-5 col-md-7 offset-xl-4 offset-lg-3 offset-md-1 mb-0 mb-md-3">
        <h5>Berlangganan</h5>
        <hr>
        <p class="mb-2">Dapatkan informasi lowongan kerja terbaru!</p>
        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
          <form action="{{ route('home.subscribe') }}" method="POST" class="w-100" onsubmit="loadingOnSubmit(event);">
            @csrf
            @method('POST')
            <div class="input-group">
            <label for="subscription" class="visually-hidden">Alamat email</label>
            <input id="subscription" type="email" class="form-control" placeholder="Alamat email" autocomplete="off" name="email" required="">
            <button class="btn btn-dual px-3 rounded-0" type="submit">
              {{ __('Kirim') }}
              <i class="bi bi-send ms-1"></i>
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="lower bg-darker-color py-2 mt-5 mt-md-3">
    <div class="container">
      <div class="d-flex flex-wrap flex-column flex-sm-row justify-content-center justify-content-sm-between align-items-center gap-1">
        <p class="m-0">{{ config('app.name') }} © {{ date('Y') }}</p>
        <a href="#capitis" class="dotted">Top<i class="bi bi-mouse2 ms-2"></i></a>
      </div>
    </div>
  </div>
</footer>