<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="{{ asset('img/selena.webp') }}" alt="{{ config('app.name') }}" width="257" height="69">
{{-- ![SELENA]({{ asset('img/selena.webp') }} "SELENA") --}}
{{-- {{ config('app.name') }} --}}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
{{ config('app.name') }} &copy; {{ date('Y') }}
{{-- @lang('All rights reserved.') --}}
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>