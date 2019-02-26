@extends('emails.layout')

@section('content')
<h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;">
    <p>
        {{ trans('htc.email_photo', ['portal' => env('APP_NAME'), 'user_name' => $user_name, 'camera_name' => $camera_name]) }}
    </p>
</h1>

<p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
    {{ trans('htc.DO NOT REPLY TO THIS EMAIL.') }}
</p>

<p>
    <a href=""  target="_blank">
        <img src="{{ $message->embed($imgPath) }}">
    </a>
</p>
@endsection