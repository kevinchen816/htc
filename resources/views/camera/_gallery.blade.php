<!-- GALLERY TAB -->
<div class="tab-pane fade  active in" id="gallery-54">
<style type="text/css">
    .panel-body{
        overflow-x: hidden;
    }
    @media (max-width: 500px){
        .panel-body{
            overflow-x: visible;
        }
    }
    .cancel-modal,
    .confirm-modal{
        margin: 10px;
    }

    .image-checkbox {
        position: absolute;
        z-index: 5;
    }

    .check-label input {
        display: none
    }

    .check-label {
        position: relative;
        cursor: pointer;
    }

    .check-label .span-cr {
        display: inline-block;
        position: absolute;
        left: -10px;
        top: -25px;
        background-color:rgba(0, 0, 0, 0.3);
    }

    .check-label input:checked + .span-cr {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .check-label:hover .span-cr{
        background-color: rgba(0, 0, 0, 0.4);
    }

    .check-label input:checked + .span-cr:after{
        background-repeat: no-repeat;
        background-image: url(http://www.ridgetec.us/images/Check-Mark2.png);
        background-size: 100% 100%;
        position: absolute;
        top: 5%;
        left: 0%;
        height: 95%;
        width: 100%;
        content: ' ';
    }

    .thumbnail-timestamp {
        position: absolute;
        width: 100%;
        //height:95%;
        bottom: 3px;
        background-color:rgba(0, 0, 0, 0.35);
        padding-bottom: 2px;
        padding-right:10px;
    }

    .custom-thumbnail-grid-column {
        padding-left: 3px!important;
        padding-right: 0px;
        margin-top: 0px!important;
        margin-bottom: 0px!important;
        padding-bottom: 4px!important;
    }

    .row.no-gutters {
      margin-right: 0;
      margin-left: 0;
    }

    .row.no-gutters > [class^="col-"],
    .row.no-gutters > [class*=" col-"] {
      padding-right: 0;
      padding-left: 0;
    }

.popup-video {
    position: absolute;
    top: 20%;
    left: 32%;
    height: 60%;
    width: 36%;
    background-repeat: no-repeat;
    background-image: url(http://www.ridgetec.us/images/icon-play-video-white.png);
    background-size: 100% 100%;
    cursor: pointer;
}

.custom-video-close {
    position: absolute;

    /* don't need to go crazy with z-index here, just sits over .modal-guts */
    z-index: 1100!important;

    top: -4px;
    right: -4px;
    width: 30px;
    height: 30px;
    border: 0;
    background-image: url(http://www.ridgetec.us/images/close-icon.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    //background-color:rgba(0, 0, 0, 1.00)!important;
    //background-color: black;
    color: white;
    padding: 0px 0px 0px 0px!important;
    //font-size: 4.0rem;
    opacity: 1.0;
}

.modal-video-content {
    padding-top:0px;
    padding-right:0px;
    padding-bottom:0px;
    padding-left:0px;
    background-color: transparent;
        margin-top:8px;
        border-style: solid;
    border-color: #9d0b0e;
    border-width: 3px;
}

.modal-dialog-player {
   //width: 77%;
   margin: 0 auto;
}

/*
@media  screen and (orientation : portrait) {
    .modal-dialog-player {
       width: 100%;
       margin: 0 auto;
    }
}
*/

@media  screen and (max-width: 480px) {
    .thumbnail-timestamp {
        display: none !important;
    }

}

</style>

<div class="panel panel-default panel-primary custom-settings-panel">
        <div class="panel-heading" style="padding-top:6px;">
        <h4 class="panel-title">
            <span style="font-size: .70em; margin-top: 6px; margin-left: 1px;">
                <i class="fa fa-camera" style="color:lime;"></i> HighRes | <i class="fa fa-hourglass" style="color:#ffd352;"></i> Pending Request
            </span>

            <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="gallery"><i class="fa fa-question"></i></a>

            <span class="pull-right" style="font-size: .70em; margin-top: 6px;">
                <strong>(3 thumbs this page) | Page 1 of 1</strong>
            </span>
        </h4>
    </div>

    <div class="panel-body" style="padding-top:2px;">
        <!-- ====GALLERY CODE== -->

        <div class="row">
            <div class="col-md-12">

                <div class="col-count-4 gallery-manager" data-col="4" data-row="6">

                    <div class="gallery-toolbar">
                        <div class="row">
                            <div class="col-sm-12 clearfix">
                                                                <div class="pull-left" style="margin-top: 1px; margin-bottom:1px; padding-top:0px; padding-bottom: 0px;">

                                </div>

                                <div class="pull-right">
                                    <!--<span id="itemAmount"> </span>-->
                                    <div class="btn-group" role="group" aria-label="User options">

                                        <div class="btn-group" data-toggle="buttons" data-toggle="tooltip" title="Manage Photos" id="manage">
                                            <label class="btn btn-default" style="padding-top:2px;padding-bottom:2px;">
                                                <input type="checkbox" autocomplete="off" id="multi-select">
                                                <i class="fa fa-wrench"></i>
                                                <span id="itemAmount"> </span>
                                            </label>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button
                                                type="button"
                                                id="with-selected"
                                                class="btn btn-default dropdown-toggle disabled hidden"
                                                style="padding-top:2px;padding-bottom:2px;"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                data-multiple="1"
                                                aria-expanded="false">
                                                <span>
                                                <i class="fa fa-bolt"></i>
                                                                                                Action
                                                                                                <span class="caret"></span>
                                                </span>
                                            </button>


                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="btn" data-toggle="modal" data-target="#DeleteModal" data-type="delete">
                                                        Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="btn" data-toggle="modal" data-target="#HighresModal" data-type="highres">
                                                                                                                Request HighRes MAX
                                                                                                            </a>
                                                </li>
                                                                                                <li>
                                                    <a class="btn" data-toggle="modal" data-target="#OriginalModal" data-type="original">
                                                                                                                Request Original
                                                                                                            </a>
                                                </li>
                                                <li>
                                                    <a class="btn" data-toggle="modal" data-target="#VideoModal" data-type="video">
                                                                                                                Request Video
                                                                                                            </a>
                                                </li>
                                                                                            </ul>
                                        </div>

                                        <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-none-54" data-action="select-none" data-toggle="tooltip" title="Select None"><i class="far fa-square"></i></a>
                                        <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="select-all-54" data-action="select-all"data-toggle="tooltip" title="Select All"><i class="fa fa-th"></i></a>
                                        <a class="btn btn-default disabled hidden" style="padding-top:2px;padding-bottom:2px;" id="clear-all-54" data-action="clear-all"data-toggle="tooltip" title="Clear All"><i class="fa fa-eraser"></i></a>



                                        <div class="btn-group" role="group">
                                            <button
                                                type="button"
                                                class="btn btn-default dropdown-toggle"
                                                style="padding-top:2px;padding-bottom:2px;"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-toggle="tooltip"
                                                title="Column Layout">
                                                Columns
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu layout-grid">

                                                <li>
                                                    <a href="/cameras/gallerylayout/54/2"  >
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerylayout/54/3"  >
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerylayout/54/4" class="current-item">
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerylayout/54/6"  >
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerylayout/54/12"   >
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                        <span class="grid-block"></span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                        <div class="btn-group" role="group">
                                            <button
                                                type="button"
                                                class="btn btn-default dropdown-toggle"
                                                style="padding-top:2px;padding-bottom:2px;"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-toggle="tooltip"
                                                title="Thumbs per page">
                                                Thumbs
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu layout-grid">

                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/10">
                                                        10 Per Page
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/20">
                                                        20 Per Page
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/30">
                                                        30 Per Page
                                                    </a>
                                                </li>

                                                                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/40">
                                                        40 Per Page
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/60">
                                                        60 Per Page
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="/cameras/gallerythumbs/54/80">
                                                        80 Per Page
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                                                            </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- gallery-toolbar -->

                    <form method="POST" action="http://www.ridgetec.us/cameras/gallery" accept-charset="UTF-8" class="form-horizontal" role="form" name="pictureForm" id="gallery-form-54"><input name="_token" type="hidden" value="ZHGGTc2HCZReCSAdIoHRuojsPSm3kcKIDrByxGYl">

                    <input name="id" type="hidden" value="54">


                    <div class="thumbnail-gallery" data-token="">
                        <div id="info"></div>


                            <!-- Begin Row --><div class="row no-gutters">

                                <div class="col-xs-3 custom-thumbnail-grid-column column-number-1">
                <div class="image-checkbox">
                        <label style="font-size: 1.5em" class="check-label hidden">
                            <input type="checkbox" class="image-check" value="90815" id="check_90815" />
                            <span class="cr span-cr"></span>
                        </label>
                </div>


                <div class="image-highdef pull-right" hidden id="pending-90815">
                    <label style="font-size: 1.0em; margin-right: 4px;">
                        <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                    </label>
                </div>


                <a class="thumb-anchor" data-fancybox="gallery-54" href="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" data-caption="PICT0019.JPG | 09/08/2018 9:20:42 pm | Scheduled Upload | Standard Low(1/20/16136) | Points: 1.00" data-camera="54" data-id="90815" data-highres="0" data-pending="0">

                    <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=8e1e0e2ac491275350a4091d1b00b06b56f71477371a4eafbbab13995200d36e" class="img-responsive custom-thumb" title="PICT0019.JPG (90815)" alt="PICT0019.JPG" data-description="PICT0019.JPG">
                </a>


                                <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                    <a href="/cameras/download/54/90815"><i class="fa fa-download"></i></a>
                    09/08/2018 9:20:42 pm
                </p>



            </div>






                                <div class="col-xs-3 custom-thumbnail-grid-column column-number-2">
                <div class="image-checkbox">
                        <label style="font-size: 1.5em" class="check-label hidden">
                            <input type="checkbox" class="image-check" value="90809" id="check_90809" />
                            <span class="cr span-cr"></span>
                        </label>
                </div>


                <div class="image-highdef pull-right" hidden id="pending-90809">
                    <label style="font-size: 1.0em; margin-right: 4px;">
                        <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                    </label>
                </div>


                <a class="thumb-anchor" data-fancybox="gallery-54" href="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90809.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=1d5077f1ac01838988bdda3d6b30dfc85334b17ba5bc87d43dd8c0ee31568ba9" data-caption="PICT0013.JPG | 09/08/2018 8:50:36 pm | Scheduled Upload | Standard Low(1/20/12171) | Points: 1.00" data-camera="54" data-id="90809" data-highres="0" data-pending="0">

                    <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90809.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=1d5077f1ac01838988bdda3d6b30dfc85334b17ba5bc87d43dd8c0ee31568ba9" class="img-responsive custom-thumb" title="PICT0013.JPG (90809)" alt="PICT0013.JPG" data-description="PICT0013.JPG">
                </a>


                                <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                    <a href="/cameras/download/54/90809"><i class="fa fa-download"></i></a>
                    09/08/2018 8:50:36 pm
                </p>



            </div>






                                <div class="col-xs-3 custom-thumbnail-grid-column column-number-3">
                <div class="image-checkbox">
                        <label style="font-size: 1.5em" class="check-label hidden">
                            <input type="checkbox" class="image-check" value="90774" id="check_90774" />
                            <span class="cr span-cr"></span>
                        </label>
                </div>


                <div class="image-highdef pull-right" hidden id="pending-90774">
                    <label style="font-size: 1.0em; margin-right: 4px;">
                        <span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>
                    </label>
                </div>


                <a class="thumb-anchor" data-fancybox="gallery-54" href="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90774.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=a7a0fdc370766fb536db284708bf297e9488ed6eb6d3d645a21a546e3a0cd8e5" data-caption="PICT0008.JPG | 09/08/2018 8:30:12 pm | Motion | Standard Low(1/20/4875) | Points: 1.00" data-camera="54" data-id="90774" data-highres="0" data-pending="0">

                    <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90774.JPG?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJDYHALJC3XEXZNWA%2F20180911%2Fus-east-2%2Fs3%2Faws4_request&X-Amz-Date=20180911T012016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=86400&X-Amz-Signature=a7a0fdc370766fb536db284708bf297e9488ed6eb6d3d645a21a546e3a0cd8e5" class="img-responsive custom-thumb" title="PICT0008.JPG (90774)" alt="PICT0008.JPG" data-description="PICT0008.JPG">
                </a>


                                <p class="thumbnail-timestamp pull-right" style="font-size: .70em">
                    <a href="/cameras/download/54/90774"><i class="fa fa-download"></i></a>
                    09/08/2018 8:30:12 pm
                </p>



            </div>




                        </div><!-- End Row -->                    </div>
                    <!-- thumbnail-gallery -->

                    </form>


                </div>
                <!-- gallery-manager -->

            </div>
            <!-- col-md-12 -->
        </div>
        <!-- row -->

    </div>
    <!-- panel-body -->

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm" style="padding-left:2px;margin-left:2px;">

            </div>
        </div>
    </div>

</div>
<!-- panel -->

<div id="gallery" class="hidden">
    <div class="alert alert-sm alert-info help-container">
                <h4><strong>
        Media Gallery: How it works
    </strong>
</h4>
<p>
    <i class="fa fa-info-circle"></i> The primary function of the Media Gallery is to view your uploaded media, both Photos and Video
        clips. It also provides the means to perform Administrative functions.
</p>
<hr>


<h4>
    <i class="fa fa-image"></i> <strong>Viewing Media</strong>
</h4>

<p>
    Initially the gallery is presented as a page grid of thumbnails, each representing either a photo or a video clip sent to the portal by your camera.
    As your camera continues capturing and sending to the server, you can accumulate several pages of thumbnails. To make it easier for you to view
    on your device, whether it be a desktop computer, tablet or mobile phone, there are two buttons of interest:
</p>
<ul>
    <li>Layout</li>
    <li>Thumbs</li>
</ul>
<br />
<p>The <label class="label label-primary"> Layout</label> button provides a way to customize the number of grid columns that you prefer.  Click the button and select a layout option.
    The thumbnails will auto resize to fit the width, meaning more columns will produce smaller thumbnails and fewer, larger ones.</p>
<br />
<p>The <label class="label label-primary"> Thumbs</label> button provides a way to control the number of thumbnails sent per page by the server.  This is important for several reasons.
Fewer thumbs per page will load faster and use less data (if you use a mobile plan for example).  However you may find it more convenient to see more on a
page possibly giving you a full day overview  of your activity.
</p>
<p><strong><i class="fa fa-arrow-circle-right"></i>Both the Layout and Thumbs options will be remembered per camera in the system and will have these same values the next time you log in.</strong></p><br />

<h5><strong><i class="fa fa-play-circle"></i> The Lightbox</strong></h5>

<p>
In order to begin to view your media in a larger format simply click one of the thumbnails in the grid.  This will open a "lightbox".  A lightbox is a viewer that is optimized to
help you scroll through the media files, in either direction.  To move back and forth you can click the left and right arrows, tap left or right arrow keys on a keyboard, or if
your device has a touch screen you can swipe left or right.
</p>
<p>
    In order to exit the lightbox mode, press ESC on a keyboard, click or tap the <strong><i class="fa fa-times"></i></strong> in the upper right corner to close.  Clicking or
    tapping outside the boundry of an image will also close the lightbox viewer.
</p>
<hr>

<h4>
    <i class="fa fa-wrench"></i>  Manage Media
</h4>
<p>
    The <label class="label label-primary"><i class="fa fa-wrench"></i>  Manage</label> button toggles the management mode and reveals several additional related buttons.  These are:
</p>

<ul>
    <li><label class="label label-primary"> Select None</label></li>
    <li><label class="label label-primary"> Select All</label></li>
    <li><label class="label label-primary"> With Selected</label></li>
</ul>
<br />

<p>
    Toggling or activating the Manage mode will add a checkbox to each thumbnail in the grid, allowing you to select individual thumbs on the page.
    Once you have selected one or more thumbs by checking the box(es), you have several options. Use the <label class="label label-primary"> With Selected</label> button
    to perform the following with your selected media:
</p>

<ul>
    <li><label class="label label-primary"> Delete</label></li>
    <li><label class="label label-primary"> Request HighRes MAX</label></li>
</ul>

<br />
<p>
    <strong>Delete</strong> will remove this media file from the server permanently.</p>

<p>
<strong>Request HighRes MAX</strong> will queue an action request for each selected thumnail that is a photo event.  When the camera next communicates with
the server, it will be instructed one by one to process these requests. Once you have performed this action select the <strong>Action History</strong> tab
and the pending requests should be listed.<br />
</p>

<h5><strong><i class="fa fa-arrow-circle-right"></i>Why do I want HighRes MAX?</strong></h5>
<p>The purpose of this function is to request from the camera a larger size than was originally uploaded.  HighRes MAX is the largest Photo upload size supported.
    It is good practice to run the camera in a lower resolution like Standard Low or Standard Medium to achieve better battery life and reduce Image Points consumption.
Keep in mind that you can always request a HighRes MAX copy of any thumbnail which you require more detail. Requesting a HighRes Max will consume additional Image Points
in your data plan.
</p>
<br />

<strong><i class="fa fa-arrow-circle-right"></i>If while selecting thumbs, if you select both Video and Photo targets, and Photos that are already HighRes MAX on the server
    this will not create any issues as these items will just be skipped in the process.</strong>

    </div>
</div>
<div class="modal fade modal-video-container" id="modal-video-dlg" tabindex="-1" role="dialog" aria-labelledby="modal-video-label" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-player" role="document" orig-width="640" orig-height="360">
        <div class="modal-content modal-video-content">
            <div class="close custom-video-close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                <!--<span aria-hidden="true">&times;</span>-->
            </div>
            <div class="modal-body" style="padding: 0px 0px 0px 0px;">
                <div class="modal-video" id="modal-video-wrapper">
                    <div class="embed-responsive embed-responsive-16by9">

                        <video autoplay controls="controls" preload="auto" id="video-block">
                            <source src="" poster="" id="video-source" type="video/mp4" >Your browser doesn't support HTML5 video
                        </video>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="HighresModal" tabindex="-1" role="dialog" aria-labelledby="HighresModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request HighRes MAX</h4>
                <h5 class="modal-body" id="HighresModalLabel"> Confirmation</h5>
            </div>
            <a aria-hidden="true" class="btn btn-danger cancel-modal" role="button" data-dismiss="modal" aria-label="Cancel">Cancel</a>
            <a class="btn btn-success confirm-modal" id="button-confirm-highres" role="button" data-dismiss="modal" aria-label="Confirm">Confirm</a>
        </div>
    </div>
</div>

<div class="modal fade" id="OriginalModal" tabindex="-1" role="dialog" aria-labelledby="OriginalModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request Original Photo from SD Card</h4>
                <h5 class="modal-body" id="HighresModalLabel"> Confirmation</h5>
            </div>
            <a aria-hidden="true" class="btn btn-danger cancel-modal" role="button" data-dismiss="modal" aria-label="Cancel">Cancel</a>
            <a class="btn btn-success confirm-modal" id="button-confirm-original" role="button" data-dismiss="modal" aria-label="Confirm">Confirm</a>
        </div>
    </div>
</div>

<div class="modal fade" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="VideoModalLabel" aria-hidden="true" data-backdrop="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Request Video</h4>
                <h5 class="modal-body" id="HighresModalLabel"> Confirmation</h5>
            </div>
            <a aria-hidden="true" class="btn btn-danger cancel-modal" role="button" data-dismiss="modal" aria-label="Cancel">Cancel</a>
            <a class="btn btn-success confirm-modal" id="button-confirm-video" role="button" data-dismiss="modal" aria-label="Confirm">Confirm</a>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true" data-backdrop="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Media</h4>
                <h5 class="modal-body" id="DeleteModalLabel"> Confirmation</h5>
            </div>
            <a aria-hidden="true" class="btn btn-danger cancel-modal" role="button" data-dismiss="modal" aria-label="Cancel">Cancel</a>
            <a class="btn btn-success confirm-modal" id="button-confirm-delete" role="button" data-dismiss="modal" aria-label="Confirm">Confirm</a>
        </div>
    </div>
</div>


<script>
/*
    var cameraId = '54';
    var lastCamera = JSON.parse(sessionStorage.getItem('currentCam')) || null;
    var windowload = false;
    var documentready = false;
    var is_landscape = isLandscape();


    //var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;

    if(cameraId !== lastCamera){
        sessionStorage.removeItem('manageOn');
        sessionStorage.removeItem('items');
        sessionStorage.setItem('currentCam', JSON.stringify(cameraId));
        document.getElementById('itemAmount').innerHTML = getbadge(0);
    }
    function isPortrait() {
        return window.innerHeight > window.innerWidth;
    }

    function isLandscape() {
        return (window.orientation === 90 || window.orientation === -90);
    }
*/



    //var items = JSON.parse(sessionStorage.getItem('items')) || [];
    //var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
    function IEVersion() {
      var sAgent = window.navigator.userAgent;
      var Idx = sAgent.indexOf("MSIE");

      // If IE, return version number.
      if (Idx > 0)
        return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

      // If IE 11 then look for Updated user agent string.
      else if (!!navigator.userAgent.match(/Trident\/7\./))
        return 11;

      else
        return 0; //It is not IE
    }

    function isItemChecked(items, id) {
        //console.log(id + ' ' + v);
    var returnValue = false;
    var pos = items.indexOf(id);
    if (pos >= 0) {
            returnValue = true;
    }
    return returnValue;
    }

    function InitializeCheckBoxes() {
        var items = JSON.parse(sessionStorage.getItem('items')) || [];
        var checkboxes = document.getElementsByClassName('image-check');
        if (checkboxes) {
            for (var i = 0; i < checkboxes.length; i++) {
                check = checkboxes[i];
                check.checked = isItemChecked(items, check.id);
            }
        }
        console.log('InitializeCheckBoxes: checkboxes.length = ' + checkboxes.length.toString());
    }

    function PostGallery(action, items) {
        //console.log('PostGallery: starting');
        $('#gallery-form-54').append('<input type="hidden" name="action" value="' + action + '" />');
        $('#gallery-form-54').append('<input type="hidden" name="medialist" id="mediaid-list" value="" />');
        $('#mediaid-list').val(JSON.stringify(items));
        $("#gallery-form-54").submit();
        //console.log('PostGallery: submitted form');
    }


    function UpdateToolbar() {
        var items = JSON.parse(sessionStorage.getItem('items')) || [];
        var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        if (manageSelected === true) {
            console.log('we should open the toolbar');
            $('#itemAmount').show();
            $('.check-label .span-cr').height(height);
            $('.check-label .span-cr').width(width);
            $('.check-label').removeClass('hidden');
            //$('.check-label').show(100);
            $('#with-selected').hide();
            $('#camera-desc').hide();
            $('#select-all-54').hide();
            $('#clear-all-54').hide(350);
            $('#select-none-54').hide();
            $('#with-selected').removeClass('disabled hidden');
            $('#select-all-54').removeClass('disabled hidden');
            $('#select-none-54').removeClass('disabled hidden');
            $('#clear-all-54').removeClass('disabled hidden');
            $('#select-all-54').show(350);
            $('#select-none-54').show(350);
            $('#clear-all-54').show(350);
            $('#with-selected').show(350);
            document.getElementById('itemAmount').innerHTML = getbadge(items.length);
        }
        else {
            console.log('we should close the toolbar');
            //$('.image-check').prop('checked', false).change();
            $('#with-selected').addClass('disabled');
            $('#camera-desc').show();
            $('#select-all-54').addClass('disabled');
            $('#select-none-54').addClass('disabled');
            $('#clear-all-54').addClass('disabled');
            //$('.check-label').hide(100);
            $('.check-label').addClass('hidden');
            $('#select-all-54').hide(350);
            $('#clear-all-54').hide(350);
            $('#select-none-54').hide(350);
            $('#with-selected').hide(350);
            $('#itemAmount').hide();
        }
        InitializeCheckBoxes();

    }

    $(window).on('load', function() {
        UpdateToolbar();
        //InitializeCheckBoxes();
        windowload = true;
        if (documentready) {
            console.log('window load was last');
            //UpdateToolBarState();
        }
    });

    $(document).ready(function () {
        var height = '';
        var width = '';
        console.log('gallery2-partial - document ready');
        $(window).on('resize', function() {
            //alert('window on resize 1');
            height = $('.custom-thumbnail-grid-column').height();
            width = $('.custom-thumbnail-grid-column').width();
            $('.check-label .span-cr').height(height);
            $('.check-label .span-cr').width(width);
        });

        $('.custom-thumbnail-grid-column').on('load', function() {
            height = $('.custom-thumbnail-grid-column').height();
            width = $('.custom-thumbnail-grid-column').width();
        });

        $('.image-check').on('change', function () {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            var id = $(this).attr('id');
            v = $(this).prop('checked');

            // add or remove this item in items array
            if(v) {
                if( !(isItemChecked(items, id)) ){
                    items.push(id);
                    //console.log('gallery2-partial: id ' + id + ' added to items');
                }
            }
            else{
                if( isItemChecked(items, id) ) {
                    items.splice(items.indexOf(id), 1);
                    //console.log('gallery2-partial: id ' + id + ' removed from items');
                }
            }

            sessionStorage.setItem("items", JSON.stringify(items));
            document.getElementById('itemAmount').innerHTML = getbadge(items.length);
        });

        $('#multi-select').on('change', function () {
            console.log('multi-select change event fired');
            //alert('multi-select change event fired');
            sessionStorage.setItem('manageOn', JSON.stringify($(this).prop('checked')));
            var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
            var items = JSON.parse(sessionStorage.getItem('items')) || [];

            if (manageSelected === true && !($('#itemAmount').is(':visible'))) {
                document.getElementById('itemAmount').innerHTML = getbadge(items.length);
                var height = $('.custom-thumbnail-grid-column').height();
                var width = $('.custom-thumbnail-grid-column').width();
                $('.check-label .span-cr').height(height);
                $('.check-label .span-cr').width(width);
                //$('.check-label').show(100);
                $('.check-label').removeClass('hidden');
                $('#with-selected').hide();
                $('#camera-desc').hide();
                $('#select-all-54').hide();
                $('#clear-all-54').hide(350);
                $('#select-none-54').hide();
                $('#with-selected').removeClass('disabled hidden');
                $('#select-all-54').removeClass('disabled hidden');
                $('#select-none-54').removeClass('disabled hidden');
                $('#clear-all-54').removeClass('disabled hidden');
                $('#itemAmount').show();
                $('#select-all-54').show(350);
                $('#select-none-54').show(350);
                $('#clear-all-54').show(350);
                $('#with-selected').show(350);
            }
            else if( manageSelected === false && $('#itemAmount').is(':visible')){
                $('#with-selected').addClass('disabled');
                $('#camera-desc').show();
                $('#select-all-54').addClass('disabled');
                $('#select-none-54').addClass('disabled');
                $('#clear-all-54').addClass('disabled');
                //$('.check-label').hide(100);
                $('.check-label').addClass('hidden');
                $('#select-all-54').hide(350);
                $('#select-none-54').hide(350);
                $('#clear-all-54').hide(350);
                $('#with-selected').hide(350);
                $('#itemAmount').hide();

            }
            else if(manageSelected === true && ($('#itemAmount').is(':visible'))){
                sessionStorage.setItem('manageOn', JSON.stringify(false));
                manageSelected = JSON.parse(sessionStorage.getItem('manageOn'));
                $('#with-selected').addClass('disabled');
                $('#camera-desc').show();
                $('#select-all-54').addClass('disabled');
                $('#select-none-54').addClass('disabled');
                $('#clear-all-54').addClass('disabled');
                //$('.check-label').hide(100);
                $('.check-label').addClass('hidden');
                $('#select-all-54').hide(350);
                $('#clear-all-54').hide(350);
                $('#select-none-54').hide(350);
                $('#with-selected').hide(350);
                $('#itemAmount').hide();
            }
            else if(manageSelected === false && !($('#itemAmount').is(':visible'))){
                sessionStorage.setItem('manageOn', JSON.stringify(true));
                manageSelected = JSON.parse(sessionStorage.getItem('manageOn'));
                $('#itemAmount').show();
                document.getElementById('itemAmount').innerHTML = getbadge(items.length);
                var height = $('.custom-thumbnail-grid-column').height();
                var width = $('.custom-thumbnail-grid-column').width();
                $('.check-label .span-cr').height(height);
                $('.check-label .span-cr').width(width);
                //$('.check-label').show(100);
                $('.check-label').removeClass('hidden');
                $('#with-selected').hide();
                $('#camera-desc').hide();
                $('#select-all-54').hide();
                $('#select-none-54').hide();
                $('#clear-all-54').hide(350);
                $('#with-selected').removeClass('disabled hidden');
                $('#select-all-54').removeClass('disabled hidden');
                $('#clear-all-54').removeClass('disabled hidden');
                $('#select-none-54').removeClass('disabled hidden');
                $('#select-all-54').show(350);
                $('#clear-all-54').show(350);
                $('#select-none-54').show(350);
                $('#with-selected').show(350);
            }

        });




        $('#DeleteModal').on('show.bs.modal', function (event) {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            //var button = $(event.relatedTarget); // Button that triggered the modal
            //var dialogType = button.data('type'); // Extract info from data-* attributes
            var modal = $(this);
            var itemcount = items.length;
            //modal.find('.modal-title').text('Delete Media');
            if (itemcount > 1) {
                modal.find('.confirm-modal').show();
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you would like to delete all ' + itemcount.toString() + ' images?');
            } else if (itemcount === 1) {
                modal.find('.confirm-modal').show();
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you would like to delete this image?');
            } else {
                modal.find('.modal-body').text('No images currently selected. Please select items prior to submitting');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            }
        });

        $('#button-confirm-delete').on('click', function() {
            //console.log('Confirm Button Click multi: Start');
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                //console.log('about to call PostGallery multi');
                PostGallery('d', items);
            }
            //console.log('Confirm Button Click: : return from PostGallery multi');
        });


        $('#HighresModal').on('show.bs.modal', function (event) {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            //var button = $(event.relatedTarget); // Button that triggered the modal
            //var dialogType = button.data('type'); // Extract info from data-* attributes
            var modal = $(this);
            var itemcount = items.length;
            //modal.find('.modal-title').text('Request HighRes MAX');
            if(itemcount > 10){
                modal.find('.modal-body').text('You can not request High Res MAX for more than 10 images');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            } else if(items.length > 1 && items.length <= 10) {
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request HighRes for ' + itemcount.toString() + ' images?');
            } else if(items.length === 1){
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request HighRes for this image?');
            } else{
                modal.find('.modal-body').text('No images currently selected. Please select items prior to submitting');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            }

        });

        $('#button-confirm-highres').on('click', function() {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('h', items);
            }
        });

        $('#OriginalModal').on('show.bs.modal', function (event) {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            //var button = $(event.relatedTarget); // Button that triggered the modal
            //var dialogType = button.data('type'); // Extract info from data-* attributes
            var modal = $(this);
            var itemcount = items.length;
            //modal.find('.modal-title').text('Request HighRes MAX');
            if(itemcount > 10){
                modal.find('.modal-body').text('You can not request Original for more than 10 images');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            } else if(items.length > 1 && items.length <= 10) {
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request Original for ' + itemcount.toString() + ' images?');
            } else if(items.length === 1){
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request Original for this image?');
            } else{
                modal.find('.modal-body').text('No images currently selected. Please select items prior to submitting');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            }

        });

        $('#button-confirm-original').on('click', function() {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('o', items);
            }
        });






        $('#VideoModal').on('show.bs.modal', function (event) {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            //var button = $(event.relatedTarget); // Button that triggered the modal
            //var dialogType = button.data('type'); // Extract info from data-* attributes
            var modal = $(this);
            var itemcount = items.length;
            //modal.find('.modal-title').text('Request HighRes MAX');
            if(itemcount > 10){
                modal.find('.modal-body').text('You can not request video for more than 10 images');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            } else if(items.length > 1 && items.length <= 10) {
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request video for ' + itemcount.toString() + ' images?');
            } else if(items.length === 1){
                modal.find('.confirm-modal').show(100);
                modal.find('.cancel-modal').text('Cancel');
                modal.find('.modal-body').text('Are you sure you want to request a video for this image?');
            } else{
                modal.find('.modal-body').text('No videos currently selected. Please select items prior to submitting');
                modal.find('.confirm-modal').hide(100);
                modal.find('.cancel-modal').text('OK');
            }

        });

        $('#button-confirm-video').on('click', function() {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('v', items);
            }
        });



        $(document).on('click', '#select-all-54', function() {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            var checkboxes = $('.thumbnail-gallery .image-check');
            checkboxes.each(function(){
                if(!(isItemChecked(items, this.id))){
                    items.push(this.id)
                }
            });
            sessionStorage.setItem("items", JSON.stringify(items));
            InitializeCheckBoxes();

            document.getElementById('itemAmount').innerHTML = getbadge(items.length);
        });

        $(document).on('click', '#clear-all-54', function() {
            //console.log('clear-all clicked');
            sessionStorage.removeItem("items");
            //sessionStorage.setItem('items', JSON.stringify([]));
            document.getElementById('itemAmount').innerHTML = getbadge(0);
            items = [];
            InitializeCheckBoxes();
        });

        $('#select-none-54').click(function () {
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            var checkboxes = $('.thumbnail-gallery .image-check');
            checkboxes.each(function(){
                if(this.checked === true){
                    if(isItemChecked(items, this.id)){
                        items.splice(items.indexOf(this.id), 1)
                    }
                }
            });
            sessionStorage.setItem("items", JSON.stringify(items));
            InitializeCheckBoxes();

            document.getElementById('itemAmount').innerHTML = getbadge(items.length);
        });


        $('.popup-video').click(function () {
            var url = $(this).attr('video-url');
            var poster = $(this).attr('data-poster');
            $('#video-source').attr('src', url);
            $('#video-source').attr('poster', poster);

            var video_w = parseInt($(this).attr('data-width'));
            var video_h = parseInt($(this).attr('data-height'));
            $(".modal-dialog-player").css("width", video_w);
            $(".modal-dialog-player").css("height", video_h);

            $(".modal-dialog-player").attr("orig-width", video_w);
            $(".modal-dialog-player").attr("orig-height", video_h);

            var width  = $(window).width(),
                height = $(window).height();

            $('.modal-dialog-player').css('max-width', '98%');

            if (isLandscape()) {
                if (video_h > (height - 20)) {
                    var new_h = height - 20;

                    var new_w = new_h * video_w / video_h;
                    $('.modal-dialog-player').css('max-width', new_w);
                }
            }
            else {
                if (video_w > (width - 10)) {
                    var new_w = width - 10;
                    $('.modal-dialog-player').css('max-width', new_w);
                }
            }


            var video_block = $('#video-block');
            if (video_block) {
                //console.log('popup-video about to load video block');
                video_block.get(0).load();
                //console.log('popup-video loaded');
                //video_block.get(0).play();
                //alert('video block processed');
            }

            $('#modal-video-dlg').modal('show');
        });

        $('#modal-video-dlg').on('hide.bs.modal', function () {
            var video_block = $('#video-block');
            //console.log('user is closing video so pause it');
            if (video_block) {
                video_block.get(0).pause();
            }
        });

        documentready = true;
        if (windowload) {
            UpdateToolbar();        // required for IE
        }

        $(function(){
            $(window).resize(function(){
            //console.log('gallery2-partial - window resize function for video player');
            video_w = parseInt($(".modal-dialog-player").attr("orig-width"));
            video_h = parseInt($(".modal-dialog-player").attr("orig-height"));

            $(".modal-dialog-player").css("width", video_w);
            $(".modal-dialog-player").css("height", video_h);

            var width  = $(window).width(),
                height = $(window).height();

            $('.modal-dialog-player').css('max-width', '98%');

            if (isLandscape()) {
                if (video_h > (height - 20)) {
                    var new_h = height - 20;

                    var new_w = new_h * video_w / video_h;
                    $('.modal-dialog-player').css('max-width', new_w);
                }
            }
            else {
                if (video_w > (width - 10)) {
                    var new_w = width - 10;
                    $('.modal-dialog-player').css('max-width', new_w);
                }
            }


            })

          .trigger('resize');

        });


});
</script>

<script src="http://www.ridgetec.us/js/gallery.js"></script>
</div>
