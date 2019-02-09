<hr>

<!-- <p>
    Need to Register for a new account? <br/>

        <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
</p> -->

<p>
    {{ trans('htc.dont_you_have_an_account') }}
    <a href="{{ route('register') }}"> {{ trans('htc.create_new_account') }}</a>
</p>

<p>
    {{ trans('htc.did_you') }} <a href="{{ route('password.request') }}">{{ trans('htc.forget_your_password') }}</a>
</p>

<p>
    {{ trans('htc.you_already_have_an_account_an_need_to') }}
    <a href="{{ route('confirm.send') }}">{{ trans('htc.resend_confirmation_email') }}</a>
</p>