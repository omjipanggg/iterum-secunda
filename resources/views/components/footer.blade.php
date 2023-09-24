<div class="mb-12-on"></div>
<footer class="mt-auto pt-5 text-bg-color">
  <div class="container mb-5">
    <div class="row">
      <div class="col-12 col-xl-3 col-lg-4 col-md-6 mb-3">
        <h5>Informasi</h5>
        <hr>
        <div class="group d-flex gap-2 align-items-baseline">
          <i class="bi bi-geo-alt-fill"></i>
          <a href="https://maps.app.goo.gl/QWCKaYxv96xArMjM8" class="dotted mb-2">Jl. T.B. Simatupang No.10, RT.010/002, Kel. Cilandak Barat, Kec. Cilandak, Kota Jakarta Selatan, DKI Jakarta 12430</a>
        </div>
        <div class="group d-flex gap-2 align-items-baseline">
          <i class="bi bi-telephone-fill"></i>
          <p class="mb-2">
            <a href="#" class="dotted">0818 0606 0979</a> / <a href="#" class="dotted">021 769 236 9</a>
          </p>
        </div>
        <div class="group d-flex gap-2 align-items-baseline">
          <i class="bi bi-envelope-fill"></i>
          <a href="mailto:selena@ptkam.co.id" class="dotted mb-2">selena@ptkam.co.id</a>
        </div>
      </div>
      <div class="col-12 col-xl-2 col-lg-3 col-md-6 mb-4">
        <h5>Tautan</h5>
        <hr>
        <ul class="nav flex-column gap-2">
          <li class="nav-item"><a href="#" class="nav-link p-0 dotted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link p-0 dotted">Portal</a></li>
          <li class="nav-item"><a href="#" class="nav-link p-0 dotted">Sitemap</a></li>
          <li class="nav-item"><a href="#" class="nav-link p-0 dotted">Bantuan</a></li>
        </ul>
      </div>
      <div class="col-xl-4 col-lg-5 col-md-12 offset-xl-3 mb-0 mb-md-3">
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