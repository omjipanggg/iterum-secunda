<div id="tutoria"></div>
<section class="tutoria py-6">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">
                <a href="#tutoria" class="dotted">Tata Cara Melamar</a>
            </h2>
            <p class="section-subtitle text-muted">Ikuti petunjuk pelamaran pekerjaan di sini</p>
        </div>

        <div class="row pt-6 hr-top position-relative align-items-center">
            <div class="col-lg-4 offset-lg-2 text-lg-start text-center px-5 px-lg-0">
                <div class="position-relative how-step wrap pe-0 pe-lg-5 pb-3">
                    <span class="position-relative text-center number-container d-none d-lg-inline">
                        <span class="how-to-number rounded-circle position-absolute">1</span>
                    </span>
                    <div class="wrap ps-6">
                        <h4 class="m-0 text-color">Pendaftaran akun</h4>
                        <p class="text-muted">Lakukan pendaftaran akun melalui <a href="{{ route('register') }}" class="underlined">tautan berikut ini</a>.</p>
                    </div>
                </div>
                <div class="position-relative how-step wrap pe-0 pe-lg-5 pb-3">
                    <span class="position-relative text-center number-container d-none d-lg-inline">
                        <span class="how-to-number rounded-circle position-absolute">2</span>
                    </span>
                    <div class="wrap ps-6">
                        <h4 class="m-0 text-color">Cari pekerjaan</h4>
                        <p class="text-muted">Telusuri pekerjaan impianmu <a href="{{ route('portal.index') }}" class="underlined">di sini</a>.</p>
                    </div>
                </div>
                <div class="position-relative how-step wrap pe-0 pe-lg-5 pb-3">
                    <span class="position-relative text-center number-container d-none d-lg-inline">
                        <span class="how-to-number rounded-circle position-absolute">3</span>
                    </span>
                    <div class="wrap ps-6">
                        <h4 class="m-0 text-color">Lakukan pelamaran</h4>
                        <p class="text-muted">Lengkapi biodatamu, dan mulailah melamar!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <img src="{{ asset('img/idea.webp') }}" alt="Logo" class="img-fluid">
            </div>
        </div>
    </div>
</section>