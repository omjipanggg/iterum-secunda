@component('mail::message')
# Halo, {{ $data['candidate_name'] }}!

Selamat, Anda dinyatakan **LOLOS** dari serangkaian tahap seleksi penerimaan kerja dengan rincian sebagai berikut:

@component('mail::table')
|            |                         |
|------------|-------------------------|
| **Posisi** | {{ $data['position'] }} |
| **Kota Penempatan** | {{ $data['placement'] }} |
| **Gaji Pokok** | {{ $data['first_salary'] }} |
| **Tunjangan Tetap** | {{ $data['second_salary'] }} |
| **Tgl. Mulai Kontrak** | {{ $data['starting_date'] }} |
| **Tgl. Akhir Kontrak** | {{ $data['ending_date'] }} |
@endcomponent

----

<div style="text-align: center; margin: auto; width: 100%;">
@component('mail::button', ['url' => route('home.offeringResponse', [$data['id'], 1]), 'color' => 'primary', 'style' => 'margin: auto;'])
	Terima
@endcomponent
@component('mail::button', ['url' => route('home.offeringResponse', [$data['id'], 2]), 'color' => 'error', 'style' => 'margin: auto;'])
	Tolak
@endcomponent
</div>

----

<font size="1">**Perhatian!** Mohon berikan jawaban Anda sebelum tanggal {{ $data['expired_at'] }} 23:59:59 WIB.</font>
@endcomponent