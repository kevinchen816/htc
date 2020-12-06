<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>BiBi 位置分享</title>

    <script src="../js/bibi/audio.min.js"></script>

    <link rel="stylesheet" href="/css/bibi/reset.css">
    <link rel="stylesheet" href="/css/bibi/index.css">

    <style>
        body, html {
            height: 100%;
            width: 100%;
        }

        .map-box {
            height: 100%;
            width: 100%;
        }

        #mymapX {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;

            width: 100%;
            height: 100%;
            overflow: hidden;
            margin:0;
            font-family:"微软雅黑";
        }

        #mymap {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            /* display: none; */

            width: 100%;
            height: 100%;
        }

        #player {
            position: fixed;
            top: 0;
            height: 100px;
            left: 0;
            bottom: 0;
        }

        .player {
            display: none;
            text-align: center;
            min-height: 30px;
            line-height: 30px;
        }

        .player audio {
            /* width: 100%; */
            width: 50%;
            margin: 0 auto;
        }

        .address {
            position: fixed;
            padding: 1rem;
            height: 5rem;
            line-height: 1.5rem;
            color: #fff;
            width: 100%;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(49, 139, 251);
            text-align: center;
            box-sizing: border-box;
        }

        .amap-zoomcontrol {
            display: none
        }

        /*回到中心位置按钮*/
        .back-center {
            width: 3rem;
            height: 3rem;
            background: url({{ route('home') }}/images/position-icon.png);
            background-size: 100% 100%;
            position: fixed;
            left: 1rem;
            bottom: 5rem;
        }
    </style>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJW4jsPlNKgv6jFm3B5Edp5ywgdqLWdmc&sensor=false">
    </script>
    <script src="../js/bibi/jquery-2.1.0.js"></script>
    <script>
        // When the window has finished loading create our google map below
        // google.maps.event.addDomListener(window, 'load', initialize);

        /////////////////////////  测试服 /////////////////////////////////////
        //地图数据地址
        // const WEB_POSITION_URL = 'http://120.78.89.29:8777/Line/Show';
        //录音文件上传地址
        // const WEB_AUDIO_URL = 'http://120.78.89.29:8777/uploadDownload/';
        /////////////////////////  正式服 /////////////////////////////////////

        //地图数据地址
        // const WEB_POSITION_URL='http://api.airuize.com:8777/Line/Show';
        // const WEB_POSITION_URL='https://portal.eztoview.com/api/downloadposition';
        const WEB_POSITION_URL='{{ route('home') }}/api/downloadposition';

        //录音文件上传地址
        // const WEB_AUDIO_URL='http://api.airuize.com:8777/uploadDownload/';
        const WEB_AUDIO_URL='{{ route('home') }}/api/playaudio';
        /////////////////////////////////////////////////////////////////////

        console.log('WEB_POSITION_URL='+WEB_POSITION_URL);
        console.log('WEB_AUDIO_URL='+WEB_AUDIO_URL);

        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var map, geolocation, polyline;
        var isDraged = false;  //是否拖拽
        var countdownTime = 0; //倒计时为0时自动居中定位
        var marker = null;

        var lastLat = 24.171243848401744;
        var lastLng = 120.6455130413344;
        var myCenter = new google.maps.LatLng(lastLat, lastLng);

        var p1 = new google.maps.LatLng(24.17032375493668, 120.64481566699327);
        var p2 = new google.maps.LatLng(24.17104808439007, 120.64359257968727);
        var p3 = new google.maps.LatLng(24.170509731810075, 120.64351747783515);
        var pos = [p1, p2, p3];

        var myTrip;
        var myPolyline;
        var index = 0;

        var g_map_zoom = 18;

        //回到地图中心
        $(".back-center").click(function() {
            console.log("click back-center");
            isDraged = false;
            // alert(lastLng+" | "+lastLat);
            goCenter(lastLng, lastLat);
        })

        /*----------------------------------------------------------------------------------*/
        function initialize() {
            console.log(">> initialize()");

            var mapProp = {
                center: myCenter,
                zoom: g_map_zoom,
                // disableDefaultUI: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP         // 用于显示默认的道路地图视图
            };
            map = new google.maps.Map(document.getElementById("mymap"), mapProp);

            // var marker = new google.maps.Marker({
            //     position:myCenter,
            //     // icon:'EZ-150X150.png',
            //     // title:'Click to zoom',
            //     // animation:google.maps.Animation.BOUNCE // DROP
            // });
            // marker.setMap(map);

            // Zoom to 9 when clicking on marker
            // google.maps.event.addListener(marker,'click',function() {
            //     console.log("#marker click");
            //     map.setZoom(18);
            //     map.setCenter(marker.getPosition());
            // });

            // 重置标记
            // google.maps.event.addListener(map,'center_changed',function() {
            //     // 3 seconds after the center of the map has changed, pan back to the marker
            //     window.setTimeout(function() {
            //         map.panTo(marker.getPosition());
            //     }, 3000);
            // });

            // var urlParam = {
            //     "uid":12345,
            //     "eid":"123451607073689"
            // };
            var urlParam = GetRequest();
            console.log(JSON.stringify(urlParam)); // {"uid":"12345","eid":"123451607073689"}

            // $.post(WEB_POSITION_URL, JSON.stringify(urlParam), function (data) {
            $.post(WEB_POSITION_URL, urlParam, function (data) {
                // data = "{\"Code\":200, \"Data\":{\"AccountId\":54241, \"Status\":1, \"SoundFile\":\"1606465119-1606465080421.amr\", \"Tag\":\"542411606465080\", \"LineShareURL\":\"https://2i1i.cn/MYsu\", \"Point\":[\"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\"], \"RecordTime\":[\"2020-11-27T16:18:04.25690545+08:00\", \"2020-11-27T16:18:09.240894288+08:00\" ], \"MapName\":[\"台湾省台湾省靠近财团法人惠来里礼拜堂\", \"台湾省台湾省靠近财团法人惠来里礼拜堂\" ] }, \"Msg\":\"请求成功\", \"Path\":\"Line.Show\"}";
                console.log(data);

                // data = JSON.parse(data);
                if (data.result == 0) {

                    if (data.status == 2) { //分享结束
                        console.log("隐藏地图 (1)");
                        $(".map-box").hide();
                        $(".save-content").show();
                        return;
                    } else {
                        $(".map-box").show();
                        $(".save-content").hide();
                    }

                    console.log(data.sound);
                    if (data.sound && $(".player").css("display") == 'none') {
                        console.log('audio='+data.sound);
                        $(".player").css({ "display": "block" });
                        // $(".player audio").attr("src", WEB_AUDIO_URL + data.sound);
                        $(".player audio").attr("src", 'http://api.airuize.com:8777/uploadDownload/1606465119-1606465080421.amr.mp3');
                        // http://api.airuize.com:8777/uploadDownload/1606465119-1606465080421.amr
                        // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                    }

                    if (data.position) {
                        var lat = data.position[data.position.length - 1].split(',')[0];
                        var lng = data.position[data.position.length - 1].split(',')[1];
                        lastLat = lat;
                        lastLng = lng;
                        goCenter(lastLat, lastLng);

                        if (marker) {
                            marker.setMap(null);
                        }
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lastLat, lastLng),
                        });
                        marker.setMap(map);

                        $(".address").text(data.address[data.address.length - 1]);
                    }
                }
            })
        }

        /*----------------------------------------------------------------------------------*/
        // 将创建的点标记添加到已有的地图实例：
        function GetRequest() {
            var url = location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for (var i = 0; i < strs.length; i++) {
                    theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
                }
            }
            return theRequest;
        }

        function goCenter(lat, lng) {
            console.log(">>goCenter()");
            console.log('lat='+lat);
            console.log('lng='+lng);

            // if(isDraged){
            //     return;
            // }

            if (map) {
                map.setCenter(new google.maps.LatLng(lat, lng));
            }
        }

        // function countdownGoCenter(){
        //     setInterval(function() {
        //         console.log("...go center");
        //         goCenter(lastLng, lastLat);
        //     }, 3000);
        // }
        // countdownGoCenter();

        /*----------------------------------------------------------------------------------*/
        var test_flag = 0;
        var interval = setInterval(function () {
            console.log(".......refresh");

            // if (test_flag == 1) {
            //     clearInterval(interval);
            //     return;
            // } else {
            //     test_flag = 1;
            // }

            // var urlParam = {
            //     "uid":12345,
            //     "eid":"123451607073689"
            // };
            var urlParam = GetRequest();
            console.log(JSON.stringify(urlParam)); // {"uid":"12345","eid":"123451607073689"}

            // $.post(WEB_POSITION_URL, JSON.stringify(urlParam), function (data) {
            $.post(WEB_POSITION_URL, urlParam, function (data) {
                // data = "{\"Code\":200, \"Data\":{\"AccountId\":54241, \"Status\":1, \"SoundFile\":\"1606465119-1606465080421.amr\", \"Tag\":\"542411606465080\", \"LineShareURL\":\"https://2i1i.cn/MYsu\", \"Point\":[\"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\"], \"RecordTime\":[\"2020-11-27T16:18:04.25690545+08:00\", \"2020-11-27T16:18:09.240894288+08:00\" ], \"MapName\":[\"台湾省台湾省靠近财团法人惠来里礼拜堂\", \"台湾省台湾省靠近财团法人惠来里礼拜堂\" ] }, \"Msg\":\"请求成功\", \"Path\":\"Line.Show\"}";
                console.log(data);

                // data = JSON.parse(data);
                if (data.result == 0) {

                    if (data.status == 2) { // 分享结束
                        console.log("隐藏地图 (2)");
                        clearInterval(interval);
                        $(".map-box").hide();
                        $(".save-content").show();
                        return;
                    }

                    if (data.position) {
                        // if (data.Data.SoundFile && $(".player").css("display") == 'none') {
                        //     $(".player").css({ "display": "block" });
                        //     $(".player audio").attr("src", WEB_AUDIO_URL + data.Data.SoundFile + '.mp3');
                        //     // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                        // }

                        var lat = data.position[data.position.length - 1].split(',')[0];
                        var lng = data.position[data.position.length - 1].split(',')[1];
                        lastLat = lat;
                        lastLng = lng;
                        goCenter(lastLat, lastLng);
                        // map.setCenter(pos[index]); // for test

                        if (marker) {
                            marker.setMap(null);
                        }
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lastLat, lastLng),
                            // position: pos[index], // for test
                        });
                        marker.setMap(map);

                        $(".address").text(data.address[data.address.length - 1]);

                        // 删除轨迹
                        if (myPolyline) {
                            myPolyline.setMap(null);
                        }

                        // // myTrip = [myCenter, p1, p2, p3];
                        // if (index == 0) {
                        //     myTrip = [myCenter, p1];
                        // } else if (index == 1) {
                        //     myTrip = [myCenter, p1, p2];
                        // } else if (index == 2) {
                        //     myTrip = [myCenter, p1, p2, p3];
                        // }
                        // index = (index+1) % 3;
                        myTrip = getPolylineDatas(data);
                        myPolyline = new google.maps.Polyline({
                            path: myTrip,
                            strokeColor: "blue", //"#0000FF",
                            strokeOpacity: 0.5, //0.8,
                            strokeWeight: 6 //5
                        });
                        myPolyline.setMap(map);
                    }

                    //绘制轨迹
                    function getPolylineDatas(_data) {
                        var resArr = [];
                        for(var i=0, len=_data.position.length; i<len; i++){
                            var d = _data.position[i].split(',');
                            if (d[0]==undefined) {
                                alert(_data.position[i]);
                            } else if (d[0]==NaN) {
                                alert(_data.position[i]);
                            }

                            if(d[0]!="undefined" && d[1]!="undefined" && d[0]!=NaN && d[1]!=NaN && d[0]!=0 && d[1]!=0){
                                // resArr.push([d[0], d[1]]);
                                resArr.push(new google.maps.LatLng(d[0], d[1]));
                            }
                        }
                        // console.log(resArr)
                        return resArr;
                    }
                }
            })

        }, 5000)

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>
<body>
    <!-- <div id="googleMap" style="width:800px;height:800px;"></div> -->
    <!-- <div id="mymap"></div> -->

    <div style="background-color: #376fd8; margin: 0px 0px 0px; color: #ffffff; text-align: center;">
        <h2 style="display:none;" class="save-content"> 我已經安全，停止分享！</h2>
    </div>

    <div class="map-box">
        <div id="mymap"></div>

        <div class="back-center"></div>

        <div class="player">
            <audio controls="controls" id="audiojs" preload="auto"> </audio>
        </div>

        <div class="address"></div>
    </div>

</body>
</html>