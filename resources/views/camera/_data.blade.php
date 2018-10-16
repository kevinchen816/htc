<div id="camera_data" class="col-md-9" style="padding-left:6px!important;">

    <div class="panel panel-default panel-primary custom-settings-panel">
    <!-- <div class="panel panel-default panel-primary kk-test"> -->

        <!-- kk-test add -->
<!--         <div class="panel-heading">
            <h3 class="panel-title">Hello</h3>
        </div>
 -->
        <div class="panel-body custom-panel-body" style="padding-top:0px;">
        <!-- /*<div class="panel-body kk-test" style="padding-top:0px;">*/ -->

            <!-- CAMERA DATA - TOOL BAR -->
            <div class="gallery-toolbar camera-toolbar" style="margin-top:0px;">
            <!-- <div class="kk-test"> -->
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="pull-left" style="padding-top:0px;padding-bottom:0px;margin-top:4px">

                            <div class="btn-group" role="group">
                                <!-- <div class="btn-group" data-toggle="tooltip" title="Open Side Panel"> -->
                                <div class="btn-group hidden kk-test" id="show_cameras" data-toggle="tooltip" title="Open Side Panel">
                                    <strong>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-default hidden-kk_del"
                                            id="show_cameras-kk_del"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            style="padding-top:1px;padding-bottom:1px;padding-left:8px;padding-right:8px;margin-left:4px;margin-right:4px;"
                                            >
                                            <i class="fa fa-forward"></i>
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </strong>
                                </div>

                                <div class="btn-group hidden" role="group" id="camera_dropdown" data-toggle="tooltip" title="Select Camera">
                                    <button
                                        type="button"
                                        class="btn btn-default dropdown-toggle"
                                        style="padding-top:0px;padding-bottom:0px;padding-right:6px;"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-camera"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                                        {!! $cc->Camera_Gallery_Select_Camera() !!}
                                    </ul>
                                </div>

                                <div class="btn-group" role="group" style="margin-left:8px;font-size: 1.10em;padding-top:3px;">
                                     @if ($camera)
                                     {{$camera->description}} |
                                     @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- CAMERA DATA - TAB -->
            <!-- <div id="tabs-54" class="tab-container"> -->
            <div id="tabs-{{ $camera->id}}" class="tab-container">

                <!-- <ul class="nav nav-tabs" id="cameratabs-54"> -->
                <ul class="nav nav-tabs" id="cameratabs-{{ $camera->id }}">
                    <!-- <li class="active" >-->
@if ($user->tab == 'overview')
                    <li class="active" >
@else
                    <li>
@endif
                        <a href="#overview-{{ $camera->id }}" data-toggle="tab" data-tab="overview" data-url="{{ route('camera.overview', $camera->id) }}" aria-expanded="true">
                        <!-- <a href="#overview-54" data-toggle="tab" data-tab="overview" data-url="/cameras/overview/54" aria-expanded="true">  -->
                            <span class="glyphicon glyphicon-list-alt"> </span> Overview
                        </a>
                    </li>
@if ($user->tab == 'gallery')
                    <li class="active" >
@else
                    <li>
@endif
                        <a href="#gallery-{{ $camera->id }}" data-toggle="tab" data-tab="gallery" data-url="reload" aria-expanded="true">
                        <!-- <a href="#gallery-{{$camera->id}}" data-toggle="tab" data-tab="gallery" data-url="reload" aria-expanded="true"> -->
                            <span class="glyphicon glyphicon-picture"> </span> Gallery
                        </a>
                    </li>
@if ($user->tab == 'settings')
                    <li class="active" >
@else
                    <li>
@endif
                        <a href="#settings-{{ $camera->id }}" data-toggle="tab" data-tab="settings" aria-expanded="false">
                        <!-- <a href="#settings-{{$camera->id}}" data-toggle="tab" data-tab="settings" aria-expanded="false"> -->
                            <span class="glyphicon glyphicon-edit"> </span> Settings
                        </a>
                    </li>
@if ($user->tab == 'commands')
                    <li class="active" >
@else
                    <li>
@endif
                        <a href="#action-{{ $camera->id }}" data-toggle="tab" data-tab="commands" data-url="{{ route('camera.actions', $camera->id) }}" aria-expanded="false">
                            <span class="glyphicon glyphicon-tasks"> </span> Actions
                        </a>
                    </li>
@if ($user->tab == 'options')
                    <li class="active" >
@else
                    <li>
@endif
                        <a href="#options-{{ $camera->id }}" data-toggle="tab" data-tab="options" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog"> </span> Options
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent-{{ $camera->id }}">
                    <!-- OVERVIEW TAB -->
@if ($user->tab == 'overview')
                    <div class="tab-pane fade active in" id="overview-{{$camera->id}}">
@else
                    <div class="tab-pane fade" id="overview-{{$camera->id}}">
@endif
                    @include('camera.tab_overview')
                    </div>

                    <!-- GALLERY TAB --> <!--class="tab-pane fade active in"-->
@if ($user->tab == 'gallery')
                    <div class="tab-pane fade active in" id="gallery-{{$camera->id}}">
@else
                    <div class="tab-pane fade" id="gallery-{{ $camera->id }}">
@endif
                    @include('camera.tab_gallery')
                    </div>

                    <!-- SETTINGS TAB -->
@if ($user->tab == 'settings')
                    <div class="tab-pane fade active in" id="settings-{{$camera->id}}">
@else
                    <div class="tab-pane fade" id="settings-{{ $camera->id }}">
@endif
                    @include('camera.tab_settings')
                    </div>

                    <!-- ACTION HISTORY TAB -->
@if ($user->tab == 'commands')
                    <div class="tab-pane fade active in" id="action-{{$camera->id}}">
@else
                    <div class="tab-pane fade" id="action-{{ $camera->id }}">
@endif
                    @include('camera.tab_actions')
                    </div>

                    <!-- OPTIONS TAB s -->
@if ($user->tab == 'options')
                    <div class="tab-pane fade active in" id="options-{{$camera->id}}">
@else
                    <div class="tab-pane fade" id="options-{{ $camera->id }}">
@endif
                    @include('camera.tab_options')
                    </div>
                    <!-- OPTIONS TAB e -->
                </div>

            </div>
        </div>
    </div>
</div>
