@component('mail::message')
    # Hello!

    You are receiving this email because we received a password reset request for your account.

    @component('mail::button', ['url' => url('/api/reset/password/'.$data['token'])])
        Reset Password
    @endcomponent

    This password reset link will expire in 60 minutes.<br>
    <br>
    If you did not request a password reset, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
    <hr>
    If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{url('/api/reset/password/'.$data['token'])}}">{{url('/api/reset/password/'.$data['token'])}}</a>
@endcomponent
