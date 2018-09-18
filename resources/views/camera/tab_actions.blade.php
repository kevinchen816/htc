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
            <div class="panel-body  " id="commandhistory-54">
                <table class="table" id="action-table">
                    <tbody>
                        <tr>
                            <td>
                                <form class="form-horizontal" role="form" method="POST" action="http://www.ridgetec.us/cameras/actionqueue" id="action-formatsd-form-54">
                                    <input type="hidden" name="_token" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">
                                    <input name="id" type="hidden" value="54">
                                    <input name="action" type="hidden" value="FC">
                                    <div class="form-group">
                                        <label for="password inputSmall" class="control-label">Account Password:</label>
                                        <input id="54_password_format" type="password" class="form-control input-sm" name="password" required>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-trash"></i> Erase SD Card</button>
                                    </div>
                                    <div class="alert alert-sm alert-info">
                                        <p><i class="fa fa-info-circle"></i> <strong>Note:</strong> You must input your account password, then click the Erase SD Card button.
                                            All photos on your SD card will be removed.
                                        </p>
                                    </div>
                                </form>
                            </td>
                            <!-- <td><a href="/cameras/actionqueue/54/FC" class="btn btn-sm btn-success">Format SD Card</a></td>-->
                        </tr>

                        <tr>
                            <td>
                                <a data-param="LD" class="btn btn-sm btn-success action-queue-54" camera-id="54">Log Disable</a>
                                <a data-param="LU" class="btn btn-sm btn-success action-queue-54" camera-id="54">Log Upload</a>
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
            <div class="panel-body" id="commandhistory-54" style="padding-left: 1px; padding-right: 1px;">
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
                        <tr>
                            <td>Scheduled Update</td>
                            <td>Completed</td>
                            <td>09/10/2018 1:31:14 pm</td>
                            <td>09/10/2018 1:34:53 pm</td>
                            <td>49 photos uploaded.</td>
                        </tr>

                        <tr>
                            <td>Scheduled Update</td>
                            <td>Completed</td>
                            <td>09/10/2018 1:31:14 pm</td>
                            <td>09/10/2018 1:34:53 pm</td>
                            <td>49 photos uploaded.</td>
                        </tr>
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

    $(".action-queue-54").click(function() {
        //alert('action queue');
        action = $(this).attr('data-param');
        id = $(this).attr('camera-id');
                    url = '/cameras/actionqueue/' + id + '/' + action;
                //alert(url);

        $('#action-' + id).load(url);
        //alert(url);
    });

    $( ".action-cancel-54" ).click(function(event) {
        event.preventDefault();
        //alert('actioncancel');
        actionid = $(this).attr('data-param');
                    url='/cameras/actioncancel/' + actionid;
                //alert(url);
        $('#action-54').load(url);
    });

    $('#clear-missing').click(function(event) {
                    var url = '/cameras/clearmissing/54';
                console.log('url = ' + url);
        $('#action-54').load(url);

    });

    $('.missing-request').click(function(event) {
        missingid = $(this).attr('missing-id');
        //console.log('.missingid ' + missingid);
                    var url = '/cameras/requestmissing/54/' + missingid;
                //console.log('url = ' + url);
        $('#action-54').load(url);

    });

    $('.show-highres').click(function(event) {
        actionid = $(this).attr('action-id');
        console.log('.showhighres ' + actionid);
                    url = '/cameras/getmediaurl/' + actionid;
                $(this).addClass('hidden');
        $('#action-img-' + actionid).load(url);
    });

    $('#action-show').click(function() {
        val = $("#commandhistory-54").hasClass('hidden');
        //console.log('action show click ' + val);

        if (val) {
            $("#commandhistory-54").show(250);
            $("#commandhistory-54").removeClass('hidden');
            $('#action-show').html('<i class="fa fa-angle-up"></i> Commands');
        }
        else {
            $("#commandhistory-54").hide(250);
            $("#commandhistory-54").addClass('hidden');
            $('#action-show').html('<i class="fa fa-angle-down"></i> Commands');
        };
    })
});
</script>