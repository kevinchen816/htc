<!DOCTYPE html>
<html>
<head>
   <title>Bootstrap 模板</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->

   <!-- 引入 Bootstrap -->
   <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
   <!-- 新 Bootstrap 核心 CSS 文件 -->
   <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


   <!-- HTML5 Shiv 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
   <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
   <![endif]-->
</head>
<body>
   <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default panel-success custom-settings-panel">
                    <div class="panel-heading">
                        Camera Identification
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputSmall">Camera Description</label>
                            <div class="col-md-7">
                                <input type="text"
                                    name="54_camera_desc"
                                    maxlength="30"
                                    value="Truphone #1"
                                    id="54_camera_desc"
                                    class="form-control input-sm"
                                    placeholder="Input Camera Description">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputSmall">Camera Location</label>
                            <div class="col-md-7">
                                <input type="text"
                                name="54_camera_loc"
                                maxlength="30"
                                value=""
                                id="54_camera_loc"
                                class="form-control input-sm"
                                placeholder="Input Camera Location">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputSmall">Camera Region</label>
                            <div class="col-md-7">
                                <select id="54_country" class="bs-select form-control input-sm"   name="54_country">
                                    <option value="USA">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="AU">Australia</option>
                                    <option value="CN" selected="selected">China</option>
                                    <option value="EU">Europe</option>
                                </select>
                                <span class="help-block"> Select the country where the camera is located. </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputSmall">Time Zone</label>
                            <div class="col-md-7">
                                <select id="54_timezone" class="bs-select form-control input-sm"   name="54_timezone">
                                    <option value="Asia/Hong_Kong" selected="selected">Hong_Kong</option>
                                </select>
                                <span class="help-block"> Select the time zone where the camera is located. </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default panel-primary custom-settings-panel">
                    <div class="panel-heading">
                        Notifications
                        <span class="pull-right">
                            <a href="/account/profile-emails" class="btn btn-xs btn-primary">
                                <i class="fa fa-gear"></i> Manage Addresses
                            </a>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="button-checkbox">
                                    <button type="button" class="btn btn-default btn-xs" data-color="info">Send Mobile Push Notifications</button>
                                    <input type="checkbox" class="hidden" name="push_notifications" id="push_notifications" checked />
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="button-checkbox">
                                    <button type="button" class="btn btn-default btn-xs" data-color="info">kevin@10ware.com</button>
                                    <input type="checkbox" class="hidden" name="54_email_owner" id="54_email_owner" checked />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default panel-primary custom-settings-panel">
                <div class="panel-heading">
                    High Activity Suppression
                    <!--<a class="btn btn-info btn-xs ToggleHelp pull-right" help-id="activity-suppression"><i class="fa fa-question"></i></a>-->
                    <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="activity-suppression">
                        <i class="fa fa-question"></i>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-default btn-xs" data-color="info">Use Activity Suppression</button>
                                <input type="checkbox" class="hidden" name="54_bw_option" id="54_bw_option"   />
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label" for="inputSmall">Average Uploads per Hour</label>
                        <div class="col-md-5">
                            <input type="text" name="54_bw_medias_hour_est" maxlength="30" value="0" id="54_bw_medias_hour_est" class="form-control input-sm" placeholder="Input Ceiling Rate">
                            <span class="help-block"> Reccomended: set Quiet Time from 5s to 30s</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

      <h1>我是标题1 h1. <small>我是副标题1 h1</small></h1>
      <!--<h2>我是标题2 h2. <small>我是副标题2 h2</small></h2>
      <h3>我是标题3 h3. <small>我是副标题3 h3</small></h3>
      <h4>我是标题4 h4. <small>我是副标题4 h4</small></h4>
      <h5>我是标题5 h5. <small>我是副标题5 h5</small></h5>-->
      <h6>我是标题6 h6. <small>我是副标题6 h6</small></h6>
      <hr>

      <small>本行内容是在标签内</small><br>
      <strong>本行内容是在标签内</strong><br>
      <em>本行内容是在标签内，并呈现为斜体</em><br>
      <p class="text-left">向左对齐文本</p>
      <p class="text-center">居中对齐文本</p>
      <p class="text-right">向右对齐文本</p>
      <p class="text-muted">本行内容是减弱的</p>
      <p class="text-primary">本行内容带有一个 primary class</p>
      <p class="text-success">本行内容带有一个 success class</p>
      <p class="text-info">本行内容带有一个 info class</p>
      <p class="text-warning">本行内容带有一个 warning class</p>
      <p class="text-danger">本行内容带有一个 danger class</p>
      <hr>

      <div class="row">
         <div class="col-md-3" style="background-color: #dedef8;box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
            <h4>第一列</h4>
            <p>
               Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </p>
         </div>
         <div class="col-md-9" style="background-color: #dedef8;box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
            <h4>第二列 - 分为四个盒子</h4>
            <div class="row">
                  <div class="col-md-6" style="background-color: #B18904; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
                     <p>
                        Consectetur art party Tonx culpa semiotics. Pinterest assumenda minim organic quis.
                     </p>
                  </div>
                  <div class="col-md-6" style="background-color: #B18904; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
                     <p>
                         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                     </p>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-6" style="background-color: #B18904; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
                     <p>
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                     </p>
                  </div>
                  <div class="col-md-6" style="background-color: #B18904; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.
                     </p>
                  </div>
            </div>
         </div>
      </div>


      <!-- 通过把任意的 .table 包在 .table-responsive class 内，您可以让表格水平滚动以适应小型设备（小于 768px）。
      当在大于 768px 宽的大型设备上查看时，您将看不到任何的差别。 -->
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover table-condensed">
            <caption>基本的表格布局</caption>
            <thead>
               <tr>
                  <th>名称</th>
                  <th>城市</th>
               </tr>
            </thead>
            <tbody>
               <tr class="active">
                  <td>Tanmay</td>
                  <td>Bangalore</td>
               </tr>
               <tr class="success">
                  <td>Sachin</td>
                  <td>Mumbai</td>
               </tr>
               <tr class="info">
                  <td>Sachin</td>
                  <td>Mumbai</td>
               </tr>
               <tr class="warning">
                  <td>Sachin</td>
                  <td>Mumbai</td>
               </tr>
               <tr class="danger">
                  <td>Sachin</td>
                  <td>Mumbai</td>
               </tr>
            </tbody>
         </table>
      </div>
      <hr>

      <form role="form">
         <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control" id="name" placeholder="请输入名称">
         </div>
         <div class="form-group">
            <label for="inputfile">文件输入</label>
            <input type="file" id="inputfile">
            <p class="help-block">这里是块级帮助文本的实例。</p>
         </div>
         <div class="checkbox">
            <label>
               <input type="checkbox">请打勾
            </label>
         </div>
         <button type="submit" class="btn btn-default">提交</button>
      </form>

      <hr>

      <div class="panel panel-default panel-primary custom-settings-panel">
         <div class="panel-heading">
            Camera Identification
         </div>
         <div class="panel-body">
            <form class="form-horizontal" role="form">

               <!-- 静态控件 -->
               <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                     <p class="form-control-static">email@example.com</p>
                     <span class="help-block"> Select the time zone where the camera is located. </span>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-2 control-label" for="firstname" >名字</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="firstname" placeholder="请输入名字">
                     <span class="help-block"> Select the time zone where the camera is located. </span>
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-2 control-label" for="lastname" >姓</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="lastname" placeholder="请输入姓">
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox">请记住我
                        </label>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-default">登录</button>
                  </div>
               </div>
            </form>

         </div>
      </div>

      <hr>

      <form role="form">
         <div class="form-group">
            <label for="name">选择列表</label>
            <select class="form-control">
               <option>1</option>
               <option>2</option>
               <option>3</option>
               <option>4</option>
               <option>5</option>
            </select>

            <label for="name">可多选的选择列表</label>
            <select multiple class="form-control">
               <option>1</option>
               <option>2</option>
               <option>3</option>
               <option>4</option>
               <option>5</option>
            </select>
            </div>
      </form>


   </div>

   <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
   <!-- <script src="https://code.jquery.com/jquery.js"></script> -->
   <!-- 包括所有已编译的插件 -->
   <!-- <script src="js/bootstrap.min.js"></script> -->

   <!-- 新 Bootstrap 核心 CSS 文件 -->
   <!-- <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->

   <!-- 可选的Bootstrap主题文件（一般不使用） -->
   <script src="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"></script>

   <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
   <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>

   <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
   <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <!--
   还可以使用以下的 CDN 服务：
      国内推荐使用 : https://www.staticfile.org/
      国际推荐使用：https://cdnjs.com/
   -->
</body>
</html>
