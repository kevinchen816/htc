<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!--
        .btn
        .btn-default .btn-primary .btn-success .btn-info .btn-warning .btn-danger
        .btn-lg .btn-sm .btn-xs
        .btn-link
        .btn-block
        .active .disabled

        .btn-group
        .btn-group-lg .btn-group-vertical .btn-group-justified

        您可以在 <a>、<button> 或 <input> 元素上使用按钮 class。
        但是建议您在 <button> 元素上使用按钮 class，避免跨浏览器的不一致性问题。
    -->
    <div>
        <a class="btn btn-primary" href="#" role="button">链接</a>
        <input class="btn btn-primary" type="button" value="输入">
        <button class="btn btn-primary" type="submit">按钮</button>
        <button class="btn btn-link" type="button">链接按钮</button>
    </div>
    <!-- <br/> -->

    <div class="btn-group">
    <!-- <div class="btn-group btn-group-lg"> -->
    <!-- <div class="btn-group btn-group-vertical"> -->
    <!-- <div class="btn-group btn-group-justified"> -->
        <a class="btn btn-default" href="#" role="button">链接</a>
        <a class="btn btn-primary" href="#" role="button">链接</a>
        <a class="btn btn-success" href="#" role="button">链接</a>
        <a class="btn btn-info" href="#" role="button">链接</a>
        <a class="btn btn-warning" href="#" role="button">链接</a>

        <div class="btn-group">
            <a class="btn btn-danger dropdown-toggle" role="button" data-toggle="dropdown">
                dropdown <span class="caret"></span>
            </a>
            <!--
            <a class="btn btn-danger" href="#" role="button">dropdown</a>
            <a class="btn btn-danger dropdown-toggle" role="button" data-toggle="dropdown">
                <span class="caret"></span>
            </a> -->
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Tablet</a></li>
                <li><a href="#">Smartphone</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
