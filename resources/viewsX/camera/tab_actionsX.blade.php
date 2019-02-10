<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <span style="font-size: .70em;" >Request Actions</span>
                    <a class="btn btn-xs btn-primary pull-right" id="action-show">
                        <i class="fa fa-angle-up"></i>
                        Commands
                    </a>
                </div>
            </div>
            <div class="panel-body  " id="commandhistory-{{ $camera->id }}">
                <table class="table" id="action-table">
                    <tbody>
@if ($camera->remotecurrent == '24h')
                        <tr>
                            <td>
                                <div class="well well-sm">
                                    <h4>Remote Control Options</h4>
                                    <a data-param="snap" class="btn btn-sm btn-success sms-button" camera-id="{{ $camera->id }}"><i class="fa fa-bolt"></i> SMS: Snap Photo</a>
                                    <a data-param="wake" class="btn btn-sm btn-success sms-button" camera-id="{{ $camera->id }}"><i class="fa fa-bolt"></i> SMS: Wakeup</a>
                                    <div id="sms-message"></div>
                                </div>
                            </td>
                        </tr>
@endif
                        <tr>
                            <td>
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('camera.actionqueue_post') }}" id="action-formatsd-form-{{ $camera->id }}">
                                    {{ csrf_field() }}
                                    <input name="id" type="hidden" value="{{ $camera->id }}">
                                    <input name="action" type="hidden" value="FC">
                                    <div class="form-group">
                                        <label for="password inputSmall" class="control-label">Account Password:</label>
                                        <input id="{{ $camera->id }}_password_format" type="password" class="form-control input-sm" name="password" required>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-trash"></i> Erase SD Card</button>
                                        <!--<p>Erase SD card temporarily disabled. Your camera needs
                                                        to upgrade to firmware 20181003 or higher.</p>-->

                                    </div>
                                    <div class="alert alert-sm alert-info">
                                        <p><i class="fa fa-info-circle"></i> <strong>Note:</strong> You must input your account password, then click the Erase SD Card button.
                                            All photos on your SD card will be removed.
                                        </p>
                                    </div>
                                </form>
                            </td>
                            <!-- <td><a href="/cameras/actionqueue/{{ $camera->id }}/FC" class="btn btn-sm btn-success">Format SD Card</a></td>-->
                        </tr>

                        @inject('actions_ctrl', 'App\Http\Controllers\ActionsController')
                        {!! $actions_ctrl->Commands($camera) !!}

                        <!--<tr>
                            <td>
                                <a data-param="FW" class="btn btn-sm btn-success action-queue-15" camera-id="{{ $camera->id }}">Update Firmware to (20181003)</a>
                            </td>
                        </tr>-->

                        <tr>
                            <td>
@if ($camera->log == 1)
                                <a data-param="LD" class="btn btn-sm btn-success action-queue-{{ $camera->id }}" camera-id="{{ $camera->id }}">Log Disable</a>
@else
                                <a data-param="LE" class="btn btn-sm btn-success action-queue-{{ $camera->id }}" camera-id="{{ $camera->id }}">Log Enable</a>
@endif
                                <a data-param="LU" class="btn btn-sm btn-success action-queue-{{ $camera->id }}" camera-id="{{ $camera->id }}">Log Upload</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Action History</h4>
            </div>
            <div class="panel-body" id="commandhistory-{{ $camera->id }}" style="padding-left: 1px; padding-right: 1px;">
                <table class="table table-striped table-condensed" style="font-size: .80em; margin-left: 0px;">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Requested On</th>
                            <th>Completed On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @inject('actions_ctrl', 'App\Http\Controllers\ActionsController')
                        {!! $actions_ctrl->History($camera) !!}

                        <!--<tr>
                            <td>Scheduled Update</td>
                            <td>Completed</td>
                            <td>09/10/2018 1:31:14 pm</td>
                            <td>09/10/2018 1:34:53 pm</td>
                            <td>49 photos uploaded.</td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-9">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Missing Images
                    <span class="pull-right"><a class="btn btn-xs btn-primary" id="clear-missing">Clear Missing</a></span>
                </h4>
            </div>
            <div class="panel-body" style="padding-left: 1px; padding-right: 1px;">
                <table class="table table-striped table-condensed" style="font-size: .80em; margin-left: 0px;">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-sm-1">
                                PICT4912.JPG
                            </td>
                            <td class="col-sm-1">
                                <a class="btn btn-xs btn-info missing-request" missing-id="949">Request</a>
                            </td>
                            <td class="col-sm-1">09/08/2018 7:35:55 pm</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    $(".sms-button").click(function() {
        //alert('action queue');
        sms = $(this).attr('data-param');
        id = $(this).attr('camera-id');
        url = '/cameras/sendsms/' + id + '/' + sms;

        $("#sms-message").load(url);
    });

    $(".action-queue-{{ $camera->id }}").click(function() {
        //alert('action queue');
        action = $(this).attr('data-param');
        id = $(this).attr('camera-id');
        var url = '/cameras/actionqueue/' + id + '/' + action;
        $('#action-' + id).load(url);
    });

    $( ".action-cancel-{{ $camera->id }}" ).click(function(event) {
        //alert('actioncancel');
        event.preventDefault();

        actionid = $(this).attr('data-param');
        var url='/cameras/actioncancel/' + actionid;
        $('#action-{{ $camera->id }}').load(url);
    });

    $('#clear-missing').click(function(event) {
        var url = '/cameras/clearmissing/{{ $camera->id }}';
        $('#action-{{ $camera->id }}').load(url);
    });

    $('.missing-request').click(function(event) {
        missingid = $(this).attr('missing-id');
        //console.log('.missingid ' + missingid);
        var url = '/cameras/requestmissing/{{ $camera->id }}/' + missingid;
        //console.log('url = ' + url);
        $('#action-{{ $camera->id }}').load(url);

    });

    $('.show-highres').click(function(event) {
        actionid = $(this).attr('action-id');
        console.log('.showhighres ' + actionid);
        url = '/cameras/getmediaurl/' + actionid;
        $(this).addClass('hidden');
        $('#action-img-' + actionid).load(url);
    });

    $('#action-show').click(function() {
        val = $("#commandhistory-{{ $camera->id }}").hasClass('hidden');
        //console.log('action show click ' + val);

        if (val) {
            $("#commandhistory-{{ $camera->id }}").show(250);
            $("#commandhistory-{{ $camera->id }}").removeClass('hidden');
            $('#action-show').html('<i class="fa fa-angle-up"></i> Commands');
        }
        else {
            $("#commandhistory-{{ $camera->id }}").hide(250);
            $("#commandhistory-{{ $camera->id }}").addClass('hidden');
            $('#action-show').html('<i class="fa fa-angle-down"></i> Commands');
        };
    })
});
</script>