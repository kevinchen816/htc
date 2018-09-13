

                            <!-- SETTINGS TAB -->
                            <div class="tab-pane fade  " id="settings-54">
                                <form method="POST" action="http://www.ridgetec.us/cameras/settings" accept-charset="UTF-8" class="form-horizontal" role="form" id="camerasettings-form54"><input name="_token" type="hidden" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">

<input name="id" type="hidden" value="54">


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
            <div class="panel-heading">Camera Identification
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputSmall">Camera Description</label>
                    <div class="col-md-7">
                        <input type="text" name="54_camera_desc" maxlength="30" value="Truphone #1" id="54_camera_desc" class="form-control input-sm" placeholder="Input Camera Description">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputSmall">Camera Location</label>
                    <div class="col-md-7">
                        <input type="text" name="54_camera_loc" maxlength="30" value="" id="54_camera_loc" class="form-control input-sm" placeholder="Input Camera Location">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputSmall">Camera Region</label>
                    <div class="col-md-7">
                        <select id="54_country" class="bs-select form-control input-sm"   name="54_country"><option value="USA">United States</option><option value="CA">Canada</option><option value="AU">Australia</option><option value="CN" selected="selected">China</option><option value="EU">Europe</option></select>
                            <span class="help-block"> Select the country where the camera is located. </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputSmall">Time Zone</label>
                    <div class="col-md-7">
                        <select id="54_timezone" class="bs-select form-control input-sm"   name="54_timezone"><option value="Asia/Hong_Kong" selected="selected">Hong_Kong</option></select>
                            <span class="help-block"> Select the time zone where the camera is located. </span>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-md-6">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">Notifications
                                <span class="pull-right"><a href="/account/profile-emails" class="btn btn-xs btn-primary"><i class="fa fa-gear"></i> Manage Addresses</a></span>
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
            <div class="panel-heading">High Activity Suppression
                <!--<a class="btn btn-info btn-xs ToggleHelp pull-right" help-id="activity-suppression"><i class="fa fa-question"></i></a>-->
                <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="activity-suppression"><i class="fa fa-question"></i></a>
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

<div class="row">
    <div class="col-md-6">
        <p> </p>
    </div>
</div>


<div class="row">

    <div class="col-md-6">

    <div class="panel panel-default panel-primary custom-settings-panel">
        <div class="panel-heading">Control Settings
        </div>
        <div class="panel-body">




                        <div class="form-group " id="field-wrapper-54-cameramode">

                            <label class="col-md-4 control-label" for="inputSmall">Camera Mode</label>

                                                        <div class="col-md-7">
                                <select id="54_cameramode" class="bs-select form-control input-sm"   name="54_cameramode"><option value="p" selected="selected">Photo</option><option value="v">Video</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-photoresolution">

                            <label class="col-md-4 control-label" for="inputSmall">Photo Resolution</label>

                                                        <div class="col-md-7">
                                <select id="54_photoresolution" class="bs-select form-control input-sm"   name="54_photoresolution"><option value="4" selected="selected">4MP 16:9</option><option value="6">6MP 16:9</option><option value="8">8MP 16:9</option><option value="12">12MP 16:9</option></select>
                                                                    <span class="help-block"> Use this setting to control the size of the Photo saved on the SD Card. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group  hidden" id="field-wrapper-54-video_resolution">

                            <label class="col-md-4 control-label" for="inputSmall">Video Resolution</label>

                                                        <div class="col-md-7">
                                <select id="54_video_resolution" class="bs-select form-control input-sm"   name="54_video_resolution"><option value="8" selected="selected">Standard Low</option><option value="9">Standard Medium</option><option value="10">Standard High</option><option value="11">High Def</option></select>
                                                                    <span class="help-block"> This determines the frame size of the video in pixels, or how wide it is when viewed on your computer monitor. A higher resolution means the video file saved to the SD card is larger and when uploaded uses more battery and costs more image points from your data plan, but it will have more detail on the other hand. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group  hidden" id="field-wrapper-54-video_rate">

                            <label class="col-md-4 control-label" for="inputSmall">Capture Rate</label>

                                                        <div class="col-md-7">
                                <select id="54_video_rate" class="bs-select form-control input-sm"   name="54_video_rate"><option value="4" selected="selected">4fps</option><option value="6">6fps</option><option value="8">8fps</option><option value="10">10fps</option><option value="12">12fps</option><option value="15">15fps</option><option value="30">30fps</option></select>
                                                                    <span class="help-block"> Capture rate does not affect the size of the video file captured or reduce the points used to upload to the portal. A lower frame rate in low motion will improve the quality of each frame while motion blur may increase. A faster frame rate may reduce motion blur when there is higher motion and may reduce the image quality of each frame. Every environment is different. Please experiment to find the right value for your environment and needs. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group  hidden" id="field-wrapper-54-video_bitrate">

                            <label class="col-md-4 control-label" for="inputSmall">Quality Level</label>

                                                        <div class="col-md-7">
                                <select id="54_video_bitrate" class="bs-select form-control input-sm"   name="54_video_bitrate"><option value="300">1 (default/smallest)</option><option value="400">2</option><option value="500" selected="selected">3</option><option value="600">4</option><option value="700">5</option><option value="800">6</option><option value="900">7</option><option value="1000">8 (balanced)</option><option value="1200">9</option><option value="1400">10</option><option value="1800">11</option><option value="2500">12 (High)</option><option value="5000">13 (Maximum/LARGE!)</option></select>
                                                                    <span class="help-block"> Use quality level to control the image quality for each frame in the video.  A higher value will increase quality while also increasing the size of the file captured.  If you frequently make video upload requests you may want a lower quality in order to minimize image points used in your data plan. There is no set quality level for a particular application.  Please experiment with video quality to achieve an acceptable balance for your environment and budget. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->




                        <div class="form-group  hidden" id="field-wrapper-54-video_length">

                            <label class="col-md-4 control-label" for="inputSmall">Video Duration</label>

                                                        <div class="col-md-7">
                                <select id="54_video_length" class="bs-select form-control input-sm"   name="54_video_length"><option value="2s">2s</option><option value="3s">3s</option><option value="4s">4s</option><option value="5s" selected="selected">5s</option><option value="6s">6s</option><option value="7s">7s</option><option value="8s">8s</option><option value="9s">9s</option><option value="10s">10s</option></select>
                                                                    <span class="help-block"> Note: The longer the duration, the larger the video file will be if uploaded to the portal. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group  hidden" id="field-wrapper-54-video_sound">

                            <label class="col-md-4 control-label" for="inputSmall">Video Sound</label>

                                                        <div class="col-md-7">
                                <select id="54_video_sound" class="bs-select form-control input-sm"   name="54_video_sound"><option value="on" selected="selected">On</option><option value="off">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-photoburst">

                            <label class="col-md-4 control-label" for="inputSmall">Photo Burst</label>

                                                        <div class="col-md-7">
                                <select id="54_photoburst" class="bs-select form-control input-sm"   name="54_photoburst"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option></select>
                                                                    <span class="help-block"> Photo Burst is used to set the number of photos captured per event in Photo Mode.  It is not used for Video mode.  If Cellular mode is ON, then the camera will upload each photo of the burst to the portal. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-burst_delay">

                            <label class="col-md-4 control-label" for="inputSmall">Burst Delay</label>

                                                        <div class="col-md-7">
                                <select id="54_burst_delay" class="bs-select form-control input-sm"   name="54_burst_delay"><option value="250">250ms</option><option value="500" selected="selected">500ms</option><option value="1000">1s</option><option value="3000">3s</option></select>
                                                                    <span class="help-block"> The Burst Delay is the elapsed time between each burst photo. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-upload_resolution">

                            <label class="col-md-4 control-label" for="inputSmall">Upload Resolution</label>

                                                        <div class="col-md-7">
                                <select id="54_upload_resolution" class="bs-select form-control input-sm"   name="54_upload_resolution"><option value="1" selected="selected">Standard Low</option><option value="2">Standard Medium</option><option value="3">Standard High</option><option value="4">High Def</option></select>
                                                                    <span class="help-block"> Use this setting to control the size of the uploaded thumbnail. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-photo_quality">

                            <label class="col-md-4 control-label" for="inputSmall">Upload Quality</label>

                                                        <div class="col-md-7">
                                <select id="54_photo_quality" class="bs-select form-control input-sm"   name="54_photo_quality"><option value="1" selected="selected">Standard</option><option value="2">Medium</option><option value="3">High</option></select>
                                                                    <span class="help-block"> Use this setting to control the image quality and size of the uploaded thumbnail. A higher quality means clearer images but larger file sizes when uploaded to the portal. Use a Photo quality that best meets your application and budget. [Standard] quality will reduce the size and cost to upload each photo to the portal and is generally good enough for most applications.  Keep in mind that you can request a High-res Max or the Original file from the SD card when/if you need it for more detail on this particular photo event. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->

                            <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-timestamp">

                            <label class="col-md-4 control-label" for="inputSmall">Time Stamp</label>

                                                        <div class="col-md-7">
                                <select id="54_timestamp" class="bs-select form-control input-sm"   name="54_timestamp"><option value="on" selected="selected">On</option><option value="off">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-date_format">

                            <label class="col-md-4 control-label" for="inputSmall">Date Format</label>

                                                        <div class="col-md-7">
                                <select id="54_date_format" class="bs-select form-control input-sm"   name="54_date_format"><option value="mdY">mdY</option><option value="Ymd" selected="selected">Ymd</option><option value="dmY">dmY</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-time_format">

                            <label class="col-md-4 control-label" for="inputSmall">Time Format</label>

                                                        <div class="col-md-7">
                                <select id="54_time_format" class="bs-select form-control input-sm"   name="54_time_format"><option value="12">12 Hour</option><option value="24" selected="selected">24 Hour</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-temperature">

                            <label class="col-md-4 control-label" for="inputSmall">Temperature</label>

                                                        <div class="col-md-7">
                                <select id="54_temperature" class="bs-select form-control input-sm"   name="54_temperature"><option value="f">Fahrenheit</option><option value="c" selected="selected">Celsius</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

        <!-- for each $tokens -->

      </div>

  </div>

  </div>




    <div class="col-md-6">

    <div class="panel panel-default panel-primary custom-settings-panel">
        <div class="panel-heading">Trigger Settings
        </div>
        <div class="panel-body">



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-quiettime">

                            <label class="col-md-4 control-label" for="inputSmall">Quiet Time</label>

                                                        <div class="col-md-7">
                                <select id="54_quiettime" class="bs-select form-control input-sm"   name="54_quiettime"><option value="0s" selected="selected">0s</option><option value="5s">5s</option><option value="10s">10s</option><option value="15s">15s</option><option value="20s">20s</option><option value="25s">25s</option><option value="30s">30s</option><option value="35s">35s</option><option value="40s">40s</option><option value="45s">45s</option><option value="50s">50s</option><option value="55s">55s</option><option value="1m">1m</option><option value="2m">2m</option><option value="3m">3m</option><option value="4m">4m</option><option value="5m">5m</option><option value="10m">10m</option><option value="15m">15m</option><option value="20m">20m</option><option value="25m">25m</option><option value="30m">30m</option><option value="35m">35m</option><option value="40m">40m</option><option value="45m">45m</option><option value="50m">50m</option><option value="55m">55m</option><option value="60m">60m</option></select>
                                                                    <span class="help-block"> Quiet Time is a delay after the current event is complete (photo or video). It can be used to reduce the number of PIR events in a given time.  If your camera is taking too many photos or videos, then increase the quiet time to reduce the frequency of PIR (motion) activations.  PIR or motion capture, as well as Time Lapse capture is disabled while sleeping in the quiet time period. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->





                        <div class="panel panel-default panel-success custom-settings-panel">
                            <div class="panel-heading">
                                <span class="button-checkbox">
                                    <button type="button" class="btn btn-default btn-xs" data-color="info"></button>
                                    <input type="checkbox" class="hidden" name="54_timelapse" id="54_timelapse" checked  />
                                </span>

                                Time Lapse
                            </div>
                            <div class="panel-body" id="panel-54-timelapse">



                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-tls_start">

                            <label class="col-md-4 control-label" for="inputSmall">Timelapse Start Time</label>

                                                        <div class="col-md-7">
                                <select id="54_tls_start" class="bs-select form-control input-sm"   name="54_tls_start"><option value="00:00" selected="selected">00:00</option><option value="00:15">00:15</option><option value="00:30">00:30</option><option value="00:45">00:45</option><option value="01:00">01:00</option><option value="01:15">01:15</option><option value="01:30">01:30</option><option value="01:45">01:45</option><option value="02:00">02:00</option><option value="02:15">02:15</option><option value="02:30">02:30</option><option value="02:45">02:45</option><option value="03:00">03:00</option><option value="03:15">03:15</option><option value="03:30">03:30</option><option value="03:45">03:45</option><option value="04:00">04:00</option><option value="04:15">04:15</option><option value="04:30">04:30</option><option value="04:45">04:45</option><option value="05:00">05:00</option><option value="05:15">05:15</option><option value="05:30">05:30</option><option value="05:45">05:45</option><option value="06:00">06:00</option><option value="06:15">06:15</option><option value="06:30">06:30</option><option value="06:45">06:45</option><option value="07:00">07:00</option><option value="07:15">07:15</option><option value="07:30">07:30</option><option value="07:45">07:45</option><option value="08:00">08:00</option><option value="08:15">08:15</option><option value="08:30">08:30</option><option value="08:45">08:45</option><option value="09:00">09:00</option><option value="09:15">09:15</option><option value="09:30">09:30</option><option value="09:45">09:45</option><option value="10:00">10:00</option><option value="10:15">10:15</option><option value="10:30">10:30</option><option value="10:45">10:45</option><option value="11:00">11:00</option><option value="11:15">11:15</option><option value="11:30">11:30</option><option value="11:45">11:45</option><option value="12:00">12:00</option><option value="12:15">12:15</option><option value="12:30">12:30</option><option value="12:45">12:45</option><option value="13:00">13:00</option><option value="13:15">13:15</option><option value="13:30">13:30</option><option value="13:45">13:45</option><option value="14:00">14:00</option><option value="14:15">14:15</option><option value="14:30">14:30</option><option value="14:45">14:45</option><option value="15:00">15:00</option><option value="15:15">15:15</option><option value="15:30">15:30</option><option value="15:45">15:45</option><option value="16:00">16:00</option><option value="16:15">16:15</option><option value="16:30">16:30</option><option value="16:45">16:45</option><option value="17:00">17:00</option><option value="17:15">17:15</option><option value="17:30">17:30</option><option value="17:45">17:45</option><option value="18:00">18:00</option><option value="18:15">18:15</option><option value="18:30">18:30</option><option value="18:45">18:45</option><option value="19:00">19:00</option><option value="19:15">19:15</option><option value="19:30">19:30</option><option value="19:45">19:45</option><option value="20:00">20:00</option><option value="20:15">20:15</option><option value="20:30">20:30</option><option value="20:45">20:45</option><option value="21:00">21:00</option><option value="21:15">21:15</option><option value="21:30">21:30</option><option value="21:45">21:45</option><option value="22:00">22:00</option><option value="22:15">22:15</option><option value="22:30">22:30</option><option value="22:45">22:45</option><option value="23:00">23:00</option><option value="23:15">23:15</option><option value="23:30">23:30</option><option value="23:45">23:45</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-tls_stop">

                            <label class="col-md-4 control-label" for="inputSmall">Timelapse Stop Time</label>

                                                        <div class="col-md-7">
                                <select id="54_tls_stop" class="bs-select form-control input-sm"   name="54_tls_stop"><option value="00:00">00:00</option><option value="00:15">00:15</option><option value="00:30">00:30</option><option value="00:45">00:45</option><option value="01:00">01:00</option><option value="01:15">01:15</option><option value="01:30">01:30</option><option value="01:45">01:45</option><option value="02:00">02:00</option><option value="02:15">02:15</option><option value="02:30">02:30</option><option value="02:45">02:45</option><option value="03:00">03:00</option><option value="03:15">03:15</option><option value="03:30">03:30</option><option value="03:45">03:45</option><option value="04:00">04:00</option><option value="04:15">04:15</option><option value="04:30">04:30</option><option value="04:45">04:45</option><option value="05:00">05:00</option><option value="05:15">05:15</option><option value="05:30">05:30</option><option value="05:45">05:45</option><option value="06:00">06:00</option><option value="06:15">06:15</option><option value="06:30">06:30</option><option value="06:45">06:45</option><option value="07:00">07:00</option><option value="07:15">07:15</option><option value="07:30">07:30</option><option value="07:45">07:45</option><option value="08:00">08:00</option><option value="08:15">08:15</option><option value="08:30">08:30</option><option value="08:45">08:45</option><option value="09:00">09:00</option><option value="09:15">09:15</option><option value="09:30">09:30</option><option value="09:45">09:45</option><option value="10:00">10:00</option><option value="10:15">10:15</option><option value="10:30">10:30</option><option value="10:45">10:45</option><option value="11:00">11:00</option><option value="11:15">11:15</option><option value="11:30">11:30</option><option value="11:45">11:45</option><option value="12:00">12:00</option><option value="12:15">12:15</option><option value="12:30">12:30</option><option value="12:45">12:45</option><option value="13:00">13:00</option><option value="13:15">13:15</option><option value="13:30">13:30</option><option value="13:45">13:45</option><option value="14:00">14:00</option><option value="14:15">14:15</option><option value="14:30">14:30</option><option value="14:45">14:45</option><option value="15:00">15:00</option><option value="15:15">15:15</option><option value="15:30">15:30</option><option value="15:45">15:45</option><option value="16:00">16:00</option><option value="16:15">16:15</option><option value="16:30">16:30</option><option value="16:45">16:45</option><option value="17:00">17:00</option><option value="17:15">17:15</option><option value="17:30">17:30</option><option value="17:45">17:45</option><option value="18:00">18:00</option><option value="18:15">18:15</option><option value="18:30">18:30</option><option value="18:45">18:45</option><option value="19:00">19:00</option><option value="19:15">19:15</option><option value="19:30">19:30</option><option value="19:45">19:45</option><option value="20:00">20:00</option><option value="20:15">20:15</option><option value="20:30">20:30</option><option value="20:45">20:45</option><option value="21:00">21:00</option><option value="21:15">21:15</option><option value="21:30">21:30</option><option value="21:45">21:45</option><option value="22:00">22:00</option><option value="22:15">22:15</option><option value="22:30">22:30</option><option value="22:45">22:45</option><option value="23:00">23:00</option><option value="23:15">23:15</option><option value="23:30">23:30</option><option value="23:45">23:45</option><option value="23:59" selected="selected">23:59</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-tls_interval">

                            <label class="col-md-4 control-label" for="inputSmall">Timelapse Interval</label>

                                                        <div class="col-md-7">
                                <select id="54_tls_interval" class="bs-select form-control input-sm"   name="54_tls_interval"><option value="5m" selected="selected">5m</option><option value="10m">10m</option><option value="15m">15m</option><option value="20m">20m</option><option value="25m">25m</option><option value="30m">30m</option><option value="35m">35m</option><option value="40m">40m</option><option value="45m">45m</option><option value="50m">50m</option><option value="55m">55m</option><option value="1h">1h</option><option value="2h">2h</option><option value="4h">4h</option><option value="6h">6h</option><option value="8h">8h</option><option value="10h">10h</option><option value="12h">12h</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

        <!-- for each $tokens -->

            </div></div>
      </div>

  </div>

  </div>
</div>

<div class="row">

    <div class="col-md-6">

    <div class="panel panel-default panel-primary custom-settings-panel">
        <div class="panel-heading">Wireless Settings
        </div>
        <div class="panel-body">



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-wireless_mode">

                            <label class="col-md-4 control-label" for="inputSmall">Wireless Mode</label>

                                                        <div class="col-md-7">
                                <select id="54_wireless_mode" class="bs-select form-control input-sm"   name="54_wireless_mode"><option value="instant">Instant</option><option value="schedule" selected="selected">Schedule</option></select>
                                                                    <span class="help-block"> In [Instant] the camera will capture a photo or video then attach to the network and upload the file. In [Schedule] it will wake up either when the timer is up (Schedule Interval) or when the file limit is reached (File Limit)  and upload the pending files to the server.  Using [Schedule] will save battery because it reduces the handshaking that occurs each time the camera has to connect to the network (5 to 10 seconds per photo in Instant mode).  The mobile app will recieve a notification as each scheduled upload starts and completes.  The Action tab will show the scheduled event and the number of photos uploaded. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-wm_schedule">

                            <label class="col-md-4 control-label" for="inputSmall">Schedule Interval</label>

                                                        <div class="col-md-7">
                                <select id="54_wm_schedule" class="bs-select form-control input-sm"   name="54_wm_schedule"><option value="1h">Every Hour</option><option value="2h">Every 2 Hours</option><option value="4h" selected="selected">Every 4 Hours</option></select>
                                                                    <span class="help-block"> The camera will use a timer to wake up and determine if there are files to upload based on the interval you select.  If there are pending files, they will be uploaded to the server at that time. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-wm_sclimit">

                            <label class="col-md-4 control-label" for="inputSmall">Schedule File Limit</label>

                                                        <div class="col-md-7">
                                <select id="54_wm_sclimit" class="bs-select form-control input-sm"   name="54_wm_sclimit"><option value="20">20 Files</option><option value="30">30 Files</option><option value="40">40 Files</option><option value="50" selected="selected">50 Files</option></select>
                                                                    <span class="help-block"> As the camera captures photos or videos, it will maintain a file count.  If the file count reaches your selected File Limit, then the camera will attach to the network at that time (not the Scheduled Interval) and upload all pending files. A lower limit may increase network connections and use more battery, while a higher value may reduce network connections and battery usage.  File Limit will be more important during periods of high activity. If the File Limit is not reached in a schedule interval period then it has no effect.  File Limit is the only way to ensure that all media files captured will get uploaded to the pportal. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-hb_interval">

                            <label class="col-md-4 control-label" for="inputSmall">Heartbeat Interval</label>

                                                        <div class="col-md-7">
                                <select id="54_hb_interval" class="bs-select form-control input-sm"   name="54_hb_interval"><option value="1h" selected="selected">Every Hour</option><option value="2h">Every 2 Hours</option><option value="4h">Every 4 Hours</option><option value="8h">Every 8 Hours</option><option value="12h">Every 12 Hours</option></select>
                                                                    <span class="help-block"> This timer will fire on the whole hour and will send a status to the server.  The mobile app will recieve a notification when this occurs.  This lets you know your camera is still functioning and its curent status. It will also process any pending Action items you have queued like High-Res Max, Video, Original, Settings. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-online_max_time">

                            <label class="col-md-4 control-label" for="inputSmall">Max Online Time</label>

                                                        <div class="col-md-7">
                                <select id="54_online_max_time" class="bs-select form-control input-sm"   name="54_online_max_time"><option value="2" selected="selected">2m</option><option value="3">3m</option><option value="4">4m</option><option value="5">5m</option><option value="6">6m</option><option value="7">7m</option><option value="8">8m</option><option value="9">9m</option><option value="10">10m</option></select>
                                                                    <span class="help-block"> Use this setting to control the amount of time the camera will remain online, per event, processing queued action requests. A shorter time means the camera can return to PIR mode more quickly and continue capturing Photo and Video, otherwise the camera is busy and may miss PIR events due to queue processing. A longer time means your queued Action items should get completed sooner if the queue is large. </span>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-cellularpw">

                            <label class="col-md-4 control-label" for="inputSmall">Cellular Password</label>

                                                        <div class="col-md-7">
                                <input type="text" pattern="[0-9]{6}" name="54_cellularpw" id="54_cellularpw" value="" class="form-control input-sm" placeholder="Input Cellular Password">
                                                                    <span class="help-block"> Input 6 digits. Blank for no password. If you input a password, it is required when you power the camera into Setup mode. This means if your camera is stolen, the thief is not able to set cellular mode to OFF, which means he can only use the camera in cellular mode. </span>
                                                            </div>

                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-remotecontrol">

                            <label class="col-md-4 control-label" for="inputSmall">Remote Control</label>

                                                        <div class="col-md-7">
                                <select id="54_remotecontrol" class="bs-select form-control input-sm"   name="54_remotecontrol"><option value="off" selected="selected">Disabled</option><option value="24h">24 Hour</option></select>
                                                                    <span class="help-block"> This option will cause the camera to sleep in a high power state waiting on SMS commands from the network. It will use more battery power at rest in this mode.  You will see additional buttons on the Actions tab, used to wake your camera up immediately.  When clicked, those buttons [SNAP] and [WAKE] will send an SMS message to wake the camera up. [SNAP] will cause the camera to capture a photo or video and upload it to the portal. The camera will then process any Action items you have queued up. </span>
                                                            </div>
                                                    </div>


                        <div class="panel panel-default">
                            <div class="panel-body" id="panel-54-remotecontrol">



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

        <!-- for each $tokens -->

            </div></div>
      </div>

  </div>

  </div>




    <div class="col-md-6">

    <div class="panel panel-default panel-primary custom-settings-panel">
        <div class="panel-heading">Block Mode Settings (Kevin Test)
        </div>
        <div class="panel-body">



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->



                <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->

                            <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode1">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 1</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode1" class="bs-select form-control input-sm"   name="54_blockmode1"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode2">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 2</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode2" class="bs-select form-control input-sm"   name="54_blockmode2"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode3">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 3</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode3" class="bs-select form-control input-sm"   name="54_blockmode3"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode4">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 4</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode4" class="bs-select form-control input-sm"   name="54_blockmode4"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode5">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 5</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode5" class="bs-select form-control input-sm"   name="54_blockmode5"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode7">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 7</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode7" class="bs-select form-control input-sm"   name="54_blockmode7"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode8">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 8</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode8" class="bs-select form-control input-sm"   name="54_blockmode8"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode9">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 9</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode9" class="bs-select form-control input-sm"   name="54_blockmode9"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode10">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 10</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode10" class="bs-select form-control input-sm"   name="54_blockmode10"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->




                        <div class="form-group " id="field-wrapper-54-blockmode11">

                            <label class="col-md-4 control-label" for="inputSmall">Block Mode 11</label>

                                                        <div class="col-md-7">
                                <select id="54_blockmode11" class="bs-select form-control input-sm"   name="54_blockmode11"><option value="on">On</option><option value="off" selected="selected">Off</option></select>
                                                            </div>
                                                    </div>




                <!-- if showinput -->

        <!-- for each $tokens -->

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
                                    <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked />
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
                                                    </tr><tr>                                <td class="custom-time-toggle-td">
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
                                                    </tr><tr>                                <td class="custom-time-toggle-td">
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
                                                    </tr><tr>                                <td class="custom-time-toggle-td">
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
//              alert($("#54_timezone"));

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
        }
        else {
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
/*
    val = $("#54_cameramode").val();

    if (val == 'p') {
        $('#field-wrapper-54-photoresolution').show(0);
        $('#field-wrapper-54-upload_resolution').show(0);
        $('#field-wrapper-54-video_resolution').hide(0);
        $('#field-wrapper-54-video_rate').hide(0);
        $('#field-wrapper-54-video_length').hide(0);
        $('#field-wrapper-54-video_sound').hide(0);
    }
    else {
        $('#field-wrapper-54-photoresolution').hide(0);
        $('#field-wrapper-54-upload_resolution').hide(0);
        $('#field-wrapper-54-video_resolution').show(0);
        $('#field-wrapper-54-video_rate').show(0);
        $('#field-wrapper-54-video_length').show(0);
        $('#field-wrapper-54-video_sound').show(0);
    }
*/

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
                        </div>