<div class="col-xs-3 custom-thumbnail-grid-column column-number-1">
    <div class="image-checkbox">
        <label style="font-size: 1.5em" class="check-label hidden">
            <input type="checkbox" class="image-check" value="{{ $photo->id }}" id="check_{{ $photo->id }}" />
            <span class="cr span-cr"></span>
        </label>
    </div>

    <div class="image-highdef pull-right" hidden id="pending-{{ $photo->id }}">
        <label style="font-size: 1.0em; margin-right: 4px;">
            <span class="cr">
                <i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i>
            </span>
        </label>
    </div>
    <a class="thumb-anchor" data-fancybox="gallery-{{ $camera->id }}"
        href="{{ url('uploads/'.$camera->id.'/'.$photo->filepath) }}"
        data-caption="{{ $photo->filename }} | {{ $photo->datetime }} | Scheduled Upload | Standard Low(1/20/16136) | Points: 1.00"
        data-camera="{{ $camera->id }}"
        data-id="{{ $photo->id }}"
        data-highres="0"
        data-pending="0">

        <img src="{{ url('uploads/'.$camera->id.'/'.$photo->filepath) }}"
            class="img-responsive custom-thumb"
            title="{{ $photo->filename }} ({{ $photo->id }})"
            alt="{{ $photo->filename }}"
            data-description="{{ $photo->filename }}">
    </a>
    <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
        <!-- <a href="/cameras/download/54/90815"> -->
        <!-- <a href="/cameras/download/{{$camera->id}}/{{$photo->id}}"> -->
        <a href="/uploads/{{ $camera->id }}/{{ $photo->filepath }}">
            <i class="fa fa-download"></i>
        </a>
        <!-- 09/08/2018 9:20:42 pm -->
        {{ $photo->datetime }}
    </p>
</div>
