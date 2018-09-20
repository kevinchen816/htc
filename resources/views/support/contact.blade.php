@extends('layouts.XX')
@section('content')
<div class="fixed-navbar-container">
    <div class="container">
        <div class="container">
            <div class="row">
                <h4>
                    <ol class="breadcrumb">
                        <li><a href="https://portal.ridgetec.com">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ol>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('support.contact') }}" accept-charset="UTF-8" id="contactForm">
                {{ csrf_field() }}

            <div class="row">
                <div class="form-group ">
                    <div class="col-md-6">
                        <label>Your name *</label>
                        <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group ">
                    <div class="col-md-6">
                        <label>Your email address *</label>
                        <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group ">
                    <div class="col-md-6">
                        <label>Your Phone Number</label>
                        <input type="text" value="" data-msg-required="Please enter your Phone Number." data-msg-email="Please enter a valid Phone Number." maxlength="100" class="form-control" name="phone" id="phone">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Your Camera Module ID (optional)</label>
                        <input type="text" value="" maxlength="100" class="form-control" name="moduleid" id="moduleid">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Your Camera ICCID (optional)</label>
                        <input type="text" value="" maxlength="100" class="form-control" name="iccid" id="iccid">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Subject *</label>
                        <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group ">
                    <div class="col-md-12">
                        <label>Message *</label>
                        <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="msg" id="msg" required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 20px; margin-bottom: 20px;">Send Message</button>
                </div>
            </div>

            </form>

        </div>

        <div class="col-md-6">
            <h4 class="push-top">Get in <strong>touch</strong></h4>
            <p>Please allow our friendly staff to assist you.</p>
            <hr />

            <h4>The <strong>Office</strong></h4>
            <ul class="list-unstyled">
                <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:xxx@xxxx.xxx">xxx@xxxx.xxx</a></li>
                <li><i class="fa fa-phone"></i> <strong>Phone: x-xxx-xxx-xxxx</strong></li>
            </ul>
            <hr />

            <h4>Business <strong>Hours</strong></h4>
            <ul class="list-unstyled">
                <li><i class="fa fa-time"></i> Monday - Friday 8:30am to 4:30pm MST</li>
                <li><i class="fa fa-time"></i> Saturday - Sunday - Closed</li>
            </ul>
            <hr />
        </div>
    </div>
</div>
@stop