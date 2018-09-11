<!DOCTYPE html>
<html>
<head>
  <title>Sample App</title>
</head>
<body>

<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      @if (count($photos) > 0)
        <ol class="photos">
          @foreach ($photos as $photo)
            {{$photo->filename}}</br>
            {{$photo->filepath}}</br>
            <img src="uploads/images/{{$photo->filepath}}" alt="{{$photo->filename}} width="320" height="180""/>
            </br>
          @endforeach
        </ol>
        <!-- {!! $photos->render() !!} -->
      @endif
    </div>
  </div>
</div>

</body>
</html>
