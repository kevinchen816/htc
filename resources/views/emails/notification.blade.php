@extends('emails.layout')

@section('content')
<h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;">
    <p>
        {{ trans('htc.email_notification', ['portal' => env('APP_NAME'), 'user_name' => $user_name, 'object' => $object]) }}
    </p>
</h1>

<p style="font-size: 16px; color: #FF0000; line-height: 1.5em;">
    {{ $message_txt }}<br>
</p>

<p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
    {{ trans('htc.DO NOT REPLY TO THIS EMAIL.') }}
</p>
@endsection