<form method="POST" action="{{ route('camera.settings') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="camerasettings-form{{ $camera->id }}">
    {{ csrf_field() }}
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
                    {!! $cc->Settings_Identification($camera) !!}
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
                    {!! $cc->Settings_Basic($camera) !!}
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
                    {!! $cc->Settings_Trigger($camera) !!}

                    <div class="panel panel-default panel-success custom-settings-panel">
                        <div class="panel-heading">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
@if ($camera->timelapse == 'on')
                                <input type="checkbox" class="hidden" name="{{ $camera->id }}_timelapse" id="{{ $camera->id }}_timelapse" checked  />
@else
                                <input type="checkbox" class="hidden" name="{{ $camera->id }}_timelapse" id="{{ $camera->id }}_timelapse"/>
@endif
                            </span>
                            Time Lapse
                        </div>
                        <div class="panel-body" id="panel-{{ $camera->id }}-timelapse">
                            @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                            {!! $cc->Settings_Timelapse($camera) !!}
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
                    {!! $cc->Settings_Wireless_Mode($camera) !!}
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
                    {!! $cc->Settings_Block_Mode($camera) !!}
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
@if ($camera->dutytime == 'on')
                        <input type="checkbox" class="hidden" name="{{ $camera->id }}_dutytime" id="{{ $camera->id }}_dutytime" checked />
@else
                        <input type="checkbox" class="hidden" name="{{ $camera->id }}_dutytime" id="{{ $camera->id }}_dutytime" />
@endif
                        <!-- <input type="checkbox" name="54_dutytime" id="54_dutytime"   /> -->
                    </span>
                    Duty Time/Hours of operation
                </div>
                <div class="panel-body">
                    <div id="duty-tabs-{{ $camera->id }}" class="tab-set mobile-nopadding-nomargin" >
                        <a class="btn btn-xs btn-info duty-time-button" style="color:#fff" id="Togglebutton{{ $camera->id }}-on">Check All</a>
                        <a class="btn btn-xs btn-info duty-time-button" style="color:#fff" id="Togglebutton{{ $camera->id }}-off">Check None</a>

                        <ul class="tab-headers" style="font-size: .80em;">
                            <li><a href="#tabs{{ $camera->id }}-1">Sunday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-2">Monday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-3">Tuesday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-4">Wednesday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-5">Thursday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-6">Friday</a></li>
                            <li><a href="#tabs{{ $camera->id }}-7">Saturday</a></li>
                        </ul>

                        @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                        {!! $cc->Settings_DutyTime($camera) !!}

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
        function initremotecontrolcontainer(id) { // not used
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

        $('#{{ $camera->id }}_region').on('change', function() {
            val = this.value;
            //alert(val);
            //$.getJSON("/data/timezones/" + val, function(j) {
            $.getJSON("/data/timezones/"+val+".json", function(j) {
                var options = '';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
                }
                //alert($("#54_timezone"));

                //$("#54_timezone").html(options);
                $("#{{ $camera->id }}_timezone").empty().append(options);
            })
        });

        $('#{{ $camera->id }}_camera_mode').on('change', function() {
            val = this.value;
            if (val == 'p') {
                $('#field-wrapper-{{ $camera->id }}-photo_resolution').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-photo_resolution').show(250);
                $('#field-wrapper-{{ $camera->id }}-upload_resolution').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-upload_resolution').show(250);
                $('#field-wrapper-{{ $camera->id }}-photo_quality').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-photo_quality').show(250);
                $('#field-wrapper-{{ $camera->id }}-photo_burst').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-photo_burst').show(250);
                $('#field-wrapper-{{ $camera->id }}-burst_delay').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-burst_delay').show(250);
                $('#field-wrapper-{{ $camera->id }}-video_resolution').hide(250);
                $('#field-wrapper-{{ $camera->id }}-video_fps').hide(250);
                $('#field-wrapper-{{ $camera->id }}-video_bitrate').hide(250);
                $('#field-wrapper-{{ $camera->id }}-video_length').hide(250);
                $('#field-wrapper-{{ $camera->id }}-video_sound').hide(250);
            } else {
                $('#field-wrapper-{{ $camera->id }}-photo_resolution').hide(250);
                $('#field-wrapper-{{ $camera->id }}-upload_resolution').hide(250);
                $('#field-wrapper-{{ $camera->id }}-photo_quality').hide(250);
                $('#field-wrapper-{{ $camera->id }}-photo_burst').hide(250);
                $('#field-wrapper-{{ $camera->id }}-burst_delay').hide(250);
                $('#field-wrapper-{{ $camera->id }}-video_resolution').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-video_resolution').show(250);
                $('#field-wrapper-{{ $camera->id }}-video_fps').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-video_bitrate').removeClass('hidden');
                //$('#field-wrapper-{{ $camera->id }}-video_rate').show(250);
                $('#field-wrapper-{{ $camera->id }}-video_bitrate').show(250);
                $('#field-wrapper-{{ $camera->id }}-video_length').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-video_length').show(250);
                $('#field-wrapper-{{ $camera->id }}-video_sound').removeClass('hidden');
                $('#field-wrapper-{{ $camera->id }}-video_sound').show(250);
            }
        });

        $('#{{ $camera->id }}_wireless_mode').on('change', function() {
          val = this.value;
          if (val == 'schedule') {
              $('#field-wrapper-{{ $camera->id }}-wm_schedule').show(250);
              $('#field-wrapper-{{ $camera->id }}-wm_sclimit').show(250);
          }
          else {
              $('#field-wrapper-{{ $camera->id }}-wm_schedule').hide(250);
              $('#field-wrapper-{{ $camera->id }}-wm_sclimit').hide(250);
          }
        });

        // not used
        $('#{{ $camera->id }}_remotecontrol').on('change', function() {
          val = this.value;
          if (val == 'range') {
              $('#panel-{{ $camera->id }}-remotecontrol').show();
              $('#{{ $camera->id }}_rc_start').val('00:00');
              $('#{{ $camera->id }}_rc_stop').val('23:59');
          }
          else {
              $('#panel-{{ $camera->id }}-remotecontrol').hide();
                $('#{{ $camera->id }}_rc_start').val("off");
                $('#{{ $camera->id }}_rc_stop').val("off");
          }
        });

        $('#{{ $camera->id }}_dutytime').change(function() {
            val = $(this).prop('checked');
            if (val) {
              $("#duty-tabs-{{ $camera->id }}").show(500);
            }
            else {
              $("#duty-tabs-{{ $camera->id }}").hide(500);
            };
        })

        $('#{{ $camera->id }}_timelapse').change(function() {
            val = $(this).prop('checked');
            if (val) {
                $("#panel-{{ $camera->id }}-timelapse").show(250);
                $('#{{ $camera->id }}_tls_start').val('00:00');
                $('#{{ $camera->id }}_tls_stop').val('23:59');
                $('#{{ $camera->id }}_tls_interval').val('5m');
            }
            else {
                $("#panel-{{ $camera->id }}-timelapse").hide(250);
                $('#{{ $camera->id }}_tls_start').val("off");
                $('#{{ $camera->id }}_tls_stop').val("off");
                $('#{{ $camera->id }}_tls_interval').val("off");
            };
        })

        $( "#Togglebutton{{ $camera->id }}-on" ).click(function() {
          $('.custom-time-button').prop('checked', true).change()
        });

        $( "#Togglebutton{{ $camera->id }}-off" ).click(function() {
          $('.custom-time-button').prop('checked', false).change()
        });

        // show hide duty time tables
        $("#duty-tabs-{{ $camera->id }}").tabs();

        // first time through set duty time container visibility
        initdutytimecontainer({{ $camera->id }});
        inittimelapsecontainer({{ $camera->id }});
        initremotecontrolcontainer({{ $camera->id }}); // not used

        // TODO
        val = $("#{{ $camera->id }}_camera_mode").val();
        if (val == 'p') {
            $('#field-wrapper-{{ $camera->id }}-photo_resolution').show(0);
            $('#field-wrapper-{{ $camera->id }}-photo_burst').show(0);
            $('#field-wrapper-{{ $camera->id }}-burst_delay').show(0);
            $('#field-wrapper-{{ $camera->id }}-upload_resolution').show(0);
            $('#field-wrapper-{{ $camera->id }}-photo_quality').show(0);

            $('#field-wrapper-{{ $camera->id }}-video_resolution').hide(0);
            $('#field-wrapper-{{ $camera->id }}-video_fps').hide(0);
            $('#field-wrapper-{{ $camera->id }}-video_bitrate').hide(0);
            $('#field-wrapper-{{ $camera->id }}-video_length').hide(0);
            $('#field-wrapper-{{ $camera->id }}-video_sound').hide(0);
        }
        else {
            $('#field-wrapper-{{ $camera->id }}-photo_resolution').hide(0);
            $('#field-wrapper-{{ $camera->id }}-photo_burst').hide(0);
            $('#field-wrapper-{{ $camera->id }}-burst_delay').hide(0);
            $('#field-wrapper-{{ $camera->id }}-upload_resolution').hide(0);
            $('#field-wrapper-{{ $camera->id }}-photo_quality').hide(0);

            $('#field-wrapper-{{ $camera->id }}-video_resolution').show(0);
            $('#field-wrapper-{{ $camera->id }}-video_fps').show(0);
            $('#field-wrapper-{{ $camera->id }}-video_bitrate').show(0);
            $('#field-wrapper-{{ $camera->id }}-video_length').show(0);
            $('#field-wrapper-{{ $camera->id }}-video_sound').show(0);
        }

        // show/hide wireless schedule
        val = $("#{{ $camera->id }}_wireless_mode").val();
        if (val == 'schedule') {
            $('#field-wrapper-{{ $camera->id }}-wm_schedule').show();
            $('#field-wrapper-{{ $camera->id }}-wm_sclimit').show();
        }
        else {
            $('#field-wrapper-{{ $camera->id }}-wm_schedule').hide();
            $('#field-wrapper-{{ $camera->id }}-wm_sclimit').hide();
        }
    });
</script>
