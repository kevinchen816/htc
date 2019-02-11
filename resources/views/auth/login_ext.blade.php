<hr>

<!-- <p>
    Need to Register for a new account? <br/>

        <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
</p> -->

<p>
    {{ trans('htc.dont_you_have_an_account') }}
    <a href="{{ route('register') }}"> {{ trans('htc.Create New Account') }}</a>
</p>

<p>
    {{ trans('htc.did_you') }} <a href="{{ route('password.request') }}">{{ trans('htc.Forget Your Password') }}</a>
</p>

<p>
    {{ trans('htc.you_already_have_an_account_an_need_to') }}
    <a href="{{ route('confirm.send') }}">{{ trans('htc.Resend Confirmation Email') }}</a>
</p>