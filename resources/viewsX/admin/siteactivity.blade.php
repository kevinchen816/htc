@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}">Activity</a></li>
                <li class="active">SIMs</li>
            </ol>
        </h4>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-search"></i> Search Options</h3>
            </div>
            <div class="panel-body">

               <form method="POST" action="{{ route('admin.user-search') }}" accept-charset="UTF-8" class="form-horizontal" role="form" id="sims-search-form">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by ICCID" name="iccid" value="">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-3">
                    <a href="{{ route('admin.clear-search.sims') }}" class="btn btn-sm btn-primary">Clear Search</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-list"></i> Results
                </span>
            </div>
            <div class="panel-body">
                <div class="pull-right">
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Event</th>
                            <th>Account</th>
                            <th>User</th>
                            <th>Camera</th>
                            <th>Plan</th>
                            <th>Album</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td><a href="/admin/cameras/detail/79">861107032685590</a>/89860117851014783481)<br />Lookout North America/New Camera</td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>10/15/2018 9:36:14 am</td>
                        </tr>

                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td><a href="/admin/cameras/detail/79">861107032685590</a>/89860117851014783481)<br />Lookout North America/New Camera</td>
                            <td></td>
                            <td></td>
                            <td>10/15/2018 9:36:12 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030190999] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>10/09/2018 5:45:12 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030190593] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>10/09/2018 5:43:55 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030198722] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>10/09/2018 5:43:42 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030198721] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>10/09/2018 5:43:30 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>6</td>
                            <td><a href="/admin/users/detail/17">Troy<br />service@ridgetecoutdoors.com</a></td>
                            <td><a href="/admin/cameras/detail/78">861107030190591</a>/8944503540145561054)<br />Lookout North America/New Camera</td>
                            <td>Prepaid | Active</td>
                            <td></td>
                            <td>09/23/2018 5:17:50 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td><a href="/admin/cameras/detail/78">861107030190591</a>/8944503540145561054)<br />Lookout North America/New Camera</td>
                            <td></td>
                            <td></td>
                            <td>09/23/2018 5:17:48 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Renew Pay as you go Plan</td>
                            <td>1</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/19/2018 3:34:59 pm</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/18/2018 9:06:31 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/18/2018 9:06:30 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/18/2018 8:51:23 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/18/2018 8:51:22 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/17/2018 1:09:32 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 1:09:32 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/17/2018 1:09:24 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 1:09:24 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td><a href="/admin/cameras/detail/73">861075021165006</a>/89860117851014783507)<br />Summit 4/Summit</td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/17/2018 1:02:45 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td><a href="/admin/cameras/detail/73">861075021165006</a>/89860117851014783507)<br />Summit 4/Summit</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 1:02:40 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107033669715] I (89860117851014783507)</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 12:25:47 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107032952435] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 12:25:24 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030190591] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 12:24:45 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107030190123] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 12:21:05 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td>M [861107032685001] I (89860117851014783481)</td>
                            <td></td>
                            <td></td>
                            <td>09/17/2018 12:20:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/14/2018 8:35:39 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/14/2018 8:35:39 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/14/2018 8:35:30 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/14/2018 8:35:29 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>5</td>
                            <td><a href="/admin/users/detail/16">Kevin<br />kevin@10ware.com</a></td>
                            <td></td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/14/2018 7:52:12 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>09/14/2018 7:52:11 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>20</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075023461700] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>30</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075022497531] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>30</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021416227] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>30</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021418231] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>21</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075027071224] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>21</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075027073113] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>12</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075027067750] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>2</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021416854] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>19</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075022113591] I (89011702272014061813)</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>11</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075022114136] I (89011702272036892625)</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>22</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021165016] I (89886920042020212150)</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>22</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075027068063] I (8944503540145561054)</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>22</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021165006] I (89886920042020212150)</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>2</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075021416953] I ()</td>
                            <td></td>
                            <td></td>
                            <td>09/09/2018 8:16:37 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Data plan Suspended</td>
                            <td>1</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td><a href="/admin/cameras/detail/69">861107033669855</a>/8944503540145562706)<br />Lookout North America/Look out - Pay as you go</td>
                            <td></td>
                            <td></td>
                            <td>09/07/2018 1:26:15 pm</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>1</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861075022112874] I (89011702272013900037)</td>
                            <td></td>
                            <td></td>
                            <td>09/07/2018 1:22:35 pm</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>1</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td><a href="/admin/cameras/detail/69">861107033669855</a>/8944503540145562706)<br />Lookout North America/Look out - Pay as you go</td>
                            <td></td>
                            <td></td>
                            <td>09/07/2018 11:41:01 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Created - API</td>
                            <td></td>
                            <td></td>
                            <td><a href="/admin/cameras/detail/69">861107033669855</a>/8944503540145562706)<br />Lookout North America/Look out - Pay as you go</td>
                            <td></td>
                            <td></td>
                            <td>09/07/2018 11:41:00 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Deleted by Admin</td>
                            <td>1</td>
                            <td><a href="/admin/users/detail/2">Anthony Jowers<br />ajowers@comcast.net</a></td>
                            <td>M [861107033669855] I (8944503540145562706)</td>
                            <td></td>
                            <td></td>
                            <td>09/07/2018 11:30:44 am</td>
                        </tr>
                                                                        <tr>
                            <td></td>
                            <td>Camera Assigned to Account  - API</td>
                            <td>6</td>
                            <td><a href="/admin/users/detail/17">Troy<br />service@ridgetecoutdoors.com</a></td>
                            <td><a href="/admin/cameras/detail/68">861075027068410</a>/8944503540145561062)<br />Summit 4/New Camera</td>
                            <td>Pay as you go | Active</td>
                            <td></td>
                            <td>09/06/2018 4:18:45 pm</td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
</div>
@stop
