<div class="row">
    <div class="col-sm-12 clearfix">
        <div class="pull-left" style="margin-top: 1px; margin-bottom:1px; padding-top:0px; padding-bottom: 0px;">
            @if (count($photos) > 0)
                {!! $photos->render() !!}
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
                            <i class="fa fa-bolt"></i>
                                Action <span class="caret"></span>
                        </span>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#DeleteModal" data-type="delete">
                                Delete
                            </a>
                        </li>
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#HighresModal" data-type="highres">
                                Request HighRes MAX
                            </a>
                        </li>
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#OriginalModal" data-type="original">
                                Request Original
                            </a>
                        </li>
                        <li>
                            <a class="btn" data-toggle="modal" data-target="#VideoModal" data-type="video">
                                Request Video
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Select None -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-none-{{ $camera->id }}" data-action="select-none" data-toggle="tooltip" title="Select None"><i class="far fa-square"></i></a>

                <!-- Select All -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-all-{{ $camera->id }}" data-action="select-all" data-toggle="tooltip" title="Select All"><i class="fa fa-th"></i></a>

                <!-- Clear All -->
                <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="clear-all-{{ $camera->id }}" data-action="clear-all" data-toggle="tooltip" title="Clear All"><i class="fa fa-eraser"></i></a>

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
                        Columns
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu layout-grid">
                        <li>
                            <!--<a href="/cameras/gallerylayout/{{ $camera->id }}/2"  >-->
                            <a href="{{ route('camera.gallerylayout', [$camera, 2]) }}"  >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 3]) }}"  >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <!--<a href="/cameras/gallerylayout/{{ $camera->id }}/4" class="current-item">-->
                            <a href="{{ route('camera.gallerylayout', [$camera, 4]) }}"  >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 6]) }}"  >
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                                <span class="grid-block"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('camera.gallerylayout', [$camera, 12]) }}"  >
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
                        Thumbs
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu layout-grid">
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/10">10 Per Page</a></li>
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/20">20 Per Page</a></li>
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/30">30 Per Page</a></li>
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/40">40 Per Page</a></li>
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/60">60 Per Page</a></li>
                        <li><a href="/cameras/gallerythumbs/{{ $camera->id }}/80">80 Per Page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
