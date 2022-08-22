@component('mail::message')
# Welcome !!

Hi, {{ $user->name }}!.
<br>
Welcome to Laracamp, your account has been successfully registered. Now you can choose the best match camp!.

@component('mail::button', ['url' => route('login')])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
