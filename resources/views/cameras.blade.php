@extends('layouts.default2')
@section('gallery')
    @if ($photos)
    @foreach ($photos as $photo)
        @include('photos.photo')
    @endforeach
    @endif
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('camera._list')
        @include('camera._data')
    </div>
</div>
@stop

@section('javascript')
<script>
    //console.log('cameras page just loaded: {{ $camera->id }}');
    function isPortrait() {
        return window.innerHeight > window.innerWidth;
    }

    function isLandscape() {
        return (window.orientation === 90 || window.orientation === -90);
    }

    var cameraId = '{{ $camera->id }}'; //'54';
    var lastCamera = JSON.parse(sessionStorage.getItem('currentCam')) || null;

console.log('#cameraId='+cameraId);
console.log('#lastCamera='+lastCamera);

    //console.log('cameraId ' + cameraId);
    //console.log('lastCamera ' + lastCamera);

    if(cameraId !== lastCamera){
console.log('current camera <> lastcamera');
        sessionStorage.removeItem('manageOn');
        sessionStorage.removeItem('items');
        sessionStorage.setItem('currentCam', JSON.stringify(cameraId));
        var el = document.getElementById("itemAmount");
        if (el) {
           document.getElementById('itemAmount').innerHTML = getbadge(0);
        }

    }

    var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
console.log('#manageSelected='+manageSelected);
    if (!manageSelected) {
        sessionStorage.setItem('manageOn', JSON.stringify(false));
    }

    var windowload = false;
    var documentready = false;
    var is_landscape = isLandscape();

$(document).ready(function(){
    //console.log('document ready just fired');
    console.log('=> document.ready()');

    var height = $('.custom-thumbnail-grid-column').height();
    var width = $('.custom-thumbnail-grid-column').width();
console.log('#height='+height);
console.log('#width='+width);

    $('#show_cameras').click(function() {
//alert('#show_cameras');
        //alert('after open');
        $.get('/account/showcameralist/open');
        $("#camera_data").removeClass('col-md-12');
        $("#camera_data").addClass('col-md-9');
        $("#camera_list").removeClass('hidden');
        $("#show_cameras").addClass('hidden');
        $("#camera_dropdown").addClass('hidden');

        $("#camera_list").hide();
        $("#camera_list").show(500);
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        $('.check-label .span-cr').height(height);
        $('.check-label .span-cr').width(width);
    });

    $('#close_cameras').click(function() {
//alert('#close_cameras');
        $("#show_cameras").show();
        $("#show_cameras").removeClass('hidden');
        $("#camera_dropdown").removeClass('hidden');
        $("#camera_list").hide();
        $("#camera_data").addClass('col-md-12');
        $("#camera_data").removeClass('col-md-9');
        $("#show_cameras").show();
        $.get('/account/showcameralist/close');
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        $('.check-label .span-cr').height(height);
        $('.check-label .span-cr').width(width);
    });

    $("#btn-refresh").click(function () {
//alert('#btn-refresh');
        window.location.reload(false);
    });

    $("#notify_photo").click(function () {
//alert('#notify_photo');
        //alert('notify_photo');
        var cam = $(this).attr('data-cam');
        var url = '/cameras/testnotify/photo/' + cam + '/62830';
        $('#notify-photo-msg').load(url);
    });

    $("#notify_video").click(function () {
//alert('#notify_video');
        var cam = $(this).attr('data-cam');
        var url = '/cameras/testnotify/video/' + cam + '/62852';
        $('#notify-video-msg').load(url);
    });

    $(".thumb-select").click(function () {
//alert('.thumb-select');
        id = $(this).attr('data-id');
        url = '/cameras/getdetail/' + id;
        //alert('thumb-select' + url);
        $.post("/cameras/activetab",
        {
            _token: '{{ csrf_token() }}',
            tab: 'gallery'
        },
        function(data, status){
//alert('#data='+data);
            //alert("Data: " + data + "\nStatus: " + status);
            window.location.href = url;
        });

    });

    //the reason for the odd-looking selector is to listen for the click event
    // on links that don't even exist yet - i.e. are loaded from the server.
    // respond to tab change
    //$('#tabs-54').on('click','.tablink,#cameratabs-54 a',function (e) {
    $('#tabs-{{ $camera->id }}').on('click','.tablink,#cameratabs-{{ $camera->id }} a',function (e) {
//alert('#tabs-{{ $camera->id }}');
        //alert('tab change');
        e.preventDefault();
        var url = $(this).attr("data-url");
        var tabname = $(this).attr("data-tab");
        var data = '';

//alert('#tabname='+tabname);
//alert('#url='+url);

//{{ csrf_field() }}
//<input type="hidden" name="_token" value="zyj7Xun779JLytaKxnVwAMe5HImSLY24qodO9VIX">

//{{ csrf_token() }} -> zyj7Xun779JLytaKxnVwAMe5HImSLY24qodO9VIX
//_token: 'zyj7Xun779JLytaKxnVwAMe5HImSLY24qodO9VIX',
        //alert('tabname = ' + tabname);
        //alert('url = ' + url);
        $.post("/cameras/activetab",
        {
            _token: '{{ csrf_token() }}',
            tab: tabname,
        },
        function(data, status){
//alert('#data='+data);
             //alert("Data: " + data + "\nStatus: " + status);
        });

        //alert('hold on');

        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;
            setTimeout(function() {
                if (url == "reload") {
                    //alert('reload');
                    location.reload();
                } else {
                    //alert('ajax');
                    // ajax load from data-url
                    $(href).load(url,data,function(result) {
                        //alert(result);
                        n = result.search("Unauthenticated");
                        //alert('n = ' + n);
                        if (n == -1) {
                            pane.tab('show');
                        } else {
                            //alert('reload');
                            location.reload();
                        }
                    });
                }
            }, 500);

            //alert('url = ' + url);
            $(this).tab('show');
        } else {
            $(this).tab('show');
        }
    });
});
</script>
@stop

