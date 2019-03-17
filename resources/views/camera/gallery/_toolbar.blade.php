<div class="row">
    <div class="col-sm-12 clearfix">
        <div class="pull-left" style="margin-top: 1px; margin-bottom:1px; padding-top:0px; padding-bottom: 0px;">
            @if (count($photos) > 0)
                @if (Browser::isMobile())
                {!! $photos->links('layouts.pagination') !!}
                @else
                {!! $photos->render() !!}
                @endif
            @endif
        </div>

        <div class="pull-right">
            <!--<span id="itemAmount"> </span>-->
            <div class="btn-group" role="group" aria-label="User options">
                <!-- Manage Photos -->
                <div class="btn-group" data-toggle="buttons" data-toggle="tooltip" title="Manage Photos" id="manage">
                    <label class="btn btn-default" style="padding-top:2px;padding-bottom:2px;">
                        <input type="checkbox" autocomplete="off" id="multi-select">
                        <i class="fa fa-wrench"></i>
                        <span id="itemAmount"> </span>
                    </label>
                </div>

                <!-- Action -->
                <div class="btn-group" role="group">
                    <button
                        type="button"
                        id="with-selected"
                        class="btn btn-default dropdown-toggle disabled hidden"
                        style="padding-top:2px;padding-bottom:2px;"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        data-multiple="1"
                        aria-expanded="false">
                        <span>
                            @if (Browser::isMobile())
                            <i class="fa fa-bolt"></i><span class="caret"></span>
                            @else
                            <i class="fa fa-bolt"></i>{{ trans('htc.Action') }}<span class="caret"></span>
                            @endif
                        </span>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#DeleteModal" data-type="delete">
                                {{ trans('htc.Delete') }}
                            </a>
                        </li>
                        <!--<li>
                            <a class="btn" data-toggle="modal" data-target="#HighresModal" data-type="highres">
                                Request HighRes MAX
                            </a>
                        </li>-->
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#OriginalModal" data-type="original">
                                {{ trans('htc.Request Original') }}
                            </a>
                        </li>
                        <!--<li>
                            <a class="btn" data-toggle="modal" data-target="#VideoModal" data-type="video">
                                {{ trans('htc.Request Video') }}
                            </a>
                        </li>-->
                    </ul>
                </div>

                <!-- Select None -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-none-{{ $camera->id }}" data-action="select-none" data-toggle="tooltip" title="Select None"><i class="fa fa-square-o"></i></a>

                <!-- Select All -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-all-{{ $camera->id }}" data-action="select-all" data-toggle="tooltip" title="Select All"><i class="fa fa-th"></i></a>

                <!-- Clear All -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="clear-all-{{ $camera->id }}" data-action="clear-all" data-toggle="tooltip" title="Clear All"><i class="fa fa-eraser"></i></a>

@if (Browser::isMobile())
                <a class="btn btn-default" style="padding-top:2px;padding-bottom:2px;" id="refresh-all-{{ $camera->id }}" data-action="refresh-all" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
@else
                <!-- Columns -->
                <div class="btn-group" role="group">
                    <button
                        type="button"
                        class="btn btn-default dropdown-toggle"
                        style="padding-top:2px;padding-bottom:2px;"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-toggle="tooltip"
                        title="Column Layout">
                        {{ trans('htc.Columns') }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu layout-grid">
                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 2]) }}" class="{{ ($camera->columns == 2) ? 'current-item' : '' }}" >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 3]) }}" class="{{ ($camera->columns == 3) ? 'current-item' : '' }}" >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 4]) }}" class="{{ ($camera->columns == 4) ? 'current-item' : '' }}" >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 6]) }}" class="{{ ($camera->columns == 6) ? 'current-item' : '' }}" >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 12]) }}" class="{{ ($camera->columns == 12) ? 'current-item' : '' }}" >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Thumbs -->
                <div class="btn-group" role="group">
                    <button
                        type="button"
                        class="btn btn-default dropdown-toggle"
                        style="padding-top:2px;padding-bottom:2px;"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-toggle="tooltip"
                        title="Thumbs per page">
                        {{ trans('htc.Thumbs') }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu layout-grid">
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 10]) }}" class="{{ ($camera->thumbs == 10) ? 'current-item' : '' }}">10 Per Page</a></li>
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 20]) }}" class="{{ ($camera->thumbs == 20) ? 'current-item' : '' }}">20 Per Page</a></li>
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 30]) }}" class="{{ ($camera->thumbs == 30) ? 'current-item' : '' }}">30 Per Page</a></li>
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 40]) }}" class="{{ ($camera->thumbs == 40) ? 'current-item' : '' }}">40 Per Page</a></li>
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 60]) }}" class="{{ ($camera->thumbs == 60) ? 'current-item' : '' }}">60 Per Page</a></li>
                        <li><a href="{{ route('camera.gallerythumbs', [$camera, 80]) }}" class="{{ ($camera->thumbs == 70) ? 'current-item' : '' }}">80 Per Page</a></li>
                    </ul>
                </div>
@endif
            </div>
        </div>
    </div>
</div>