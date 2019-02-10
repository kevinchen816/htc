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
        //background-image: url({{ public_path()}}/images/Check-Mark2.png);
        background-image: url(/images/Check-Mark2.png);
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
        background-color:rgba(0, 0, 0, 0.65);
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
        //background-image: url({{ public_path()}}/images/icon-play-video-white.png);
        background-image: url(/images/icon-play-video-white.png);
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
        //background-image: url({{ public_path()}}/images/close-icon.png);
        background-image: url(/images/close-icon.png);
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

<!----------------------------------------------------------------->
<div class="panel panel-default panel-primary custom-settings-panel">
    <div class="panel-heading" style="padding-top:6px;">
        <h4 class="panel-title">
            <span style="font-size: .70em; margin-top: 6px; margin-left: 1px;">
                <i class="fa fa-camera" style="color:lime;"></i> HighRes | <i class="fa fa-hourglass" style="color:#ffd352;"></i> Pending Request
                <span class="label label-info">*Note: Uploads will automatically purge after 90 days</span>
            </span>

            <a class="btn btn-info btn-xs ToggleHelp pull-right" style="margin-left: 14px;" help-id="gallery"><i class="fa fa-question"></i></a>

            <span class="pull-right" style="font-size: .70em; margin-top: 6px;">
                <strong>({{ $photos->count() }} thumbs this page) | Page {{ $photos->currentPage() }} of {{ $photos->lastPage() }}</strong>
            </span>
        </h4>
    </div> <!-- panel-heading -->

    <div class="panel-body" style="padding-top:2px;">
        <!-- ====GALLERY CODE== -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-count-4 gallery-manager" data-col="4" data-row="6">
                    <div class="gallery-toolbar">
                    @include('camera.gallery._toolbar')
                    </div> <!-- gallery-toolbar -->

                    <form method="POST" action="{{ route('camera.gallery') }}"
                        accept-charset="UTF-8"
                        class="form-horizontal"
                        role="form"
                        name="pictureForm"
                        id="gallery-form-{{ $camera->id }}">
                        {{ csrf_field() }}
                        <input name="portal" type="hidden" value="{{ $portal }}">
                        <input name="id" type="hidden" value="{{ $camera->id }}">

                        <div class="thumbnail-gallery" data-token="">
                            <div id="info"></div>

                            <!-- Begin Row -->
                            <div class="row no-gutters">
                                @inject('cc', 'App\Http\Controllers\Api\CamerasController')
                                {!! $cc->html_GalleryPhoto($user, $camera, $photos) !!}
                            </div>
                            <!-- End Row -->
                        </div> <!-- thumbnail-gallery -->
                    </form>
                </div> <!-- gallery-manager -->
            </div> <!-- col-md-12 -->
        </div> <!-- row -->
    </div> <!-- panel-body -->

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm" style="padding-left:2px;margin-left:2px;">
                @if (count($photos) > 0)
                    {!! $photos->render() !!}
                @endif

                <!-- kevin test -->
                <!--
                <ul class="pagination pagination">
                    <li class="disabled"><span>&laquo;</span></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="/cameras?photos=2">2</a></li>
                    <li><a href="/cameras?photos=3">3</a></li>
                    <li><span>...</span></li>
                    <li class="hidden-xs"><a href="/cameras?photos=7">7</a></li>
                    <li><a href="/cameras?photos=2" rel="next">&raquo;</a></li>
                </ul> -->
                <!-- kevin test -->
            </div>
        </div>
    </div>
</div> <!-- panel -->

<!----------------------------------------------------------------->
@include('camera.gallery._help')
@include('camera.gallery._dlg')

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

        console.log('>>IEVersion'); // kk-debug

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
        console.log('>>isItemChecked('+id+')='+returnValue);
        return returnValue;
    }

    function InitializeCheckBoxes() {
        var items = JSON.parse(sessionStorage.getItem('items')) || [];
        var checkboxes = document.getElementsByClassName('image-check');
//        alert('>>InitializeCheckBoxes'); // kk-debug
        if (checkboxes) {
            for (var i = 0; i < checkboxes.length; i++) {
                check = checkboxes[i];
                check.checked = isItemChecked(items, check.id);
            }
        }
        console.log('InitializeCheckBoxes: checkboxes.length = ' + checkboxes.length.toString());
    }

    function PostGallery(action, items) {
        console.log('**** PostGallery: starting'); // kevin
        $('#gallery-form-{{ $camera->id }}').append('<input type="hidden" name="action" value="' + action + '" />');
        $('#gallery-form-{{ $camera->id }}').append('<input type="hidden" name="medialist" id="mediaid-list" value="" />');
        $('#mediaid-list').val(JSON.stringify(items));
        $("#gallery-form-{{ $camera->id }}").submit();
        console.log('PostGallery: submitted form'); // kevin
    }

    function UpdateToolbar() {
        var items = JSON.parse(sessionStorage.getItem('items')) || [];
        var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
        console.log('#manageSelected='+manageSelected);
        height = $('.custom-thumbnail-grid-column').height();
        width = $('.custom-thumbnail-grid-column').width();
        if (manageSelected === true) {
            //console.log('we should open the toolbar');
            console.log('==> UpdateToolbar(open)');
            $('#itemAmount').show();
            $('.check-label .span-cr').height(height);
            $('.check-label .span-cr').width(width);
            $('.check-label').removeClass('hidden');
            //$('.check-label').show(100);
            $('#with-selected').hide();
            $('#camera-desc').hide();
            $('#select-all-{{ $camera->id }}').hide();
            $('#clear-all-{{ $camera->id }}').hide(350);
            $('#select-none-{{ $camera->id }}').hide();
            $('#with-selected').removeClass('disabled hidden');
            $('#select-all-{{ $camera->id }}').removeClass('disabled hidden');
            $('#select-none-{{ $camera->id }}').removeClass('disabled hidden');
            $('#clear-all-{{ $camera->id }}').removeClass('disabled hidden');
            $('#select-all-{{ $camera->id }}').show(350);
            $('#select-none-{{ $camera->id }}').show(350);
            $('#clear-all-{{ $camera->id }}').show(350);
            $('#with-selected').show(350);
            document.getElementById('itemAmount').innerHTML = getbadge(items.length);
        }
        else {
            //console.log('we should close the toolbar');
            console.log('==> UpdateToolbar(close)');
            //$('.image-check').prop('checked', false).change();
            $('#with-selected').addClass('disabled');
            $('#camera-desc').show();
            $('#select-all-{{ $camera->id }}').addClass('disabled');
            $('#select-none-{{ $camera->id }}').addClass('disabled');
            $('#clear-all-{{ $camera->id }}').addClass('disabled');
            //$('.check-label').hide(100);
            $('.check-label').addClass('hidden');
            $('#select-all-{{ $camera->id }}').hide(350);
            $('#clear-all-{{ $camera->id }}').hide(350);
            $('#select-none-{{ $camera->id }}').hide(350);
            $('#with-selected').hide(350);
            $('#itemAmount').hide();
        }
        InitializeCheckBoxes();
    }

    $(window).on('load', function() {
        console.log('[tab_gallery]...............window.load'); // kk-debug
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
        console.log('[tab_gallery]...............document.ready'); // kk-debug
        //console.log('gallery2-partial - document ready');
        $(window).on('resize', function() {
            //alert('window on resize 1');
            console.log('[tab_gallery]...............window.on(resize)'); // kk-debug
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
			//alert('==> .image-check'); // kk-debug
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            var id = $(this).attr('id');
            v = $(this).prop('checked');

            console.log('#id='+id+'('+v+')');
            //console.log('#items='+items);

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
            //console.log('multi-select change event fired');
            console.log(JSON.stringify('#manageOn='+$(this).prop('checked'))); // kk-debug

            sessionStorage.setItem('manageOn', JSON.stringify($(this).prop('checked')));

            var manageSelected = JSON.parse(sessionStorage.getItem('manageOn')) || false;
            var items = JSON.parse(sessionStorage.getItem('items')) || [];

            if (manageSelected === true && !($('#itemAmount').is(':visible'))) {
                //alert('#multi-select...........1'); // kk-debug
                document.getElementById('itemAmount').innerHTML = getbadge(items.length);

                var height = $('.custom-thumbnail-grid-column').height();
                var width = $('.custom-thumbnail-grid-column').width();
                $('.check-label .span-cr').height(height);
                $('.check-label .span-cr').width(width);
                //$('.check-label').show(100);
                $('.check-label').removeClass('hidden');

                $('#with-selected').hide();
                $('#camera-desc').hide();
                $('#select-all-{{ $camera->id }}').hide();
                $('#clear-all-{{ $camera->id }}').hide(350);
                $('#select-none-{{ $camera->id }}').hide();

                $('#with-selected').removeClass('disabled hidden');
                $('#select-all-{{ $camera->id }}').removeClass('disabled hidden');
                $('#select-none-{{ $camera->id }}').removeClass('disabled hidden');
                $('#clear-all-{{ $camera->id }}').removeClass('disabled hidden');

                $('#itemAmount').show();
                $('#select-all-{{ $camera->id }}').show(350);
                $('#select-none-{{ $camera->id }}').show(350);
                $('#clear-all-{{ $camera->id }}').show(350);
                $('#with-selected').show(350);
            }
            else if( manageSelected === false && $('#itemAmount').is(':visible')){
                //alert('#multi-select...........2'); // kk-debug
                $('#with-selected').addClass('disabled');
                $('#camera-desc').show();
                $('#select-all-{{ $camera->id }}').addClass('disabled');
                $('#select-none-{{ $camera->id }}').addClass('disabled');
                $('#clear-all-{{ $camera->id }}').addClass('disabled');

                //$('.check-label').hide(100);
                $('.check-label').addClass('hidden');

                $('#select-all-{{ $camera->id }}').hide(350);
                $('#select-none-{{ $camera->id }}').hide(350);
                $('#clear-all-{{ $camera->id }}').hide(350);
                $('#with-selected').hide(350);
                $('#itemAmount').hide();
            }
            else if(manageSelected === true && ($('#itemAmount').is(':visible'))){
                //alert('#multi-select...........3'); // kk-debug
                sessionStorage.setItem('manageOn', JSON.stringify(false));
                manageSelected = JSON.parse(sessionStorage.getItem('manageOn'));
                $('#with-selected').addClass('disabled');
                $('#camera-desc').show();

                $('#select-all-{{ $camera->id }}').addClass('disabled');
                $('#select-none-{{ $camera->id }}').addClass('disabled');
                $('#clear-all-{{ $camera->id }}').addClass('disabled');

                //$('.check-label').hide(100);
                $('.check-label').addClass('hidden');

                $('#select-all-{{ $camera->id }}').hide(350);
                $('#clear-all-{{ $camera->id }}').hide(350);
                $('#select-none-{{ $camera->id }}').hide(350);
                $('#with-selected').hide(350);
                $('#itemAmount').hide();
            }
            else if(manageSelected === false && !($('#itemAmount').is(':visible'))){
                //alert('#multi-select...........4'); // kk-debug
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
                $('#select-all-{{ $camera->id }}').hide();
                $('#select-none-{{ $camera->id }}').hide();
                $('#clear-all-{{ $camera->id }}').hide(350);

                $('#with-selected').removeClass('disabled hidden');
                $('#select-all-{{ $camera->id }}').removeClass('disabled hidden');
                $('#clear-all-{{ $camera->id }}').removeClass('disabled hidden');
                $('#select-none-{{ $camera->id }}').removeClass('disabled hidden');

                $('#select-all-{{ $camera->id }}').show(350);
                $('#clear-all-{{ $camera->id }}').show(350);
                $('#select-none-{{ $camera->id }}').show(350);
                $('#with-selected').show(350);
            }
        });

        /* Action - Delete */
        $('#DeleteModal').on('show.bs.modal', function (event) {
            console.log('==> #DeleteModal'); // kk-debug
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
            //alert('==> click #button-confirm-deletel'); // kk-debug
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

        /* Action - Request HighRes MAX */
        $('#HighresModal').on('show.bs.modal', function (event) {
            console.log('==> #HighresModal'); // kk-debug
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
            //alert('==> click #button-confirm-highres'); // kk-debug
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('h', items);
            }
        });

        /* Action - Request Original */
        $('#OriginalModal').on('show.bs.modal', function (event) {
            console.log('==> #OriginalModal'); // kk-debug
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
            //alert('==> click #button-confirm-original'); // kk-debug
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('o', items);
            }
        });

        /* Action - Request Video */
        $('#VideoModal').on('show.bs.modal', function (event) {
            console.log('==> #VideoModal'); // kk-debug
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
            //alert('==> click #button-confirm-video'); // kk-debug
            var items = JSON.parse(sessionStorage.getItem('items')) || [];
            sessionStorage.removeItem('items');
            sessionStorage.removeItem('manageOn');
            if (items.length > 0) {
                PostGallery('v', items);
            }
        });

        /* Select All */
        $(document).on('click', '#select-all-{{ $camera->id }}', function() {
            console.log('==> click #select-all-{{ $camera->id }}'); // kk-debug
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

        /* Clear All */
        $(document).on('click', '#clear-all-{{ $camera->id }}', function() {
            console.log('==> click #clear-all-{{ $camera->id }}'); // kk-debug
            sessionStorage.removeItem("items");
            //sessionStorage.setItem('items', JSON.stringify([]));
            document.getElementById('itemAmount').innerHTML = getbadge(0);
            items = [];
            InitializeCheckBoxes();
        });

        /* Select None */
        $('#select-none-{{ $camera->id }}').click(function () {
            console.log('==> click #select-none-{{ $camera->id }}'); // kk-debug
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
//alert('==> .popup-video'); // kk-debug
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
//alert('==> #modal-video-dlg'); // kk-debug
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
                console.log('[tab_gallery]...............window.resize'); // kk-debug
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

<!--<script src="{{ public_path()}}/js/gallery.js"></script>-->
<script src="/js/gallery.js"></script>
