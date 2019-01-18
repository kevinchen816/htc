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
<!--                         <thead>
                            <tr>
                                <th>Device Info</th>
                                <th>Confirmed</th>
                            </tr>
                        </thead> -->
                        <!-- <tbody> -->
                            @inject('ac', 'App\Http\Controllers\AccountsController')
                            {!! $ac->html_Devices() !!}
                        <!-- </tbody> -->
                    </table>
                </div>
            </div>
        </div>
    </form>
<!--</div>-->
