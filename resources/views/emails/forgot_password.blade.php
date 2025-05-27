@component('mail::message')

Hi, {{ $user->name }}. Forgot Password?$_COOKIE
<p>It Happens.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password 
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent