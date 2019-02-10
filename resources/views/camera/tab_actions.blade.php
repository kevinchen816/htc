@inject('actions_ctrl', 'App\Http\Controllers\ActionsController')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <span style="font-size: .70em;" >{{ trans('htc.Request Actions') }}</span>
                    <a class="btn btn-xs btn-primary pull-right" id="action-show">
                        <i class="fa fa-angle-up"></i>
                        {{ trans('htc.Commands') }}
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
                                        <label for="password inputSmall" class="control-label">{{ trans('htc.Account Password') }}:</label>
                                        <input id="{{ $camera->id }}_password_format" type="password" class="form-control input-sm" name="password" required>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-trash"></i> {{ trans('htc.Erase SD Card') }}</button>
                                    </div>
                                    <div class="alert alert-sm alert-info">
                                        <p><i class="fa fa-info-circle"></i>
                                            {{ trans('htc.Erase SD Card Note') }}
                                        </p>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        {!! $actions_ctrl->html_Commands($camera) !!}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">{{ trans('htc.Action History') }}</h4>
            </div>
            <div class="panel-body" id="commandhistory-{{ $camera->id }}" style="padding-left: 1px; padding-right: 1px;">
                <table class="table table-striped table-condensed" style="font-size: .80em; margin-left: 0px;">
                    <thead>
                        <tr>
                            <th>{{ trans('htc.Action') }}</th>
                            <th>{{ trans('htc.Action Status') }}</th>
                            <th>{{ trans('htc.Requested On') }}</th>
                            <th>{{ trans('htc.Completed On') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {!! $actions_ctrl->html_History($user, $camera) !!}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
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