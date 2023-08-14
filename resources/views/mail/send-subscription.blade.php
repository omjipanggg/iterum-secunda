@component('mail::message')
# Halo, {{ $email }}
Terima kasih sudah berlangganan!
<br>
<font size="1"><a href="{{ route('home.unsubscribe', $email) }}" style="text-decoration: none;">Berhenti berlangganan</a></font>
@endcomponent