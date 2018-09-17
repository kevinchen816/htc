function GetIEVersion() {
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

function getbadge(itemCount) {
    return '<span class="badge bg-info">' + itemCount.toString() + '</span>';
}

function isChecked(items, id) {
    //v = items.includes(id);
    //console.log(id + ' ' + v);
    //return v;
    var returnValue = false;
    var pos = items.indexOf(id);
    if (pos >= 0) {
            returnValue = true;
    }
    return returnValue;        
    
}

function UpdateSelectButton(button, buttonchecked) {
    if (buttonchecked) {
        button.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i> Select';
    } else {
        button.innerHTML = 'Select';
    }    
}

function OpenToolbar() {
    sessionStorage.setItem('manageOn', JSON.stringify(true));
    var cameraId = JSON.parse(sessionStorage.getItem('currentCam'));
    var manageToolbar = document.getElementById('multi-select');
    
    if (GetIEVersion() > 0) {
        //alert("This is IE " + GetIEVersion());
        //var event = document.createEvent('Event');
        //event.initEvent('change', false, true);
        //manageToolbar.dispatchEvent(event);
        $('#multi-select').prop("checked",true).trigger("change");
   }
    else {
        //alert("This is not IE.");
        var change = new Event('change');
        manageToolbar.dispatchEvent(change);  
   }
}

$(document).ready(function () {
    $("[data-fancybox]").fancybox({
            loop : true,
            
            buttons : [
                'slideShow',
                'fullScreen',
                'thumbs',
                //'share',
                //'download',
                'zoom',
                'close'
            ],

            idleTime : false,

            fullScreen : {
                autoStart : true,
            },

            beforeLoad: function(slide, item) {
                //var items = JSON.parse(sessionStorage.getItem('items'));
                //console.log('gallery beforeload starting');
                var items = JSON.parse(sessionStorage.getItem('items')) || [];

                var elem = slide.current.opts.$orig;
                var id = 'check_' + elem.data('id');
                var button = document.getElementById("gallery-select-button");
                UpdateSelectButton(button, isChecked(items, id));
            },
            
            caption : function( instance, item ) {
                //console.log('gallery caption starting');
                
                var caption = $(this).data('caption') || '';
                var photoid = $(this).data('id') || '';
                var camera = $(this).data('camera') || '';
                var ispending = $(this).data('pending') || '';
                var ishighres = $(this).data('highres') || '';
                var el = $(this).closest(".thumbnail-gallery");
                var mobile = '';
                var prefix = 'cameras';
                
                //console.log('gallery caption var section');
                
                if (el) {
                    mobile = $(el).attr('data-token');
                    if (!mobile) {
                        mobile = '';
                    }
                    else {
                        mobile = '/' + mobile;
                        prefix = 'mobile';
                    }
                }
                else {
                    mobile = '';
                }

                var button = '<a href="/' + prefix + '/download/' + camera + '/' + photoid + mobile + '" class="btn btn-xs btn-success" style="margin-right:10px;"><i class="fa fa-download"> </i> Download</a>';
                var highres = ' ';
                var pending = ' ';

                //var row = '<div class="row">';
                //var col = '<div class="col-lg-6">';
                //var col_right = '<div class="col-lg-6 pull-right">';
                //var close_div = '</div>';
                  var check =
                      '<a class="btn btn-primary btn-xs custom-select" id="gallery-select-button" role="button"' +
                      ' style="margin-left: 10px; text-decoration: none;" ' + 
                      ' onclick="selectphoto(' + '\'' + photoid + '\'' + ');">' + 
                      'Select' +
                      '</a>';

                var fullcaption = '';

                if ( ishighres == '1' ) {
                  highres = '<label style="font-size: 1.5em; margin-right: 4px;">' +
                                '<span class="cr"><i class="cr-icon fa fa-camera" style="color:lime;"></i></span>' +
                            '</label>';
                }

                if ( ispending == '1' ) {
                  pending = '<label style="font-size: 1.5em; margin-right: 4px;">' +
                                '<span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>' +
                            '</label>'; 
                }

                if ( item.type === 'image' ) {
                  fullcaption = pending + highres + caption + check;
                }
                else {
                  fullcaption = caption + check;
                }

                  if (prefix === 'mobile') {
                      button = '';
                      fullcaption = '<span style="font-size: 0.65em;">' + button + fullcaption + '</span>';
                  }
                  else {
                      fullcaption = button + fullcaption;
                  }

                return fullcaption;
            }
    });

     
});

function selectphoto(photoId) {

    var button = document.getElementsByClassName('custom-select');
    var items = JSON.parse(sessionStorage.getItem('items')) || [];

    var manageOn = JSON.parse(sessionStorage.getItem('manageOn')) || false;
    var selectedItems = document.getElementById('itemAmount');
    var id = 'check_' + photoId;
    
    if(isChecked(items, id)){
        // uncheck the button and remove item from items array
        if(manageOn === false){
            // open the tool bar if not already open
            OpenToolbar();
        }
        
        UpdateSelectButton(button[0], false);

        items.splice(items.indexOf(id), 1);
        //console.log('gallery.selectphoto: id ' + id + ' removed from items');

        document.getElementById(id).checked = false;
    } 
    else {
        // check the button and add item to items array
        if(manageOn === false){
            // open the tool bar if not already open
            OpenToolbar();            
        }
        
        UpdateSelectButton(button[0], true);

        items.push(id);
        //console.log('gallery.selectphoto: id ' + id + ' added to items');
        document.getElementById(id).checked = true;
    }

 
    sessionStorage.setItem('items', JSON.stringify(items));
    selectedItems.innerHTML = getbadge(items.length);
    
}
