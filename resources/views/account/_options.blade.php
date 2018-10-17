<!--<div class="tab-pane fade " id="security">-->
    <div class="col-md-6">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Account Options</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="https://portal.ridgetec.com/account/options" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
                    {{ csrf_field() }}
                    <label class="col-md-4 control-label" for="inputSmall">Date Format</label>
                    <div class="col-md-8">
                        <select date_format class="bs-select form-control input-sm"   name="date_format"><option value="m%2Fd%2FY+g%3Ai%3As+a" selected="selected">MM/DD/YYYY HH:MM:SS AM/PM (12 hours)</option><option value="m%2Fd%2FY+H%3Ai%3As">MM/DD/YYYY HH:MM:SS (24 hours)</option><option value="Y%2Fm%2Fd+g%3Ai%3As+a">YYYY/MM/DD HH:MM:SS AM/PM (12 hours)</option><option value="Y%2Fm%2Fd+H%3Ai%3As">YYYY/MM/DD HH:MM:SS (24 hours)</option><option value="d%2Fm%2FY+g%3Ai%3As+a">DD/MM/YYYY HH:MM:SS AM/PM (12 hours)</option><option value="d%2Fm%2FY+H%3Ai%3As">DD/MM/YYYY HH:MM:SS (24 hours)</option></select>
                    </div>

                    <label class="col-md-4 control-label" for="inputSmall">High-Res Gallery Thumbs</label>
                    <div class="col-md-8" style="padding-top:16px;">
                        <span class="button-checkbox">
                            <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                            <input type="checkbox" class="hidden" name="gallery_highres" id="gallery_highres"   />
                        </span>
                        <div class="help-block">
                            <p>Note: Selecting High-Res will cause your thumbnail gallery to load slower, but the thumbs will look better with fewer columns.
                            If you want the gallery to load faster (or use less of your data on a mobile device) do not check this option.</p>
                            <p><strong>The Default reccomended is Unchecked.</strong></p>
                        </div>
                    </div>
                    <div class="pull-right"><button type="submit" class="btn btn-success btn-xs">Save</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
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
                        <a href="/account/sendreset" class="btn btn-xs btn-success">Send Password Reset Email</a>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <p> </p>
                    </div>
                </div>

                <div class="row">
                    <form method="POST" action="https://portal.ridgetec.com/account/email-change" accept-charset="UTF-8" class="form-horizontal" role="form" id="profile-emailchange-form">
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
    </div>
<!--</div>-->
