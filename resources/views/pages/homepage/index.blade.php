@extends('layouts.app')
@section('title', 'Home')
@section('content')
@include('components.navbar')
<section id="patria">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-flex flex-column align-items-center justify-content-center order-lg-1 order-2 mb-lg-31">
                <h4 class="fw-bold display-6 text-center">Wujudkan Pekerjaan Impianmu Bersama <abbr class="text-color" title="Selection &amp; Recruitment Alihdaya">{{ config('app.name', 'SELENA') }}™</abbr></h4>
                <p class="text-center">Kirimkan CV Anda, dan lamar pekerjaan di sini!</p>
                <form action="{{ route('portal.index') }}" method="POST" class="w-100 mt-12">
                    @csrf
                    <div class="input-group w-100 d-flex">
                        <div class="position-relative flex-fill">
                            <i class="bi bi-briefcase icon-floating position-absolute"></i>
                            <input type="text" class="form-control ps-8 py-3" name="keyword" autocomplete="off" placeholder="Pencarian" id="query">
                            <label for="query" class="visually-hidden">Pencarian</label>
                        </div>
                        <button type="submit" class="btn btn-color px-4">
                            {{ __('Telusuri') }}
                            <i class="bi bi-search ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex align-items-center order-lg-2 order-1">
                <img src="{{ asset('img/browse.webp') }}" alt="Browse" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section id="list-of-vacancy">
    <div class="w-100 bg-brighter-color py-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <h2 class="section-title">
                            <a href="{{ route('portal.index') }}" class="dotted">Lowongan Pekerjaan</a>
                        </h2>
                        <p class="section-subtitle text-muted">Terlusuri dan lamar pekerjaan impianmu di sini</p>
                    </div>
                </div>
            </div>

            <div class="row py-6 hr-top">
                <div class="col">
                    <div class="d-flex vacancy-container flex-column flex-lg-row gap-4">
                        <div class="card vacancy-item">
                            <div class="card-body">
                                <div class="text-justify">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia nihil quos excepturi accusantium in praesentium eos aspernatur suscipit impedit, eum voluptas id facilis eaque nisi fugiat vero laboriosam reiciendis odio perspiciatis cupiditate veritatis ullam autem neque provident? Inventore nobis facere ipsa, modi ab deleniti odit voluptates accusantium magni esse eum cum omnis labore nesciunt cumque libero voluptas adipisci, dolores dolor molestiae. Quam minus quas totam molestiae veniam numquam voluptatibus, consectetur necessitatibus maxime repellendus ad sint tempore ipsam. Odit facere, obcaecati expedita atque voluptate explicabo molestiae nisi labore? Accusantium fugiat deserunt repudiandae in explicabo a ipsam, quibusdam, adipisci porro sapiente illo!
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <i class="bi bi-clock me-2"></i>
                                Dipublikasikan: 2 hari yang lalu
                            </div>
                        </div>
                        <div class="card vacancy-item">
                            <div class="card-body">
                                <div class="text-justify">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia nihil quos excepturi accusantium in praesentium eos aspernatur suscipit impedit, eum voluptas id facilis eaque nisi fugiat vero laboriosam reiciendis odio perspiciatis cupiditate veritatis ullam autem neque provident? Inventore nobis facere ipsa, modi ab deleniti odit voluptates accusantium magni esse eum cum omnis labore nesciunt cumque libero voluptas adipisci, dolores dolor molestiae. Quam minus quas totam molestiae veniam numquam voluptatibus, consectetur necessitatibus maxime repellendus ad sint tempore ipsam. Odit facere, obcaecati expedita atque voluptate explicabo molestiae nisi labore? Accusantium fugiat deserunt repudiandae in explicabo a ipsam, quibusdam, adipisci porro sapiente illo!
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <i class="bi bi-clock me-2"></i>
                                Dipublikasikan: 2 hari yang lalu
                            </div>
                        </div>
                        <div class="card vacancy-item">
                            <div class="card-body">
                                <div class="text-justify">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia nihil quos excepturi accusantium in praesentium eos aspernatur suscipit impedit, eum voluptas id facilis eaque nisi fugiat vero laboriosam reiciendis odio perspiciatis cupiditate veritatis ullam autem neque provident? Inventore nobis facere ipsa, modi ab deleniti odit voluptates accusantium magni esse eum cum omnis labore nesciunt cumque libero voluptas adipisci, dolores dolor molestiae. Quam minus quas totam molestiae veniam numquam voluptatibus, consectetur necessitatibus maxime repellendus ad sint tempore ipsam. Odit facere, obcaecati expedita atque voluptate explicabo molestiae nisi labore? Accusantium fugiat deserunt repudiandae in explicabo a ipsam, quibusdam, adipisci porro sapiente illo!
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <i class="bi bi-clock me-2"></i>
                                Dipublikasikan: 2 hari yang lalu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
