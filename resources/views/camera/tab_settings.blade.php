<form method="POST" action="{{ route('camera.settings') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="camerasettings-form{{ $camera->id }}">
    {{ csrf_field() }}
    <!-- <input name="_token" type="hidden" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl"> -->
    <input name="id" type="hidden" value="{{ $camera->id }}">

    <div class="row">
        <div class="col-md-12">
            <span class="pull-right" style="margin-top:20px;padding-right:10px;padding-bottom:8px;">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save All Changes</button>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Camera Identification
                </div>
                <div class="panel-body">
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_Settings_Camera_Identification($camera) !!}

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="inputSmall">Camera Region</label>
                        <div class="col-md-7">
                            <select id="{{ $camera->id }}_country" class="bs-select form-control input-sm" name="54_country">
                                <option value="USA">United States</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                                <option value="CN" selected="selected">China</option>
                                <option value="EU">Europe</option>
                            </select>
                            <span class="help-block"> Select the country where the camera is located. </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="inputSmall">Time Zone</label>
                        <div class="col-md-7">
                            <select id="{{ $camera->id }}_timezone" class="bs-select form-control input-sm"   name="{{ $camera->id }}_timezone">
                                <option value="Asia/Hong_Kong" selected="selected">Hong_Kong</option>
                            </select>
                            <span class="help-block"> Select the time zone where the camera is located. </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Notifications
                    <span class="pull-right">
                        <a href="/account/profile-emails" class="btn btn-xs btn-primary">
                            <i class="fa fa-gear"></i> Manage Addresses
                        </a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Send Mobile Push Notifications</button>
                                <input type="checkbox" class="hidden" name="push_notifications" id="push_notifications" checked />
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">kevin@10ware.com</button>
                                <input type="checkbox" class="hidden" name="54_email_owner" id="54_email_owner" checked />
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    High Activity Suppression
                    <!--<a class="btn btn-info btn-xs ToggleHelp pull-right" help-id="activity-suppression"><i class="fa fa-question"></i></a>-->
                    <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="activity-suppression">
                        <i class="fa fa-question"></i>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Use Activity Suppression</button>
                                <input type="checkbox" class="hidden" name="54_bw_option" id="54_bw_option"   />
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label" for="inputSmall">Average Uploads per Hour</label>
                        <div class="col-md-5">
                            <input type="text" name="54_bw_medias_hour_est" maxlength="30" value="0" id="54_bw_medias_hour_est" class="form-control input-sm" placeholder="Input Ceiling Rate">
                            <span class="help-block"> Reccomended: set Quiet Time from 5s to 30s</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!--
    <div class="row">
        <div class="col-md-6">
            <p> </p>
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Control Settings
                </div>
                <div class="panel-body">
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_Settings_Control_Settings($camera) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Trigger Settings
                </div>
                <div class="panel-body">
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_Settings_Trigger_Settings($camera) !!}

                    <div class="panel panel-default panel-success custom-settings-panel">
                        <div class="panel-heading">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                                <input type="checkbox" class="hidden" name="54_timelapse" id="54_timelapse" checked  />
                            </span>
                            Time Lapse
                        </div>
                        <div class="panel-body" id="panel-54-timelapse">
                            @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                            {!! $cc->Camera_Settings_Time_Lapse($camera) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Wireless Settings
                </div>
                <div class="panel-body">
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_Settings_Wireless_Settings($camera) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    Block Mode Settings (Kevin Test)
                </div>
                <div class="panel-body">
                    @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                    {!! $cc->Camera_Settings_Block_Mode_Settings($camera) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    <!--<input type="checkbox"   data-size="normal" class="tog" name="dutytime_54" id="dutytime_54" data-toggle="toggle" data-on="Enabled" data-off="Disabled"> Duty Time/Hours of operation-->
                    <span class="button-checkbox">
                        <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                        <input type="checkbox" class="hidden" name="54_dutytime" id="54_dutytime"   />
                        <!-- <input type="checkbox" name="54_dutytime" id="54_dutytime"   /> -->
                    </span>
                    Duty Time/Hours of operation
                </div>
                <div class="panel-body">
                    <div id="duty-tabs-54" class="tab-set mobile-nopadding-nomargin" >
                        <a class="btn btn-xs btn-info duty-time-button" style="color:#fff" id="Togglebutton54-on">Check All</a>
                        <a class="btn btn-xs btn-info duty-time-button" style="color:#fff" id="Togglebutton54-off">Check None</a>

                        <ul class="tab-headers" style="font-size: .80em;">
                            <li><a href="#tabs54-1">Sunday</a></li>
                            <li><a href="#tabs54-2">Monday</a></li>
                            <li><a href="#tabs54-3">Tuesday</a></li>
                            <li><a href="#tabs54-4">Wednesday</a></li>
                            <li><a href="#tabs54-5">Thursday</a></li>
                            <li><a href="#tabs54-6">Friday</a></li>
                            <li><a href="#tabs54-7">Saturday</a></li>
                        </ul>

                        <div id="tabs54-1">
                            <div id="controlgroup54-1" class="mobile-dutytime-div">
                                <table>
                                    <tr>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <!-- <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked /> -->
                                        </span>
                                        </td>

                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_2" id="54_hour_1_2"  checked />
                                        </span>
                                        </td>

                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_3" id="54_hour_1_3"  checked />
                                        </span>
                                        </td>

                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_4" id="54_hour_1_4"  checked />
                                        </span>
                                        </td>

                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_5" id="54_hour_1_5"  checked />
                                        </span>
                                        </td>

                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_6" id="54_hour_1_6"  checked />
                                        </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_7" id="54_hour_1_7"  checked />
                                        </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_8" id="54_hour_1_8"  checked />
                                        </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_9" id="54_hour_1_9"  checked />
                                        </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_10" id="54_hour_1_10"  checked />
                                        </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_11" id="54_hour_1_11"  checked />
                                        </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_12" id="54_hour_1_12"  checked />
                                        </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_13" id="54_hour_1-13"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_14" id="54_hour_1-14"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_15" id="54_hour_1-15"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_16" id="54_hour_1-16"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_17" id="54_hour_1-17"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_18" id="54_hour_1-18"  checked />
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_19" id="54_hour_1-19"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_20" id="54_hour_1-20"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_21" id="54_hour_1-21"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_22" id="54_hour_1-22"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_23" id="54_hour_1-23"  checked />
                                            </span>
                                        </td>
                                        <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_24" id="54_hour_1-24"  checked />
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div id="tabs54-2">
                            <div id="controlgroup54-2" class="mobile-dutytime-div">
                                                        <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_1" id="54_hour_2_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_2" id="54_hour_2_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_3" id="54_hour_2_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_4" id="54_hour_2_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_5" id="54_hour_2_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_6" id="54_hour_2_6"  checked />
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_7" id="54_hour_2_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_8" id="54_hour_2_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_9" id="54_hour_2_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_10" id="54_hour_2_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_11" id="54_hour_2_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_12" id="54_hour_2_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_13" id="54_hour_2-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_14" id="54_hour_2-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_15" id="54_hour_2-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_16" id="54_hour_2-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_17" id="54_hour_2-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_18" id="54_hour_2-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_19" id="54_hour_2-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_20" id="54_hour_2-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_21" id="54_hour_2-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_22" id="54_hour_2-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_23" id="54_hour_2-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_2_24" id="54_hour_2-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                        <div id="tabs54-3">
                            <div id="controlgroup54-3" class="mobile-dutytime-div">
                                                        <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_1" id="54_hour_3_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_2" id="54_hour_3_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_3" id="54_hour_3_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_4" id="54_hour_3_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_5" id="54_hour_3_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_6" id="54_hour_3_6"  checked />
                                        </span>
                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_7" id="54_hour_3_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_8" id="54_hour_3_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_9" id="54_hour_3_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_10" id="54_hour_3_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_11" id="54_hour_3_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_12" id="54_hour_3_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_13" id="54_hour_3-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_14" id="54_hour_3-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_15" id="54_hour_3-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_16" id="54_hour_3-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_17" id="54_hour_3-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_18" id="54_hour_3-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_19" id="54_hour_3-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_20" id="54_hour_3-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_21" id="54_hour_3-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_22" id="54_hour_3-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_23" id="54_hour_3-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_3_24" id="54_hour_3-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                        <div id="tabs54-4">
                            <div id="controlgroup54-4" class="mobile-dutytime-div">
                                <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_1" id="54_hour_4_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_2" id="54_hour_4_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_3" id="54_hour_4_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_4" id="54_hour_4_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_5" id="54_hour_4_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_6" id="54_hour_4_6"  checked />
                                        </span>
                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_7" id="54_hour_4_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_8" id="54_hour_4_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_9" id="54_hour_4_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_10" id="54_hour_4_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_11" id="54_hour_4_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_12" id="54_hour_4_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_13" id="54_hour_4-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_14" id="54_hour_4-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_15" id="54_hour_4-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_16" id="54_hour_4-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_17" id="54_hour_4-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_18" id="54_hour_4-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_19" id="54_hour_4-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_20" id="54_hour_4-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_21" id="54_hour_4-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_22" id="54_hour_4-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_23" id="54_hour_4-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_4_24" id="54_hour_4-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                        <div id="tabs54-5">
                            <div id="controlgroup54-5" class="mobile-dutytime-div">
                                                        <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_1" id="54_hour_5_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_2" id="54_hour_5_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_3" id="54_hour_5_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_4" id="54_hour_5_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_5" id="54_hour_5_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_6" id="54_hour_5_6"  checked />
                                        </span>
                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_7" id="54_hour_5_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_8" id="54_hour_5_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_9" id="54_hour_5_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_10" id="54_hour_5_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_11" id="54_hour_5_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_12" id="54_hour_5_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_13" id="54_hour_5-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_14" id="54_hour_5-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_15" id="54_hour_5-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_16" id="54_hour_5-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_17" id="54_hour_5-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_18" id="54_hour_5-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_19" id="54_hour_5-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_20" id="54_hour_5-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_21" id="54_hour_5-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_22" id="54_hour_5-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_23" id="54_hour_5-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_5_24" id="54_hour_5-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                        <div id="tabs54-6">
                            <div id="controlgroup54-6" class="mobile-dutytime-div">
                                                        <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_1" id="54_hour_6_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_2" id="54_hour_6_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_3" id="54_hour_6_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_4" id="54_hour_6_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_5" id="54_hour_6_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_6" id="54_hour_6_6"  checked />
                                        </span>
                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_7" id="54_hour_6_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_8" id="54_hour_6_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_9" id="54_hour_6_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_10" id="54_hour_6_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_11" id="54_hour_6_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_12" id="54_hour_6_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_13" id="54_hour_6-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_14" id="54_hour_6-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_15" id="54_hour_6-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_16" id="54_hour_6-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_17" id="54_hour_6-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_18" id="54_hour_6-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_19" id="54_hour_6-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_20" id="54_hour_6-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_21" id="54_hour_6-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_22" id="54_hour_6-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_23" id="54_hour_6-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_6_24" id="54_hour_6-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                        <div id="tabs54-7">
                            <div id="controlgroup54-7" class="mobile-dutytime-div">
                                                        <table>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_1" id="54_hour_7_1"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">01 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_2" id="54_hour_7_2"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">02 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_3" id="54_hour_7_3"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">03 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_4" id="54_hour_7_4"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">04 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_5" id="54_hour_7_5"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">05 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_6" id="54_hour_7_6"  checked />
                                        </span>
                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">06 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_7" id="54_hour_7_7"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">07 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_8" id="54_hour_7_8"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">08 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_9" id="54_hour_7_9"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">09 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_10" id="54_hour_7_10"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">10 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_11" id="54_hour_7_11"  checked />
                                        </span>
                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                        <span class="button-checkbox" style="font-size: .80em;">
                                            <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">11 AM</button>
                                            <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_12" id="54_hour_7_12"  checked />
                                        </span>
                                        </td>
                                                            </tr>
                                    <tr>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">12 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_13" id="54_hour_7-13"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">01 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_14" id="54_hour_7-14"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">02 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_15" id="54_hour_7-15"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">03 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_16" id="54_hour_7-16"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">04 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_17" id="54_hour_7-17"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">05 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_18" id="54_hour_7-18"  checked />
                                            </span>

                                        </td>
                                                            </tr><tr>                                <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">06 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_19" id="54_hour_7-19"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">07 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_20" id="54_hour_7-20"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">08 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_21" id="54_hour_7-21"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">09 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_22" id="54_hour_7-22"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">10 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_23" id="54_hour_7-23"  checked />
                                            </span>

                                        </td>
                                                                                            <td class="custom-time-toggle-td">
                                            <span class="button-checkbox" style="font-size: .80em;">
                                                <button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">11 PM</button>
                                                <input type="checkbox" class="hidden custom-time-button" name="54_hour_7_24" id="54_hour_7-24"  checked />
                                            </span>

                                        </td>
                                                            </tr>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <span class="pull-right" style="margin-top:20px;padding-right:10px;">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save All Changes</button>
            </span>
        </div>
    </div>
</form>

<div id="activity-suppression" class="hidden">
    <div class="alert alert-sm alert-info help-container">
                <h4>
            <strong><i class="fa fa-info-circle"></i> How Activity Suppression works</strong>
        </h4>
        <h5>
            <strong>Wireless Mode must be set to <strong>Instant</strong> in order to use Activity Suppression</strong>
        </h5>
        <ul>
            <li><strong>Applies only to Motion based activity, not Time Lapse</strong></li>
            <li>The system keeps a moving average of uploads in 5 minutes increments over the last hour</li>
            <li>At any time the actual moving average becomes <strong>higher</strong> than your inputted Average Uploads/Hour, it begins to slowly increase quiet time</li>
            <li>It will advance your quiet time setting to the next higher setting every 10 minutes until the 5 min average is below your specified average</li>
            <li>As activity slows, the reverse will happen</li>
            <li>It will reduce quiet time in increments each 10 minutes back to your original quiet time</li>
            <li>This does not limit the number of photos in an hour, rather it slows down prolonged high rates of activity (hours)</li>
        </ul>
        <hr>
        <h4>
            <strong>What are the benefits?</strong>
        </h4>
        <p>
            It means you are free to leave the Quiet Time setting at a lower value maximizing the capture of motion events.
            This means you are not playing games all day micromanaging your quiet time to reduce upload frequencies.
        </p>
        <p>
            Example:  Should a storm blow in and prolonged winds cause your camera to "run away" with motion events,
            the system will continue raising your quiet time sustaining your average per hour.  The system is not
            literally limiting to a certain number of photos per hour initially.  Instead it becomes a governor that slows down motion uploads
            during prolonged high rates.
        </p>
        <hr>

        <h4><strong>The Goals:</strong></h4>
        <p>Reduce the need to micromanage your camera quiet time while
            maximizing capture during periodic motion periods by keeping quiet time low.</p>


    </div>
</div>

<script>
    $(document).ready(function(){
        function initremotecontrolcontainer(id) {
            val = $('#' + id + '_remotecontrol').val();

            if (val == 'range') {
                $('#panel-' + id + '-remotecontrol').show();
            }
            else {
                $('#panel-' + id + '-remotecontrol').hide();
            }
        };

        function initdutytimecontainer(id) {
            val = $('#' + id + '_dutytime').prop('checked');
            if (!val) {
              $('#duty-tabs-' + id).hide();
            }
            else {
                $('#duty-tabs-' + id).show();
            }
        }

        function inittimelapsecontainer(id) {
            val = $('#' + id + '_timelapse').prop('checked');
            if (!val) {
              $('#panel-' + id + '-timelapse').hide();
            }
            else {
              $('#panel-' + id + '-timelapse').show();
            }
        }

        $('#54_country').on('change', function() {
            val = this.value;
            //alert(val);
            $.getJSON("/data/timezones/" + val, function(j) {
                var options = '';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                }
                //alert($("#54_timezone"));

                //$("#54_timezone").html(options);
                $("#54_timezone").empty().append(options);
            })
        });

        $('#54_cameramode').on('change', function() {
            val = this.value;
            if (val == 'p') {
                $('#field-wrapper-54-photoresolution').removeClass('hidden');
                $('#field-wrapper-54-photoresolution').show(250);
                $('#field-wrapper-54-upload_resolution').removeClass('hidden');
                $('#field-wrapper-54-upload_resolution').show(250);
                $('#field-wrapper-54-photo_quality').removeClass('hidden');
                $('#field-wrapper-54-photo_quality').show(250);
                $('#field-wrapper-54-photoburst').removeClass('hidden');
                $('#field-wrapper-54-photoburst').show(250);
                $('#field-wrapper-54-burst_delay').removeClass('hidden');
                $('#field-wrapper-54-burst_delay').show(250);
                $('#field-wrapper-54-video_resolution').hide(250);
                $('#field-wrapper-54-video_rate').hide(250);
                $('#field-wrapper-54-video_bitrate').hide(250);
                $('#field-wrapper-54-video_length').hide(250);
                $('#field-wrapper-54-video_sound').hide(250);
            } else {
                $('#field-wrapper-54-photoresolution').hide(250);
                $('#field-wrapper-54-upload_resolution').hide(250);
                $('#field-wrapper-54-photo_quality').hide(250);
                $('#field-wrapper-54-photoburst').hide(250);
                $('#field-wrapper-54-burst_delay').hide(250);
                $('#field-wrapper-54-video_resolution').removeClass('hidden');
                $('#field-wrapper-54-video_resolution').show(250);
                $('#field-wrapper-54-video_rate').removeClass('hidden');
                $('#field-wrapper-54-video_bitrate').removeClass('hidden');
                $('#field-wrapper-54-video_rate').show(250);
                $('#field-wrapper-54-video_bitrate').show(250);
                $('#field-wrapper-54-video_length').removeClass('hidden');
                $('#field-wrapper-54-video_length').show(250);
                $('#field-wrapper-54-video_sound').removeClass('hidden');
                $('#field-wrapper-54-video_sound').show(250);
            }
        });

        $('#54_wireless_mode').on('change', function() {
          val = this.value;
          if (val == 'schedule') {
              $('#field-wrapper-54-wm_schedule').show(250);
              $('#field-wrapper-54-wm_sclimit').show(250);
          }
          else {
              $('#field-wrapper-54-wm_schedule').hide(250);
              $('#field-wrapper-54-wm_sclimit').hide(250);
          }
        });

        $('#54_remotecontrol').on('change', function() {
          val = this.value;
          if (val == 'range') {
              $('#panel-54-remotecontrol').show();
              $('#54_rc_start').val('00:00');
              $('#54_rc_stop').val('23:59');
          }
          else {
              $('#panel-54-remotecontrol').hide();
                $('#54_rc_start').val("off");
                $('#54_rc_stop').val("off");
          }
        });

        $('#54_dutytime').change(function() {
            val = $(this).prop('checked');
            if (val) {
              $("#duty-tabs-54").show(500);
            }
            else {
              $("#duty-tabs-54").hide(500);
            };
        })

        $('#54_timelapse').change(function() {
            val = $(this).prop('checked');
            if (val) {
                $("#panel-54-timelapse").show(250);
                $('#54_tls_start').val('00:00');
                $('#54_tls_stop').val('23:59');
                $('#54_tls_interval').val('5m');
            }
            else {
                $("#panel-54-timelapse").hide(250);
                $('#54_tls_start').val("off");
                $('#54_tls_stop').val("off");
                $('#54_tls_interval').val("off");
            };
        })

        $( "#Togglebutton54-on" ).click(function() {
          $('.custom-time-button').prop('checked', true).change()
        });

        $( "#Togglebutton54-off" ).click(function() {
          $('.custom-time-button').prop('checked', false).change()
        });

        // show hide duty time tables
        $("#duty-tabs-54").tabs();

        // first time through set duty time container visibility
        initdutytimecontainer(54);
        inittimelapsecontainer(54);
        initremotecontrolcontainer(54);

        // val = $("#54_cameramode").val();

        // if (val == 'p') {
        //     $('#field-wrapper-54-photoresolution').show(0);
        //     $('#field-wrapper-54-upload_resolution').show(0);
        //     $('#field-wrapper-54-video_resolution').hide(0);
        //     $('#field-wrapper-54-video_rate').hide(0);
        //     $('#field-wrapper-54-video_length').hide(0);
        //     $('#field-wrapper-54-video_sound').hide(0);
        // }
        // else {
        //     $('#field-wrapper-54-photoresolution').hide(0);
        //     $('#field-wrapper-54-upload_resolution').hide(0);
        //     $('#field-wrapper-54-video_resolution').show(0);
        //     $('#field-wrapper-54-video_rate').show(0);
        //     $('#field-wrapper-54-video_length').show(0);
        //     $('#field-wrapper-54-video_sound').show(0);
        // }

        // show/hide wireless schedule
        val = $("#54_wireless_mode").val();
        if (val == 'schedule') {
            $('#field-wrapper-54-wm_schedule').show();
            $('#field-wrapper-54-wm_sclimit').show();
        }
        else {
            $('#field-wrapper-54-wm_schedule').hide();
            $('#field-wrapper-54-wm_sclimit').hide();
        }
    });
</script>
