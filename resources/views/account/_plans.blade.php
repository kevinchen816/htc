    <form method="POST" action="{{ route('account.plans') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="data-plans-form">
        {{ csrf_field() }}

<!--         <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <h4>
                        My Camera Data Plans -->
                        <!--<span class="pull-right">
                            <button class="btn btn-sm btn-primary" type="submit">Save Changes</button>
                        </span>-->
<!--                     </h4>
                </div>
            </div>
        </div> -->

        @inject('ac', 'App\Http\Controllers\AccountsController')
        {!! $ac->html_MyPlans() !!}
    </form>