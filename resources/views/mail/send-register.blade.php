@component('mail::message')
# Halo, {{ $data['email'] }}
Silakan menuju tautan berikut untuk mendaftar: [{{ route('register.createInternal', $data['hash']) }}]({{ route('register.createInternal', $data['hash']) }}), tautan terkait akan kedaluwarsa dalam 60 menit.
<br>
Salam hangat,
<br>
{{ config('app.name') }}
@endcomponent