<!--<div class="tab-pane fade " id="security">-->
    <div class="col-md-6">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Account Options</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('account.options') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
                    {{ csrf_field() }}
                    <label class="col-md-4 control-label" for="inputSmall">Date Format</label>
                    <div class="col-md-8">
                        <select date_format class="bs-select form-control input-sm" name="date_format">
                            @inject('ac', 'App\Http\Controllers\AccountsController')
                            {!! $ac->html_DateFormat() !!}
                        </select>
                        <button type="submit" class="btn btn-success btn-xs">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--     <div class="col-md-6">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Security Options
                    <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="security-options"><i class="fa fa-question"></i></a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label pull-right" for="inputSmall">Password Reset</label>
                    </div>
                    <div class="col-md-7">
                        <a href="{{ route('account.password-send-reset-email') }}" class="btn btn-xs btn-success">Send Password Reset Email</a>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <p> </p>
                    </div>
                </div>

                <div class="row">
                    <form method="POST" action="{{ route('account.email-change') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
                        {{ csrf_field() }}
                        <input name="current-email" type="hidden" value="kevin@10ware.com">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email inputSmall">Change Email</label>
                            <div class="col-md-7">
                                <input type="text" name="email" maxlength="70" id="email" class="form-control input-sm" placeholder="Input New Email">
                                <button type="submit" class="btn btn-success btn-xs" name="email-change" value="update">Send Email Change request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
<!--</div>-->
