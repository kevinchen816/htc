<hr>

<!-- <p>
    Need to Register for a new account? <br/>

        <a class="btn btn-primary" href="{{ route('register') }}" role="button">Register</a>
</p> -->

<p>
    Don't you have an account yet ?
    <a href="{{ route('register') }}"> Create New Account</a>
</p>

<p>
    Did you <a href="{{ route('password.request') }}">Forget Your Password ?</a>
</p>

<p>
    You already have an account and need to
    <a href="{{ route('confirm.send') }}">Resend Confirmation Email.</a>
</p>
