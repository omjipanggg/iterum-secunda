<div class="mt-3"></div>
<footer class="py-3 bg-light mt-auto shadow-lg">
    <div class="container-fluid px-12">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="wrap">
                <a href="{{ route('dashboard.faq') }}" class="dotted pe-2">Bantuan</a>&middot;<a href="{{ route('home.report') }}" class="dotted ps-2" onclick="underMaintenance(event);">Laporkan</a>
            </div>
            <div class="text-muted">{{ config('app.name') }} &copy; {{ date('Y') }}</div>
        </div>
    </div>
</footer>