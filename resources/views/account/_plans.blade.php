<!--<div class="tab-pane fade active in" id="data-plans">-->
    <!--<div class="panel panel-default panel-primary custom-settings-panel">-->
    <form method="POST" action="https://portal.ridgetec.com/account/data-plans" accept-charset="UTF-8" class="form-horizontal" role="form" id="data-plans-form">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <h4>
                        My Camera Data Plans
                        <!--<span class="pull-right">
                            <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                        </span>-->
                    </h4>
                </div>
            </div>
        </div>

        @inject('ac', 'App\Http\Controllers\AccountsController')
        {!! $ac->MyPlans() !!}
    </form>

    <div class="row" >
        <div class="col-md-12">
            <div class="alert alert-info" style="margin-left: 20px; margin-right: 20px; background-color: #444">
                <strong><h4>Configuration Help</h4></strong>

                <h4>Auto-Bill</h4>
                <p>Select this option to have the system automatically renew your camera data plan at the selected Renewal Tier cost on its anniversary renewal date.
                    Your credit card on file will be charged the data plan period cost.
                    If you want your camera data plan to expire, then uncheck Auto-Bill and your camera will run out of Reserve Points (if any) and Suspend.
                    You can then Renew the camera data plan at any time in the future.</p><hr>

                <h4>Auto-Reserve</h4>
                <p>Select this option to have the system automatically refill your Points Reserve any time they are running out.
                    Your credit card on file will be charged a $10 fee automatically.
                    This will ensure that you have continued service otherwise if your data plan runs out of points as well as your Points Reserve,
                    your camera data plan will suspend.  You can then Renew the camera data plan at any time in the future.</p>
                <div class="alert alert-success">Note:  The points you purchase for the Reserve have no expiration and remain on your plan until used.</div>
            </div>
         </div>
    </div>

<!--</div>-->
