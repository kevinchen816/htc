<!DOCTYPE html>
<html>
<head>
  <title>Sample App</title>
</head>
<body>

<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      @if (count($statuses) > 0)
        <ol class="statuses">
          @foreach ($statuses as $status)
            {{$status}}</br>
          @endforeach
        </ol>
<!--         {!! $statuses->render() !!} -->
      @endif
    </div>
  </div>
</div>

</body>
</html>