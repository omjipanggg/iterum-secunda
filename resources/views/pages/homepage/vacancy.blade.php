<div id="vacancies"></div>
<section id="list-of-vacancy">
    <div class="w-100 bg-brighter-color py-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <h2 class="section-title">
                            <a href="#vacancies" class="dotted">Lowongan Pekerjaan</a>
                        </h2>
                        <p class="section-subtitle text-muted">Telusuri dan lamar pekerjaan impianmu di sini</p>
                    </div>
                </div>
            </div>
            <div class="row pt-6 hr-top position-relative">
                <div class="col-lg-8 offset-lg-2">
                    <div class="d-flex flex-column gap-4 vacancy-container">
                        @forelse ($vacancies as $vacancy)
                        <div class="card vacancy-item pointer" onclick="window.location.href = '{{ route('portal.show', $vacancy->slug) }}';">
                            <div class="card-body position-relative py-4">
                                <div class="row">
                                    <div class="col-12 d-block d-lg-none">
                                        <span class="badge text-bg-color order-2 order-lg-1">
                                            {{ $vacancy->type->name }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-lg-4 align-self-center">
                                        <div class="wrap py-3 py-lg-0">
                                            <h4 class="fw-semibold mb-0">
                                                <a href="{{ route('portal.show', $vacancy->slug) }}" class="dotted">
                                                    {{ $vacancy->name }}
                                                </a>
                                            </h4>
                                            @if (!$vacancy->hidden_partner)
                                                <p class="text-muted m-0">
                                                    {{ $vacancy->project->partner->name }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 align-self-center">
                                        @if (!$vacancy->hidden_placement)
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ $vacancy->placement }}
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-2 align-self-center">
                                        @if(!$vacancy->hidden_salary)
                                            <i class="bi bi-cash-coin me-1"></i>
                                            {{ 'Rp' . money_indo_format($vacancy->min_limit) }}&mdash;{{ 'Rp' . money_indo_format($vacancy->max_limit) }}
                                        @endif
                                    </div>
                                    <div class="col-lg-2 offset-lg-1 d-none d-lg-flex flex-wrap justify-content-lg-end">
                                        <div class="d-flex flex-wrap flex-column justify-content-between align-items-end">
                                            <span class="badge text-bg-color py-1 px-2">
                                                {{ $vacancy->type->name }}
                                            </span>
                                            <div class="my-3"></div>
                                            <div class="wrap"><i class="bi bi-people-fill me-1"></i>{{ $vacancy->candidates_count }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="wrap">
                                        <i class="bi bi-clock me-1"></i>
                                        Dipublikasikan sejak {{ $vacancy->published_at->locale('id')->diffForHumans() }}
                                    </div>
                                    <a href="{{ route('portal.show', $vacancy->slug) }}" class="btn btn-sm btn-color px-3">
                                        Rincian
                                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                    {{-- {{ date_indo_format($vacancy->closing_date) }} --}}
                                    {{--
                                    <p class="m-0 dotted">
                                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </p>
                                    --}}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="m-0 text-center">Tidak ada data.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center py-4">
                    <a href="{{ route('portal.index') }}" class="btn btn-lg btn-color rounded-0 px-4">
                        Telusuri Lowongan Lainnya
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>