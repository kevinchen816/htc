<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
    /*body, html,#map {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}*/


        body, html {
            height: 100%;
            width: 100%;
        }

        .map-box {
            height: 100%;
            width: 100%;
        }

        /*#map {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}*/

        #map {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            /* display: none; */
            width: 100%;height: 100%;
        }

    </style>
    <script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=pFh66WksTS6ThAOet8U0Md4xytsikNdV"></script>
    <script src="../js/bibi/jquery-2.1.0.js"></script>
    <title>地图展示</title>
</head>
<body>
    <!-- <div id="map"></div> -->

    <div style="background-color: #376fd8; margin: 0px 0px 0px; color: #ffffff; text-align: center;">
        <h2 style="display:none;" class="save-content"> 我已经安全，停止分享！</h2>
    </div>

    <div class="map-box">
        <div id="map"> </div>

        <div class="back-center">
        </div>

        <div class="player">
            <audio controls="controls" id="audiojs" preload="auto">
            </audio>
        </div>

        <div class="address">
        </div>
    </div>

</body>
</html>
<script type="text/javascript">
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

    var map;
    var lastLat = 24.171243848401744;
    var lastLng = 120.6455130413344;
    var g_map_zoom = 22;


    // var map = new BMap.Map("map");    // 创建Map实例
    // map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  // 初始化地图,设置中心点坐标和地图级别
    // map.addControl(new BMap.MapTypeControl({
    //     mapTypes:[
    //         BMAP_NORMAL_MAP,
    //         BMAP_HYBRID_MAP
    //     ]}));
    // map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
    // map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

        map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(lastLng, lastLat), g_map_zoom);
        map.addControl(new BMap.MapTypeControl({
            mapTypes:[
                BMAP_NORMAL_MAP,
                BMAP_HYBRID_MAP
            ]}));
        map.setCurrentCity("台中");          // 设置地图显示的城市 此项是必须设置的

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
                    //隐藏地图
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
                    $(".player audio").attr("src", WEB_AUDIO_URL + data.sound + '.mp3');
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

                    // if (marker) {
                    //     map.remove(marker)
                    // }
                    // marker = new AMap.Marker({
                    //     position: new AMap.LngLat(lng, lat), // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
                    //     buttonOffset: new AMap.Pixel(0, 0),
                    //     icon: new AMap.Icon({
                    //         size: new AMap.Size(35, 50), //图标大小
                    //         imageSize: new AMap.Size(35, 50),
                    //         image: "../images/person.png",
                    //         imageOffset: new AMap.Pixel(0, 0)
                    //     })
                    // });
                    // map.add(marker);

                    // $(".address").text(data.address[data.address.length - 1]);
                }
            }
        })

        function goCenter(lat, lng) {
            console.log(">>goCenter()");
            console.log('lat='+lat);
            console.log('lng='+lng);

            // if(isDraged){
            //     return;
            // }

            if (map) {
                map.centerAndZoom(new BMap.Point(lng, lat), g_map_zoom);
            }
        }

</script>