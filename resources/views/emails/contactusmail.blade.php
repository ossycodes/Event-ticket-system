@component('mail::message')
# Dear {{ $data->name }}

Thanks For your feedback, we would get back to you shortly.

@component('mail::button', ['url' => ''])
Events XXI
@endcomponent

Thanks,<br>
Yourdomain.com
@endcomponent
