@component('mail::message')
# Dear {{$userName}}

The event with name of {{$ticketName}} with id of {{$ticketId}} and unique reference of {{$ticketReference}} was successfully purchased at a price of {{$ticketAmount}} Naira.

Thanks,<br>

<a href="{{$url}}">View on Dashboard</a>

{{ config('app.name') }}
@endcomponent
