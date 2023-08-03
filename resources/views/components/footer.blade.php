<footer class="mt-12 pt-5 text-bg-color text-white">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-2 mb-3">
        <h5>Menu</h5>
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white dotted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white dotted">Portal</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white dotted">Tutorial</a></li>
        </ul>
      </div>
      <div class="col-12 col-md-2 mb-3">
        <h5>Permalink</h5>
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white dotted">Bantuan</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white dotted">Peta situs</a></li>
        </ul>
      </div>
      <div class="col-xl-4 col-lg-5 col-md-7 offset-xl-4 offset-lg-3 offset-md-1 mb-3">
        <form>
          <h5>Berlangganan</h5>
          <hr>
          <p>Dapatkan informasi lowongan kerja terbaru!</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Alamat email</label>
            <div class="input-group">
              <form action="{{ route('home.subscription') }}" method="POST">
                <input id="newsletter1" type="text" class="form-control" placeholder="Alamat email">
                <button class="btn btn-dual px-3 rounded-0" type="submit">
                  {{ __('Kirim') }}
                  <i class="bi bi-send ms-2"></i>
              </form>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="lower bg-darker-color py-2 mt-4">
    <div class="container">
      <div class="d-flex flex-wrap flex-column flex-sm-row justify-content-center justify-content-sm-between align-items-center gap-1">
        <p class="m-0">{{ config('app.name') }} © {{ date('Y') }}</p>
        <a href="#capitis" class="dotted text-white">Top<i class="bi bi-mouse2 ms-2"></i></a>
      </div>
    </div>
  </div>
</footer>