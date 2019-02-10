@extends('layouts.admin')
@section('content')
<style>
    .laravellog {
        background-color: black;
        color: #f0f0f0;
    }
</style>
<div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
    <div class="panel-title">
        <span class="pull-left">
            <a class="btn btn-xs btn-primary button-refresh">Refresh</a>
        </span>
    </div>

<div class="panel-body" style="padding-left:0px;padding-right:0px;">
    <div class="row">
        <div class="col-md-12">
            <pre class="laravellog">
[2018-10-15 23:40:56] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:56] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:56] local.INFO:
[2018-10-15 23:40:56] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:56] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:56] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:56] local.INFO:
[2018-10-15 23:40:56] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:56] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:56] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:56] local.INFO:
[2018-10-15 23:40:57] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:57] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:57] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:57] local.INFO:
[2018-10-15 23:40:57] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:57] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:57] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:57] local.INFO:
[2018-10-15 23:40:57] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:57] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:57] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:57] local.INFO:
[2018-10-15 23:40:57] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:57] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:57] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:57] local.INFO:
[2018-10-15 23:40:58] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:58] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:58] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:58] local.INFO:
[2018-10-15 23:40:58] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:58] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:58] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:58] local.INFO:
[2018-10-15 23:40:58] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:58] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:58] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:58] local.INFO:
[2018-10-15 23:40:58] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:58] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:58] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:58] local.INFO:
[2018-10-15 23:40:59] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:59] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:59] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:59] local.INFO:
[2018-10-15 23:40:59] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:59] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:59] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:59] local.INFO:
[2018-10-15 23:40:59] local.INFO: ***************** Register Mobile...
[2018-10-15 23:40:59] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:40:59] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:40:59] local.INFO:
[2018-10-15 23:40:59] local.INFO: MobileController.SyncCameras
[2018-10-15 23:40:59] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:40:59] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:40:59] local.INFO:
[2018-10-15 23:41:00] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:00] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:00] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:00] local.INFO:
[2018-10-15 23:41:00] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:00] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:00] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:00] local.INFO:
[2018-10-15 23:41:00] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:00] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:00] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:00] local.INFO:
[2018-10-15 23:41:01] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:01] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:01] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:01] local.INFO:
[2018-10-15 23:41:01] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:01] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:01] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:01] local.INFO:
[2018-10-15 23:41:01] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:01] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:01] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:01] local.INFO:
[2018-10-15 23:41:02] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:02] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:02] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:02] local.INFO:
[2018-10-15 23:41:02] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:02] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:02] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:02] local.INFO:
[2018-10-15 23:41:02] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:02] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:02] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:02] local.INFO:
[2018-10-15 23:41:02] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:02] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:02] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:02] local.INFO:
[2018-10-15 23:41:03] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:03] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:03] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:03] local.INFO:
[2018-10-15 23:41:03] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:03] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:03] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:03] local.INFO:
[2018-10-15 23:41:04] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:04] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:04] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:04] local.INFO:
[2018-10-15 23:41:04] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:04] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:04] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:04] local.INFO:
[2018-10-15 23:41:04] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:04] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:04] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:04] local.INFO:
[2018-10-15 23:41:04] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:04] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:04] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:04] local.INFO:
[2018-10-15 23:41:05] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:05] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:05] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:05] local.INFO:
[2018-10-15 23:41:05] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:05] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:05] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:05] local.INFO:
[2018-10-15 23:41:05] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:05] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:05] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:05] local.INFO:
[2018-10-15 23:41:05] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:05] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:05] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:05] local.INFO:
[2018-10-15 23:41:06] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:06] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:06] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:06] local.INFO:
[2018-10-15 23:41:06] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:06] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:06] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:06] local.INFO:
[2018-10-15 23:41:06] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:06] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:06] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:06] local.INFO:
[2018-10-15 23:41:07] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:07] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:07] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:07] local.INFO:
[2018-10-15 23:41:07] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:07] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:07] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:07] local.INFO:
[2018-10-15 23:41:08] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:08] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:08] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:08] local.INFO:
[2018-10-15 23:41:08] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:08] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:08] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:08] local.INFO:
[2018-10-15 23:41:08] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:08] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:08] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:08] local.INFO:
[2018-10-15 23:41:08] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:08] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:08] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:08] local.INFO:
[2018-10-15 23:41:08] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:08] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:08] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:08] local.INFO:
[2018-10-15 23:41:09] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:09] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:09] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:09] local.INFO:
[2018-10-15 23:41:09] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:09] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:09] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:09] local.INFO:
[2018-10-15 23:41:09] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:09] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:09] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:09] local.INFO:
[2018-10-15 23:41:09] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:09] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:09] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:09] local.INFO:
[2018-10-15 23:41:10] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:10] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:10] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:10] local.INFO:
[2018-10-15 23:41:10] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:10] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:10] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:10] local.INFO:
[2018-10-15 23:41:10] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:10] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:10] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:10] local.INFO:
[2018-10-15 23:41:11] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:11] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:11] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:11] local.INFO:
[2018-10-15 23:41:11] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:11] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:11] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:11] local.INFO:
[2018-10-15 23:41:11] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:11] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:11] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:11] local.INFO:
[2018-10-15 23:41:12] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:12] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:12] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:12] local.INFO:
[2018-10-15 23:41:12] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:12] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:12] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:12] local.INFO:
[2018-10-15 23:41:12] local.INFO: MobileController.SyncCameras
[2018-10-15 23:41:12] local.INFO:    &gt;&gt;MobileController.SyncCameras: post parameters:Array
(
    [SessionToken] =&gt; 2MTc0LTUtMTYtMU1qQXhPQzB3T1Mwd05DQXlNam8xTWpvek5rTmlTVGw1U1ZBMFZHVQ
    [LastCameraID] =&gt; 0
    [MaxCameras] =&gt; 100
)

[2018-10-15 23:41:12] local.INFO: &gt;&gt; MobileController.SyncCameras | Response: Array
(
    [ResultCode] =&gt; 901
    [ErrorMsg] =&gt; Invalid or Expired Session Token
)

[2018-10-15 23:41:12] local.INFO:
[2018-10-15 23:41:12] local.INFO: ***************** Register Mobile...
[2018-10-15 23:41:12] local.INFO: MobileController.RegisterMobile: post parameters:Array
(
    [AppVersion] =&gt; 1.1.4
    [OS] =&gt; Android
    [OSVersion] =&gt; 7.1.2
    [MobileID] =&gt; 174
    [Brand] =&gt; Xiaomi
    [Model] =&gt; MI 5X
    [Serial] =&gt; b6c40aebe2e964d1
    [DeviceToken] =&gt;
)

[2018-10-15 23:41:12] local.INFO: &gt;&gt; MobileController.RegisterMobile | Response: Array
(
    [ResultCode] =&gt; 0
    [MobileID] =&gt; 174
)

[2018-10-15 23:41:12] local.INFO:
[2018-10-15 23:42:54] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:42:55] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:42:56] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:14] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:17] local.INFO: GetActions: id = 73
[2018-10-15 23:43:22] local.INFO: GetActions: id = 73
[2018-10-15 23:43:22] local.INFO: GetActions: id = 73
[2018-10-15 23:43:25] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:25] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:29] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:31] local.INFO: GetActions: id = 73
[2018-10-15 23:43:37] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:43:46] local.INFO: GetActions: id = 73
[2018-10-15 23:44:12] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:44:44] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:44:52] local.INFO: GetActions: id = 73
[2018-10-15 23:46:00] local.INFO: Portalcontroller.GetOverview id: 73
[2018-10-15 23:55:24] local.INFO: GetActions: id = 73
[2018-10-16 00:00:04] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 00:00:04] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 29
            [Cardspace] =&gt; 29479MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 26C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 00:00:04] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 00:00:04] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 00:00:04] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 00:00:04] local.INFO:      &gt;&gt;&gt; Pending Request [15]: Action Code = DS  ||  Pending Request: Action param = {&quot;REQUESTID&quot;:&quot;7752&quot;}
[2018-10-16 00:00:04] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 08:00:04
[2018-10-16 00:00:04] local.INFO:
[2018-10-16 00:00:06] local.INFO: CameraController.HandleCameraRequest: Route: api.downloadsettings
[2018-10-16 00:00:06] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [RequestID] =&gt; 7752
)

[2018-10-16 00:00:06] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 00:00:06] local.INFO: Handlecamerarequest - requestid = 7752
[2018-10-16 00:00:06] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 00:00:06] local.INFO: CompleteAction start: id:7752 msg:  actioncode: DS camera_id: 0
[2018-10-16 00:00:06] local.INFO:      &gt;&gt;&gt; CameraController.CameraSettings [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0,&quot;DataList&quot;:{&quot;cameramode&quot;:&quot;p&quot;,&quot;photoresolution&quot;:&quot;4&quot;,&quot;video_resolution&quot;:&quot;8&quot;,&quot;video_rate&quot;:&quot;4&quot;,&quot;video_bitrate&quot;:&quot;1000&quot;,&quot;video_bitrate7&quot;:&quot;500&quot;,&quot;video_bitrate8&quot;:&quot;1000&quot;,&quot;video_bitrate9&quot;:&quot;500&quot;,&quot;video_bitrate10&quot;:&quot;500&quot;,&quot;video_bitrate11&quot;:&quot;5000&quot;,&quot;video_length&quot;:&quot;5s&quot;,&quot;video_sound&quot;:&quot;on&quot;,&quot;photoburst&quot;:&quot;1&quot;,&quot;burst_delay&quot;:&quot;500&quot;,&quot;upload_resolution&quot;:&quot;1&quot;,&quot;photo_quality&quot;:&quot;2&quot;,&quot;photo_compression&quot;:&quot;43&quot;,&quot;timestamp&quot;:&quot;on&quot;,&quot;date_format&quot;:&quot;Ymd&quot;,&quot;time_format&quot;:&quot;24&quot;,&quot;temperature&quot;:&quot;c&quot;,&quot;quiettime&quot;:&quot;0s&quot;,&quot;timelapse&quot;:&quot;on&quot;,&quot;tls_start&quot;:&quot;00:00&quot;,&quot;tls_stop&quot;:&quot;23:59&quot;,&quot;tls_interval&quot;:&quot;6h&quot;,&quot;wireless_mode&quot;:&quot;instant&quot;,&quot;wm_schedule&quot;:&quot;4h&quot;,&quot;wm_sclimit&quot;:&quot;20&quot;,&quot;hb_interval&quot;:&quot;4h&quot;,&quot;online_max_time&quot;:&quot;2&quot;,&quot;cellularpw&quot;:&quot;&quot;,&quot;remotecontrol&quot;:&quot;off&quot;,&quot;dutytime&quot;:&quot;off&quot;,&quot;dt_sun&quot;:&quot;ffffff&quot;,&quot;dt_mon&quot;:&quot;ffffff&quot;,&quot;dt_tue&quot;:&quot;ffffff&quot;,&quot;dt_wed&quot;:&quot;00000f&quot;,&quot;dt_thu&quot;:&quot;000000&quot;,&quot;dt_fri&quot;:&quot;000000&quot;,&quot;dt_sat&quot;:&quot;000000&quot;,&quot;use_crc32&quot;:&quot;n&quot;,&quot;blockmode1&quot;:&quot;off&quot;,&quot;blockmode2&quot;:&quot;off&quot;,&quot;blockmode3&quot;:&quot;off&quot;,&quot;blockmode4&quot;:&quot;off&quot;,&quot;blockmode5&quot;:&quot;off&quot;,&quot;blockmode7&quot;:&quot;off&quot;,&quot;blockmode8&quot;:&quot;off&quot;,&quot;blockmode9&quot;:&quot;off&quot;,&quot;blockmode10&quot;:&quot;off&quot;,&quot;blockmode11&quot;:&quot;off&quot;}}]
[2018-10-16 00:00:06] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 08:00:06
[2018-10-16 00:00:06] local.INFO:
[2018-10-16 00:39:39] local.INFO: Portalcontroller.GetOverview id: 54
[2018-10-16 00:39:46] local.INFO: Portalcontroller.GetOverview id: 54
[2018-10-16 00:45:25] local.INFO: Portalcontroller.GetOverview id: 54
[2018-10-16 01:06:35] local.INFO: CameraController.HandleCameraRequest: Route: api.uploadthumb
[2018-10-16 01:06:35] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [FileName] =&gt; PICT1094.JPG
    [upload_resolution] =&gt; 1
    [photo_quality] =&gt; 2
    [photo_compression] =&gt; 43
    [Source] =&gt; tl
    [DateTime] =&gt; 20181016090618
    [Battery] =&gt; f
    [SignalValue] =&gt; 25
    [Cardspace] =&gt; 29478MB
    [Cardsize] =&gt; 30432MB
    [Temperature] =&gt; 26C
    [mcu] =&gt; 4.36
    [FirmwareVersion] =&gt; 20181001
    [cellular] =&gt; 4G LTE
    [Image] =&gt; Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt;
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; PICT1094.JPG
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; image/jpeg
            [size:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 12663
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 0
            [hashName:protected] =&gt;
            [pathName:SplFileInfo:private] =&gt; /tmp/phpz44ANt
            [fileName:SplFileInfo:private] =&gt; phpz44ANt
        )

)

[2018-10-16 01:06:35] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 01:06:35] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 01:06:35] local.INFO: CameraController.ProcessAccountPoints points_initial:50000
[2018-10-16 01:06:35] local.INFO: CameraController.ProcessAccountPoints    points_used:1789.00
[2018-10-16 01:06:35] local.INFO: CameraController.ProcessAccountPoints current points:1.5
[2018-10-16 01:06:35] local.INFO:      &gt;&gt;&gt; CameraController.UploadPhoto (thumbnail) [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 01:06:35] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 09:06:35
[2018-10-16 01:06:35] local.INFO:
[2018-10-16 01:18:55] local.INFO: Portalcontroller.GetOverview id: 54
[2018-10-16 01:44:30] local.INFO: Portalcontroller.GetOverview id: 54
[2018-10-16 01:53:53] local.INFO: GetActions: id = 54
[2018-10-16 02:27:08] local.INFO: Portalcontroller.GetOverview id: 15
[2018-10-16 02:29:40] local.INFO: GetActions: id = 54
[2018-10-16 04:00:16] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 04:00:16] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 25
            [Cardspace] =&gt; 29478MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 25C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 04:00:16] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 04:00:16] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 04:00:16] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 04:00:16] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 12:00:16
[2018-10-16 04:00:16] local.INFO:
[2018-10-16 07:06:37] local.INFO: CameraController.HandleCameraRequest: Route: api.uploadthumb
[2018-10-16 07:06:37] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [FileName] =&gt; PICT1095.JPG
    [upload_resolution] =&gt; 1
    [photo_quality] =&gt; 2
    [photo_compression] =&gt; 43
    [Source] =&gt; tl
    [DateTime] =&gt; 20181016150620
    [Battery] =&gt; f
    [SignalValue] =&gt; 24
    [Cardspace] =&gt; 29477MB
    [Cardsize] =&gt; 30432MB
    [Temperature] =&gt; 25C
    [mcu] =&gt; 4.36
    [FirmwareVersion] =&gt; 20181001
    [cellular] =&gt; 4G LTE
    [Image] =&gt; Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt;
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; PICT1095.JPG
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; image/jpeg
            [size:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 14228
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 0
            [hashName:protected] =&gt;
            [pathName:SplFileInfo:private] =&gt; /tmp/phpgZsKpo
            [fileName:SplFileInfo:private] =&gt; phpgZsKpo
        )

)

[2018-10-16 07:06:37] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 07:06:37] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 07:06:37] local.INFO: CameraController.ProcessAccountPoints points_initial:50000
[2018-10-16 07:06:37] local.INFO: CameraController.ProcessAccountPoints    points_used:1790.50
[2018-10-16 07:06:37] local.INFO: CameraController.ProcessAccountPoints current points:1.5
[2018-10-16 07:06:38] local.INFO:      &gt;&gt;&gt; CameraController.UploadPhoto (thumbnail) [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 07:06:38] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 15:06:38
[2018-10-16 07:06:38] local.INFO:
[2018-10-16 08:00:16] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 08:00:16] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 99
            [Cardspace] =&gt; 29477MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 25C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 08:00:16] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 08:00:16] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 08:00:16] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 08:00:16] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 16:00:16
[2018-10-16 08:00:16] local.INFO:
[2018-10-16 12:00:16] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 12:00:16] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 24
            [Cardspace] =&gt; 29477MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 24C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 12:00:16] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 12:00:16] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 12:00:16] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 12:00:16] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 20:00:16
[2018-10-16 12:00:16] local.INFO:
[2018-10-16 13:06:40] local.INFO: CameraController.HandleCameraRequest: Route: api.uploadthumb
[2018-10-16 13:06:40] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [FileName] =&gt; PICT1096.JPG
    [upload_resolution] =&gt; 1
    [photo_quality] =&gt; 2
    [photo_compression] =&gt; 43
    [Source] =&gt; tl
    [DateTime] =&gt; 20181016210622
    [Battery] =&gt; f
    [SignalValue] =&gt; 23
    [Cardspace] =&gt; 29477MB
    [Cardsize] =&gt; 30432MB
    [Temperature] =&gt; 24C
    [mcu] =&gt; 4.36
    [FirmwareVersion] =&gt; 20181001
    [cellular] =&gt; 4G LTE
    [Image] =&gt; Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt;
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; PICT1096.JPG
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; image/jpeg
            [size:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 13165
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 0
            [hashName:protected] =&gt;
            [pathName:SplFileInfo:private] =&gt; /tmp/phpAsa0ly
            [fileName:SplFileInfo:private] =&gt; phpAsa0ly
        )

)

[2018-10-16 13:06:40] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 13:06:40] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 13:06:40] local.INFO: CameraController.ProcessAccountPoints points_initial:50000
[2018-10-16 13:06:40] local.INFO: CameraController.ProcessAccountPoints    points_used:1792.00
[2018-10-16 13:06:40] local.INFO: CameraController.ProcessAccountPoints current points:1.5
[2018-10-16 13:06:40] local.INFO:      &gt;&gt;&gt; CameraController.UploadPhoto (thumbnail) [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 13:06:40] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-16 21:06:40
[2018-10-16 13:06:40] local.INFO:
[2018-10-16 16:00:17] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 16:00:17] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 24
            [Cardspace] =&gt; 29477MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 24C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 16:00:17] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 16:00:17] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 16:00:17] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 16:00:17] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 00:00:17
[2018-10-16 16:00:17] local.INFO:
[2018-10-16 18:30:23] local.INFO: GetActions: id = 73
[2018-10-16 19:06:41] local.INFO: CameraController.HandleCameraRequest: Route: api.uploadthumb
[2018-10-16 19:06:41] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [FileName] =&gt; PICT1097.JPG
    [upload_resolution] =&gt; 1
    [photo_quality] =&gt; 2
    [photo_compression] =&gt; 43
    [Source] =&gt; tl
    [DateTime] =&gt; 20181017030624
    [Battery] =&gt; f
    [SignalValue] =&gt; 24
    [Cardspace] =&gt; 29476MB
    [Cardsize] =&gt; 30432MB
    [Temperature] =&gt; 24C
    [mcu] =&gt; 4.36
    [FirmwareVersion] =&gt; 20181001
    [cellular] =&gt; 4G LTE
    [Image] =&gt; Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt;
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; PICT1097.JPG
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; image/jpeg
            [size:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 13043
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 0
            [hashName:protected] =&gt;
            [pathName:SplFileInfo:private] =&gt; /tmp/phpLXW91K
            [fileName:SplFileInfo:private] =&gt; phpLXW91K
        )

)

[2018-10-16 19:06:41] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 19:06:41] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 19:06:41] local.INFO: CameraController.ProcessAccountPoints points_initial:50000
[2018-10-16 19:06:41] local.INFO: CameraController.ProcessAccountPoints    points_used:1793.50
[2018-10-16 19:06:41] local.INFO: CameraController.ProcessAccountPoints current points:1.5
[2018-10-16 19:06:41] local.INFO:      &gt;&gt;&gt; CameraController.UploadPhoto (thumbnail) [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 19:06:41] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 03:06:41
[2018-10-16 19:06:41] local.INFO:
[2018-10-16 20:00:16] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-16 20:00:16] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 24
            [Cardspace] =&gt; 29476MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 24C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-16 20:00:16] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-16 20:00:16] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-16 20:00:16] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-16 20:00:16] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 04:00:16
[2018-10-16 20:00:16] local.INFO:
[2018-10-16 20:15:09] local.INFO: GetActions: id = 15
[2018-10-16 23:03:57] local.INFO: GetActions: id = 73
[2018-10-16 23:03:58] local.INFO: PortalController.GetRequestMissingImage start
[2018-10-16 23:09:50] local.INFO: Portalcontroller.GetOverview id: 79
[2018-10-17 00:00:17] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-17 00:00:17] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 24
            [Cardspace] =&gt; 29476MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 24C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-17 00:00:17] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-17 00:00:17] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-17 00:00:17] local.INFO:      &gt;&gt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-17 00:00:17] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 08:00:17
[2018-10-17 00:00:17] local.INFO:
[2018-10-17 01:06:44] local.INFO: CameraController.HandleCameraRequest: Route: api.uploadthumb
[2018-10-17 01:06:44] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [FileName] =&gt; PICT1098.JPG
    [upload_resolution] =&gt; 1
    [photo_quality] =&gt; 2
    [photo_compression] =&gt; 43
    [Source] =&gt; tl
    [DateTime] =&gt; 20181017090626
    [Battery] =&gt; f
    [SignalValue] =&gt; 23
    [Cardspace] =&gt; 29475MB
    [Cardsize] =&gt; 30432MB
    [Temperature] =&gt; 24C
    [mcu] =&gt; 4.36
    [FirmwareVersion] =&gt; 20181001
    [cellular] =&gt; 4G LTE
    [Image] =&gt; Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt;
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; PICT1098.JPG
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; image/jpeg
            [size:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 13956
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] =&gt; 0
            [hashName:protected] =&gt;
            [pathName:SplFileInfo:private] =&gt; /tmp/php9FiFAZ
            [fileName:SplFileInfo:private] =&gt; php9FiFAZ
        )

)

[2018-10-17 01:06:44] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-17 01:06:44] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-17 01:06:44] local.INFO: CameraController.ProcessAccountPoints points_initial:50000
[2018-10-17 01:06:44] local.INFO: CameraController.ProcessAccountPoints    points_used:1795.00
[2018-10-17 01:06:44] local.INFO: CameraController.ProcessAccountPoints current points:1.5
[2018-10-17 01:06:44] local.INFO:      &gt;&gt;&gt; CameraController.UploadPhoto (thumbnail) [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-17 01:06:44] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 09:06:44
[2018-10-17 01:06:44] local.INFO:
[2018-10-17 04:00:17] local.INFO: CameraController.HandleCameraRequest: Route: api.report
[2018-10-17 04:00:17] local.INFO: CameraController.HandleCameraRequest: post parameters:Array
(
    [iccid] =&gt; 89860117851014783481
    [module_id] =&gt; 861107032685597
    [model_id] =&gt; lookout-na
    [cellular] =&gt; 4G LTE
    [DataList] =&gt; Array
        (
            [Battery] =&gt; f
            [SignalValue] =&gt; 23
            [Cardspace] =&gt; 29475MB
            [Cardsize] =&gt; 30432MB
            [Temperature] =&gt; 24C
            [mcu] =&gt; 4.36
            [FirmwareVersion] =&gt; 20181001
            [cellular] =&gt; 4G LTE
        )

)

[2018-10-17 04:00:17] local.INFO: CameraController.ValidateSim: [89860117851014783481 | 861107032685597 | lookout-na]
[2018-10-17 04:00:17] local.INFO: CameraController.HandleCameraRequest: Primary User Name: Kevin (kevin@10ware.com) Camera: Mountaineer
[2018-10-17 04:00:17] local.INFO:      &gt;&ggt;&gt; CameraController.ReportIn [camera_id=15]: ResultCode (0) $result = [{&quot;ResultCode&quot;:0}]
[2018-10-17 04:00:17] local.INFO:  &gt;&gt; Camera DateTimeStamp: Asia/Hong_Kong/2018-10-17 12:00:17
[2018-10-17 04:00:17] local.INFO:
</pre>
                            </div>
        </div>
    </div>

    <div class="panel-title">
        <span class="pull-left">
            <a class="btn btn-xs btn-primary button-refresh">Refresh</a>
        </span>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".button-refresh").click(function () {
            location.reload();
        });
    });
</script>
@stop
