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
                <!-- <h4 class="modal-title">Request Original Photo from SD Card</h4> -->
                <h4 class="modal-title">Request Original File from SD Card</h4>
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