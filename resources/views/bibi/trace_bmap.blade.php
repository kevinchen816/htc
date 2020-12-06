<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>BiBi 位置分享</title>
    <script>var _gaq = [['_setAccount', 'UA-20257902-1'], ['_trackPageview']]; (function (d, t) { var g = d.createElement(t), s = d.getElementsByTagName(t)[0]; g.async = 1; g.src = '//www.google-analytics.com/ga.js'; s.parentNode.insertBefore(g, s) }(document, 'script'))</script>

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

        #map {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            /* display: none; */

            height: 100%;
            width: 100%;
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
</head>

<body>
    <div style="background-color: #376fd8; margin: 0px 0px 0px; color: #ffffff; text-align: center;">
        <h2 style="display:none;" class="save-content"> 我已经安全，停止分享！</h2>
    </div>

    <div class="map-box">
        <div id="map">
        </div>

        <div class="back-center">
        </div>

        <div class="player">
            <audio controls="controls" id="audiojs" preload="auto">
            </audio>
        </div>

        <div class="address">
        </div>
    </div>

    <!-- <script src="https://webapi.amap.com/maps?v=1.4.9&key=b1c0a0045fb86f46d0114d09d510995b&&plugin=AMap.Scale"></script> -->
    <!-- <script type="text/javascript" src="https://cache.amap.com/lbs/static/addToolbar.js"></script> -->

    <script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=pFh66WksTS6ThAOet8U0Md4xytsikNdV"></script>
    <script src="../js/bibi/jquery-2.1.0.js"></script>

    <script>
        /////////////////////////  测试服 /////////////////////////////////////
        //地图数据地址
        // const WEB_POSITION_URL = 'http://120.78.89.29:8777/Line/Show';
        //录音文件上传地址
        // const WEB_AUDIO_URL = 'http://120.78.89.29:8777/uploadDownload/';
        /////////////////////////  正式服 /////////////////////////////////////

        //地图数据地址
        // const WEB_POSITION_URL='http://api.airuize.com:8777/Line/Show';
        const WEB_POSITION_URL='{{ route('home') }}/api/downloadposition';

        //录音文件上传地址
        const WEB_AUDIO_URL='http://api.airuize.com:8777/uploadDownload/';
        // const WEB_AUDIO_URL='{{ route('home') }}/api/playaudio/';
        /////////////////////////////////////////////////////////////////////

        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var map, geolocation, polyline;
        // var lastLng, lastLat;  //最后的坐标
        var isDraged = false;  //是否拖拽
        var countdownTime = 0; //倒计时为0时自动居中定位

        var lastLat = 24.171243848401744;
        var lastLng = 120.6455130413344;
        var g_map_zoom = 22;

        //默认隐藏安全提示
        $(".map-box").hide();

        //加载地图，调用浏览器定位服务

        //回到地图中心
        $(".back-center").click(function() {
            isDraged = false;
            // alert(lastLng+" | "+lastLat);
            // goCenter(lastLng, lastLat);
            goCenter(lastLat, lastLng);

        })

        map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(lastLng, lastLat), g_map_zoom);
        map.addControl(new BMap.MapTypeControl({
            mapTypes:[
                BMAP_NORMAL_MAP,
                BMAP_HYBRID_MAP
            ]}));
        map.setCurrentCity("台中");          // 设置地图显示的城市 此项是必须设置的

        // var marker = new AMap.Marker({
        //     position: new AMap.LngLat(113.879008, 22.568113),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
        // });
        var marker = null;

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

        var urlParam = GetRequest();
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
                    $(".player").css({ "display": "block" });
                    // $(".player audio").attr("src", WEB_AUDIO_URL + data.sound + '.mp3');
                    $(".player audio").attr("src", 'http://api.airuize.com:8777/uploadDownload/1606465119-1606465080421.amr.mp3');
                    // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                }

                if (data.position) {
                    var lat = data.position[data.position.length - 1].split(',')[0];
                    var lng = data.position[data.position.length - 1].split(',')[1];
                    lastLat = lat;
                    lastLng = lng;
                    goCenter(lastLat, lastLng);

                    if (marker) {
                        map.removeOverlay(marker);
                    }
                    var point = new BMap.Point(lastLng, lastLat);
                    var marker = new BMap.Marker(point);
                    map.addOverlay(marker);

                    $(".address").text(data.address[data.address.length - 1]);
                }
            }
        })

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

                    if (data.sound && $(".player").css("display") == 'none') {
                        $(".player").css({ "display": "block" });
                        // $(".player audio").attr("src", WEB_AUDIO_URL + data.sound + '.mp3');
                        $(".player audio").attr("src", 'http://api.airuize.com:8777/uploadDownload/1606465119-1606465080421.amr.mp3');
                        // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                    }

                    if (data.position) {
                        var lat = data.position[data.position.length - 1].split(',')[0];
                        var lng = data.position[data.position.length - 1].split(',')[1];
                        lastLat = lat;
                        lastLng = lng;
                        goCenter(lastLat, lastLng);

                        if (marker) {
                            map.removeOverlay(marker);
                        }
                        var point = new BMap.Point(lastLng, lastLat);
                        var marker = new BMap.Marker(point);        // 创建标注
                        map.addOverlay(marker);

                        $(".address").text(data.address[data.address.length - 1]);

                        //删除轨迹
                        if (polyline) {
                            map.removeOverlay(polyline);
                        }

                        var myTrip = getPolylineDatas(data);
                        polyline = new BMap.Polyline(
                            myTrip,
                            {strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5}
                        );
                        map.addOverlay(polyline);

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
                                    resArr.push(new BMap.Point(d[1], d[0]));
                                }
                            }
                            // console.log(resArr)
                            return resArr;
                        }
                    }
                }

            })

        }, 5000)

        //居中
        // function goCenter(lng, lat){
        function goCenter(lat, lng) {
            console.log(">>goCenter()");
            console.log('lat='+lat);
            console.log('lng='+lng);

            if(isDraged){
                return;
            }

            if (map) {
                map.centerAndZoom(new BMap.Point(lng, lat), g_map_zoom);
            }
        }

        //鼠标移动事件
        function showInfoDragend(){
            if (map) {
                var center = map.getCenter(); //获取当前地图中心位置
                // alert(center);
                isDraged = true;
                countdownTime = 120;//倒计时2分钟
            }
        }

        //倒计时
/*
        function countdownGoCenter(){
            setInterval(function() {
                //拖拽后 && 倒计时为0
                if(isDraged && countdownTime==0){
                    isDraged = false;
                    goCenter(lastLng, lastLat);
                }

                //
                countdownTime --;
                if(countdownTime < 0){
                    countdownTime = 0;
                }

            }, 1000);
        }

        countdownGoCenter();
*/
        //设置语音音量
        document.getElementById("audiojs").volume = 1;

    </script>
</body>
</html>