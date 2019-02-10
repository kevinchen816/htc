<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-primary custom-settings-panel">
            <div class="panel-heading">
                <h4 class="panel-title">Camera Options</h4>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default panel-primary custom-settings-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-times-circle" style="color:red"></i> Delete this Camera
                                    <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="delete-camera"><i class="fa fa-question"></i></a>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('camera.delete') }}" id="delete-camera-form-{{ $camera->id }}">
                                    {{ csrf_field() }}
                                    <input name="id" type="hidden" value="{{ $camera->id }}">

                                    <div class="form-group">
                                        <label for="password inputSmall" class="col-md-5 control-label">Account Password</label>
                                        <div class="col-md-6">
                                            <input id="{{ $camera->id }}_password_delete" type="password" class="form-control input-sm" name="password" required>
                                            <button type="submit" class="btn btn-sm btn-primary">Delete Camera</button>
                                        </div>
                                    </div>
                                    <div class="alert alert-sm alert-info">
                                        <p><i class="fa fa-info-circle"></i> <strong>Note:</strong> You must input your account password, then click the delete camera button.</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default panel-primary custom-settings-panel">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Other Options
                                </h4>
                            </div>
                            <div class="panel-body">
                                <a href="/cameras/apilog/{{ $camera->id }}" class="btn btn-sm btn-primary">View Camera Activity Log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete-camera" class="hidden">
    <div class="alert alert-sm alert-info help-container">
        <h4><strong>Before you delete this camera, you should realize that all media currently linked to the camera will be permanently removed.</strong></h4>
        <p><i class="fa fa-arrow-circle-right"></i> Because a camera will automatically link to your account when it is linked to an active data plan also on your account,
            you could cancel the data plan first to stop this from happening.
        </p>

        <p><i class="fa fa-arrow-circle-right"></i> If this camera is tied to an active data plan, and you are moving your SIM with active plan to a new camera, move the SIM card
            first, get your new camera operating, then delete this camera.
        </p>
        <hr>

        <h4><strong>Selling/Giving this camera to someone</strong></h4>
        <p><i class="fa fa-arrow-circle-right"></i> If you are selling/giving this camera to someone, you should likely provide it with its original SIM card, unless that SIM is tied
        to an active data plan on your account.  However, if you have purchased a new Ridgetec camera, you could keep your original SIM and active
        plans intact by placing your active SIM with plan into your new camera, and provide the new SIM from the retail package with your old camera.
        In this case, once you have your new camera operating on the portal with your old SIM, then you can delete the camera and someone else
        will be able to activate their own data plan using the brand new SIM and the camera will add to their account.
        <hr>

        <p><i class="fa fa-arrow-circle-right"></i> If you decide to cancel your data plan prior to deleting a camera, you have several options:
        </p>
            <ul>
                <li>
                    Cancelling your active Pay as you go plan, will only mark it to cancel at the end of the current monthly billing cycle, giving you
                    time to use the remaining Image Points
                </li>

                <li>
                    Cancelling your active Pay as you go plan immediately, will deactivate the SIM card and you will lose any remaining Image Points
                </li>

                <li>
                    Cancelling a Prepaid plan is not an option.
                </li>

                <li>Assign the Data Plan to another account:  The Ridgetec Support team is able to migrate active Data Plans to another users Account.
                    This means you should provide the SIM card linked to that data plan to that user (likely with a camera).  By assigning a data plan
                    to another user, the remaining Image Points can be used by that user.  <strong>Keep in mind that if the Data Plan is a Pay as you go plan,
                        the system will charge the new owner's credit card on the next billing cycle, not yours.</strong>
                </li>
            </ul>
        </p>
    </div>
</div>