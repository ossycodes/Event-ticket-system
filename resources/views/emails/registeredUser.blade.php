@component('mail::message')
# Introduction

Dear {{$user->name}}, thanks for signing up with  email of {{$user->email}}, 
keep up with all the latest events happening today.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/events'])
LATEST EVENTS
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent