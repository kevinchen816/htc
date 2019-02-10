<!--<div class="tab-pane fade" id="remote">-->
    <form method="POST" action="{{ route('account.devices') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="mobile-apps-form">
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
                                <!-- <th>Confirmed</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            @inject('ac', 'App\Http\Controllers\AccountsController')
                            {!! $ac->html_Devices() !!}
                            {!! $ac->html_Devices() !!}
                            <tr>
                                <td colspan=3>
                                    <i class="fa fa-dot-circle" style="color:lime;"> </i> Android 7.1.2 Xiaomi MI 5X - 77/1.1.4<br />
                                    <span style="color:yellowgreen;">Last Active: 2019/01/17 22:40:32</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Send Notifications</button>
                                        <input type="checkbox" class="hidden camera-select" name="sendnotify[]" value="77"  checked  />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Heartbeat</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonreport[]" value="77"   />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Upload</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonupload[]" value="77"  checked  />
                                    </span>
                                </td>

                                <td>
                                    <a href="/account/mobileconfirm/77" class="btn btn-xs btn-success">Confirm now</a>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=3>
                                    <i class="fa fa-dot-circle" style="color:lime;"> </i> Android 8.1.0 Xiaomi MI 8 SE - 617/1.1.4<br />
                                    <span style="color:yellowgreen;">Last Active: 2019/01/18 03:02:45</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Send Notifications</button>
                                        <input type="checkbox" class="hidden camera-select" name="sendnotify[]" value="617"  checked  />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Heartbeat</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonreport[]" value="617"  checked  />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Upload</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonupload[]" value="617"  checked  />
                                    </span>
                                </td>

                                <td>
                                    Yes
                                    <a href="/account/mobilerevoke/617" class="btn btn-xs btn-warning"><i class="fa fa-times-circle"> </i> Block now</a>
                                    <a href="/account/mobileremove/617" class="btn btn-xs btn-danger"><i class="fa fa-trash"> </i> Remove</a>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=3>
                                    <i class="fa fa-dot-circle" style="color:lime;"> </i> Android 7.1.2 Xiaomi MI 5X -
                                    77/1.1.4<br />
                                    <span style="color:yellowgreen;">Last Active: 2019/01/18 22:38:27</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Send Notifications</button>
                                        <input type="checkbox" class="hidden camera-select" name="sendnotify[]" value="77"  checked  />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Heartbeat</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonreport[]" value="77"   />
                                    </span>
                                    <span class="button-checkbox">
                                        <button type="button" class="btn btn-default btn-xs" data-color="info">Notify on Upload</button>
                                        <input type="checkbox" class="hidden camera-select" name="notifyonupload[]" value="77"  checked  />
                                    </span>
                                </td>

                                <td>
                                    <a href="/account/mobileinstate/77" class="btn btn-xs btn-success"><i class="fa fa-times-circle"> </i> Unblock</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
<!--</div>-->
