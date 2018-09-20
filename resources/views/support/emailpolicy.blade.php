@extends('layouts.XX')
@section('content')
<div class="fixed-navbar-container">
    <div class="container">
        <div class="container">
            <div class="row">
                <h4>
                    <ol class="breadcrumb">
                        <li><a href="https://portal.ridgetec.com">Home</a></li>
                        <li class="active">Email Policy</li>
                    </ol>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Our Email Policy</h2>
            <p>
                All emails used by this site, supplied by you, must be confirmed via email with confirmation link click.
                This means that when you register for a new account, the server will send you an email and you must click the verify button before you can log in.
            </p>
            <p>
                As an account owner, if you add email addresses to your account for friends, family, etc, then those addresses must also be verified.
                At the time you input an email address into email setup in your Account, the server will send a verification link to that email address.
                Before the site will send any emails to that address, the user owning the address must confirm it by clicking the verification button in the
                email received.
            </p>
            <p>
                If you do not receive the verification email, check your spam folder in your email client.  Tell your email client that correspondence from Ridgetec is "not spam" or "not junk".
                If the emails are blocked by your internet provider, or corporate mail server, then you will need to "white list" emails from our domain, or request from IT/Support that emails
                from our domain be allowed to go through.
            </p>

            <h2>Email Bounces</h2>
            <p>
                An email bounce occurs when our server attempts to send to a verified/confirmed email yet the email is not delivered and is returned-to-sender, or "bounces" back to our server.
                In this case your email will be temporarily "blocked" in our system.  It is your responsibility to work with your internet providers or IT departments and whitelist our domain,
                so that you can receive emails.  Because of the thousands of email addresses we are working with, not only do we not have the resources to work with each email provider to get
                your email "working", but we can't tolerate bounces on our system because of the monetary cost as well as internet reputation.
            </p>
            <p>
                In order for our domain and server to remain in good standing with email providers, we can't be considered a "spammer".  This means we must take the neccessary precautions,
                including blocking emails that bounce, in order to keep our reputation in good standing with vendors we cooperate with/license services from.
            </p>
            <p>
                If your email has been blocked or you suspect it has been blocked, then use the Opt-in page to once again verify your email.  Click the button on this page to request the Opt-in page.
                If after completing the Opt-in you do not receive the email verification, then it is your responsibility to work with your IT department or email provider to "white list" our domain or to allow
                emails from our domain to pass on to you.  Until you receive the confirmation/verification email your emails will not be delivered from our server.
            </p>
            <h2>We do care</h2>
            <p>
                <strong>We will always try our best to help you and we hope you understand our email policy and philosophy presented here.</strong>
            </p>
        </div>
        <div class="col-md-6">
            <h2>Opt-in to receive emails from our site</h2>
            <p>If you have opted out of email receipts or did not get the confirmation email, then click this button to get started</p>
            <a class="btn btn-md btn-primary" href="/email/optin">Email Opt-in page</a>

            <h2>Opt-out to stop getting emails from our site</h2>
            <p>If you wish to no longer receive emails from our site then click the button below</p>
            <a class="btn btn-md btn-primary" href="/email/optout">Email Opt-out page</a>
        </div>
    </div>
    <hr>
</div>
@stop