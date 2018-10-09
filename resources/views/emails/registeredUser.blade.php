@component('mail::message')
# Introduction

Dear $user->name, thanks for signing up, stay in touch with the latest events happening inn your area.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent