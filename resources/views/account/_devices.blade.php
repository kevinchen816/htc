<div class="tab-pane fade" id="remote">
    <form method="POST" action="https://portal.ridgetec.com/account/remote" accept-charset="UTF-8" class="form-horizontal" role="form" id="mobile-apps-form">
    {{ csrf_field() }}
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Mobile Devices
                    <span class="pull-right"><button class="btn btn-xs btn-primary" type="submit">Save Changes</button></span>
                </h4>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Device Info</th>
                                <th>Confirmed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan=3>
                                    <i class="fa fa-dot-circle" style="color:lime;"> </i>Android 7.1.2 Xiaomi MI 5X -77/1.1.4<br />
                                    <span style="color:yellowgreen;">Last Active: 09/04/2018 6:48:03 pm</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notifications</button>
                                        <input type="checkbox" class="hidden camera-select" name="sendnotify[]" value="77"  checked  />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Heartbeat Only</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonreport[]" value="77"   />
                                    </span>
                                </td>

                                <td>
                                    Yes
                                    <a href="/account/mobilerevoke/77" class="btn btn-xs btn-warning"><i class="fa fa-times-circle"> </i> Block now</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
