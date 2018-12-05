<!--<div class="tab-pane fade" id="email-setup" style="padding-top: 10px;">-->
    <form method="POST" action="{{ route('account.emails') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emails-form">
        {{ csrf_field() }}

        <div class="row">
            <div class="well well-sm">
                <button type="submit" class="btn btn-sm btn-primary">Save All Changes</button>
            </div>
        </div>
        <div class="row">
            @inject('ac', 'App\Http\Controllers\AccountsController')
            {!! $ac->html_EmailSetup() !!}
        </div>
    </form>
<!--</div>-->
