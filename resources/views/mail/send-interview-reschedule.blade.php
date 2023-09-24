@component('mail::message')
# Halo, {{ $data['candidate_name'] }}!

**Sesi Wawancara** untuk posisi **{{ $data['position'] }}** berhasil dijadwalkan ulang pada:

@component('mail::table')
|    |      |
|----|------|
| **Hari/Tanggal** | {{ $data['interview_date'] }} |
| **Waktu** | {{ $data['interview_time'] }} WIB |
| **Tipe** | {{ $data['interview_type'] }} |
@if($data['interview_type'] == 'Online')
| **Tautan** | [Buka tautan]({{ $data['interview_location'] }}) |
@else
| **Lokasi** | <span style="word-break:break-all;">{{ $data['interview_location'] }}</span> |
@endif
@endcomponent

@isset($data['description'])
{!! html_entity_decode(stripslashes($data['description'])) !!}
<br>
@endisset

----

<div style="text-align: center; margin: auto; width: 100%;">
@component('mail::button', ['url' => route('home.scheduleResponse', [$data['id'], 1]), 'color' => 'primary', 'style' => 'margin: auto;'])
	Terima
@endcomponent
@component('mail::button', ['url' => route('home.scheduleResponse', [$data['id'], 2]), 'color' => 'error', 'style' => 'margin: auto;'])
	Tolak
@endcomponent
</div>

----

<font size="1">**Perhatian!** Mohon berikan jawaban Anda sebelum tanggal sesi wawancara yang ditentukan.</font>
{{-- @component('mail::subcopy') --}}
{{-- **Perhatian!** Mohon berikan jawaban Anda sebelum tanggal sesi wawancara yang ditentukan. --}}
{{-- @endcomponent --}}
@endcomponent