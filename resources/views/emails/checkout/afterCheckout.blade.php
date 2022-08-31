@component('mail::message')
# Register Camp: {{ $checkout->camp->title }}

Hi, {{ $checkout->user->name }}
<br>
Thankyou for register on <b>{{ $checkout->camp->title }}</b>, please check the payment intruction by clicking this button below.

@component('mail::button', ['url' => route('user.dashboard')])
My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
