{{$camera->camera_mode}}<br>
{{$camera->photo_resolution}}<br>

<div class="form-group " id="field-wrapper-54-cameramode">
    <label class="col-md-4 control-label" for="inputSmall">{{$menu['heading']}}</label>
    <div class="col-md-7">
        <select id="54_cameramode" class="bs-select form-control input-sm" name="54_cameramode">
            @foreach ($menu['options'] as $option)
                @if ($camera->camera_mode == 'p')
                    <option value={{$option['value']}} selected="selected">{{$option['name']}}</option>
                @else
                    <option value={{$option['value']}}>{{$option['name']}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

