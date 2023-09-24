<div class="mt-3"></div>
<footer class="bg-light mt-auto shadow-lg">
    <div class="container-fluid px-12">
        <div class="h-48 d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex flex-wrap small">
                <a href="{{ route('dashboard.faq') }}" class="dotted pe-2">Bantuan</a>&middot;<a href="{{ route('dashboard.report') }}" class="dotted ps-2" onclick="underMaintenance(event);">Laporkan</a>
            </div>
            <small class="small m-0 text-muted">{{ config('app.name') }} &copy; {{ date('Y') }}</small>
        </div>
    </div>
</footer>