@component('mail::message')
# Dear {{ $userName }}

Thanks For your feedback, we would get back to you shortly.

@component('mail::button', ['url' => ''])
CinemaXXI
@endcomponent

Thanks,<br>
@endcomponent
