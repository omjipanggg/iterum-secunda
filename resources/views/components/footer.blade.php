<div class="container mt-12">
  <footer class="d-flex flex-wrap justify-content-md-between align-items-center flex-md-row flex-column py-3 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">{{ config('app.name', 'Laravel') }} &copy; {{   date('Y') }}</p>
    <ul class="nav col-md-4 justify-content-center justify-content-md-end">
      <li class="nav-item"><a href="{{ route('home.index') }}" class="nav-link px-0 dotted">Home</a></li>
      {{-- <li class="nav-item"><a href="#" class="nav-link px-0 dotted">Link</a></li> --}}
      <li class="nav-item"><a href="{{ route('home.sitemap') }}" class="nav-link px-0 dotted">Sitemap</a></li>
    </ul>
  </footer>
</div>