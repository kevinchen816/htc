<!DOCTYPE html>
<html>
<head>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJW4jsPlNKgv6jFm3B5Edp5ywgdqLWdmc&sensor=false">
    </script>
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
        // const WEB_POSITION_URL='https://portal.eztoview.com/api/downloadposition';
        const WEB_POSITION_URL='http://htc.test/api/downloadposition';

        //录音文件上传地址
        const WEB_AUDIO_URL='http://api.airuize.com:8777/uploadDownload/';
        /////////////////////////////////////////////////////////////////////

        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var map, geolocation, polyline;
        var lastLng, lastLat;  //最后的坐标
        var isDraged = false;  //是否拖拽
        var countdownTime = 0; //倒计时为0时自动居中定位
        var marker = null;
        var myCenter; // = new google.maps.LatLng(24.171243848401744, 120.6455130413344);

        lastLng = 24.171243848401744;
        lastLat = 120.6455130413344;
        myCenter = new google.maps.LatLng(lastLng, lastLat);

        var p1 = new google.maps.LatLng(24.17032375493668, 120.64481566699327);
        var p2 = new google.maps.LatLng(24.17104808439007, 120.64359257968727);
        var p3 = new google.maps.LatLng(24.170509731810075, 120.64351747783515);
        var pos = [p1, p2, p3];

        var myTrip;
        var myPolyline;
        var index = 0;

        function initialize() {
            console.log(">> initialize()");

            var mapProp = {
                center: myCenter,
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP         // 用于显示默认的道路地图视图
            };
            map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

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

            // goCenter(lastLng, lastLat);


            // var urlParam = GetRequest();
            var urlParam = {
                "uid":12345,
                "eid":"123451607073689"
            };
            console.log(JSON.stringify(urlParam)); // {"sid":"54241","stag":"542411606465080"}

            // $.post(WEB_POSITION_URL, JSON.stringify(urlParam), function (data) {
            $.post(WEB_POSITION_URL, urlParam, function (data) {

                data = "{\"Code\":200, \"Data\":{\"AccountId\":54241, \"Status\":1, \"SoundFile\":\"1606465119-1606465080421.amr\", \"Tag\":\"542411606465080\", \"LineShareURL\":\"https://2i1i.cn/MYsu\", \"Point\":[\"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\"], \"RecordTime\":[\"2020-11-27T16:18:04.25690545+08:00\", \"2020-11-27T16:18:09.240894288+08:00\" ], \"MapName\":[\"台湾省台湾省靠近财团法人惠来里礼拜堂\", \"台湾省台湾省靠近财团法人惠来里礼拜堂\" ] }, \"Msg\":\"请求成功\", \"Path\":\"Line.Show\"}";

                console.log("A");
                console.log(data);
                console.log("B");

                // data = JSON.parse(data);
                console.log("C");
                console.log(data.Code);
                console.log("D");

                if (data.Code == 200 && data.Data) {
                    console.log("KK 1");

                    //分享结束
                    // if(data.Data.Status == 2){
                    //     //隐藏地图
                    //     $(".map-box").hide();
                    //     $(".save-content").show();
                    //     return;
                    // }else{
                        // $(".map-box").show();
                        // $(".save-content").hide();
                    // }

                    console.log(data);

                    // if (data.Data.SoundFile && $(".player").css("display") == 'none') {
                    //     $(".player").css({ "display": "block" });
                    //     $(".player audio").attr("src", WEB_AUDIO_URL + data.Data.SoundFile + '.mp3');
                    //     // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                    // }

                    // map.setCenter(data.Data.Point[data.Data.Point.length - 1].split(','));
                    var lat = data.Data.Point[data.Data.Point.length - 1].split(',')[0]; // kevin fix: 1->0
                    var lng = data.Data.Point[data.Data.Point.length - 1].split(',')[1]; // kevin fix: 0->1
                    // lat = 120.6455130413344;
                    // lng = 24.171243848401744;
                    console.log(lat);
                    console.log(lng);

                    lastLng = lng;
                    lastLat = lat;
                    goCenter(lastLng, lastLat);

                    // $(".address").text(data.Data.MapName[data.Data.MapName.length - 1]);
                    // if (marker) {
                    //     map.remove(marker)
                    // }

                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lastLng, lastLat),
                    });
                    marker.setMap(map);
                }
            })
        }

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

        function goCenter(lng, lat) {
            // if(isDraged){
            //     return;
            // }

            if (map) {
                // console.log("...1");
                // console.log("lng=".lng.", lat=".lat);
                console.log(lng);
                console.log(lat);
                map.setCenter(new google.maps.LatLng(lng, lat));
            }
        }

        // function countdownGoCenter(){
        //     setInterval(function() {
        //         console.log("...go center");
        //         goCenter(lastLng, lastLat);
        //     }, 3000);
        // }
        // countdownGoCenter();

/*
        var interval = setInterval(function () {
            console.log(".......refresh");
            var urlParam = GetRequest();
            console.log(JSON.stringify(urlParam)); // {"sid":"54241","stag":"542411606465080"}

            $.post(WEB_POSITION_URL, JSON.stringify(urlParam), function (data) {

                data = "{\"Code\":200, \"Data\":{\"AccountId\":54241, \"Status\":1, \"SoundFile\":\"1606465119-1606465080421.amr\", \"Tag\":\"542411606465080\", \"LineShareURL\":\"https://2i1i.cn/MYsu\", \"Point\":[\"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\", \"120.6455130413344,24.171243848401744\"], \"RecordTime\":[\"2020-11-27T16:18:04.25690545+08:00\", \"2020-11-27T16:18:09.240894288+08:00\" ], \"MapName\":[\"台湾省台湾省靠近财团法人惠来里礼拜堂\", \"台湾省台湾省靠近财团法人惠来里礼拜堂\" ] }, \"Msg\":\"请求成功\", \"Path\":\"Line.Show\"}";
                console.log(data);

                data = JSON.parse(data);
                if (data.Code == 200 && data.Data) {
                    //分享结束
                    if(data.Data.Status == 2){
                         //隐藏地图
                        $(".map-box").hide();
                        $(".save-content").show();
                        clearInterval(interval);
                        return;
                    }

                    //
                    console.log(data);

                    // if (data.Data.SoundFile && $(".player").css("display") == 'none') {
                    //     $(".player").css({ "display": "block" });
                    //     $(".player audio").attr("src", WEB_AUDIO_URL + data.Data.SoundFile + '.mp3');
                    //     // $(".player audio").attr("src",'http://web-map.oss-cn-shenzhen.aliyuncs.com/test.mp3');
                    // }

                    // map.setCenter(data.Data.Point[data.Data.Point.length - 1].split(','));
                    var lat = data.Data.Point[data.Data.Point.length - 1].split(',')[0];
                    var lng = data.Data.Point[data.Data.Point.length - 1].split(',')[1]
                    lat = 120.6447834804852;
                    lng = 24.170362907985176;
                    lastLng = lng;
                    lastLat = lat;
                    // goCenter(lastLng, lastLat);
                    map.setCenter(pos[index]); // TODO

                    if (marker) {
                        console.log(".....A");
                        marker.setMap(null);
                    }

                    // $(".address").text(data.Data.MapName[data.Data.MapName.length - 1]);
                    marker = new google.maps.Marker({
                        // position: new google.maps.LatLng(lastLng, lastLat),
                        position: pos[index], // TODO
                    });
                    marker.setMap(map);

                    //删除轨迹
                    if(myPolyline){
                        myPolyline.setMap(null);
                    }

                    // myTrip = [myCenter, p1, p2, p3];
                    if (index == 0) {
                        myTrip = [myCenter, p1];
                    } else if (index == 1) {
                        myTrip = [myCenter, p1, p2];
                    } else if (index == 2) {
                        myTrip = [myCenter, p1, p2, p3];
                    }
                    myPolyline = new google.maps.Polyline({
                        path: myTrip,
                        strokeColor: "#0000FF",
                        strokeOpacity: 0.8,
                        strokeWeight: 5
                    });
                    myPolyline.setMap(map);

                    index = (index+1) % 3;

                    // //删除轨迹
                    // if(polyline){
                    //     map.remove(polyline);
                    // }

                    // //绘制轨迹
                    // polyline = new AMap.Polyline({
                    //     map: map,
                    //     path: getPolylineDatas(data),
                    //     showDir:true,
                    //     strokeColor: "#28F",  //线颜色
                    //      // strokeOpacity: 1,     //线透明度
                    //     strokeWeight: 6,      //线宽
                    //     // strokeStyle: "solid"  //线样式
                    // });

                    function getPolylineDatas(_data){
                        var resArr = [];
                        for(var i=0, len=_data.Data.Point.length; i<len; i++){
                            var d = _data.Data.Point[i].split(',');
                            if(d[0]==undefined){
                                alert(_data.Data.Point[i]);
                            }else if(d[0]==NaN){
                                alert(_data.Data.Point[i]);
                            }

                            if(d[0]!="undefined" && d[1]!="undefined" && d[0]!=NaN && d[1]!=NaN && d[0]!=0 && d[1]!=0){
                                resArr.push([d[0], d[1]]);
                            }
                        }

                        console.log(resArr)
                        return resArr;
                    }

                    getPolylineDatas(data); // for test
                }
            })

        }, 5000)
*/
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
    <div id="googleMap" style="width:800px;height:800px;"></div>
</body>
</html>