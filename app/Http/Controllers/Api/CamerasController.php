<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Camera;
use App\Models\Device;
use App\Models\Mobile;
use App\Models\Photo;
use App\Models\Plan;
use App\Models\Firmware;
use App\Models\LogApi;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Schema;
//use Storage;

use Mail;
use App\Http\Controllers\MailController;
use App\Mail\PhotoSend;

use Carbon\Carbon;
use JPush\Client as JPush;
use Browser;

use Illuminate\Support\Facades\App;
use Debugbar;

/*
ICCID:
UniCOM #1   - 89860117851014783481
UniCOM #2   - 89860117851014783507
Truphone #1 - 8944503540145562672 F
Truphone #2 - 8944503540145561039 F
*/

//define(ERR_INVALID_SIM_CARD, '801');
const ERR_INVALID_SIM_CARD          = 801;
const ERR_PLAN_SUSPEND              = 802;
const ERR_PLAN_DEACTIVE             = 803;
const ERR_PLAN_NOT_ACTIVE           = 804;
const ERR_PLAN_EMPTY                = 805;
const ERR_PLAN_EXPIRE               = 806;
const ERR_INVALID_CAMERA            = 807;
const ERR_NOT_CAMERA_OWNER          = 808;
const ERR_NO_UPLOAD_FILE            = 809;
const ERR_NO_REQUEST_ID             = 810;
const ERR_INVALID_REQUEST_ID        = 811;
const ERR_INVALID_PHOTO_ID          = 812;

const ERR_NO_BLOCK_NUMBER           = 820;
const ERR_NO_BLOCK_ID               = 821;
const ERR_NO_CRC32                  = 822;
const ERR_NO_FILE_BUFFER            = 823;
const ERR_CRC32_FAIL                = 824;
const ERR_INVALID_BLOCK_NUMBER      = 825;
const ERR_INVALID_BLOCK_ID          = 826;
const ERR_COPY_MERGE_FILE_FAIL      = 827;

/* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
const ACTION_REQUESTED              = 1;
const ACTION_COMPLETED              = 2;
const ACTION_CANCELLED              = 3;
const ACTION_FAILED                 = 4;
const ACTION_PENDING                = 5;
//const ACTION_ABORT                = 6;

class CamerasController extends Controller
{
    //const ERR_INVALID_SIM_CARD = 801;

    private $error;

    /*
        Y - Äê·ÝµÄËÄÎ»Êý±íÊ¾
        m - ÔÂ·ÝµÄÊý×Ö±íÊ¾£¨´Ó 01 µ½ 12£©
        d - Ò»¸öÔÂÖÐµÄµÚ¼¸Ìì£¨´Ó 01 µ½ 31£©
        H - 24 Ð¡Ê±ÖÆ£¬´øÇ°µ¼Áã£¨00 µ½ 23£©
        i - ·Ö£¬´øÇ°µ¼Áã£¨00 µ½ 59£©
        s - Ãë£¬´øÇ°µ¼Áã£¨00 µ½ 59£©

        H - 24 Ð¡Ê±ÖÆ£¬´øÇ°µ¼Áã£¨00 µ½ 23£©
        G - 24 Ð¡Ê±ÖÆ£¬²»´øÇ°µ¼Áã£¨0 µ½ 23£©
        h - 12 Ð¡Ê±ÖÆ£¬´øÇ°µ¼Áã£¨01 µ½ 12£©
        g - 12 Ð¡Ê±ÖÆ£¬²»´øÇ°µ¼Áã£¨1 µ½ 12£©
        a - Ð¡Ð´ÐÎÊ½±íÊ¾£ºam »ò pm
        A - ´óÐ´ÐÎÊ½±íÊ¾£ºAM »ò PM

        m/d/Y+g:i:s+a   MM/DD/YYYY HH:MM:SS AM/PM (12 hours)
        m/d/Y+H:i:s     MM/DD/YYYY HH:MM:SS (24 hours)
        Y/m/d+g:i:s+a   YYYY/MM/DD HH:MM:SS AM/PM (12 hours)
        Y/m/d+H:i:s     YYYY/MM/DD HH:MM:SS (24 hours)
        d/m/Y+g:i:s+a   DD/MM/YYYY HH:MM:SS AM/PM (12 hours)
        d/m/Y+H:i:s     DD/MM/YYYY HH:MM:SS (24 hours)

        Y/m/d H:i:s
        Y/m/d h:i:s a
    */
    public function _datetime_get($camera) {
        //http://php.net/manual/zh/function.date-default-timezone-set.php
        //http://php.net/manual/zh/timezones.php
        if (isset($camera) && $camera) {
            $tz = date_default_timezone_get();
            date_default_timezone_set($camera->timezone);
            $ret = date('Y-m-d H:i:s');
            date_default_timezone_set($tz);
        } else {
            $ret = date('Y-m-d H:i:s');
        }
        return $ret;
    }

    public function _user_dateformat($user, $datetime) {
        //$dt = date_create('2013-03-15 23:40:00', timezone_open('Europe/Oslo'));
        $dt = '';
        if ($datetime) {
            $dt = date_create($datetime);
            $dt = date_format($dt, $user->date_format);
        }
        return $dt;
    }

    /* reference vendor/symfony/dom-crawler/Field/FileFormField.php */
    public function setErrorCode($error) {
        //$codes = array(UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE, UPLOAD_ERR_PARTIAL, UPLOAD_ERR_NO_FILE, UPLOAD_ERR_NO_TMP_DIR, UPLOAD_ERR_CANT_WRITE, UPLOAD_ERR_EXTENSION);
        //if (!in_array($error, $codes)) {
        //    throw new \InvalidArgumentException(sprintf('The error code %s is not valid.', $error));
        //}
        //
        //$this->value = array('name' => '', 'type' => '', 'tmp_name' => '', 'error' => $error, 'size' => 0);
    }

    // var $camera_id;
    // function __construct() {
    //     $this->camera_id = 999;
    // }
    // static function setCameraID($id) {
    //     echo 'XXX';
    //     $camera_id = $id;
    // }
    // static function getCameraID() {
    //     return $camera_id;
    // }

    public function getErrorMessage($errorCode) {
        static $errors = array(
            ERR_INVALID_SIM_CARD => 'Invalid SIM card',
            ERR_PLAN_SUSPEND => 'Plan is suspend',
            ERR_PLAN_DEACTIVE => 'Plan is deactive',
            ERR_PLAN_NOT_ACTIVE => 'Plan not active',
            ERR_PLAN_EXPIRE => 'Plan is expire',
            ERR_PLAN_EMPTY => 'Plan points empty',
            ERR_INVALID_CAMERA => 'Invalid Camera Module',
            ERR_NOT_CAMERA_OWNER => 'Not Camera Owner',
            ERR_NO_UPLOAD_FILE => 'No Upload File',
            ERR_NO_REQUEST_ID => 'No Request ID',
            ERR_INVALID_REQUEST_ID => 'Invalid Request ID',
            ERR_INVALID_PHOTO_ID => 'Invalid Photo ID',

            ERR_NO_BLOCK_NUMBER => 'Missing blocknbr',
            ERR_NO_BLOCK_ID => 'Missing blockid',
            ERR_NO_CRC32 => 'Missing CRC32',
            ERR_NO_FILE_BUFFER => 'Missing file buffer',
            ERR_CRC32_FAIL => 'CRC32 hash failure',
            ERR_INVALID_BLOCK_NUMBER => 'Invalid blocknbr',
            ERR_INVALID_BLOCK_ID => 'Invalid blockid',
            ERR_COPY_MERGE_FILE_FAIL => 'Copy merge file failure',

            //900 => 'Invalid or Missing camera Module',
            //901 => 'Invalid SIM card',
            //// 901 =>'Invalid or Missing camera Model',
            //902 => 'test or Missing camera Model',

//900-> "Unknown Exception: Creating default object from empty value",
//902-> "Required parameter(s) missing: [blocknbr, crc32]"
//902-> "Invalid blocknbr: 0",
//904-> "CRC32 hash failure"
//907-> "file buffer is missing"
//907-> "Invalid Block ID or No Blocks Uploaded",
//910-> "The Request ID sent is for an non-pending Action."

            //991 => 'add Camera',
            //992 => 'update Camera',
            //UPLOAD_ERR_INI_SIZE => 'The file "%s" exceeds your upload_max_filesize ini directive (limit is %d KiB).',
        );

        /* reference vendor/symfony/http-foundation/File/UploadedFile.php */
        //$errorCode = $this->error;
        //$maxFilesize = UPLOAD_ERR_INI_SIZE === $errorCode ? self::getMaxFilesize() / 1024 : 0;
        //$message = isset($errors[$errorCode]) ? $errors[$errorCode] : 'The file "%s" was not uploaded due to an unknown error.';
        //return sprintf($message, $this->getClientOriginalName(), $maxFilesize);

        $message = isset($errors[$errorCode]) ? $errors[$errorCode] : 'Unknown Error';
        return $message;
    }

    /*----------------------------------------------------------------------------------*/
    public function itemCameraDescription() {
        $array['title'] = 'Camera Description';
        $array['type'] = 'input';
        $array['format'] = 'maxlength="30"';
        $array['placeholder'] = 'Input Camera Description';
        $array['help'] = '';
        return $array;
    }

    public function itemCameraLocation() {
        $array['title'] = 'Camera Location';
        $array['type'] = 'input';
        $array['format'] = 'maxlength="30"';
        $array['placeholder'] = 'Input Camera Location';
        $array['help'] = '';
        return $array;
    }

    public function itemCameraRegion() {
        $array['title'] = 'Camera Region';
        $array['options'] = array(
            'United States' => 'USA',
            'Canada'        => 'CA',
            'Australia'     => 'AU',
            'China'         => 'CN',
            'Europe'        => 'EU',
        );
        $array['help'] = 'Select the country where the camera is located.';
        return $array;
    }

    /*----------------------------------------------------------------------------------*/
    public function itemCameraMode() {
        $array['title'] = 'Camera Mode';
        $array['options'] = array(
            'Photo' => 'p',
            'Video' => 'v',
        );
        $array['help'] = '';
        return $array;
    }

    /* Photo */
    public function itemPhotoResolution() {
        //$array = array(
        //    'title' => 'Photo Resolution',
        //    'options' => array(
        //        '4MP 16:9'  => '4',
        //        '6MP 16:9'  => '6',
        //        '8MP 16:9'  => '8',
        //        '12MP 16:9' => '12',
        //    ),
        //    'help' => 'Use this setting to control the size of the Photo saved on the SD Card.',
        //);
        $array['title'] = 'Photo Resolution';
        $array['options'] = array(
            '4MP'  => '4',
            '6MP'  => '6',
            '8MP'  => '8',
            '12MP' => '12',
        );
        $array['help'] = 'Use this setting to control the size of the Photo saved on the SD Card.';
        return $array;
    }

    public function itemPhotoFlash() {
        //$array['title'] = 'Photo Flash';
        $array['title'] = 'Flash';
        $array['options'] = array(
            'Bright'    => '1',
            'Balanced'  => '2',
            'Low Blur'  => '3',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemPhotoBurst() {
        $array['title'] = 'Photo Burst';
        $array['options'] = array(
            'Off'       => '1',
            '2 Photos'  => '2',
            '3 Photos'  => '3',
        );
        $array['help'] = 'Photo Burst is used to set the number of photos captured per event in Photo Mode. It is not used for Video mode. If Cellular mode is ON, then the camera will upload each photo of the burst to the portal.';
        return $array;
    }

    public function itemBurstDelay() {
        $array['title'] = 'Burst Delay';
        $array['options'] = array(
            '0.25s' => '250',
            '0.5s' => '500',
            '1s'    => '1000',
            '3s'    => '3000',
        );
        $array['help'] = 'The Burst Delay is the elapsed time between each burst photo.';
        return $array;
    }

    public function itemUploadResolution() {
        $array['title'] = 'Upload Resolution';
        $array['options'] = array(
            'Standard Low'      => '1',
            'Standard Medium'   => '2',
            'Standard High'     => '3',
            //'High Def (1280x)'  => '4',
        );
        $array['help'] = 'Use this setting to control the size of the uploaded thumbnail.';
        return $array;
    }

    public function itemUploadQuality() {
        $array['title'] = 'Upload Quality';
        $array['options'] = array(
            'Low'       => '1',
            'Medium'    => '2',
            'High'      => '3',
        );
        $array['help'] = 'Use this setting to control the image quality and size of the uploaded thumbnail. A higher quality means clearer images but larger file sizes when uploaded to the portal. Use a Photo quality that best meets your application and budget. [Standard] quality will reduce the size and cost to upload each photo to the portal and is generally good enough for most applications. Keep in mind that you can request a High-res Max or the Original file from the SD card when/if you need it for more detail on this particular photo event.';
        return $array;
    }

    /* Video */
    public function itemVideoResolution() {
        $array['title'] = 'Video Resolution';
        $array['options'] = array(
            'Standard Low (640x)'       => '8',
            'Standard Medium (800x)'    => '9',
            'Standard High (1024x)'     => '10',
            'HD 720p (1280x)'           => '11',
            'FHD 1080p (1920x)'         => '12',
        );
        $array['help'] = 'This determines the frame size of the video in pixels, or how wide it is when viewed on your computer monitor. A higher resolution means the video file saved to the SD card is larger and when uploaded uses more battery and costs more image points from your data plan, but it will have more detail on the other hand.';
        return $array;
    }

    public function itemFrameRate() {
        $array['title'] = 'Frame Rate';
        $array['options'] = array(
            '4fps'  => '4',
            '6fps'  => '6',
            '8fps'  => '8',
            '10fps' => '10',
            '12fps' => '12',
            '15fps' => '15',
            '30fps' => '30',
        );
        $array['help'] = 'Frame rate does not affect the size of the video file captured or reduce the points used to upload to the portal. A lower frame rate in low motion will improve the quality of each frame while motion blur may increase. A faster frame rate may reduce motion blur when there is higher motion and may reduce the image quality of each frame. Every environment is different. Please experiment to find the right value for your environment and needs.';
        return $array;
    }

    public function itemQualityLevel() {
        $array['title'] = 'Quality Level';
        $array['options'] = array(
            '1X/Lowest Cost'    => '300',
            '2X'                => '600',
            '3X'                => '900',
            '4X/Balanced'       => '1200',
            '5X'                => '1500',
            '6X'                => '1800',
            '8X'                => '2400',
            '16X/Highest Cost'  => '5000',
            '20X (test)'        => '6000',
            '25X (test)'        => '8000',
            '30X (test)'        => '9000',
            '35X (test)'        => '10000',
        );
        $array['help'] = 'Use quality level to control the image quality for each frame in the video. A higher value will increase quality while also increasing the size of the file captured. If you frequently make video upload requests you may want a lower quality in order to minimize image points used in your data plan. There is no set quality level for a particular application. Please experiment with video quality to achieve an acceptable balance for your environment and budget.';
        return $array;
    }

    public function itemVideoLength() {
        $array['title'] = 'Video Length';
        $array['options'] = array(
            '2s'    => '2',
            '3s'    => '3',
            '4s'    => '4',
            '5s'    => '5',
            '6s'    => '6',
            '7s'    => '7',
            '8s'    => '8',
            '9s'    => '9',
            '10s'   => '10',
        );
        $array['help'] = 'Note: The longer the duration, the larger the video file will be if uploaded to the portal.';
        return $array;
    }

    public function itemVideoSound() {
        $array['title'] = 'Video Sound';
        $array['options'] = array(
            'On'    => 'on',
            'Off'   => 'off',
        );
        $array['help'] = '';
        return $array;
    }

    /* Timestamp */
    public function itemTimeStamp() {
        $array['title'] = 'Time Stamp';
        $array['options'] = array(
            'On'    => 'on',
            'Off'   => 'off',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemDateFormat() {
        $array['title'] = 'Date Format';
        $array['options'] = array(
            'mdY' =>    'mdY',
            'Ymd' =>    'Ymd',
            'dmY' =>    'dmY',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemTimeFormat() {
        $array['title'] = 'Time Format';
        $array['options'] = array(
            '12 Hour'   => '12',
            '24 Hour'   => '24',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemTemperature() {
        $array['title'] = 'Temperature Unit';
        $array['options'] = array(
            'Fahrenheit'    => 'f',
            'Celsius'       => 'c',
        );
        $array['help'] = '';
        return $array;
    }

    /* Quiet Time */
    public function itemQuietTime() {
        $array['title'] = 'Quiet Time';
        $array['options'] = array(
             '0s'=> '0s',  '5s'=> '5s', '10s'=>'10s', '15s'=>'15s',
            '20s'=>'20s', '25s'=>'25s', '30s'=>'30s', '35s'=>'35s',
            '40s'=>'40s', '45s'=>'45s', '50s'=>'50s', '55s'=>'55s',
            '1m' => '1m',  '2m' =>'2m',  '3m'=> '3m',  '4m'=> '4m', '5m'=>'5m',
            '10m'=>'10m', '15m'=>'15m', '20m'=>'20m', '25m'=>'25m',
            '30m'=>'30m', '35m'=>'35m', '40m'=>'40m', '45m'=>'45m',
            '50m'=>'50m', '55m'=>'55m', '60m'=>'60m',
        );
        $array['help'] = 'Quiet Time is a delay after the current event is complete (photo or video). It can be used to reduce the number of PIR events in a given time. If your camera is taking too many photos or videos, then increase the quiet time to reduce the frequency of PIR (motion) activations. PIR or motion capture, as well as Time Lapse capture is disabled while sleeping in the quiet time period.';
        return $array;
    }

    /* Timelapse */
    public function itemTimeLapse() {
        $array['title'] = 'Time Lapse';
        $array['options'] = array(
            'On'    => 'on',
            'Off'   => 'off',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemTimelapseStartTime() {
        $array['title'] = 'Timelapse Start Time';
        $array['type'] = 'hhmm';
        $array['options'] = array(
            '00:00'=>'00:00', '00:15'=>'00:15', '00:30'=>'00:30', '00:45'=>'00:45',
            '01:00'=>'01:00', '01:15'=>'01:15', '01:30'=>'01:30', '01:45'=>'01:45',
            '02:00'=>'02:00', '02:15'=>'02:15', '02:30'=>'02:30', '02:45'=>'02:45',
            '03:00'=>'03:00', '03:15'=>'03:15', '03:30'=>'03:30', '03:45'=>'03:45',
            '04:00'=>'04:00', '04:15'=>'04:15', '04:30'=>'04:30', '04:45'=>'04:45',
            '05:00'=>'05:00', '05:15'=>'05:15', '05:30'=>'05:30', '05:45'=>'05:45',
            '06:00'=>'06:00', '06:15'=>'06:15', '06:30'=>'06:30', '06:45'=>'06:45',
            '07:00'=>'07:00', '07:15'=>'07:15', '07:30'=>'07:30', '07:45'=>'07:45',
            '08:00'=>'08:00', '08:15'=>'08:15', '08:30'=>'08:30', '08:45'=>'08:45',
            '09:00'=>'09:00', '09:15'=>'09:15', '09:30'=>'09:30', '09:45'=>'09:45',
            '10:00'=>'10:00', '10:15'=>'10:15', '10:30'=>'10:30', '10:45'=>'10:45',
            '11:00'=>'11:00', '11:15'=>'11:15', '11:30'=>'11:30', '11:45'=>'11:45',
            '12:00'=>'12:00', '12:15'=>'12:15', '12:30'=>'12:30', '12:45'=>'12:45',
            '13:00'=>'13:00', '13:15'=>'13:15', '13:30'=>'13:30', '13:45'=>'13:45',
            '14:00'=>'14:00', '14:15'=>'14:15', '14:30'=>'14:30', '14:45'=>'14:45',
            '15:00'=>'15:00', '15:15'=>'15:15', '15:30'=>'15:30', '15:45'=>'15:45',
            '16:00'=>'16:00', '16:15'=>'16:15', '16:30'=>'16:30', '16:45'=>'16:45',
            '17:00'=>'17:00', '17:15'=>'17:15', '17:30'=>'17:30', '17:45'=>'17:45',
            '18:00'=>'18:00', '18:15'=>'18:15', '18:30'=>'18:30', '18:45'=>'18:45',
            '19:00'=>'19:00', '19:15'=>'19:15', '19:30'=>'19:30', '19:45'=>'19:45',
            '20:00'=>'20:00', '20:15'=>'20:15', '20:30'=>'20:30', '20:45'=>'20:45',
            '21:00'=>'21:00', '21:15'=>'21:15', '21:30'=>'21:30', '21:45'=>'21:45',
            '22:00'=>'22:00', '22:15'=>'22:15', '22:30'=>'22:30', '22:45'=>'22:45',
            '23:00'=>'23:00', '23:15'=>'23:15', '23:30'=>'23:30', '23:45'=>'23:45',
            //'23:59' => '23:59',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemTimelapseStopTime() {
        $array['title'] = 'Timelapse Stop Time';
        $array['type'] = 'hhmm';
        $array['options'] = array(
            '00:00'=>'00:00', '00:15'=>'00:15', '00:30'=>'00:30', '00:45'=>'00:45',
            '01:00'=>'01:00', '01:15'=>'01:15', '01:30'=>'01:30', '01:45'=>'01:45',
            '02:00'=>'02:00', '02:15'=>'02:15', '02:30'=>'02:30', '02:45'=>'02:45',
            '03:00'=>'03:00', '03:15'=>'03:15', '03:30'=>'03:30', '03:45'=>'03:45',
            '04:00'=>'04:00', '04:15'=>'04:15', '04:30'=>'04:30', '04:45'=>'04:45',
            '05:00'=>'05:00', '05:15'=>'05:15', '05:30'=>'05:30', '05:45'=>'05:45',
            '06:00'=>'06:00', '06:15'=>'06:15', '06:30'=>'06:30', '06:45'=>'06:45',
            '07:00'=>'07:00', '07:15'=>'07:15', '07:30'=>'07:30', '07:45'=>'07:45',
            '08:00'=>'08:00', '08:15'=>'08:15', '08:30'=>'08:30', '08:45'=>'08:45',
            '09:00'=>'09:00', '09:15'=>'09:15', '09:30'=>'09:30', '09:45'=>'09:45',
            '10:00'=>'10:00', '10:15'=>'10:15', '10:30'=>'10:30', '10:45'=>'10:45',
            '11:00'=>'11:00', '11:15'=>'11:15', '11:30'=>'11:30', '11:45'=>'11:45',
            '12:00'=>'12:00', '12:15'=>'12:15', '12:30'=>'12:30', '12:45'=>'12:45',
            '13:00'=>'13:00', '13:15'=>'13:15', '13:30'=>'13:30', '13:45'=>'13:45',
            '14:00'=>'14:00', '14:15'=>'14:15', '14:30'=>'14:30', '14:45'=>'14:45',
            '15:00'=>'15:00', '15:15'=>'15:15', '15:30'=>'15:30', '15:45'=>'15:45',
            '16:00'=>'16:00', '16:15'=>'16:15', '16:30'=>'16:30', '16:45'=>'16:45',
            '17:00'=>'17:00', '17:15'=>'17:15', '17:30'=>'17:30', '17:45'=>'17:45',
            '18:00'=>'18:00', '18:15'=>'18:15', '18:30'=>'18:30', '18:45'=>'18:45',
            '19:00'=>'19:00', '19:15'=>'19:15', '19:30'=>'19:30', '19:45'=>'19:45',
            '20:00'=>'20:00', '20:15'=>'20:15', '20:30'=>'20:30', '20:45'=>'20:45',
            '21:00'=>'21:00', '21:15'=>'21:15', '21:30'=>'21:30', '21:45'=>'21:45',
            '22:00'=>'22:00', '22:15'=>'22:15', '22:30'=>'22:30', '22:45'=>'22:45',
            '23:00'=>'23:00', '23:15'=>'23:15', '23:30'=>'23:30', '23:45'=>'23:45',
            '23:59' => '23:59',
        );
        $array['help'] = '';
        return $array;
    }

    public function itemTimelapseInterval() {
        $array['title'] = 'Timelapse Interval';
        $array['options'] = array(
            '5m'=>'5m',
            '10m'=>'10m', '15m'=>'15m',
            '20m'=>'20m', '25m'=>'25m',
            '30m'=>'30m', '35m'=>'35m',
            '40m'=>'40m', '45m'=>'45m',
            '50m'=>'50m', '55m'=>'55m',
            '1h'=>'1h', '2h'=>'2h', '4h'=>'4h', '6h'=>'6h', '8h'=>'8h', '10h'=>'10h', '12h'=>'12h',
        );
        $array['help'] = '';
        return $array;
    }

    /* Wireless Settings */
    public function itemWirelessMode() {
        $array['title'] = 'Wireless Mode';
        $array['options'] = array(
            'Instant'   => 'instant',
            'Schedule'  => 'schedule',
        );
        $array['help'] = 'In [Instant] the camera will capture a photo or video then attach to the network and upload the file. In [Schedule] it will wake up either when the timer is up (Schedule Interval) or when the file limit is reached (File Limit) and upload the pending files to the server. Using [Schedule] will save battery because it reduces the handshaking that occurs each time the camera has to connect to the network (5 to 10 seconds per photo in Instant mode). The mobile app will recieve a notification as each scheduled upload starts and completes. The Action tab will show the scheduled event and the number of photos uploaded.';
        return $array;
    }

    public function itemScheduleInterval() {
        $array['title'] = 'Schedule Interval';
        $array['options'] = array(
            'Every Hour'    => '1h',
            'Every 2 Hours' => '2h',
            'Every 4 Hours' => '4h',
        );
        $array['help'] = 'The camera will use a timer to wake up and determine if there are files to upload based on the interval you select. If there are pending files, they will be uploaded to the server at that time.';
        return $array;
    }

    public function itemScheduleFileLimit() {
        $array['title'] = 'Schedule File Limit';
        $array['options'] = array(
            '20 Files'  => '20',
            '30 Files'  => '30',
            '40 Files'  => '40',
            '50 Files'  => '50',
        );
        $array['help'] = 'As the camera captures photos or videos, it will maintain a file count. If the file count reaches your selected File Limit, then the camera will attach to the network at that time (not the Scheduled Interval) and upload all pending files. A lower limit may increase network connections and use more battery, while a higher value may reduce network connections and battery usage. File Limit will be more important during periods of high activity. If the File Limit is not reached in a schedule interval period then it has no effect. File Limit is the only way to ensure that all media files captured will get uploaded to the pportal.';
        return $array;
    }

    public function itemHeartbeatInterval() {
        $array['title'] = 'Heartbeat Interval';
        $array['options'] = array(
            // 'Every 5 Minutes'   => '5m',
            // 'Every 10 Minutes'  => '10m',
            // 'Every 15 Minutes'  => '15m',
            // 'Every 20 Minutes'  => '20m',
            'Every 30 Minutes'  => '30m',
            'Every Hour'    => '1h',
            'Every 2 Hours' => '2h',
            'Every 4 Hours' => '4h',
            'Every 8 Hours' => '8h',
            'Every 12 Hours'=> '12h',
        );
        $array['help'] = 'This timer will fire on the specified interval and will send a status to the server. The mobile app will recieve a notification when this occurs. This lets you know your camera is still functioning and its curent status. It will also process any pending Action items you have queued like High-Res Max, Video, Original, Settings.';
        return $array;
    }

    public function itemActionProcessTimeLimit() {
        //$array['title'] = 'Max Online Time';
        $array['title'] = 'Action Process Time Limit';
        $array['options'] = array(
            '2m' => '2',
            '3m' => '3',
            '4m' => '4',
            'Default (5m)' => '5',
            '6m' => '6',
            '7m' => '7',
            '8m' => '8',
            '9m' => '9',
            '10m'=> '10',
        );
        $array['help'] = 'Use this setting to control the amount of time the camera will remain online, per event, processing pending action requests. A shorter time means the camera can return to PIR mode more quickly and continue capturing Photo and Video, otherwise the camera is busy and may miss PIR events due to action item processing. A longer time means your pending Action items should get completed sooner if the queue is large.';
        return $array;
    }

    public function itemCellularPassword() {
        $array['title'] = 'Cellular Password';
        $array['type'] = 'input';
        //$array['pattern'] = '[0-9]{6}';
        $array['format'] = 'pattern="[0-9]{6}"';
        $array['placeholder'] = 'Input Cellular Password';
        $array['help'] = 'Input 6 digits. Blank for no password. If you input a password, it is required when you power the camera into Setup mode. This means if your camera is stolen, the thief is not able to set cellular mode to OFF, which means he can only use the camera in cellular mode.';
        return $array;
    }

    public function itemRemoteControl() {
        $array['title'] = 'Remote Control';
        $array['options'] = array(
            'Disabled'  => 'off',
            '24 Hour'   => '24h',
        );
        $array['help'] = 'This option will cause the camera to sleep in a high power state waiting on SMS commands from the network. It will use more battery power at rest in this mode. You will see additional buttons on the Actions tab, used to wake your camera up immediately. When clicked, those buttons [SNAP] and [WAKE] will send an SMS message to wake the camera up. [SNAP] will cause the camera to capture a photo or video and upload it to the portal. The camera will then process any Action items you have queued up.';
        return $array;
    }

    public function itemBattery($battery) {
        if ($battery === 'f') {
            $battery = '<i class="fa fa-battery-full" style="color: lime;"> </i> 100%';
        } else if ($battery === 'h') {
            $battery = '<i class="fa fa-battery-three-quarters" style="color: greenyellow;"> </i> 75 %';
        } else if ($battery === 'm') {
            $battery = '<i class="fa fa-battery-half" style="color: yellow;"> </i> 50 %';
        } else if ($battery === 'l') {
            $battery = '<i class="fa fa-battery-quarter" style="color: orange;"> </i> 25 %';
        } else if ($battery === 'e') {
            $battery = '<i class="fa fa-battery-empty" style="color: red;"> </i> 0 %';
        //} else {
        //    $battery = '[Unknown]';
        }
        return $battery;
    }

    /*----------------------------------------------------------------------------------*/
    // function tsX($code, $lang = 'en') {
    //     $lang = empty($lang) ? 'en' : $lang;
    //     $code = preg_replace('/[^0-9a-zA-z.-_ ]/', '', $code);
    //     $trans = trans($code, [], '', $lang);
    //     if (empty($trans) || $trans == $code) {
    //         $trans= ucwords(preg_replace('/([0-9a-zA-z-_ ]*[.])*/', '', $code));
    //     }
    //     return $trans;
    // }

    function ts($code) {
        $txt = 'htc.'.$code;
        $trans = trans($txt);
        if (empty($trans) || $trans == $txt) {
            $trans = $code;
        }
        return $trans;
    }

    public function ovItemShow($title, $value, $empty_txt=null) {
        if (empty($value) && $empty_txt) {
            $value = $empty_txt;
        }

        $title = $this->ts($title);
        $value = $this->ts($value);

        $txt = '';
        $txt .= '<div class="row">';
        $txt .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
        $txt .= '<span class="pull-right">'.$title .'</span>';
        $txt .= '</div>';
        $txt .= '<div class="col-xs-6 col-sm-6 col-md-6" style="font-size: .85em;">';
        $txt .= '<strong>'.$value.'</strong>';
        $txt .= '</div>';
        $txt .= '</div>';
        return $txt;
    }

    public function ovItemShowEx($array, $field_value, $title=null) {
        if (!empty($array['type'])) {
            $type = $array['type'];
        } else {
            $type = 'select';
        }

        if ($type == 'input') {
            $value = $field_value;
        } else if ($type == 'hhmm') {
            //$value = substr($field_value, 0, 5); /* 23:59:00 */
            $value = date('H:i', strtotime($field_value));

        } else {
            $value = array_search($field_value, $array['options']);
            $value = ($value) ? : $field_value;
        }
        $title = ($title) ? : $array['title'];
        return $this->ovItemShow($title, $value);
    }

    public function stItemOption($id, $array, $field_name, $title = null) {
        // $id = $camera->id;
        $camera = Camera::findOrFail($id);

        $zz = $id.'_'.$field_name;
        $title = ($title) ? : $array['title'];

        $title = $this->ts($title);

        if (isset($array['help'])) {
            $help  = $array['help'];
        }

        if (!empty($array['type'])) {
            $type = $array['type'];
        } else {
            $type = 'select';
        }

        if ($type == 'hhmm') {
            $field_value = substr($camera[$field_name], 0, 5); /* 23:59:00 */
            //$field_value = date('H:i', strtotime($camera[$field_name]));
        } else {
            $field_value = $camera[$field_name];
        }

        /* Camera Mode:camera_mode=p */
        // $txt .= '<div>'.$title.':'.$field_name.'='.$field_value.'</div>';

        /*
            <div class="form-group" id="field-wrapper-54-cameramode">
                <label class="col-md-4 control-label" for="inputSmall">Camera Mode</label>
                <div class="col-md-7">
                    <select id="54_cameramode" class="bs-select form-control input-sm" name="54_cameramode">
                        <option value="p" selected="selected">Photo</option>
                        <option value="v">Video</option>
                    </select>
            ** OR **
                    <input type="text" class="form-control input-sm" id="54_xxx" name="54_xxx" maxlength="30" value="yyy" placeholder="zzz">
            ** OR **
                    <input type="text" class="form-control input-sm" id="54_xxx" name="54_xxx" pattern="[0-9]{6}" value="yyy" placeholder="zzz">

                    <span class="help-block"> .....</span>
                </div>
            </div>
        */
        $txt = '';
        //$txt .= '<div class="form-group hidden" id="field-wrapper-'.$id.'-'.$field_name.'">';
        $txt .= '<div class="form-group" id="field-wrapper-'.$id.'-'.$field_name.'">';
        $txt .=      '<label class="col-md-4 control-label" for="inputSmall">'.$title.'</label>';
        $txt .=      '<div class="col-md-7">';

        if ($type == 'input') {
            $format = $array['format'];
            $placeholder = $array['placeholder'];

            $placeholder = $this->ts($placeholder);

            // if (!empty($array['pattern']) {
            //     $pattern = $array['pattern'];
            //     //<input type="text" class="form-control input-sm" id="54_cellularpw" name="54_cellularpw" pattern="[0-9]{6}" value="xxx" placeholder="xxx">
            //     $txt .= '<input type="text" class="form-control input-sm" id="'.$zz.'" name="'.$zz.'" pattern="'.$pattern.'" value="'.$field_value.'" placeholder="'.$placeholder.'">';

            // } else if (!empty($array['maxlength']) {
            // $maxlength = $array['maxlength'];

            /*<input type="text" class="form-control input-sm" id="54_camera_desc" name="54_camera_desc" maxlength="30" value="xxx" placeholder="xxx">*/
            $txt .= '<input type="text" class="form-control input-sm" id="'.$zz.'" name="'.$zz.'" '.$format.' value="'.$field_value.'" placeholder="'.$placeholder.'">';
            // }

        } else {
            $options = $array['options'];
            /*<select class="bs-select form-control input-sm" id="54_cameramode" name="54_cameramode">*/
            $txt .= '<select class="bs-select form-control input-sm" id="'.$zz.'" name="'.$zz.'">';
            foreach ($options as $key => $value) {
                $key = $this->ts($key);

                /*<option value="p" selected="selected">Photo</option>*/
                $selected = ($value == $field_value) ? 'selected="selected"' : '';
                $txt .= '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
            }
            $txt .= '</select>';
        }

        if (!empty($help)) {
            //$txt .= '<span class="help-block">'.$help.'</span>';
            $txt .= '<span class="help-block-hidden hidden">'.$help.'</span>';
        }
        $txt .= '</div></div>';
        return $txt;
    }

    public function stItemCheckbox($name, $id=null, $value=null, $checked, $title) {
        $title = $this->ts($title);

        $txt  = '<div class="row">';
        $txt .=     '<div class="col-md-12">';
        $txt .=         '<span class="button-checkbox">';
        $txt .=             '<button type="button" class="btn btn-default btn-xs" data-color="info">'.$title.'</button>';
        if ($value) {
                           //<input type="checkbox" class="hidden" name="54_email[]" value="test1@gmail.com" checked />
            $txt .=         '<input type="checkbox" class="hidden" name="'.$name.'" value="'.$value.'" '.$checked.' />';
        } else {
                           //<input type="checkbox" class="hidden" name="54_email_owner" id="54_email_owner" checked />
            $txt .=         '<input type="checkbox" class="hidden" name="'.$name.'" id="'.$id.'" '.$checked.' />';
        }
        $txt .=         '</span>';
        $txt .=     '</div>';
        $txt .= '</div>';
        return $txt;
    }

    public function stRegion($region) {
        $regions = array(
            'USA' => array(
                'title' => 'United States',
                'options' => array(
                    'Eastern Time'                     => 'America/New_York',
                    'Central Time'                     => 'America/Chicago',
                    'Mountain Time'                    => 'America/Denver',
                    'Mountain Time (no DST)'           => 'America/Phoenix',
                    'Pacific Time'                     => 'America/Los_Angeles',
                    'Alaska Time'                      => 'America/Anchorage',
                    'Hawaii-Aleutian'                  => 'America/Adak',
                    'Hawaii-Aleutian Time (no DST)'    => 'Pacific/Honolulu',
                ),
            ),
            'CA' => array(
                'title' => 'Canada',
                'options' => array(
                    'Atlantic'     => 'Canada/Atlantic',
                    'Central'      => 'Canada/Central',
                    'Eastern'      => 'Canada/Eastern',
                    'Mountain'     => 'Canada/Mountain',
                    'Newfoundland' => 'Canada/Newfoundland',
                    'Pacific'      => 'Canada/Pacific',
                    'Saskatchewan' => 'Canada/Saskatchewan',
                    'Yukon'        => 'Canada/Yukon',

                ),
            ),
            'AU' => array(
                'title' => 'Australia',
                'options' => array(
                    'Adelaide'     => 'Australia/Adelaide',
                    'Brisbane'     => 'Australia/Brisbane',
                    'Broken_Hill'  => 'Australia/Broken_Hill',
                    'Currie'       => 'Australia/Currie',
                    'Darwin'       => 'Australia/Darwin',
                    'Eucla'        => 'Australia/Eucla',
                    'Hobart'       => 'Australia/Hobart',
                    'Lindeman'     => 'Australia/Lindeman',
                    'Lord_Howe'    => 'Australia/Lord_Howe',
                    'Melbourne'    => 'Australia/Melbourne',
                    'Perth'        => 'Australia/Perth',
                    'Sydney'       => 'Australia/Sydney',
                ),
            ),
            'CN' => array(
                'title' => 'China',
                'options' => array(
                    'Hong_Kong' => 'Asia/Hong_Kong',
                ),
            ),
            'EU' => array(
                'title' => 'Europe',
                'options' => array(
                    'Amsterdam'    => 'Europe/Amsterdam',
                    'Andorra'      => 'Europe/Andorra',
                    'Astrakhan'    => 'Europe/Astrakhan',
                    'Athens'       => 'Europe/Athens',
                    'Belgrade'     => 'Europe/Belgrade',
                    'Berlin'       => 'Europe/Berlin',
                    'Bratislava'   => 'Europe/Bratislava',
                    'Brussels'     => 'Europe/Brussels',
                    'Bucharest'    => 'Europe/Bucharest',
                    'Budapest'     => 'Europe/Budapest',
                    'Busingen'     => 'Europe/Busingen',
                    'Chisinau'     => 'Europe/Chisinau',
                    'Copenhagen'   => 'Europe/Copenhagen',
                    'Dublin'       => 'Europe/Dublin',
                    'Gibraltar'    => 'Europe/Gibraltar',
                    'Guernsey'     => 'Europe/Guernsey',
                    'Helsinki'     => 'Europe/Helsinki',
                    'Isle_of_Man'  => 'Europe/Isle_of_Man',
                    'Istanbul'     => 'Europe/Istanbul',
                    'Jersey'       => 'Europe/Jersey',
                    'Kaliningrad'  => 'Europe/Kaliningrad',
                    'Kiev'         => 'Europe/Kiev',
                    'Kirov'        => 'Europe/Kirov',
                    'Lisbon'       => 'Europe/Lisbon',
                    'Ljubljana'    => 'Europe/Ljubljana',
                    'London'       => 'Europe/London',
                    'Luxembourg'   => 'Europe/Luxembourg',
                    'Madrid'       => 'Europe/Madrid',
                    'Malta'        => 'Europe/Malta',
                    'Mariehamn'    => 'Europe/xMariehamnxxx',
                    'Minsk'        => 'Europe/Minsk',
                    'Monaco'       => 'Europe/Monaco',
                    'Moscow'       => 'Europe/Moscow',
                    'Oslo'         => 'Europe/Oslo',
                    'Paris'        => 'Europe/Paris',
                    'Podgorica'    => 'Europe/Podgorica',
                    'Prague'       => 'Europe/Prague',
                    'Riga'         => 'Europe/Riga',
                    'Rome'         => 'Europe/Rome',
                    'Samara'       => 'Europe/Samara',
                    'San_Marino'   => 'Europe/San_Marino',
                    'Sarajevo'     => 'Europe/Sarajevo',
                    'Saratov'      => 'Europe/Saratov',
                    'Simferopol'   => 'Europe/Simferopol',
                    'Skopje'       => 'Europe/Skopje',
                    'Sofia'        => 'Europe/Sofia',
                    'Stockholm'    => 'Europe/Stockholm',
                    'Tallinn'      => 'Europe/Tallinn',
                    'Tirane'       => 'Europe/Tirane',
                    'Ulyanovsk'    => 'Europe/Ulyanovsk',
                    'Uzhgorod'     => 'Europe/Uzhgorod',
                    'Vaduz'        => 'Europe/Vaduz',
                    'Vatican'      => 'Europe/Vatican',
                    'Vienna'       => 'Europe/Vienna',
                    'Vilnius'      => 'Europe/Vilnius',
                    'Volgograd'    => 'Europe/Volgograd',
                    'Warsaw'       => 'Europe/Warsaw',
                    'Zagreb'       => 'Europe/Zagreb',
                    'Zaporozhye'   => 'Europe/Zaporozhye',
                    'Zurich'       => 'Europe/Zurich',
                ),
            ),
        );

        $array = $regions[$region];
        $array['help'] = 'Select the time zone where the camera is located.';
        return $array;
    }

    // 0S - 10S - 59S - 1M - 59M - 1H - 12H - 24H
    // 0    10    59    60   118   119  130   142
    //public function cvtValueToHMS($value) {
    //    if ($value < 60) {          // 0-59 (0s-59s)
    //        $txt = $value;//.'s';
    //    } else if ($value < 119) {  // 60-118 (1m-59m)
    //        $txt = $value-59;//.'m';
    //    } else {                    // 119-142 (1h-24h)
    //        $txt = $value-118;//.'h';
    //    }
    //    return $txt;
    //}

    /*----------------------------------------------------------------------------------*/
    public function TXT_Source($txt) {
        if ($txt == 'setup') {
            $txt = 'Menu';
        } else if ($txt == 'mt') {
            $txt = 'Motion';
        } else if ($txt == 'tl') {
            $txt = 'Timelapse';
        } else if ($txt == 'ps') {
            $txt = 'Photo Snap';
        } else if ($txt == 'sc') {
            $txt = 'Scheduled Upload';
        }
        return $txt;
    }

    public function TXT_UploadResolution($txt) {
        if ($txt == 1) {
            $txt = 'Standard Low';
        } else if ($txt == 2) {
            $txt = 'Standard Medium';
        } else if ($txt == 3) {
            $txt = 'Standard High';
        } else if ($txt == 4) {
            $txt = 'High Def';
        } else if ($txt == 5) {
            $txt = 'High-Res MAX';
        } else if ($txt == 6) {
            $txt = 'Original Photo';
        //} else if ($txt == 7) {
        //    $txt = '';
        } else if ($txt == 8) {
            $txt = 'Standard Low';
        } else if ($txt == 9) {
            $txt = 'Standard Medium';
        } else if ($txt == 10) {
            $txt = 'Standard High';
        } else if ($txt == 11) {
            $txt = 'High Def';
        }
        return $txt;
    }

    public function TXT_UploadQuality($txt) {
        if ($txt == 1) {
            $txt = 'Standard';
        } else if ($txt == 2) {
            $txt = 'Medium';
        } else if ($txt == 3) {
            $txt = 'High';
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    public function LogApi_Add($api, $type, $user_id, $camera_id, $request, $response) {
        if ($user_id && $camera_id) {
            $logapi = new LogApi;

            $logapi->user_id = $user_id;
            $logapi->camera_id = $camera_id;

            $logapi->imei = $request->module_id;
            $logapi->iccid = $request->iccid;

            $logapi->api = $api;
            $logapi->type = $type;

            if (isset($request->DataList)) {
                $data = $request->DataList;
                if (isset($data['Battery'])) {
                    $logapi->battery = $data['Battery'];
                }
                if (isset($data['Voltage'])) {
                    $logapi->voltage = $data['Voltage'];
                }

            } else {
                if (isset($request->Battery)) {
                    $logapi->battery = $request->Battery;
                }
                if (isset($request->Voltage)) {
                    $logapi->voltage = $request->Voltage;
                }
                if (isset($request->LightSensor)) {
                    $logapi->light = $request->LightSensor;
                }
            }

//            $logapi->request = $request->getContent();
            $logapi->request = json_encode($request->all()); // string
            $logapi->response = json_encode($response);

            $logapi->save();
        }
    }

    public function LogApi_Search($user_id, $imei) {
        $ret = DB::table('log_apis')
            ->where('request->module_id', $imei)
            ->get();
        return $ret;
    }

    public function LogApi_Text($name, $value) {
        return sprintf('%25s: %s%c', $name, $value, 0x0a);
    }

    public function LogApi_List($log_apis) {
        $txt = '';
        foreach ($log_apis as $log_api) {
            $show = 0;
            $result = null;
            $request = json_decode($log_api->request);
            $response = json_decode($log_api->response);
            if ($log_api->api == 'report') {
                $api = 'HeartBeat';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'status') {
                $api = 'Status';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'downloadsettings') {
                $api = 'Download Settings';
                $request_type = 0;
                $response_type = 2;
                $show = 1;

            } else if ($log_api->api == 'uploadblock') {
                $api = 'Upload Block';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadthumb') {
                $api = 'Upload Photo';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadoriginal') {
                if ($request->upload_resolution == 6) {
                    $api = 'Upload Original';
                } else {
                    $api = 'Upload HighResMax';
                }
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'uploadvideothumb') {
                $api = 'Upload Video Thumb';
                $request_type = 2;
                $response_type = 1;
                $show = 1;

            } else if ($log_api->api == 'uploadvideo') {
                $api = 'Upload Video';
                $request_type = 2;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'imagemissing') {
                $api = 'Missing Photo';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'videomissing') {
                $api = 'Missing Video';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'firmwareinfo') {
                $api = 'Firmware Info';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            //} else if ($log_api->api == 'firmware') {
            //    $api = 'Firmware Download';
            //    $request_type = 1;
            //    $response_type = 0;
            //    $show = 1;

            } else if ($log_api->api == 'firmwaredone') {
                $api = 'Firmware Upgrade Success';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'firmwarefail') {
                $api = 'Firmware Upgrade Fail';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'cardfull') {
                $api = 'Card Full';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'formatdone') {
                $api = 'Format Done';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_start') {
                $api = 'Schedule Start';
                $request_type = 1; // -> 0
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_finish') {
                $api = 'Schedule Finish';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else if ($log_api->api == 'schedule_abort') {
                $api = 'Schedule Abort';
                $request_type = 1;
                $response_type = 0;
                $show = 1;

            } else {
                $api = 'Unknown';
                $request_type = 0;
                $response_type = 0;
                $show = 1;
            }

            if ($show == 1) {
                if ($result == null) {
                    if ($response->ResultCode == 0) {
                        $result = 'Success';
                        $btn_attr = 'btn-primary';
                    } else if ($response->ResultCode == 1) {
                        $result = 'Success';
                        $btn_attr = 'btn-primary';
                    } else {
                        $result = 'Fail';
                        $btn_attr = 'btn-danger';
                    }
                }

                $datetime = $log_api->created_at;

                if ($request_type == 1) {
                    $link_request = '<a class="btn btn-xs '.$btn_attr.' view-request" data-request="';
                    if(isset($request->iccid)) {
                        $link_request .= $this->LogApi_Text('ICCID', $request->iccid);
                    }
                    if(isset($request->module_id)) {
                        $link_request .= $this->LogApi_Text('Module ID', $request->module_id);
                    }

                    if (isset($request->DataList)) {
                        $data = $request->DataList;
                        if(isset($data->Battery)) {
                            $link_request .= $this->LogApi_Text('Battery', $data->Battery);
                        }
                        if(isset($data->SignalValue)) {
                            $link_request .= $this->LogApi_Text('Signal', $data->SignalValue);
                        }
                        if(isset($data->Cardspace)) {
                            $link_request .=  $this->LogApi_Text('Card Space', $data->Cardspace);
                        }
                        if(isset($data->Cardsize)) {
                            $link_request .= $this->LogApi_Text('Card Size', $data->Cardsize);
                        }
                        if(isset($data->Temperature)) {
                            $link_request .= $this->LogApi_Text('Temperature', $data->Temperature);
                        }
                    }
                    $link_request .= '">View</a>';

                } else if ($request_type == 2) {
                    $link_request = '<a class="btn btn-xs '.$btn_attr.' view-request" data-request="';
                    if(isset($request->iccid)) {
                        $link_request .= $this->LogApi_Text('ICCID', $request->iccid);
                    }
                    if(isset($request->module_id)) {
                        $link_request .= $this->LogApi_Text('Module ID', $request->module_id);
                    }

                    if(isset($request->FileName)) {
                        $link_request .= $this->LogApi_Text('FileName', $request->FileName);
                    }
                    if(isset($request->upload_resolution)) {
                        $link_request .= $this->LogApi_Text('Upload Resolution', $request->upload_resolution);
                    }
                    if(isset($request->Source)) {
                        $link_request .= $this->LogApi_Text('Source', $request->Source);
                    }

                    $data = $request;
                    if(isset($data->Battery)) {
                        $link_request .= $this->LogApi_Text('Battery', $data->Battery);
                    }
                    if(isset($data->SignalValue)) {
                        $link_request .= $this->LogApi_Text('Signal', $data->SignalValue);
                    }
                    if(isset($data->Cardspace)) {
                        $link_request .=  $this->LogApi_Text('Card Space', $data->Cardspace);
                    }
                    if(isset($data->Cardsize)) {
                        $link_request .= $this->LogApi_Text('Card Size', $data->Cardsize);
                    }
                    if(isset($data->Temperature)) {
                        $link_request .= $this->LogApi_Text('Temperature', $data->Temperature);
                    }
                    $link_request .= '">View</a>';

                } else {
                    $link_request = '';
                }

                if ($response_type == 1) {
                    $link_response = '<a class="btn btn-xs '.$btn_attr.' view-response" data-response="';
                    if(isset($response->ResultCode)) {
                        $link_response .= $this->LogApi_Text('Result Code', $response->ResultCode);
                    }
                    if(isset($response->ErrorMsg)) {
                        $link_response .= $this->LogApi_Text('Error Message', $response->ErrorMsg);
                    }
                    if(isset($response->DateTimeStamp)) {
                        $link_response .= $this->LogApi_Text('DateTime', $response->DateTimeStamp);
                    }

                    $link_response .= '">View</a>';
                } else if ($response_type == 2) {
                    if (isset($response->DataList)) {
                        $data = $response->DataList;
                        $link_response = '<a class="btn btn-xs '.$btn_attr.' view-response" data-response="';

                        if(isset($data->photoresolution)) {
                            $link_response .= $this->LogApi_Text('Photo Resolution', $data->photoresolution);
                        }
                        if(isset($data->video_resolution)) {
                            $link_response .= $this->LogApi_Text('Video Resolution', $data->video_resolution);
                        }
                        if(isset($data->video_rate)) {
                            $link_response .= $this->LogApi_Text('Frame Rate', $data->video_rate);
                        }
                        if(isset($data->video_bitrate)) {
                            $link_response .= $this->LogApi_Text('Quality Level', $data->video_bitrate);
                        }
                        if(isset($data->video_length)) {
                            $link_response .= $this->LogApi_Text('Video Length', $data->video_length);
                        }
                        if(isset($data->video_sound)) {
                            $link_response .= $this->LogApi_Text('Video Sound', $data->video_sound);
                        }
                        if(isset($data->photoburst)) {
                            $link_response .= $this->LogApi_Text('Photo Burst', $data->photoburst);
                        }
                        if(isset($data->burst_delay)) {
                            $link_response .= $this->LogApi_Text('Burst Delay', $data->burst_delay);
                        }
                        if(isset($data->upload_resolution)) {
                            $link_response .= $this->LogApi_Text('Upload Resolution', $data->upload_resolution);
                        }
                        if(isset($data->photo_quality)) {
                            $link_response .= $this->LogApi_Text('Upload Quality', $data->photo_quality);
                        }
                        if(isset($data->timestamp)) {
                            $link_response .= $this->LogApi_Text('Time Stamp', $data->timestamp);
                        }
                        if(isset($data->date_format)) {
                            $link_response .= $this->LogApi_Text('Date Format', $data->date_format);
                        }
                        if(isset($data->time_format)) {
                            $link_response .= $this->LogApi_Text('Time Format', $data->time_format);
                        }
                        if(isset($data->temperature)) {
                            $link_response .= $this->LogApi_Text('Temperature', $data->temperature);
                        }
                        if(isset($data->quiettime)) {
                            $link_response .= $this->LogApi_Text('Quiet Time', $data->quiettime);
                        }
                        if(isset($data->timelapse)) {
                            $link_response .= $this->LogApi_Text('Time Lapse', $data->timelapse);
                        }
                        if(isset($data->tls_start)) {
                            $link_response .= $this->LogApi_Text('Timelapse Start Time', $data->tls_start);
                        }
                        if(isset($data->tls_stop)) {
                            $link_response .= $this->LogApi_Text('Timelapse Stop Time', $data->tls_stop);
                        }
                        if(isset($data->tls_interval)) {
                            $link_response .= $this->LogApi_Text('Timelapse Interval', $data->tls_interval);
                        }
                        if(isset($data->wireless_mode)) {
                            $link_response .= $this->LogApi_Text('Wireless Mode', $data->wireless_mode);
                        }
                        if(isset($data->wm_schedule)) {
                            $link_response .= $this->LogApi_Text('Schedule Interval', $data->wm_schedule);
                        }
                        if(isset($data->wm_sclimit)) {
                            $link_response .= $this->LogApi_Text('Schedule File Limit', $data->wm_sclimit);
                        }
                        if(isset($data->hb_interval)) {
                            $link_response .= $this->LogApi_Text('Heartbeat Interval', $data->hb_interval);
                        }
                        if(isset($data->online_max_time)) {
                            $link_response .= $this->LogApi_Text('Action Process Time Limit', $data->online_max_time);
                        }
                        if(isset($data->cellularpw)) {
                            $link_response .= $this->LogApi_Text('Cellular Password', $data->cellularpw);
                        }
                        if(isset($data->remotecontrol)) {
                            $link_response .= $this->LogApi_Text('Remote Control', $data->remotecontrol);
                        }
                    }
                    $link_response .= '">View</a>';
                } else {
                    $link_response = '';
                }

                $txt .= '<tr>';
                $txt .=    '<td>'.$log_api->id.'</td>';
                $txt .=    '<td>'.$api.'</td>';
                $txt .=    '<td>'.$result.'</td>';
                $txt .=    '<td>'.$link_request.'</td>';
                $txt .=    '<td>'.$link_response.'</td>';
                $txt .=    '<td>'.$datetime.'</td>';
                $txt .= '</tr>';
            }
       }
       return $txt;
    }

    public function getApiLog($camera_id) {
        $user = Auth::user();
        $camera = Camera::find($camera_id);
        $log_apis = DB::table('log_apis')
            //->where(['user_id' => $user->id, 'camera_id' => $camera_id])
            ->where(['camera_id' => $camera_id])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('camera.apilog', compact('user', 'camera', 'log_apis'));
    }

    /*----------------------------------------------------------------------------------*/
    public function Action_Search($camera_id, $action_code, $status = 1) {
        // $actions = DB::table('actions')->where(['camera_id' => $camera_id, 'action' => $action_code]);
        $query['camera_id'] = $camera_id;
        $query['action'] = $action_code;
        $query['status'] = $status;
        $actions = DB::table('actions')->where($query);
        $action = $actions->first();
        return ($action) ? 1 : 0;
    }

    public function Action_FindFirst($camera_id, $status = 1) {
        $query['camera_id'] = $camera_id;
        $query['status'] = $status;
        $actions = DB::table('actions')->where($query);
        $action = $actions->first();
        return $action;
    }

//    public function Action_AddX($camera_id, $action_code, $status = 1) {
//        $action = new Action;
//        $action->camera_id = $camera_id;
//        $action->action = $action_code;
//        $action->status = $status; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
//        $action->requested = date('Y-m-d H:i:s');
//        $action->save();
//    }

    public function Action_Add($param) {
        $action = new Action;
        $action->camera_id = $param['camera_id'];
        $action->action = $param['action_code'];
        $action->status = $param['status']; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending

        // $action->requested = date('Y-m-d H:i:s');
        $camera = Camera::find($action->camera_id);
        if ($camera) {
            $action->requested = $this->_datetime_get($camera);
        } else {
            $action->requested = date('Y-m-d H:i:s');
        }


        if (isset($param['photo_id'])) {
            $action->photo_id = $param['photo_id'];
        }
        if (isset($param['filename'])) {
            $action->filename = $param['filename'];
        }
        if (isset($param['image_size'])) {
            $action->image_size = $param['image_size'];
        }
        if (isset($param['compression'])) {
            $action->compression = $param['compression'];
        }
        if (isset($param['first_number'])) {
            $action->first_number = $param['first_number'];
        }
        if (isset($param['last_number'])) {
            $action->last_number = $param['last_number'];
        }
        $action->save();
    }

    public function Action_Update($param) {
        //$ret = 0;
        $request_id = (integer) $param['request_id'];
        $actions = DB::table('actions')->where('id', $request_id);
        $action  = $actions->first();
        if ($action) {
            if (($action->camera_id == $param['camera_id']) &&
                ($action->action == $param['action_code'])) {
                /* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
                $data['status'] = $param['status'];

                $camera = Camera::find($action->camera_id);
                if ($camera) {
                    $data['completed'] = $this->_datetime_get($camera);
                } else {
                    $data['completed'] = date('Y-m-d H:i:s');
                }

                if (isset($param['filename'])) { // isset, empty, is_null
                    $data['filename'] = $param['filename'];
                }

                if (isset($param['image_size'])) {
                    $data['image_size'] = $param['image_size'];
                }

                if (isset($param['compression'])) {
                    $data['compression'] = $param['compression'];
                }

                if (isset($param['photo_id'])) {
                    $data['photo_id'] = $param['photo_id'];
                }

                if (isset($param['photo_cnt'])) {
                    $data['photo_cnt'] = $param['photo_cnt'];
                }

                $actions->update($data);
                //$ret = 1;
            }
        }
        //return $ret;
        return $action;
    }

    public function Action_Completed($param) {
        $param['status'] = ACTION_COMPLETED;
        return $this->Action_Update($param);
    }

    public function Action_Cancelled($param) {
        $param['status'] = ACTION_CANCELLED;
        return $this->Action_Update($param);
    }

    public function Action_Failed($param) {
        $param['status'] = ACTION_FAILED;
        return $this->Action_Update($param);
    }

    public function Action_Pending($param) {
        $param['status'] = ACTION_PENDING;
        return $this->Action_Update($param);
    }

    //public function Action_Completed($param) {
    //    $ret = 0;
    //    $request_id = $param['request_id'];
    //    if ($request_id) {
    //        //$actions = DB::table('actions')->find($request_id);
    //        //$action  = DB::table('actions')->first();
    //        $actions = DB::table('actions')->where('id', $request_id);
    //        $action  = $actions->first();
    //        if ($action) {
    //            if (($action->camera_id == $param['camera_id']) &&
    //                ($action->action == $param['action_code'])) {
    //
    //                if (($action->status == ACTION_REQUESTED) || ($action->status ==ACTION_PENDING)) {
    //                    /* 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending */
    //                    $data['status'] = ACTION_COMPLETED;
    //                    $data['completed'] = date('Y-m-d H:i:s');
    //
    //                    if (isset($param['filename'])) { // isset, empty, is_null
    //                        $data['filename'] = $param['filename'];
    //                    }
    //
    //                    if (isset($param['photo_id'])) {
    //                        $data['photo_id'] = $param['photo_id'];
    //                    }
    //
    //                    if (isset($param['photo_cnt'])) {
    //                        $data['photo_cnt'] = $param['photo_cnt'];
    //                    }
    //
    //                    $actions->update($data);
    //                    $ret = 1;
    //                }
    //            }
    //        }
    //    }
    //    return $ret;
    //}

    public function Action_CancellAll($camera_id) {
        /*
        $query['camera_id'] = $camera_id;
        $query['status'] = ACTION_REQUESTED; //$status;
        $actions = DB::table('actions')->where($query);
        //$action = $actions->first();

        $data['status'] = ACTION_CANCELLED;
        $actions->update($data);
        return $actions;
        */

        $affected = DB::update(
            'update actions set status = ? where camera_id = ? AND (status = ? OR status = ?)',
            [ACTION_CANCELLED, $camera_id, ACTION_REQUESTED, ACTION_PENDING]
        );
        return $affected;
    }

    public function Action_CancellSchedulePending($camera_id) {
        $query['camera_id'] = $camera_id;
        $query['status'] = ACTION_PENDING;
        $actions = DB::table('actions')->where($query);
        //$action = $actions->first();

        $data['status'] = ACTION_CANCELLED;
        $actions->update($data);
        return $actions;
    }

//    public function Action_Failed($param) {
//        $ret = 0;
//        $request_id = $param['request_id'];
//        if ($request_id) {
//            $actions = DB::table('actions')->where('id', $request_id);
//            $action  = $actions->first();
//            if ($action) {
//                if (($action->camera_id == $param['camera_id']) &&
//                    ($action->action == $param['action_code'])) {
//
//                    //if (($action->status == 1) || ($action->status == 5)) {
//                        $data['status'] = 4; // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
//                        $data['completed'] = date('Y-m-d H:i:s');
//                        $actions->update($data);
//                        $ret = 1;
//                    //}
//                }
//            }
//        }
//        return $ret;
//    }

    /*----------------------------------------------------------------------------------*/
    /*
        HighRes Max
        {
            "ResultCode": 0,
            "ActionCode": "UO",
            "ParameterList": {
                "FILENAME": "PICT0089.JPG",
                "IMAGESIZE": "5",
                "COMPRESSION": "28",
                "REQUESTID": "18372"
            },
            "DateTimeStamp": "2018-10-01 20:45:55"
        }

        Photo Original

        {
            "ResultCode": 0,
            "ActionCode": "UO",
            "ParameterList": {
                "FILENAME": "PICT0593.JPG",
                "IMAGESIZE": "6",
                "REQUESTID": "7572"
            },
            "DateTimeStamp": "2018-10-01 20:55:51"
        }

        Video
        {
            "ResultCode": 0,
            "ActionCode": "UV",
            "ParameterList": {
                "FILENAME": "PICT0478.MP4",
                "REQUESTID": "7576"
            },
            "DateTimeStamp": "2018-10-02 01:00:10"
        }
    */
    public function Response_Result($err, $camera = null, $datalist = null) {
        $ret['ResultCode'] = $err;
        if (($err == 0)||($err == 1)||($err == 2)) {
            if ($datalist) {
                $ret['DataList'] = $datalist;
            }

            if ($camera) {
                $action = $this->Action_FindFirst($camera->id);
                if ($action) {
                    $action_code = $action->action;
                    if ($action_code == 'UO') {
                        $param_list["FILENAME"] = $action->filename;
                        $param_list["IMAGESIZE"] = (string) $action->image_size;
                        if ($action->compression) {
                            $param_list["COMPRESSION"] = (string) $action->compression;
                        }
                    } else if ($action_code == 'UV') {
                        $param_list["FILENAME"] = $action->filename;
                    }
                    $param_list["REQUESTID"] = (string) $action->id;

                    $ret['ActionCode'] = $action_code;
                    $ret['ParameterList'] = $param_list;
                }
            }

        } else {
            $ret['ErrorMsg'] = $this->getErrorMessage($err);
        }
        $ret['DateTimeStamp'] = $this->_datetime_get($camera);
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    public function Plan_Check($iccid) {
        $plan = DB::table('plans')->where('iccid', $iccid)->first();
        if ($plan) {
            if ($plan->status == 'active') {

                $now = Carbon::now()->subDays(1);
                // if (Carbon::now()->gt($plan->sub_end) && ($plan->style == 'normal')) {
                if ($now->gt($plan->sub_end) && ($plan->style == 'normal')) {
                    $ret['err'] = ERR_PLAN_EXPIRE;
                } else {
                    if ($plan->points_used < $plan->points) {
                        $ret['err'] = 0;
                        $ret['user_id'] = $plan->user_id;
                    } else {
                        $ret['err'] = ERR_PLAN_EMPTY;
                    }
                }

            } else if ($plan->status == 'deactive') {
                $ret['err'] = ERR_PLAN_DEACTIVE;
            } else if ($plan->status == 'suspend') {
                $ret['err'] = ERR_PLAN_SUSPEND;
            } else {
                $ret['err'] = ERR_PLAN_NOT_ACTIVE;
            }

        } else {
            $ret['err'] = ERR_INVALID_SIM_CARD;
        }
        return $ret;
    }

    public function Plan_Update($param, $original = 0) {
        $point_photo_thumb = array(
            array( 1.0,  1.5 ,  2.0 ),  // 1
            array( 2.5,  3.25,  4.25),  // 2
            array( 4.0,  6.75,  8.25),  // 3
            array( 7.0, 10.0 , 14.5 ),  // 4
            array(13.0, 15.5 , 19.5 ),  // 5
        );

        $point_video_thumb = array(1.0, 2.0, 3.0, 6.0, 10.0);

        $resolution = (integer) ($param->upload_resolution);
        if (isset($param->photo_quality)) {
            $quality = (integer) ($param->photo_quality);
        } else {
            $quality = 1;
        }
        $points = 0;

        if ($original) {
            $points = $param->filesize/(30*1024);
        } else {
            if ($resolution >= 8) {
                $resolution -= 8;
                $points = $point_video_thumb[$resolution];
            } else if ($resolution == 6) {
                $points = $param->filesize/(30*1024);
            } else {
                $resolution -= 1;
                $quality -= 1;
                $points = $point_photo_thumb[$resolution][$quality];
            }
        }

        $plans = DB::table('plans')->where('iccid', $param['iccid']);
        $plan = $plans->first();
        if ($plan) {
            $data['points_used'] = $plan->points_used + $points;
            $plans->update($data);
        }
        //return $plan;
        return $points;
    }

    /*----------------------------------------------------------------------------------*/
    public function Camera_Find($module_id) {
        $camera = DB::table('cameras')->where('module_id', $module_id)->first();
        return $camera;
    }

    public function Camera_Check($param) {
        $camera = null;
        $user_id = null;
        $ret = $this->Plan_Check($param->iccid);
        $err = $ret['err'];
        if ($err == 0) {
            $user_id = $ret['user_id'];
            $camera = $this->Camera_Find($param->module_id);
            if ($camera) {
                if ($camera->user_id == $user_id) {
                    $err = 0;
                } else {
                    $err = ERR_NOT_CAMERA_OWNER;
                }
            } else {
                $err = ERR_INVALID_CAMERA;
            }
        }
        $ret['err'] = $err;
        $ret['camera'] = $camera;
        $ret['user_id'] = $user_id;
        return $ret;
    }

    public function Camera_Add($user_id, $request) {
        $camera = new Camera;

        $camera->user_id = $user_id; /* search iccid to find the user_id */

        $camera->module_id = $request->module_id;
        $camera->iccid     = $request->iccid;
        $camera->model_id  = $request->model_id;
        $camera->cellular  = $request->cellular;

        $datalist             = $request->DataList;
        $camera->battery      = $datalist['Battery'];
        $camera->signal_value = $datalist['SignalValue'];
        $camera->card_space   = $datalist['Cardspace'];
        $camera->card_size    = $datalist['Cardsize'];
        $camera->temperature  = $datalist['Temperature'];
        $camera->dsp_version  = $datalist['FirmwareVersion'];
        $camera->mcu_version  = $datalist['mcu'];
        //$camera->cellular     = $datalist['cellular'];
        $camera->save();
        return 0;
    }

    public function Camera_Status_Update($param, $api_type = null, $upload_original = 0) {
        $module_id = $param->module_id;
        $cameras = DB::table('cameras')->where('module_id', $module_id);
        $camera = $cameras->first();

        $data['iccid'] = $param->iccid;
        $data['model_id'] = $param->model_id;
        $data['cellular'] = $param->cellular;

        if ($api_type == 'log') {
            if ($param->status == 'enable') {
                $data['log'] = 1;
            } else {
                $data['log'] = 0;
            }

        } else if (($api_type == 'upload_photo')||($api_type == 'upload_video')) {
            $data['battery']      = $param->Battery;
            $data['signal_value'] = $param->SignalValue;
            $data['card_space']   = $param->Cardspace;
            $data['card_size']    = $param->Cardsize;
            $data['temperature']  = $param->Temperature;
            $data['dsp_version']  = $param->FirmwareVersion;
            $data['mcu_version']  = $param->mcu;
            //$data['cellular']     = $param->cellular;

            $data['last_filename'] = $param->filename;

            if ($upload_original == 0) {
                $data['last_savename'] = $param->savename;
            }

            if ($param->Source != 'setup') {
                $data['arm_photos'] = $camera->arm_photos+1;
                $data['arm_points'] = $camera->arm_points + $param->points;
            }

        } else {
            $datalist = $param->DataList;
            if ($datalist) {
                $data['battery']      = $datalist['Battery'];
                $data['signal_value'] = $datalist['SignalValue'];
                $data['card_space']   = $datalist['Cardspace'];
                $data['card_size']    = $datalist['Cardsize'];
                $data['temperature']  = $datalist['Temperature'];
                $data['dsp_version']  = $datalist['FirmwareVersion'];
                $data['mcu_version']  = $datalist['mcu'];
                //$data['cellular']     = $datalist['cellular'];
            }
        }

        //$datetime = date('Y-m-d H:i:s');
        $datetime = $this->_datetime_get($camera);
        $data['last_contact'] = $datetime;
        if ($api_type == 'arm') {                       // status with Arm='Y'
            $data['last_armed'] = $datetime;
            $data['arm_photos'] = 0;
            $data['arm_points'] = 0;
            $data['log'] = 0;

        } else if ($api_type == 'report') {
            $data['last_hb'] = $datetime;
        } else if ($api_type == 'upload_photo') {       // uploadthumb, uploadoriginal
            $data['last_photo'] = $datetime;
        } else if ($api_type == 'upload_video') {       // upload_video
            $data['last_video'] = $datetime;
        } else if ($api_type == 'schedule_start') {
            $data['last_schedule'] = $datetime;
            $data['last_schedule_status'] = 'start';
        } else if ($api_type == 'schedule_finish') {
            $data['last_schedule'] = $datetime;
            $data['last_schedule_status'] = 'finish';
        } else if ($api_type == 'schedule_abort') {
            $data['last_schedule'] = $datetime;
            $data['last_schedule_status'] = 'abort';
        } else if ($api_type == 'settings') {           // downloadsettings
            $data['last_settings'] = $datetime;
        //} else if ($api_type == 'log') {              // uploadlog
        }
        //$data['expected_contact'] = ; // TODO

        $cameras->update($data);
        // $camera->update($data); // NG
        return 0;
    }

    /*----------------------------------------------------------------------------------*/
    //public function Photo_Add($param) {
    //    $photo = new Photo;
    //    $photo->camera_id           = $param->camera_id; // TODO
    //    $photo->filename            = $param->filename;
    //    $photo->imagename           = $param->imagename;
    //    $photo->savename            = $param->savename;
    //    $photo->filesize            = $param->filesize;
    //    $photo->filetype            = 1;
    //    $photo->points              = $param->points;
    //
    //    $photo->resolution          = $param->upload_resolution;
    //    $photo->photo_quality       = $param->photo_quality;
    //    $photo->photo_compression   = $param->photo_compression;
    //    $photo->source              = $param->Source;
    //    $photo->datetime            = $param->DateTime;
    //    $photo->save();
    //    return $photo;
    //}

    //public function Video_Add($param) {
    //    $photo = new Photo;
    //    $photo->camera_id           = $param->camera_id; // TODO
    //    $photo->filename            = $param->filename;
    //    $photo->imagename           = $param->imagename;
    //    $photo->savename            = $param->savename;
    //    $photo->filesize            = $param->filesize; // $param->video_filesize;
    //    $photo->filetype            = 2;
    //    $photo->points              = $param->points;
    //
    //    $photo->resolution          = $param->upload_resolution;
    //    $photo->photo_quality       = $param->photo_quality;
    //    $photo->video_length        = (integer) ($param->video_length);
    //    $photo->video_sound         = $param->video_sound;
    //    $photo->video_rate          = $param->video_rate;
    //    $photo->video_bitrate       = $param->video_bitrate;
    //    $photo->source              = $param->Source;
    //    $photo->datetime            = $param->DateTime;
    //    $photo->save();
    //    return $photo;
    //}

    /*----------------------------------------------------------------------------------*/
    public function hello(Request $request) {
        $ret['ResultCode'] = 0;
        return $ret;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {"iccid":"89860117851014783481","module_id":"861107030190590","model_id":"lookout-na",
         "DataList":{
             "Battery":"f",
             "SignalValue":"31",
             "Cardspace":"7848MB",
             "Cardsize":"7854MB",
             "Temperature":"41C",
             "mcu":"4.1",
             "FirmwareVersion":"20180313",
             "cellular":"4G LTE"}
        }
    */
    public function report(Request $request) {
        //return $request;
        //return $request->getContent();
        //return gettype($request); // object
        //return gettype($request->getContent()); // string
        //return gettype($request->all()); // array
        //return gettype(json_encode($request->all())); // string

        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];

        if ($err == ERR_INVALID_CAMERA) {
            $err = $this->Camera_Add($user_id, $request);
            $camera = $this->Camera_Find($request->module_id);
        }

        if ($err == 0) {
            $this->Camera_Status_Update($request, 'report');
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->pushHeartbeat($user_id, $camera);
            $this->LogApi_Add('report', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
//     public function status(Request $request) {
//         $ret['ret'] = 'Hello';
// return $ret;
//     }

    public function status(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];

        if ($err == ERR_INVALID_CAMERA) {
            $err = $this->Camera_Add($user_id, $request);
            $camera = $this->Camera_Find($request->module_id);
        }

        if ($err == 0) {
            if ($request->Arm == 'Y') {
                $this->Action_CancellAll($camera->id);

                $param = array(
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                    'status'      => ACTION_REQUESTED, //1,
                );
                $this->Action_Add($param);

                $param['action_code'] = 'PS';
                $this->Action_Add($param);

                $this->Camera_Status_Update($request, 'arm');
            } else {
                $this->Camera_Status_Update($request);
            }

            //if ($request->RequestID) {
            //    $param = array(
            //        'request_id'  => $request->RequestID,
            //        'camera_id'   => $camera->id,
            //        'action_code' => 'SR',
            //    );
            //    $this->Action_Completed($param);
            //}
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('status', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function downloadsettings(Request $request) {
        $datalist = [];
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];
        $user_id = $ret['user_id'];
        if ($err == 0) {
            $this->Camera_Status_Update($request, 'settings');

            $datalist['cameramode']        = (string) $camera->camera_mode;
            $datalist['photoresolution']   = (string) $camera->photo_resolution;
            $datalist['flash']             = (string) $camera->photo_flash;
            $datalist['video_resolution']  = (string) $camera->video_resolution;
            $datalist['video_rate']        = (string) $camera->video_fps;
            $datalist['video_bitrate']     = (string) $camera->video_bitrate;
            // $datalist['video_bitrate7']    = (string) $camera->video_bitrate7;
            // $datalist['video_bitrate8']    = (string) $camera->video_bitrate8;
            // $datalist['video_bitrate9']    = (string) $camera->video_bitrate9;
            // $datalist['video_bitrate10']   = (string) $camera->video_bitrate10;
            // $datalist['video_bitrate11']   = (string) $camera->video_bitrate11;
            $datalist['video_length']      = (string) $camera->video_length;
            $datalist['video_sound']       = (string) $camera->video_sound;
            $datalist['photoburst']        = (string) $camera->photo_burst;
            $datalist['burst_delay']       = (string) $camera->burst_delay;
            $datalist['upload_resolution'] = (string) $camera->upload_resolution;
            $datalist['photo_quality']     = (string) $camera->photo_quality;
            $datalist['photo_compression'] = (string) $camera->photo_compression;
            $datalist['timestamp']         = (string) $camera->timestamp;
            $datalist['date_format']       = (string) $camera->date_format;

            $datalist['time_format']     = (string) $camera->time_format;
            $datalist['temperature']     = (string) $camera->temp_unit;
            $datalist['quiettime']       = (string) $camera->quiettime;
            $datalist['timelapse']       = (string) $camera->timelapse;
            $datalist['tls_start']       = date('H:i', strtotime($camera->tls_start));
            $datalist['tls_stop']        = date('H:i', strtotime($camera->tls_stop));
            $datalist['tls_interval']    = (string) $camera->tls_interval;
            $datalist['wireless_mode']   = (string) $camera->wireless_mode;
            $datalist['wm_schedule']     = (string) $camera->wm_schedule;
            $datalist['wm_sclimit']      = (string) $camera->wm_sclimit;
            $datalist['hb_interval']     = (string) $camera->hb_interval;
            $datalist['online_max_time'] = (string) $camera->online_max_time;
            $datalist['cellularpw']      = (string) $camera->cellularpw;
            $datalist['remotecontrol']   = (string) $camera->remotecontrol;

            $datalist['dutytime'] = $camera->dutytime;
            $datalist['dt_sun']   = $camera->dt_sun;
            $datalist['dt_mon']   = $camera->dt_mon;
            $datalist['dt_tue']   = $camera->dt_tue;
            $datalist['dt_wed']   = $camera->dt_wed;
            $datalist['dt_thu']   = $camera->dt_thu;
            $datalist['dt_fri']   = $camera->dt_fri;
            $datalist['dt_sat']   = $camera->dt_sat;

            $datalist['use_crc32'] = $camera->use_crc32;

            $datalist['blockmode1']  = $camera->blockmode1;
            $datalist['blockmode2']  = $camera->blockmode2;
            $datalist['blockmode3']  = $camera->blockmode3;
            $datalist['blockmode4']  = $camera->blockmode4;
            $datalist['blockmode5']  = $camera->blockmode5;
            $datalist['blockmode7']  = $camera->blockmode7;
            $datalist['blockmode8']  = $camera->blockmode8;
            $datalist['blockmode9']  = $camera->blockmode9;
            $datalist['blockmode10'] = $camera->blockmode10;
            $datalist['blockmode11'] = $camera->blockmode11;

            $cameras = DB::table('cameras')->where('id', $camera->id);
            $cameras->update([
                'remotecurrent' => $camera->remotecontrol,
                'settings' => json_encode($datalist),
            ]);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'DS',
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera, $datalist);
        if ($user_id && $camera) {
            $this->pushDownloadSettings($user_id, $camera);
            $this->LogApi_Add('downloadsettings', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {"ResultCode":0,
         "blockid":"rt5b4ee59befce2",
         "blocknbr":1,
         "DateTimeStamp":"2018-07-18 03:00:43"}
    */
    // public function uploadblock_response($blockid, $blocknbr) {
    //     // date_default_timezone_set("Asia/Shanghai");
    //     $ret['ResultCode'] = 0; //$err;
    //     $ret['blockid'] = $blockid;
    //     $ret['blocknbr'] = $blocknbr;
    //     $ret['DateTimeStamp'] = date('Y-m-d H:i:s');
    //     return $ret;
    // }

    public function uploadblock_merge($camera, $filename, $blockid, $crc32) {
        $uploader = new ImageUploadHandler;
        $camera_id = $camera->id;
        $ret = $uploader->merge($camera_id, $filename, $blockid, $crc32);
        $err = $ret['err'];
        if ($err == 0) {
            $ret['err'] = 0;
        } else if ($err == 1) {
            $ret['err'] = ERR_INVALID_BLOCK_ID;
        } else if ($err == 2) {
            $ret['err'] = ERR_CRC32_FAIL;
        } else if ($err == 3) {
            $ret['err'] = ERR_COPY_MERGE_FILE_FAIL;
        }
        return $ret;
    }

    public function uploadblock(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $camera = $ret['camera'];

        if ($err == 0) {
            $camera_id = $camera->id;

            if (!isset($request->blocknbr)) {
                return $this->Response_Result(ERR_NO_BLOCK_NUMBER, $camera);
            }

            if (!isset($request->crc32)) {
                return $this->Response_Result(ERR_NO_CRC32, $camera);
            }

            if (!isset($request->buffer)) {
                return $this->Response_Result(ERR_NO_FILE_BUFFER, $camera);
            }

            $blocknbr = $request->blocknbr;
            if ($blocknbr <= 0) {
                return $this->Response_Result(ERR_INVALID_BLOCK_NUMBER, $camera);
            } else if ($blocknbr == 1) {
                //$blockid = date('ymdhis').'_'.$camera_id; // 'rt5bb7b9586d6fb'
                $blockid = $camera_id.'_'.date('ymdhis');
            } else {
                if (!isset($request->blockid)) {
                    return $this->Response_Result(ERR_NO_BLOCK_ID, $camera);
                }
                $blockid = $request->blockid;
            }

            $file = $request->buffer; // $request->Image;
            if ($file && $file->isValid()) {
                /* https://www.cnblogs.com/mslagee/p/6223140.html */
                //$crc32 = hexdec(hash_file('crc32b', $file->getRealPath()));
                //if ($crc32 != $request->crc32) {
                //    $ret = $this->Response_Result(ERR_CRC32_FAIL, $camera);
                //    $ret['CRC32'] = $crc32;
                //    return $ret;
                //}

                $ret = $uploader->save_buffer($camera_id, $file, $blockid, $blocknbr);
                $err = $ret['err'];
                if ($err == 0) {
                    /* https://www.cnblogs.com/mslagee/p/6223140.html */
                    $crc32 = hexdec(hash_file('crc32b', $ret['savepath']));
                    if ($crc32 != $request->crc32) {
                        $ret = $this->Response_Result(ERR_CRC32_FAIL, $camera);
                        $ret['CRC32'] = $crc32;
                    } else {
                        // $ret = $this->uploadblock_response($blockid, $blocknbr);

                        // date_default_timezone_set("Asia/Shanghai");
                        $ret = [];
                        $ret['ResultCode'] = 0; //$err;
                        $ret['blockid'] = $blockid;
                        $ret['blocknbr'] = $blocknbr;
                        $ret['DateTimeStamp'] = $this->_datetime_get($camera);
                    }
                    return $ret;
                }

            } else {
                $err = ERR_NO_FILE_BUFFER;
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadblock', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function db_photo_new($camera_id, $request, $api) {
        $db = new Photo;
        $db->camera_id  = $camera_id;
        $db->filename   = $request->FileName;   // PICT0001.MP4
        $db->resolution = $request->upload_resolution;
        $db->source     = $request->Source;
        $db->datetime   = $request->DateTime;

        ////$db->imagename    = $imagename; //$ret['imagename'];    // PICT0001.JPG -> PICT0001.MP4
        ////$db->thumb_name   = $savename;  // 1543683105_PICT0001.JPG
        ////// $db->original_name  = ;      // 1543658475_PICT0001.MP4
        // $db->filesize   = $filesize;
        // $db->points     = $points;

        // filetype  : 1=photo, 2=video
        // uploadtype: 1=photo_thumb, 2=photo_original
        //             3=video_thumb, 4=video_original
        if ($api == 'video_thumb') {
            $db->filetype           = 2;
            $db->uploadtype         = 3;
            $db->video_length       = (integer) ($request->video_length); // 5s->5
            $db->video_sound        = $request->video_sound;
            $db->video_rate         = $request->video_rate;
            $db->video_bitrate      = $request->video_bitrate;
        } else {
            $db->filetype           = 1;
            $db->uploadtype         = 1;
            $db->photo_quality      = $request->photo_quality;
            $db->photo_compression  = $request->photo_compression;
        }
        $db->save();
        return $db;
    }

    public function s3_file_url($filename) {
        $s3 = \Storage::disk('s3');
        // if ($s3->exists($filename)) {
            $url = $s3->temporaryUrl(
                $filename, now()->addMinutes(1440)
            );
        // } else {
            // $url = '';
        // }
        return $url;
    }

    public function s3_save_file($file, $photo_id, $thumb=0) {
        $s3 = \Storage::disk('s3');
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG,MP4
        $fileName = $photo_id.'.'.$extension;
        $filePath = '/media/'.$fileName;
        $result = $s3->put($filePath, file_get_contents($file)); // "result": true
        // $result = $s3->put($filePath, file_get_contents($file), 'public'); // NG

        // if ($thumb) {
        //     $thumbPath = '/media/'.$photo_id.'_thumb.'.$extension;
        //     $s3->copy($filePath, $thumbPath);
        // }

        $ret['err'] = ($result) ? 0 : 1;
        $ret['imagename'] = $file->getClientOriginalName(); // TODO uploadoriginal (del)
        $ret['filesize'] = $file->getClientSize(); // TODO uploadoriginal (del)
        $ret['savename'] = $photo_id;
        // $ret['savename'] = $fileName;
        return $ret;
    }

    public function s3_save_thumb_file($file, $photo_id) {
        $s3 = \Storage::disk('s3');
        $extension = 'JPG'; //strtoupper($file->getClientOriginalExtension()); // JPG
        $fileName = $photo_id.'_thumb.'.$extension;
        $filePath = '/media/'.$fileName;
        $result = $s3->put($filePath, file_get_contents($file)); // "result": true
        return $result;
    }

    // for test
    public function uploads3(Request $request) {
        // $ret['s3'] = env('S3_ENABLE') ? '1' : '0';
        $savePath = 'media/80.JPG';
        $ret['exist'] = Storage::disk('s3')->exists($savePath);
return $ret;
        // $file = $request->file('Image');
        // $path = $file->store('media', 's3');
        // // $path = $file->storeAs('1', '12345.JPG', 's3');
        // $ret['path'] = $path;

        $s3 = \Storage::disk('s3');
        $file = $request->file('Image');
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG,MP4
        $fileName = time().'_'.str_random(10).'.'.$extension;
        $filePath = '/media/'.$fileName;
        // $result = $s3->put($filePath, file_get_contents($file), 'public'); // NG
        $result = $s3->put($filePath, file_get_contents($file)); // "result": true
        $ret['result'] = $result;
        $ret['savename'] = $fileName;
return $ret;
    }

    public function uploadfile_EBS($request, $api) {
        //$camera = $camera->find(1);
        //return $camera;

        //$camera = DB::table('cameras')->where('module_id', $request->module_id)->get();
        // $camera = DB::table('cameras')
        //                 ->where('module_id', $request->module_id)
        //                 ->first();

        $uploader = new ImageUploadHandler;

        $camera_id = null;
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;

            if (isset($request->blockid)) {
                $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];
            } else {
                $file = $request->Image;
                if ($file && $file->isValid()) {
                    $ret = $uploader->save_file($camera_id, $file);
                    $err = $ret['err'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];
                $savename = $ret['savename'];

                $param = $request;
                //$param['camera_id'] = $camera_id;
                //$param['filename'] = $request->FileName;
                //$param['imagename'] = $ret['imagename'];
                $param['savename'] = $savename; //$ret['savename'];
                $param['filesize'] = $filesize; //$ret['filesize'];

                $points = $this->Plan_Update($param);
                $param['points'] = $points;

                $photo = new Photo;
                $photo->camera_id           = $camera_id;
                $photo->filename            = $request->FileName;
                $photo->imagename           = $ret['imagename'];
                $photo->thumb_name          = $savename; //$ret['savename'];
                $photo->filesize            = $filesize; //$ret['filesize'];
                $photo->points              = $points;
                $photo->resolution          = $request->upload_resolution;
                $photo->source              = $request->Source;
                $photo->datetime            = $request->DateTime;

                if ($api == 'video_thumb') {
                    $photo->filetype   = 2;
                    $photo->uploadtype = 3;
                    //$photo = $this->Video_Add($param);

                    //$photo->photo_quality       = $param->photo_quality;
                    $photo->video_length        = (integer) ($param->video_length);
                    $photo->video_sound         = $param->video_sound;
                    $photo->video_rate          = $param->video_rate;
                    $photo->video_bitrate       = $param->video_bitrate;
                    $photo->save();

                    $this->Camera_Status_Update($param, 'upload_video');
                } else {
                    $photo->filetype   = 1;
                    $photo->uploadtype = 1;
                    //$photo = $this->Photo_Add($param);

                    $photo->photo_quality       = $param->photo_quality;
                    $photo->photo_compression   = $param->photo_compression;
                    $photo->save();

                    $this->Camera_Status_Update($param, 'upload_photo');
                }

                if ($request->RequestID) {
                    $request_id = $request->RequestID;
                    $actions = DB::table('actions')->where('id', $request_id);
                    $action  = $actions->first();
                    if ($action) {
                        if ($action->camera_id == $camera_id) {
                            if ($action->action == 'PS') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                $data['photo_cnt'] = 1;
                                $data['status'] = ACTION_COMPLETED;

                            } else if ($action->action == 'SC') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                if ($request->FileName != $action->filename) {
                                    $data['photo_cnt'] = $action->photo_cnt + 1;
                                }
                            }
                            // $data['completed'] = date('Y-m-d H:i:s');
                            $data['completed'] = $this->_datetime_get($camera);
                            $actions->update($data);
                        }
                    }
                }

                $this->email_Photo_Send($user_id, $camera, $savename);
            }
        }

        if ($err == ERR_CRC32_FAIL) {
            //$crc32 = $ret['CRC32'];
            $response = $this->Response_Result($err, $camera);
            $response['CRC32'] = $ret['CRC32'];
        } else {
            $response = $this->Response_Result($err, $camera);
        }

        $ret = [];
        $ret['user_id'] = $user_id;
        $ret['camera'] = $camera;
        $ret['response'] = $response;
        return $ret;
    }

    public function uploadfile_S3($request, $api) {
        $camera_id = null;
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;

            $photo = $this->db_photo_new($camera_id, $request, $api);

            if (isset($request->blockid)) {
            //     $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                $err = $ret['err'];

            } else {
                $file = $request->Image;
                if ($file && $file->isValid()) {
                    $ret = $this->s3_save_file($file, $photo->id);
                    $this->s3_save_thumb_file($file, $photo->id);
                    $err = $ret['err'];

                    // $imagename = $file->getClientOriginalName();
                    // $filesize = $file->getClientSize();
                    // $savename = $ret['savename'];
                } else {
                    $err = ERR_NO_UPLOAD_FILE;
                }
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];
                $imagename = $ret['imagename'];
                $savename = $ret['savename'];

                $param = $request;
                $param['filesize'] = $filesize; //$ret['filesize'];
                $points = $this->Plan_Update($param);

                $photo->imagename   = $imagename;   // PICT0001.JPG -> PICT0001.MP4
                $photo->filesize    = $filesize;
                $photo->points      = $points;
                $photo->save();

                $param['savename'] = $savename; //$ret['savename']; // last_savename
                $param['points'] = $points;
                if ($api == 'video_thumb') {
                   $this->Camera_Status_Update($param, 'upload_video'); // s3
                } else {
                   $this->Camera_Status_Update($param, 'upload_photo'); // s3
                }

                if ($request->RequestID) {
                    $request_id = $request->RequestID;
                    $actions = DB::table('actions')->where('id', $request_id);
                    $action  = $actions->first();
                    if ($action) {
                        if ($action->camera_id == $camera_id) {
                            if ($action->action == 'PS') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                $data['photo_cnt'] = 1;
                                $data['status'] = ACTION_COMPLETED;

                            } else if ($action->action == 'SC') {
                                $data['filename'] = $request->FileName;
                                $data['photo_id'] = $photo->id;
                                if ($request->FileName != $action->filename) {
                                    $data['photo_cnt'] = $action->photo_cnt + 1;
                                }
                            }
                            // $data['completed'] = date('Y-m-d H:i:s');
                            $data['completed'] = $this->_datetime_get($camera);
                            $actions->update($data);
                        }
                    }
                }
               $this->email_Photo_Send($user_id, $camera, $savename); // S3: $savename = $photo_id
            }
        }

        if ($err == ERR_CRC32_FAIL) {
            //$crc32 = $ret['CRC32'];
            $response = $this->Response_Result($err, $camera);
            $response['CRC32'] = $ret['CRC32'];
        } else {
            $response = $this->Response_Result($err, $camera);
        }

        $ret = [];
        $ret['user_id'] = $user_id;
        $ret['camera'] = $camera;
        $ret['response'] = $response;
        return $ret;
    }

    public function uploadfile($request, $api) {
        if (env('S3_ENABLE')) {
            $ret = $this->uploadfile_S3($request, $api);
        } else {
            $ret = $this->uploadfile_EBS($request, $api);
        }
        return $ret;
    }

    public function uploadthumb(Request $request) {
        $ret = $this->uploadfile($request, 'photo_thumb');
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        $response = $ret['response'];

        if ($user_id && $camera) {
            $body = 'New Photo: '.$request->FileName;
            $this->pushNewFile($user_id, $camera, $body);
            $this->LogApi_Add('uploadthumb', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    // // for uploadoriginal() & uploadvideothumb()
    // public function upload_check($request, $action) {
    //     $ret = $this->Camera_Check($request);
    //     $err = $ret['err'];
    //     $user_id = $ret['user_id'];
    //     $camera = $ret['camera'];
    //     if ($err == 0) {
    //         $camera_id = $camera->id;

    //         if (isset($request->RequestID)) {
    //             // search Action by RequestID
    //             $query = array(
    //                 'id' => $request->RequestID,
    //                 'camera_id' => $camera_id,
    //                 'action' => $action, //'UO',
    //                 'status' => ACTION_REQUESTED,
    //             );
    //             $actions = DB::table('actions')->where($query);
    //             $action  = $actions->first();
    //             if ($action) {
    //                 $photo_id = $action->photo_id;

    //                 // search Photo
    //                 $query = array(
    //                     'id' => $photo_id,
    //                     'camera_id' => $camera_id,
    //                 );
    //                 $photos = DB::table('photos')->where($query);
    //                 $photo = $photos->first();
    //                 if (!$photo) {
    //                     //return $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
    //                     $response = $this->Response_Result(ERR_INVALID_PHOTO_ID, $camera);
    //                     $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
    //                     return $response;
    //                 }

    //             } else {
    //                 //return $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
    //                 $response = $this->Response_Result(ERR_INVALID_REQUEST_ID, $camera);
    //                 $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
    //                 return $response;
    //             }

    //         } else {
    //             $err = ERR_NO_REQUEST_ID;
    //         }


    //     }
    //     //$ret = [];
    //     $ret['err'] = $err;
    //     //$ret['user_id'] = $user_id;
    //     //$ret['camera'] = $camera;
    //     return $ret;
    // }

    public function uploadoriginal(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            if (isset($request->RequestID)) {
                /* search Action */
                $query = array(
                    'id' => $request->RequestID,
                    'camera_id' => $camera_id,
                    'action' => 'UO',
                    'status' => ACTION_REQUESTED,
                );
                $actions = DB::table('actions')->where($query);
                $action  = $actions->first();
                if ($action) {
                    /* search Photo */
                    $query = array(
                        'id' => $action->photo_id,
                        'camera_id' => $camera_id,
                    );
                    $photos = DB::table('photos')->where($query);
                    $photo = $photos->first();
                    if ($photo) {
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            $file = $request->Image;
                            if ($file && $file->isValid()) {
                                if (env('S3_ENABLE')) {
                                    $ret = $this->s3_save_file($file, $photo->id);
                                } else {
                                    $ret = $uploader->save_file($camera_id, $file);
                                }
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }

                    } else {
                        $err = ERR_INVALID_PHOTO_ID;
                    }
                } else {
                    $err = ERR_INVALID_REQUEST_ID;
                }
            } else {
                $err = ERR_NO_REQUEST_ID;
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];
                $imagename = $ret['imagename'];
                $savename = $ret['savename'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['filesize'] = $filesize;
                $param['imagename'] = $imagename; //$ret['imagename'];
                $param['savename'] = $savename; //$ret['savename'];

                /* update Plan */
                $points = $this->Plan_Update($param);
                $param['points'] = $points;

                /* update Photo */
                $data = [];
                $data['action'] = 0;
                $data['uploadtype'] = 2; // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                $data['resolution'] = $request->upload_resolution;
                $data['photo_compression'] = $request->photo_compression;
                $data['imagename'] = $imagename; //ret['imagename'];
                if (env('S3_ENABLE')) {
                    // do nothing
                } else {
                    $data['original_name'] = $savename; //$ret['savename'];
                }
                $data['filesize'] = $filesize;
                $data['points'] = $points;
                $photos->update($data);

                /* update Camera Status */
                $this->Camera_Status_Update($param, 'upload_photo', 1);

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                // $data['completed'] = date('Y-m-d H:i:s');
                $data['completed'] = $this->_datetime_get($camera);
                $data['photo_cnt'] = 1;
                $actions->update($data);

                $this->email_Photo_Send($user_id, $camera, $savename);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $body = 'New Original Photo: '.$request->FileName;
            $this->pushNewFile($user_id, $camera, $body);
            $this->LogApi_Add('uploadoriginal', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*
        "iccid": "89860117851014783481",
        "module_id": "861107032685597",
        "model_id": "lookout-na",

        "FileName": "PICT0439.MP4",
        "upload_resolution": "8",
        "video_resolution": "8",
        "video_length": "5s",
        "video_sound": "on",
        "video_rate": "4",
        "video_bitrate": "1000",
        "video_filesize": "597939",
        "Source": "tl",
        "DateTime": "20181001213044",

        "RequestID": "7574",

        "Battery": "f",
        "SignalValue": "22",
        "Cardspace": "30039MB",
        "Cardsize": "30432MB",
        "Temperature": "27C",
        "mcu": "4.36",
        "FirmwareVersion": "20180912",
        "cellular": "4G LTE",
        "Image": {}
    */
    public function uploadvideothumb(Request $request) {
        $ret = $this->uploadfile($request, 'video_thumb');
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        $response = $ret['response'];

        if ($user_id && $camera) {
            $body = 'New Video Photo: '.$request->FileName;
            $this->pushNewFile($user_id, $camera, $body);
            $this->LogApi_Add('uploadvideothumb', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function uploadvideo(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            if (isset($request->RequestID)) {
                /* search Action */
                $query = array(
                    'id' => $request->RequestID,
                    'camera_id' => $camera_id,
                    'action' => 'UV',
                    'status' => ACTION_REQUESTED,
                );
                $actions = DB::table('actions')->where($query);
                $action  = $actions->first();
                if ($action) {
                    /* search Photo */
                    $query = array(
                        'id' => $action->photo_id,
                        'camera_id' => $camera_id,
                    );
                    $photos = DB::table('photos')->where($query);
                    $photo = $photos->first();
                    if ($photo) {
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $request->FileName, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            $file = $request->Image;
                            if ($file && $file->isValid()) {
                                if (env('S3_ENABLE')) {
                                    $ret = $this->s3_save_file($file, $photo->id);
                                } else {
                                    $ret = $uploader->save_file($camera_id, $file);
                                }
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }
                    } else {
                        $err = ERR_INVALID_PHOTO_ID;
                    }
                } else {
                    $err = ERR_INVALID_REQUEST_ID;
                }
            } else {
                $err = ERR_NO_REQUEST_ID;
            }

            if ($err == 0) {
                $filesize = $ret['filesize'];
                $imagename = $ret['imagename'];
                $savename = $ret['savename'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['filesize'] = $filesize; //$ret['filesize'];
                $param['imagename'] = $imagename; //$ret['imagename'];

                /* update Plan */
                $points = $this->Plan_Update($param, 1);
                $param['points'] = $points;

                /* update Photo */
                $data = [];
                $data['action'] = 0;
                $data['uploadtype'] = 4; // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                $data['resolution'] = $request->upload_resolution;
                //$data['photo_compression'] = $request->photo_compression;
                $data['imagename'] = $ret['imagename'];
                if (env('S3_ENABLE')) {
                    // do nothing
                } else {
                    $data['original_name'] = $savename; //$ret['savename'];
                }
                $data['filesize'] = $filesize;
                $data['points'] = $points;
                $photos->update($data);

                /* update Camera Status */
                $this->Camera_Status_Update($param, 'upload_video', 1);

                /* update Action */
                $data = [];
                $data['status'] = ACTION_COMPLETED;
                // $data['completed'] = date('Y-m-d H:i:s');
                $data['completed'] = $this->_datetime_get($camera);

                $data['photo_cnt'] = 1;
                $actions->update($data);

                $this->email_Photo_Send($user_id, $camera, $savename);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $body = 'New Video: '.$request->FileName;
            $this->pushNewFile($user_id, $camera, $body);
            $this->LogApi_Add('uploadvideo', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function imagemissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'UO',
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('imagemissing', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function videomissing(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'UV',
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('videomissing', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /*
    {"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
     "RequestID":"4980","version":"20180720",
     "Battery":"f","Cardspace":"30405MB","Cardsize":"30432MB"}
    */
    public function firmwareinfo(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            //$version = '20180816'; // TODO
            $firmware = DB::table('firmwares')
                ->where(['model' => $camera->model_id, 'active' => 1])
                ->first();
            if ($firmware) {
                $version = $firmware->version;

                if ($request->version < $version) {
                    $freespace =  (integer) ($request->Cardspace);
                    if ($freespace < 10) {
                        $err = 2;
                    } else if ($request->Battery == 'l') {
                        $err = 2;
                    } else if ($request->Battery == 'e') {
                        $err = 2;
                    } else {
                        $err = 1;

                        /* /firmware/lookout-na/20180816/IMAGE.ZIP */
                        $model_id = $request->model_id;
                        $filename = ($firmware->type == 1) ? 'IMAGE.ZIP' : 'IMAGE.BIN';
                        $pathname = public_path().'/firmware/'.$model_id.'/'.$version.'/'.$filename;

                        $crc32 = hexdec(hash_file('crc32b', $pathname));
                    }
                } else {
                    $err = 0;
                }
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($err == 1) {
            $response['crc32'] = (string) $crc32;
        }

        if ($user_id && $camera) {
            $this->LogApi_Add('firmwareinfo', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*{"iccid":"89860117851014783481","module_id":"861107032685597","model_id":"lookout-na",
       "RequestID":"4980","version":"20180720"}*/
    public function firmware(Request $request) {
        $model_id = $request->model_id;
        $firmware = DB::table('firmwares')
            ->where(['model' => $model_id, 'active' => 1])
            ->first();
        if ($firmware) {
            /* /firmware/lookout-na/20180816/IMAGE.ZIP */
            $version = $firmware->version;
            $filename = ($firmware->type == 1) ? 'IMAGE.ZIP' : 'IMAGE.BIN';
            //$pathToFile = public_path().'/firmware/'.$model_id.'/'.$version.'/'.$filename;
            $pathToFile = public_path().'/firmware/kmcam/'.$version.'/'.$filename;

            // TODO: check file exist
            return response()->download($pathToFile, $filename);
        }
    }

    public function firmwaredone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FW',
                    //'photo_id'    => null,
                    //'photo_cnt'   => null,
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('firmwaredone', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    public function firmwarefail(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FW',
                    'status' => 4, // 1:requested, 2:completed, 3:cancelled, 4:failed, 5:pending
                );
                $this->Action_Update($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('firmwarefail', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function cardfull(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            /* send email */

        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('cardfull', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    public function formatdone(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request);

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    'action_code' => 'FC',
                );
                $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('formatdone', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /*
        {
	        "iccid": "xxx", "module_id": "xxx", "model_id": "xxx",
	        "status": "start",
	        "first_number": "92",
	        "last_number": "111"
        }
        {
        	"RequestID": "7583",
        	"ResultCode": 0,
        	"DateTimeStamp": "2018-10-02 19:47:18"
        }
    */
    /*
        {
        	"iccid": "xxx", "module_id": "xxx", "model_id": "xxx",
        	"status": "finish",
        	"RequestID": "7583"
        }
    */

/*
{
    "RequestID": "18679",
    "ResultCode": 0,
    "ActionCode": "DS",
    "ParameterList": {
        "REQUESTID": "18677"
    },
    "DateTimeStamp": "2018-10-03 18:23:28"
}
*/
    public function schedule(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $param = array(
                'camera_id'   => $camera->id,
                'action_code' => 'SC',
            );

            if ($request->status == 'start') {
                $api_type = 'schedule_start';

                $this->Action_CancellSchedulePending($camera->id);
                $param['first_number'] = $request->first_number;
                $param['last_number'] = $request->last_number;
                $param['status'] = ACTION_PENDING;
                $this->Action_Add($param);

                $response = $this->Response_Result($err, $camera);

                $action = $this->Action_FindFirst($camera->id, ACTION_PENDING);
                if ($action) {
                    $response['RequestID'] = (string) $action->id;
                }

            } else if ($request->status == 'finish') {
                $api_type = 'schedule_finish';
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    $this->Action_Completed($param);
                }
                $response = $this->Response_Result($err, $camera);

            } else if ($request->status == 'abort') {
                $api_type = 'schedule_abort';
                if ($request->RequestID) {
                    $param['request_id'] = $request->RequestID;
                    $this->Action_Failed($param);
                    //$this->Action_Aborted($param);
                }
                $response = $this->Response_Result($err, $camera);
            }

            $this->Camera_Status_Update($request, $api_type);
            if ($user_id && $camera) {
                $this->LogApi_Add($api_type, 1, $user_id, $camera->id, $request, $response);
            }
        }
        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    //{"iccid":"89860117851014783507","module_id":"861107030190590","model_id":"lookout-na","status":"enable","RequestID":"3"}
    public function logstatus(Request $request) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $this->Camera_Status_Update($request, 'log');

            if ($request->RequestID) {
                $param = array(
                    'request_id'  => $request->RequestID,
                    'camera_id'   => $camera->id,
                    // 'action_code' => $action_code,
                );

                if ($request->status == 'enable') {
                    // $action_code = 'LE';
                    $param['action_code'] = 'LE';
                    $this->Action_Completed($param);
                } else if ($request->status == 'disable') {
                    // $action_code = 'LD';
                    $param['action_code'] = 'LD';
                    $this->Action_Completed($param);
                } else if ($request->status == 'missing') {
                    // $action_code = 'LU';
                    $param['action_code'] = 'LU';
                    $this->Action_Failed($param);
                }

                // $param = array(
                //     'request_id'  => $request->RequestID,
                //     'camera_id'   => $camera->id,
                //     'action_code' => $action_code,
                // );
                // $this->Action_Completed($param);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('logstatus', 1, $user_id, $camera->id, $request, $response);
        }
        return $response;
    }

/*
{
    "iccid": "89860117851014783481",
    "module_id": "861107032685597",
    "model_id": "lookout-na",
    "RequestID": "2",
    "log": []
}
*/
    //{"ResultCode":0,"ActionCode":"LU","ParameterList":{"REQUESTID":"4"},"DateTimeStamp":"2018-10-18 06:08:25"}
    public function uploadlog(Request $request, ImageUploadHandler $uploader) {
        $ret = $this->Camera_Check($request);
        $err = $ret['err'];
        $user_id = $ret['user_id'];
        $camera = $ret['camera'];
        if ($err == 0) {
            $camera_id = $camera->id;
            //if (isset($request->RequestID)) {
                /* search Action */
                //$query = array(
                //    'id' => $request->RequestID,
                //    'camera_id' => $camera_id,
                //    'action' => 'LU',
                //    'status' => ACTION_REQUESTED,
                //);
                //$actions = DB::table('actions')->where($query);
                //$action  = $actions->first();
                //if ($action) {

                    /* search Photo */
                    //$query = array(
                    //    'id' => $action->photo_id,
                    //    'camera_id' => $camera_id,
                    //);
                    //$photos = DB::table('photos')->where($query);
                    //$photo = $photos->first();
                    //if ($photo) {
                        $filename = 'LOG.TXT';
                        if (isset($request->blockid)) {
                            $ret =$this->uploadblock_merge($camera, $filename, $request->blockid, $request->crc32);
                            $err = $ret['err'];
                        } else {
                            //$file = $request->Image;
                            $file = $request->log;
                            if ($file && $file->isValid()) {
                                //$ret = $uploader->save_log($camera_id, $file);
                                $ret = $uploader->save_log($camera, $file);
                                $err = $ret['err'];
                            } else {
                                $err = ERR_NO_UPLOAD_FILE;
                            }
                        }

                    //} else {
                    //    $err = ERR_INVALID_PHOTO_ID;
                    //}
                //} else {
                //    $err = ERR_INVALID_REQUEST_ID;
                //}
            //} else {
            //    $err = ERR_NO_REQUEST_ID;
            //}

            if ($err == 0) {
                $filesize = $ret['filesize'];

                $param = $request;
                $param['camera_id'] = $camera_id;
                $param['filename'] = $request->FileName;
                $param['imagename'] = $ret['imagename'];
                $param['savename'] = $ret['savename'];
                //$param['extension'] = $ret['extension'];
                $param['filesize'] = $ret['filesize'];

                /* update Camera Status */
                $this->Camera_Status_Update($param);

                /* update Action */
                if ($request->RequestID) {
                    $param = array(
                        'request_id'  => $request->RequestID,
                        'camera_id'   => $camera->id,
                        'action_code' => 'LU',
                    );
                    $this->Action_Completed($param);
                }

                //$data = [];
                //$data['status'] = ACTION_COMPLETED;
                //$data['completed'] = date('Y-m-d H:i:s');
                ////$data['photo_cnt'] = 1;
                //$actions->update($data);
            }
        }

        $response = $this->Response_Result($err, $camera);
        if ($user_id && $camera) {
            $this->LogApi_Add('uploadlog', 1, $user_id, $camera->id, $request, $response);
        }

// if ($err == 0) { /* for test */
//     $response['camera_id'] = $camera_id;
//     //$response['filename'] = $request->FileName;
//     $response['imagename'] = $ret['imagename'];
//     $response['savename'] = $ret['savename'];
//     $response['savepath'] = $ret['savepath'];
//     //$response['extension'] = $ret['extension'];
//     $response['filesize'] = $ret['filesize'];
// }

        return $response;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Function
    /*----------------------------------------------------------------------------------*/
    /* TAB Overview */
    public function html_OverviewTitle($camera) {
        $plan = DB::table('plans')->where('iccid', $camera->iccid)->first();
        $txt = '<strong><span class="label label-highlight" style="font-size: 1.0em;">'.ucfirst($plan->status).'</strong>';
        return $txt;
    }

    public function html_OverviewStatus($camera) {
        $txt  = $this->ovItemShow('Description', $camera->description);
        $txt .= $this->ovItemShow('Location', $camera->location);

        if ($camera->signal_value <= 32) {
            $signal = round(($camera->signal_value/32)*100, 2). '%';
        } else if ($camera->signal_value == 99) {
            $signal = 'unknown';
        } else {
            $signal = 'unknown ('.$camera->signal_value.')';
        }
        // $txt .= $this->ovItemShow('Signal', $percent_signal.' %');
        $txt .= $this->ovItemShow('Signal', $signal);

        $battery = $this->itemBattery($camera->battery);
        $txt .= $this->ovItemShow('Battery', $battery);

        $card_size = intval($camera->card_size);
        $card_free = intval($camera->card_space);
        if ($card_size > 0) {
            $percent_card_avail = round(($card_free/$card_size)*100, 2);
            $txt .= $this->ovItemShow('SD Card', $percent_card_avail.' % available');
        } else {
            $txt .= $this->ovItemShow('SD Card', 'unknown');
        }


        $txt .= $this->ovItemShow('Temperature', $camera->temperature);
        //$txt .= $this->ovItemShow('Temperature', '&#176;C');

        $plan = DB::table('plans')->where('iccid', $camera->iccid)->first();
        if ($plan->points > 0) {
            $percent_plan_used = round(($plan->points_used/$plan->points)*100, 4);
            $percent_plan_avail = 100-$percent_plan_used;

            $plan_points = '';
            $plan_points .= '<div class="progress progress-points">';
            $plan_points .=     '<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="'.$percent_plan_used.'%" aria-valuemin="0" aria-valuemax="100" style="width:'.$percent_plan_used.'%; min-height: 22px; line-height: 18px;">';
            $plan_points .=         $percent_plan_used.' % used';
            $plan_points .=     '</div>';
            $plan_points .=     '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$percent_plan_avail.'%" aria-valuemin="0" aria-valuemax="100" style="width:'.$percent_plan_avail.'%; min-height: 22px; line-height: 18px;">';
            $plan_points .=         $percent_plan_avail.' % avail';
            $plan_points .=     '</div>';
            $plan_points .= '</div>';

            $txt .= $this->ovItemShow('Plan Points', $plan_points);
        }
        //$points_reserve  = '30.00 (20000.00 points)';
        //$points_reserve .= '<br /><a href="/plans/buy-reserve/7" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Buy Reserve (<i class="fa fa-dollar-sign"></i>10)</a>';
        //$txt .= $this->ovItemShow('Points Reserve', $points_reserve);
        $txt .= '<br/>';
        return $txt;
    }

    public function html_OverviewStatus2($camera) {
        $plan = DB::table('plans')->where('iccid', $camera->iccid)->first();
        $card_size = number_format(intval($camera->card_size)/1024, 2).'GB';
        $card_free = number_format(intval($camera->card_space)/1024, 2).'GB';
        $card_info = $card_free.' ('.$card_size.')';

        if ($plan->points > 0) {
            $percent = round(($plan->points_used/$plan->points)*100, 4);
            $points_used = $plan->points_used.' ('.$percent.'%)';
        } else {
            $points_used = $plan->points_used;
        }

        $txt  = $this->ovItemShow('Module ID', $camera->module_id);
        $txt .= $this->ovItemShow('SIM ICCID', $camera->iccid);
        $txt .= $this->ovItemShow('Model', $camera->model_id); // Lookout North America
        $txt .= $this->ovItemShow('Card Free (Size)', $card_info);
        $txt .= $this->ovItemShow('Firmware', $camera->dsp_version);
        $txt .= $this->ovItemShow('MCU', $camera->mcu_version);
        //$txt .= $this->ovItemShow('Carrier', 'TRUPHONE');
        $txt .= $this->ovItemShow('Last Connection', $camera->cellular);
        $txt .= $this->ovItemShow('Plan Points', $plan->points);
        $txt .= $this->ovItemShow('Points Used', $points_used);
        return $txt;
    }

    //public function html_OverviewSettingsX($camera) {
    //    $txt  = $this->ovItemShow('Last Downloaded', $camera->last_settings);
    //    $txt .= '<br/>';
    //
    //    $txt .= $this->ovItemShowEx($this->itemCameraMode(), $camera->camera_mode);
    //    if ($camera->camera_mode == 'p') {
    //        $txt .= $this->ovItemShowEx($this->itemPhotoResolution(), $camera->photo_resolution);
    //        $txt .= $this->ovItemShowEx($this->itemPhotoFlash(), $camera->photo_flash);
    //        $txt .= $this->ovItemShowEx($this->itemPhotoBurst(), $camera->photo_burst);
    //        $txt .= $this->ovItemShowEx($this->itemBurstDelay(), $camera->burst_delay);
    //        $txt .= $this->ovItemShowEx($this->itemUploadResolution(), $camera->upload_resolution);
    //        $txt .= $this->ovItemShowEx($this->itemUploadQuality(), $camera->photo_quality);
    //    } else {
    //        $txt .= $this->ovItemShowEx($this->itemVideoResolution(), $camera->video_resolution);
    //        $txt .= $this->ovItemShowEx($this->itemFrameRate(), $camera->video_fps);
    //        $txt .= $this->ovItemShowEx($this->itemQualityLevel(), $camera->video_bitrate);
    //        $txt .= $this->ovItemShowEx($this->itemVideoLength(), $camera->video_length);
    //        $txt .= $this->ovItemShowEx($this->itemVideoSound(), $camera->video_sound);
    //    }
    //    $txt .= '<br/>';
    //
    //    $txt .= $this->ovItemShowEx($this->itemTimeStamp(), $camera->timestamp);
    //    $txt .= $this->ovItemShowEx($this->itemDateFormat(), $camera->date_format);
    //    $txt .= $this->ovItemShowEx($this->itemTimeFormat(), $camera->time_format);
    //    $txt .= $this->ovItemShowEx($this->itemTemperature(), $camera->temp_unit);
    //    $txt .= '<br/>';
    //
    //    $txt .= $this->ovItemShowEx($this->itemQuietTime(), $camera->quiettime);
    //    $txt .= '<br/>';
    //
    //    $txt .= $this->ovItemShowEx($this->itemTimeLapse(), $camera->timelapse);
    //    if ($camera->timelapse == 'on') {
    //        $txt .= $this->ovItemShowEx($this->itemTimelapseStartTime(), $camera->tls_start);
    //        $txt .= $this->ovItemShowEx($this->itemTimelapseStopTime(), $camera->tls_stop);
    //        $txt .= $this->ovItemShowEx($this->itemTimelapseInterval(), $camera->tls_interval);
    //    }
    //    $txt .= '<br/>';
    //
    //    $txt .= $this->ovItemShowEx($this->itemWirelessMode(), $camera->wireless_mode);
    //    if ($camera->wireless_mode == 'schedule') {
    //        $txt .= $this->ovItemShowEx($this->itemScheduleInterval(), $camera->wm_schedule);
    //        $txt .= $this->ovItemShowEx($this->itemScheduleFileLimit(), $camera->wm_sclimit);
    //    }
    //    $txt .= $this->ovItemShowEx($this->itemHeartbeatInterval(), $camera->hb_interval);
    //    $txt .= $this->ovItemShowEx($this->itemActionProcessTimeLimit(), $camera->online_max_time);
    //    //$txt .= $this->ovItemShowEx($this->itemRemoteControl(), $camera->remotecontrol);
    //    $txt .= $this->ovItemShowEx($this->itemCellularPassword(), $camera->cellularpw);
    //    return $txt;
    //}

    public function html_OverviewSettings($user, $camera) {
        $last_settings = $this->_user_dateformat($user, $camera->last_settings);

        $txt  = $this->ovItemShow('Last Downloaded', $last_settings);
        $txt .= '<br/>';

        $obj = json_decode($camera->settings);
        if (!$obj) { return $txt; }

        $txt .= $this->ovItemShowEx($this->itemCameraMode(), $obj->cameramode); // camera_mode
        if ($camera->camera_mode == 'p') {
            $txt .= $this->ovItemShowEx($this->itemPhotoResolution(), $obj->photoresolution); // photo_resolution
            $txt .= $this->ovItemShowEx($this->itemPhotoFlash(), $obj->flash); // photo_flash
            $txt .= $this->ovItemShowEx($this->itemPhotoBurst(), $obj->photoburst); // photo_burst
            $txt .= $this->ovItemShowEx($this->itemBurstDelay(), $obj->burst_delay);
            $txt .= $this->ovItemShowEx($this->itemUploadResolution(), $obj->upload_resolution);
            $txt .= $this->ovItemShowEx($this->itemUploadQuality(), $obj->photo_quality);
        } else {
            $txt .= $this->ovItemShowEx($this->itemVideoResolution(), $obj->video_resolution);
            $txt .= $this->ovItemShowEx($this->itemFrameRate(), $obj->video_rate); // video_fps
            $txt .= $this->ovItemShowEx($this->itemQualityLevel(), $obj->video_bitrate);
            $txt .= $this->ovItemShowEx($this->itemVideoLength(), $obj->video_length);
            $txt .= $this->ovItemShowEx($this->itemVideoSound(), $obj->video_sound);
        }
        $txt .= '<br/>';

        $txt .= $this->ovItemShowEx($this->itemTimeStamp(), $obj->timestamp);
        $txt .= $this->ovItemShowEx($this->itemDateFormat(), $obj->date_format);
        $txt .= $this->ovItemShowEx($this->itemTimeFormat(), $obj->time_format);
        $txt .= $this->ovItemShowEx($this->itemTemperature(), $obj->temperature); // temp_unit
        $txt .= '<br/>';

        $txt .= $this->ovItemShowEx($this->itemQuietTime(), $obj->quiettime);
        $txt .= '<br/>';

        $txt .= $this->ovItemShowEx($this->itemTimeLapse(), $obj->timelapse);
        if ($obj->timelapse == 'on') {
            $txt .= $this->ovItemShowEx($this->itemTimelapseStartTime(), $obj->tls_start);
            $txt .= $this->ovItemShowEx($this->itemTimelapseStopTime(), $obj->tls_stop);
            $txt .= $this->ovItemShowEx($this->itemTimelapseInterval(), $obj->tls_interval);
        }
        $txt .= '<br/>';

        $txt .= $this->ovItemShowEx($this->itemWirelessMode(), $obj->wireless_mode);
        if ($obj->wireless_mode == 'schedule') {
            $txt .= $this->ovItemShowEx($this->itemScheduleInterval(), $obj->wm_schedule);
            $txt .= $this->ovItemShowEx($this->itemScheduleFileLimit(), $obj->wm_sclimit);
        }
        $txt .= $this->ovItemShowEx($this->itemHeartbeatInterval(), $obj->hb_interval);
        $txt .= $this->ovItemShowEx($this->itemActionProcessTimeLimit(), $obj->online_max_time);
        //$txt .= $this->ovItemShowEx($this->itemRemoteControl(), $obj->remotecontrol);
        $txt .= $this->ovItemShowEx($this->itemCellularPassword(), $obj->cellularpw);
        return $txt;
    }

    public function html_OverviewEvent($user, $camera) {
        $txt  = $this->ovItemShow('Last Contact', $this->_user_dateformat($user, $camera->last_contact));
        $txt .= $this->ovItemShow('Last Armed', $this->_user_dateformat($user, $camera->last_armed));
        $txt .= $this->ovItemShow('Uploads since armed', $camera->arm_photos);
        $txt .= $this->ovItemShow('Points since armed', $camera->arm_points);
        $txt .= $this->ovItemShow('Last Heartbeat', $this->_user_dateformat($user, $camera->last_hb));
        $txt .= $this->ovItemShow('Last Photo', $this->_user_dateformat($user, $camera->last_photo));
        $txt .= $this->ovItemShow('Last Video', $this->_user_dateformat($user, $camera->last_video));

        $datetime_schedule = $this->_user_dateformat($user, $camera->last_schedule);
        if ($camera->last_schedule_status == 'start') {
            $datetime_schedule .= ' - start';
        } else if ($camera->last_schedule_status == 'finish') {
            $datetime_schedule .= ' - success';
        } else if ($camera->last_schedule_status == 'abort') {
            $datetime_schedule .= ' - abort';
        }
        $txt .= $this->ovItemShow('Last Scheduled Upload', $datetime_schedule);

        $txt .= $this->ovItemShow('Last Settings', $this->_user_dateformat($user, $camera->last_settings));
        //$txt .= $this->ovItemShow('Expected Contact', $this->_user_dateformat($user, $camera->expected_contact, '[Unknown]'));
        return $txt;
    }

    public function html_OverviewStatisics($camera) {
        $txt = '';
        //$txt .= $this->ovItemShow('Time Lapse Last Hour', $camera->xx);
        ////Activity Suppression:
        //$txt .= $this->ovItemShow('Quiet Time Override', $camera->xx);
        //$txt .= $this->ovItemShow('Motions Last 15 Mins', $camera->xx);
        //$txt .= $this->ovItemShow('Motions Last Hour', $camera->xx);
        //$txt .= $this->ovItemShow('Motions 5 Min Average', $camera->xx);
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Gallery */
    public function html_GallerySelectCamera() {
        // $txt = '';
        // $txt .= '<li><a href="/cameras/getdetail/15">Camera #1</a></li>';
        // $txt .= '<li><a href="/cameras/getdetail/50">Camera #2</a></li>';

        $user    = Auth::user();
        $user_id = $user->id;
        $cameras = DB::table('cameras')
            ->select('id', 'description')
            ->where('user_id', $user_id)
            ->get();

        $style  = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $txt = '';
        foreach ($cameras as $camera) {
            $camera_id   = $camera->id;
            $description = $camera->description;
            $txt .= '<li><a href="/cameras/getdetail/' . $camera_id . '">' . $description . '</a></li>';
        }
        return $txt;
    }

    public function html_GalleryPhoto($user, $camera, $photos) {
        // $txt = '';
        $txt = PHP_EOL;
        $camera_id = $camera->id;
        $column = 1;
        $col = 12/$camera->columns;
        foreach ($photos as $photo) {
            $photo_id = $photo->id;

            $source = $this->TXT_Source($photo->source);
            $resolution = $this->TXT_UploadResolution($photo->resolution);
            $quality = $this->TXT_UploadQuality($photo->photo_quality);
            $photo_datetime = $this->_user_dateformat($user, $photo->datetime);

            if ($photo->filetype == 2) {
                // PICT0004.MP4 | 10/16/2018 9:13:31 am | Time Lapse | Standard Low | Points: 2.00 (Video Cost: 0 pts)
                $caption = sprintf('%s | %s | %s | %s | Points: %.2f', $photo->filename, $photo_datetime, $source, $resolution, $photo->points);
            } else {
                // PICT0055.JPG | 10/15/2018 6:14:02 am | Menu       | Standard Low (Q=Standard) | Points: 1.00
                $caption = sprintf('%s | %s | %s | %s (Q=%s) | Points: %.2f', $photo->filename, $photo_datetime, $source, $resolution, $quality, $photo->points);
            }
            $title = sprintf('%s (%d)', $photo->filename, $photo->id); // PICT0001.JPG (1)

            // filetype  : 1=photo, 2=video
            // uploadtype: 1=photo_thumb, 2=photo_original
            //             3=video_thumb, 4=video_original
            if (env('S3_ENABLE')) {
                $url_img = $this->s3_file_url('media/'.$photo_id.'_thumb.JPG');

                if ($photo->uploadtype == 4) { /* original video */
                    $url_href = $this->s3_file_url('media/'.$photo_id.'.MP4');
                } else {
                    $url_href = $this->s3_file_url('media/'.$photo_id.'.JPG');
                }

                // $filepath = $url_img;

            } else {
                $url_img = sprintf('/uploads/%d/%s', $camera_id, $photo->thumb_name);

                if (($photo->uploadtype == 2) || ($photo->uploadtype == 4)) {
                    $url_href = sprintf('/uploads/%d/%s', $camera_id, $photo->original_name);
                } else {
                    $url_href = $url_img;
                }

                // $filepath = $url_img;
            }

            $download = sprintf('/cameras/download/%d/%d', $camera_id, $photo_id);

            $txt .= '<div class="col-xs-'.$col.' custom-thumbnail-grid-column column-number-'.$column.'">';
            $txt .=     '<div class="image-checkbox">';
            $txt .=         '<label style="font-size: 1.5em" class="check-label hidden">';
            $txt .=             '<input type="checkbox" class="image-check" value="'.$photo_id.'" id="check_'.$photo_id.'" />';
            $txt .=             '<span class="cr span-cr"></span>';
            $txt .=         '</label>';
            $txt .=     '</div>';

            /* pending request */
            $hidden = ($photo->action) ? '' : 'hidden';
            $txt .=     '<div class="image-highdef pull-right" '.$hidden.' id="pending-'.$photo_id.'">';
            $txt .=         '<label style="font-size: 1.0em; margin-right: 4px;">';
            $txt .=             '<span class="cr"><i class="cr-icon fa fa-hourglass" style="color:#ffd352;"></i></span>';
            $txt .=         '</label>';
            $txt .=     '</div>';

            // uploadtype: 1=photo_thumb, 2=photo_original
            //             3=video_thumb, 4=video_original
            if (!$photo->action) {
                if ($photo->uploadtype == 2) {
                    $txt .= '<div class="image-highdef pull-right">';
                    $txt .= '    <label style="font-size: 1.5em; margin-right: 4px;">';
                    $txt .= '        <span class="cr"><i class="cr-icon fa fa-camera" style="color:lime;"></i></span>';
                    $txt .= '    </label>';
                    $txt .= '</div>';
                } else if ($photo->uploadtype == 3) {
                    $txt .=     '<div class="image-highdef pull-right">';
                    $txt .=         '<label style="font-size: 1.5em; margin-right: 4px;">';
                    $txt .=             '<span class="cr"><i class="cr-icon fa fa-play-circle" style="color:lime;"></i></span>';
                    $txt .=         '</label>';
                    $txt .=     '</div>';
                }
            }

            if ($photo->uploadtype == 4) { /* original video */
                // $videopath = sprintf('/uploads/%d/%s', $camera_id, $photo->original_name);

                $txt .= '<div class="thumb-anchor">';
                // $txt .=     '<img src="'.$filepath.'"';
                $txt .=     '<img src="'.$url_img.'"';
                $txt .= '        class="img-responsive custom-thumb"';
                $txt .=         'title="'.$title.'" ';
                $txt .=         'alt="'.$photo->filename.'" ';
                $txt .=         'data-description="'.$photo->filename.'">';
                $txt .= '</div>';

                // $txt .= '<div class="popup-video" video-url="'.$videopath.'"';
                $txt .= '<div class="popup-video" video-url="'.$url_href.'"';
                $txt .=     'data-caption="'. $caption.'"';
                $txt .=     'data-camera="'.$camera_id.'" ';
                $txt .=     'data-id="'.$photo_id.'" ';
                $txt .=     'data-poster="" ';
                $txt .=     'data-width="640" ';
                $txt .=     'data-height="360" controls>';
                $txt .= '</div>';

            } else {
                // if ($photo->uploadtype == 2) {
                //     $photo_path = sprintf('/uploads/%d/%s', $camera_id, $photo->original_name);
                // } else {
                //     $photo_path = $filepath;
                // }

                $txt .= '<a class="thumb-anchor" data-fancybox="gallery-'.$camera_id.'" ';
                // $txt .=     'href="'.$photo_path.'" ';
                $txt .=     'href="'.$url_href.'" ';
                $txt .=     'data-caption="'. $caption.'"';
                $txt .=     'data-camera="'.$camera_id.'" ';
                $txt .=     'data-id="'.$photo_id.'" ';
                $txt .=     'data-highres="0" ';
                $txt .=     'data-pending="0">';

                // $txt .=  '  <img src="'.$filepath.'"';
                $txt .=  '  <img src="'.$url_img.'"';
                $txt .=         'class="img-responsive custom-thumb"';
                $txt .=         'title="'.$title.'" ';
                $txt .=         'alt="'.$photo->filename.'" ';
                $txt .=         'data-description="'.$photo->filename.'">';
                $txt .= '</a>';
            }

            $txt .=     '<p class="thumbnail-timestamp pull-right" style="font-size: .70em">';
            $txt .=         '<a href="'.$download.'"><i class="fa fa-download"></i></a> ';
            $txt .=          $photo_datetime;
            $txt .=     '</p>';
            $txt .= '</div>';
            $txt .= PHP_EOL;
            $txt .= PHP_EOL;

            if ($column == $camera->columns) {
                $column = 1;
            } else {
                $column++;
            }
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Settings */
    public function html_Settings_Identification($camera) {
        $id = $camera->id;
        $txt  = $this->stItemOption($id, $this->itemCameraDescription(), 'description');
        $txt .= $this->stItemOption($id, $this->itemCameraLocation(), 'location');
        $txt .= $this->stItemOption($id, $this->itemCameraRegion(), 'region');

        $region = $this->stRegion($camera['region']);
        $txt .= $this->stItemOption($id, $region, 'timezone', 'Time Zone');
        return $txt;
    }

    public function stItemMobilePush($camera) {
        $name = $id = 'noti_mobile';
        $value = null;
        $checked = ($camera[$name] == 'on') ? 'checked' : '';
        return $this->stItemCheckbox($name, $id, $value, $checked, 'Send Mobile Push Notifications');
    }

    public function stItemEmailOwner($camera) {
        $name = $id = 'noti_email';
        $value = null;
        $checked = ($camera[$name] == 'on') ? 'checked' : '';
        return $this->stItemCheckbox($name, $id, $value, $checked, 'kevin@10ware.com');
    }

    public function html_Settings_Notifications($camera) {
        $txt = '';
        $txt .= $this->stItemMobilePush($camera);
        $txt .= $this->stItemEmailOwner($camera);
        //$txt .= $this->stItemCheckbox('54_email[]', null, 'test1@gmail.com', 'checked', 'test1@gmail.com');
        //$txt .= $this->stItemCheckbox('54_email[]', null, 'test2@gmail.com', 'checked', 'test2@gmail.com');
        return $txt;
    }

    public function html_Settings_Basic($camera) {
        $id = $camera->id;
        $txt  = $this->stItemOption($id, $this->itemCameraMode(), 'camera_mode');
        $txt .= $this->stItemOption($id, $this->itemPhotoResolution(), 'photo_resolution');
        $txt .= $this->stItemOption($id, $this->itemPhotoFlash(), 'photo_flash');
        $txt .= $this->stItemOption($id, $this->itemPhotoBurst(), 'photo_burst');
        $txt .= $this->stItemOption($id, $this->itemBurstDelay(), 'burst_delay');
        $txt .= $this->stItemOption($id, $this->itemUploadResolution(), 'upload_resolution');
        $txt .= $this->stItemOption($id, $this->itemUploadQuality(), 'photo_quality');

        $txt .= $this->stItemOption($id, $this->itemVideoResolution(), 'video_resolution');
        $txt .= $this->stItemOption($id, $this->itemFrameRate(), 'video_fps');
        $txt .= $this->stItemOption($id, $this->itemQualityLevel(), 'video_bitrate');
        $txt .= $this->stItemOption($id, $this->itemVideoLength(), 'video_length');
        $txt .= $this->stItemOption($id, $this->itemVideoSound(), 'video_sound');

        $txt .= '<hr>';
        $txt .= $this->stItemOption($id, $this->itemTimeStamp(), 'timestamp');
        $txt .= $this->stItemOption($id, $this->itemDateFormat(), 'date_format');
        $txt .= $this->stItemOption($id, $this->itemTimeFormat(), 'time_format');
        $txt .= $this->stItemOption($id, $this->itemTemperature(), 'temp_unit');
        return $txt;
    }

    public function html_Settings_Trigger($camera) {
        $txt = $this->stItemOption($camera->id, $this->itemQuietTime(), 'quiettime');
        return $txt;
    }

    public function html_Settings_Timelapse($camera) {
        $id = $camera->id;
        $txt  = $this->stItemOption($id, $this->itemTimelapseStartTime(), 'tls_start');
        $txt .= $this->stItemOption($id, $this->itemTimelapseStopTime(), 'tls_stop');
        $txt .= $this->stItemOption($id, $this->itemTimelapseInterval(), 'tls_interval');
        return $txt;
    }

    public function html_Settings_Wireless_Mode($camera) {
        $id = $camera->id;
        $txt  = $this->stItemOption($id, $this->itemWirelessMode(), 'wireless_mode');
        $txt .= $this->stItemOption($id, $this->itemScheduleInterval(), 'wm_schedule');
        $txt .= $this->stItemOption($id, $this->itemScheduleFileLimit(), 'wm_sclimit');
        $txt .= $this->stItemOption($id, $this->itemHeartbeatInterval(), 'hb_interval');
        $txt .= $this->stItemOption($id, $this->itemActionProcessTimeLimit(), 'online_max_time');
        //$txt .= $this->stItemOption($id, $this->itemRemoteControl(), 'remotecontrol');
        $txt .= $this->stItemOption($id, $this->itemCellularPassword(), 'cellularpw');
        return $txt;
    }

    public function html_Settings_Block_Mode($camera) {
        $array = array(
            'options' => array(
                'On'=>'on', 'Off'=>'off',
            ),
        );
        $id = $camera->id;
        $txt  = $this->stItemOption($id, $array, 'blockmode1', 'Block Mode 1');
        $txt .= $this->stItemOption($id, $array, 'blockmode2', 'Block Mode 2');
        $txt .= $this->stItemOption($id, $array, 'blockmode3', 'Block Mode 3');
        $txt .= $this->stItemOption($id, $array, 'blockmode4', 'Block Mode 4');
        $txt .= $this->stItemOption($id, $array, 'blockmode5', 'Block Mode 5');
        //$txt .= $this->stItemOption($id, $array, 'blockmode6', 'Block Mode 6');
        $txt .= $this->stItemOption($id, $array, 'blockmode7', 'Block Mode 7');
        $txt .= $this->stItemOption($id, $array, 'blockmode8', 'Block Mode 8');
        $txt .= $this->stItemOption($id, $array, 'blockmode9', 'Block Mode 9');
        $txt .= $this->stItemOption($id, $array, 'blockmode10', 'Block Mode 10');
        $txt .= $this->stItemOption($id, $array, 'blockmode11', 'Block Mode 11');
        return $txt;
    }

    public function html_Settings_DutyTime($camera) {
        $hour = array(
            '12 AM', '01 AM', '02 AM', '03 AM', '04 AM', '05 AM',
            '06 AM', '07 AM', '08 AM', '09 AM', '10 AM', '11 AM',
            '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM',
            '06 PM', '07 PM', '08 PM', '09 PM', '10 PM', '11 PM',
        );

        $dt_week = array(
            'dt_sun','dt_mon','dt_tue','dt_wed','dt_thu','dt_fri','dt_sat',
        );

        $id = $camera->id;

        $txt = '';
        for ($week=0; $week<7; $week++) {
            $tabs_id = 'tabs'.$id.'-'.($week+1); // tabs54-1
            $control_group = 'controlgroup'.$id.'-'.($week+1); // controlgroup54-1

            $value = hexdec($camera[$dt_week[$week]]);
            $bit = 0x800000;

            $txt .= '<div id="'.$tabs_id.'">';
            $txt .=    '<div id="'.$control_group.'" class="mobile-dutytime-div">';
            $txt .=        '<table>';
            for ($h=0; $h<24; $h++) {
                $zz = $id.'_hour_'.($week+1).'_'.($h+1); //54_hour_1_1
                if (($h%6) == 0) {
                    $txt .= '<tr>';
                }

                /*
                    <td class="custom-time-toggle-td">
                    <span class="button-checkbox" style="font-size: .80em;">
                        <button type="button" class="btn btn-default btn-md"  style="padding-left:2px;padding-right:2px;" data-color="info">12 AM</button>
                        <input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked />
                    </span>
                    </td>
                */
                $txt .= '<td class="custom-time-toggle-td">';
                $txt .= '<span class="button-checkbox" style="font-size: .80em;">';
                $txt .=     '<button type="button" class="btn btn-default btn-md" style="padding-left:2px;padding-right:2px;" data-color="info">'.$hour[$h].'</button>';
                //$txt .=     '<input type="checkbox" class="hidden custom-time-button" name="54_hour_1_1" id="54_hour_1_1"  checked />';
                if ($value & $bit) {
                    $txt .=   '<input type="checkbox" class="hidden custom-time-button" name="'.$zz.'" id="'.$zz.'" checked />';
                } else {
                    $txt .=   '<input type="checkbox" class="hidden custom-time-button" name="'.$zz.'" id="'.$zz.'" />';
                }
                $txt .= '</span>';
                $txt .= '</td>';
                if (($h+1)%6 == 0) {
                    $txt .= '</tr>';
                }

                $bit >>= 1;
            }
            $txt .=        '</table>';
            $txt .=    '</div>';
            $txt .= '</div>';
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    /* TAB Actions */

    /*----------------------------------------------------------------------------------*/
    /* TAB Options */

    /*----------------------------------------------------------------------------------*/
    /* Camera List */
    /*
    <tr>
        <td class="col-sm-1">
        </td>
        <td class="col-sm-5 ">
            <a href="/cameras/getdetail/50">New Camera</a><br />
            <i class="fa fa-battery-full" style="color: lime;"> </i> 100%<br />
            <span style="font-size: .95em">07/12/2018 5:49:00 am</span>
        </td>
        <td class="col-sm-6">
            <a class="btn thumb-select" data-id="54" style="padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;">
                <img src="https://ridgetec-dev.s3.us-east-2.amazonaws.com/camera_media/90815.JPG?X-Amz,,," class="img-responsive" />
            </a>
        </td>
    </tr>
    */
    public function html_CameraList($user, $active_camera_id) {
        if ($user->permission == 1) {
            $cameras = DB::table('cameras')
                ->orderBy('description', 'asc')
                ->get();
        } else {
            $cameras = DB::table('cameras')
                //->select('id', 'description', 'battery', 'last_contact', 'last_filename', 'last_savename')
                ->where('user_id', $user->id)
                ->orderBy('description', 'asc')
                ->get();
        }

        $style  = 'padding-top:0px;padding-bottom:0px;padding-left:0px;padding-right:0px;';
        $txt = PHP_EOL;
        foreach ($cameras as $camera) {
            $camera_id    = $camera->id;
            $description  = $camera->description;
            $battery = $this->itemBattery($camera->battery);
            $last_contact = $this->_user_dateformat($user, $camera->last_contact);

            $url = '';
            if (!empty($camera->last_savename)) {
                if (env('S3_ENABLE')) {
                    // $url = $this->s3_file_url('media/'.$camera->last_savename.'.JPG');
                    $url = $this->s3_file_url('media/'.$camera->last_savename.'_thumb.JPG');
                } else {
                    //$url = 'http://sample.test/uploads/1/1537233425_2YDReN47PS.JPG';
                    $url = url('/uploads/'.$camera_id.'/').'/'.$camera->last_savename;
                }
            }

            $txt .= '<tr>';
            $txt .=     '<td class="col-sm-1">';
            if ($camera_id == $active_camera_id) {
                $txt .= '<i class="fa fa-camera"> </i>';
            }
            $txt .=     '</td>';

            if ($camera_id == $active_camera_id) {
                $txt .=     '<td class="col-sm-5 active">';
            } else {
                $txt .=     '<td class="col-sm-5">';
            }

            $txt .=         '<a href="/cameras/getdetail/'.$camera_id.'">'.$description.'</a><br/>';

            //$txt .= '        <i class="fa fa-battery-full" style="color: lime;"> </i>'.$battery.'<br />';
            $txt .= $battery.'<br/>';
            $txt .=         '<span style="font-size: .95em">'.$last_contact.'</span>';
            $txt .=     '</td>';

            $txt .=     '<td class="col-sm-6">';
            if (!empty($url)) {
                $txt .=         '<a class="btn thumb-select" data-id="'.$camera_id.'" style="'.$style.'"><img src="'.$url.'" class="img-responsive"/></a>';
            }
            $txt .=     '</td>';
            $txt .= '</tr>';

            $txt .= PHP_EOL;
            $txt .= PHP_EOL;
        }
        return $txt;
    }

    /*----------------------------------------------------------------------------------*/
    /* Web Function */
    public function route_to_cameras() {
        return redirect()->route('cameras');
    }

    public function home() {

// Debugbar::debug('..........A');
// Debugbar::debug(App::getLocale());
// App::setLocale('zh-TW');
// return trans('htc.login');
// return redirect()->route('confirm.send');

        if (Auth::check()) {
            return $this->route_to_cameras();
        } else {
            if (Browser::isMobile()) {
                return redirect()->route('mobile.login');
            } else if (Browser::isTablet()) {
                return redirect()->route('mobile.login');
            } else {
                return redirect()->route('login');
                // return redirect()->route('mobile.login'); // for test
            }
        }
    }

    public function postActiveTab() {
        $sel_camera_tab = $_POST['tab'];
        $data['sel_camera_tab'] = $sel_camera_tab;
        Auth::user()->update($data);

        return $sel_camera_tab;
    }

    // https://blog.csdn.net/woshihaiyong168/article/details/52992812
    public function cameras() {
        $user = Auth::user();
        $user_id = $user->id;

        // $cameras = DB::table('cameras')->where('user_id', $user_id);
        if ($user->permission == 1) {
            // $cameras = DB::table('cameras');
            $cameras = Camera::get();
        } else {
            // $cameras = DB::table('cameras')->where('user_id', $user_id);
            $cameras = Camera::where('user_id', $user_id)->get();
        }

        if ($cameras->count() > 0) {
            $camera_id = $user->sel_camera;
            if (!$camera_id) {
                $camera = $cameras->first();
                $camera_id = $camera->id;
            } else {
                $camera = Camera::find($camera_id);
                if (!$camera) {
                    $camera = $cameras->first();
                    $camera_id = $camera->id;
                }
            }
            //$camera = Camera::findOrFail($camera_id);

            //$photos = DB::table('photos')->where('camera_id', $camera_id)
            $photos = $camera->photos()
                ->orderBy('created_at', 'desc')
                ->paginate($camera->thumbs);

            if (($user->sel_menu != 'camera')||($user->sel_camera != $camera_id)) {
                $data['sel_menu'] = 'camera';
                $data['sel_camera'] = $camera_id;
                $user->update($data);
            }

            return view('cameras', compact('user', 'cameras', 'camera', 'photos'));
        } else {
            if ($user->sel_menu != 'camera') {
                $data['sel_menu'] = 'camera';
                $data['sel_camera'] = 0;
                $user->update($data);
            }
            return view('cameras_empty', compact('user'));
        }
    }

// public function validateCredentials(UserContract $user, array $credentials)
// {
//     $plain = $credentials['password'];

//     return $this->hasher->check($plain, $user->getAuthPassword());
// }

    public function postDelete(Request $request) {
        // {"_token":"xxxx","id":"1","password":"123456"}
        $user = Auth::user();
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $camera = Camera::find($request->id);
            if ($camera) {
                $camera->delete();
                $camera->photos()->delete();
                $camera->actions()->delete();
                $camera->log_apis()->delete();

                $data['sel_camera'] = 0; // IMPORTANT !!
                $user->update($data);
            }
            session()->flash('success', ' Success: Camera Deleted. All associated media files removed.');
        } else {
            session()->flash('danger', 'Error: Invalid Password. Please try again.');
        }
        return $this->route_to_cameras();
    }

    public function download($camera_id, $photo_id) {
        //return 'camera_id='.$camera_id.', photo_id='.$photo_id;

        //$user   = Auth::user();
        $camera = Camera::findOrFail($camera_id);
        $photos = $camera->photos()->where('id', $photo_id);
        //$photos = DB::table('photos')->where('id', $photo_id);
        $photo  = $photos->first();

        /* /uploads/camera_id/1539695099_2Q7NJJh7ur.ZIP */
        // 1=photo_thumb, 2=photo_original,
        // 3=video_thumb, 4=video_original
        if (env('S3_ENABLE')) {
            if ($photo->uploadtype == 1) {
                $filename = $photo->filename;
                $s3_pathname = 'media/'.$photo_id.'.JPG';

            } else if ($photo->uploadtype == 2) {
                $filename = $photo->filename;
                $s3_pathname = 'media/'.$photo_id.'.JPG';

            } else if ($photo->uploadtype == 3) {
                $filename = $photo->imagename;          // Notice!! imagename
                $s3_pathname = 'media/'.$photo_id.'.JPG';

            } else if ($photo->uploadtype == 4) {
                $filename = $photo->filename;
                $s3_pathname = 'media/'.$photo_id.'.MP4';
            }

            // $exists = Storage::disk('s3')->exists($s3_pathname);
            // if (!$exists) {
            //     $error = new MessageBag([
            //         'title' => '文件不存在',
            //     ]);
            //     return redirect('admin/task/create')->with(compact('error'));
            // }

            $fileSize = Storage::disk('s3')->size($s3_pathname);
            $content = Storage::disk('s3')->get($s3_pathname);

            //告诉浏览器这是一个文件流格式的文件
            Header("Content-type: application/octet-stream");

            //请求范围的度量单位
            Header("Accept-Ranges: bytes");

            //Content-Length是指定包含于请求或响应中数据的字节长度
            Header("Accept-Length: ".$fileSize);

            //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
            Header("Content-Disposition: attachment; filename=".$filename);

            echo $content;
            exit();

        } else {
            // if (($photo->uploadtype == 2)||($photo->uploadtype == 4)) {
            if ($photo->original_name) {
                $pathToFile = public_path().'/uploads/'.$camera_id.'/'.$photo->original_name;
            } else {
                $pathToFile = public_path().'/uploads/'.$camera_id.'/'.$photo->thumb_name;
            }

            // TODO: check file exist
            return response()->download($pathToFile, $photo->imagename);
        }
    }

    /* /cameras/getdetail/{camera_id} */
    public function getdetail($camera_id) {
        $user = Auth::user();
        $data['sel_camera'] = $camera_id;
        $user->update($data);
        return $this->route_to_cameras();
    }

    public function gallery(Request $request) {
        //$medialist = $_POST['medialist'];
        //{"id":"1","action":"d","medialist":"[\"check_22\"]"}
        //return $request;

        $action = $request->action;
        $param = array(
            'camera_id'   => $request->id,
            'status'      => ACTION_REQUESTED,
        );

        $medialist = json_decode($request->medialist);
        foreach ($medialist as $media) {
            /*
                Array(
                    [0] => check
                    [1] => 22
                )
            */
            $x = explode("_", $media);
            $photo_id = $x[1];
            //echo $photo_id; echo '<br>';

            $photo = Photo::findOrFail($photo_id);
            $filename = $photo->filename;
            //echo $filename; echo '<br>';

            if ($photo->action == 0) {
                if ($action == 'd') {
                    $photo->delete();

                } else if ($action == 'h') {
                    //if ($photo->filetype == 1) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 1) {
                        $param['action_code'] = 'UO';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $param['image_size'] = 5;
                        $param['compression'] = 28; //$compression;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }

                } else if ($action == 'o') {
                    //if ($photo->filetype == 1) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 1) {
                        $param['action_code'] = 'UO';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $param['image_size'] = 6;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }

                } else if ($action == 'v') {
                    //if ($photo->filetype == 2) {
                    // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original
                    if ($photo->uploadtype == 3) {
                        $param['action_code'] = 'UV';
                        $param['photo_id'] = $photo_id;
                        $param['filename'] = $filename;
                        $this->Action_Add($param);

                        $data['action'] = 1;
                        $photo->update($data);
                    }
                }
            }
        }
        return $this->route_to_cameras();
    }

    public function gallerylayout($camera_id, $number) {
        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update(['columns' => $number]);
        return $this->route_to_cameras();
    }

    public function gallerythumbs($camera_id, $number) {
        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update(['thumbs' => $number]);
        return $this->route_to_cameras();
    }

    //public function activetab(Request $request) {
    //    return $request;
    //}

    public function overview($cameras_id) {
        $camera = Camera::findOrFail($cameras_id);
        return view('camera.tab_overview', compact('camera'));
    }

    public function actions($cameras_id) {
        $camera = Camera::findOrFail($cameras_id);
        return view('camera.tab_actions', compact('camera'));
    }

    public function postSettings(Request $request) {
        $Control_Settings = array(
            /* Identification Settings */
            "description",
            "location",
            "region",
            "timezone",

            /* Basic Settings */
            "camera_mode",
            "photo_resolution",
            "photo_flash",
            "photo_burst",
            "burst_delay",
            "upload_resolution",
            "photo_quality",
            "video_resolution", "video_fps", "video_bitrate", "video_length", "video_sound",
            "timestamp", "date_format", "time_format",
            "temp_unit",

            /* Trigger Settings */
            "quiettime",

            /* Wireless Settings */
            "wireless_mode", "wm_schedule", "wm_sclimit",
            "hb_interval",
            "online_max_time",
            "cellularpw",
            "remotecontrol",
        );

        $Notification_Settings = array(
            "timelapse","tls_start","tls_stop","tls_interval",
        );

        $Timelapse_Settings = array(
            "timelapse","tls_start","tls_stop","tls_interval",
        );

        $Block_Mode_Settings = array(
            "blockmode1","blockmode2","blockmode3","blockmode4","blockmode5",
            "blockmode7","blockmode8","blockmode9","blockmode10","blockmode11",
        );

        $dt_week = array(
            'dt_sun','dt_mon','dt_tue','dt_wed','dt_thu','dt_fri','dt_sat',
        );

        $camera_id = $request->id;

        for ($week=1; $week<=7; $week++) {
            $value = 0;
            $bit = 0x800000;
            for ($hour=1; $hour<=24; $hour++) {
                $zz = $camera_id.'_hour_'.$week.'_'.$hour; //54_hour_1_1
                if($request[$zz]) {
                    $value |= $bit;
                }
                $bit >>= 1;
            }
            $key = $dt_week[$week-1];
            $data[$key] = sprintf("%06x", $value);
        }

        foreach ($Control_Settings as $key) {
            //$name = $camera_id.'_'.$key;
            //$data[$key] = $request[$name];
            if (isset($request[$camera_id.'_'.$key])) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        }

        $data['noti_mobile'] = isset($request['noti_mobile']) ? 'on' : 'off';
        $data['noti_email'] = isset($request['noti_email']) ? 'on' : 'off';
        //54_email[]: test1@gmail.com
        //54_email[]: test2@gmail.com

        if (isset($request[$camera_id.'_timelapse'])) {
            foreach ($Timelapse_Settings as $key) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        } else {
            $data['timelapse'] = 'off';
        }

        if (isset($request[$camera_id.'_dutytime'])) {
            $data['dutytime'] = 'on';
        } else {
            $data['dutytime'] = 'off';
        }

        foreach ($Block_Mode_Settings as $key) {
            if (isset($request[$camera_id.'_'.$key])) {
                $data[$key] = $request[$camera_id.'_'.$key];
            }
        }
//return $data;

        $cameras = DB::table('cameras')->where('id', $camera_id);
        $cameras->update($data);

        $ret = $this->Action_Search($camera_id, 'DS', ACTION_REQUESTED);
        if ($ret == 0) {
            $param = array(
                'camera_id'   => $camera_id,
                'action_code' => 'DS',
                'status'      => ACTION_REQUESTED,
            );
            $this->Action_Add($param);
        }
        return $this->route_to_cameras();
    }

    /* Action */
    public function sendsms($camera_id, $sms) {
        $ret = '/cameras/sendsms/'.$camera_id.'/'.$sms;
        return $ret;

        if ($sms == 'snap') {
            // send SMS 'snap'
        } else if ($sms == 'wake') {
            // send SMS 'wake'
        }
    }

    /*
        /cameras/actionqueue/2/LD (for FW, LD, LE, LU)
    */
    public function getActionQueue($camera_id, $action_code) {
        $camera = Camera::find($camera_id);
        if ($camera) {
            $ret = $this->Action_Search($camera_id, $action_code, ACTION_REQUESTED);
            if ($ret == 0) {
                $param = array(
                    'camera_id'   => $camera_id,
                    'action_code' => $action_code,
                    'status'      => ACTION_REQUESTED,
                );
                $this->Action_Add($param);
            }
            $user = Auth::user();
            return view('camera.tab_actions', compact('user', 'camera'));
        } else {
            session()->flash('warning', 'camera not found');
            return $this->route_to_cameras();
        }
    }

    /* for FC */
    //public function actionqueue_post(Request $request) {
    public function postActionQueue(Request $request) {
        /*
            {
                "_token":"D6RyLJ5esCNGbgPPcw6D18sAgY9X3UZQNsesJDvO",
                "id":"2",
                "action":"FC",
                "password":"12345"
            }
        */
        $user = Auth::user();
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $camera_id = $request->id;
            $action_code = $request->action;
            $ret = $this->Action_Search($camera_id, $action_code, ACTION_REQUESTED);
            if ($ret == 0) {
                $param = array(
                    'camera_id'   => $camera_id,
                    'action_code' => $action_code,
                    'status'      => ACTION_REQUESTED,
                );
                $this->Action_Add($param);
            }
            session()->flash('success', 'Success: Erase SD Card queued.');
        } else {
            session()->flash('danger', 'Error: Invalid Password. Please try again.');
        }
        return redirect()->back();
    }

    public function getActionCancel($action_id) {
        $actions = DB::table('actions')->where('id', $action_id);
        $action  = $actions->first();
        if ($action) {
            $camera_id = $action->camera_id;
            $data['status'] = ACTION_CANCELLED;

            // $data['completed'] = date('Y-m-d H:i:s');
            $camera = Camera::find($action->camera_id);
            if ($camera) {
                $data['completed'] = $this->_datetime_get($camera);
            } else {
                $data['completed'] = date('Y-m-d H:i:s');
            }

            $actions->update($data);

            $photo_id = $action->photo_id;
            if ($photo_id) {
                $photo = Photo::findOrFail($photo_id);
                $filename = $photo->filename;

                $data['action'] = 0;
                $photo->update($data);
            }
        }
        $camera = Camera::findOrFail($camera_id);

        $user = Auth::user();
        return view('camera.tab_actions', compact('user', 'camera'));
    }

    public function getClearMissing($cameras_id) {
        $camera = Camera::findOrFail($camera_id);
        return view('camera.tab_actions', compact('user', 'camera'));
    }

    public function getRequestMissing($cameras_id, $missing_id) {
        $camera = Camera::findOrFail($camera_id);
        $user = Auth::user();
        return view('camera.tab_actions', compact('user', 'camera'));
    }

    //public function emailpolicy() {
    //    $user   = Auth::user();
    //    //$camera = Camera::findOrFail($camera_id);
    //    $camera = Camera::find($camera_id);
    //    $photos = $camera->photos()
    //        ->orderBy('created_at', 'desc')
    //        ->paginate(10);
    //    return view('support.emailpolicy', compact('user', 'camera', 'photos'));
    //}

    /*----------------------------------------------------------------------------------*/
    public function admin() {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    /* Users */
    public function admin_filter_users($email, $name) {
        $user = Auth::user();
        if ($email && $name) {
            $users = DB::table('users')
                ->where(['email' => $email, 'name' => $name])
                ->orderBy('name', 'asc')
                ->paginate(20);
        } else if ($email) {
            $users = DB::table('users')
                ->where(['email' => $email])
                ->orderBy('name', 'asc')
                ->paginate(20);
        } else if ($name) {
            $users = DB::table('users')
                ->where(['name' => $name])
                ->orderBy('name', 'asc')
                ->paginate(20);
        } else {
            $users = DB::table('users')
                ->orderBy('name', 'asc')
                ->paginate(20);
        }
        return view('admin.user', compact('users', 'email', 'name'));
    }

    public function admin_users() {
        return $this->admin_filter_users('', '');
    }

    public function admin_user_search(Request $request) {
        //return 'admin_user_search';
        //{"_token":"J6pv3ftu1s5fbRGolbBgMIPd9kG0KQuuQKEGbxOB","email":null,"username":null}
        return $this->admin_filter_users($request->email, $request->username);
    }

    public function admin_clear_search_users() {
        return $this->admin_filter_users('', '');
    }

    /* Email */
    public function admin_email() {
        $user = Auth::user();
        $emails = DB::table('emails')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.email', compact('user', 'emails'));
    }

    public function admin_email_search(Request $request) {
        return $request;
    }

    /* Cameras */
    public function admin_filter_cameras($module_id, $iccid) {
        $user = Auth::user();
        if ($module_id && $iccid) {
            $cameras = DB::table('cameras')
                ->where(['module_id' => $module_id, 'iccid' => $iccid])
                //->orderBy('created_at', 'desc')
                //->orderBy('created_at', 'asc')
                ->paginate(20);
        } else if ($module_id) {
            $cameras = DB::table('cameras')
                ->where(['module_id' => $module_id])
                ->paginate(20);
        } else if ($iccid) {
            $cameras = DB::table('cameras')
                ->where(['iccid' => $iccid])
                ->paginate(20);
        } else {
            $cameras = DB::table('cameras')
                ->paginate(20);
        }
        return view('admin.camera', compact('user', 'cameras', 'module_id', 'iccid'));

        // $cameras = DB::table('cameras')
        //     //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
        //     //->where(['camera_id' => $camera_id])
        //     //->orderBy('created_at', 'desc')
        //     ->paginate(20);
        // return view('admin.camera', compact('user', 'cameras'));
    }

    public function admin_cameras() {
        return $this->admin_filter_cameras('', '');
    }

    public function admin_camera_search(Request $request) {
        //{"_token":"inQgWyUI4oezCh8Mi1z9du16JF4U8PAbFWUnjAbS","moduleid":null,"iccid":null}
        return $this->admin_filter_cameras($request->moduleid, $request->iccid);
    }

    public function admin_clear_search_cameras() {
        return $this->admin_filter_cameras('', '');
    }

    public function admin_cameras_operation(Request $request) {
        //{"_token":"...","settings":"settings","firmware":"firmware","delete":"delete","select":["1"]}
return $request;
    }

    /* Data Plans */
    public function admin_plans() {
        $user = Auth::user();
        $plans = DB::table('plans')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.plan', compact('user', 'plans'));
    }

    /* Firmware */
    public function admin_firmware() {
        $user = Auth::user();
        $firmwares = DB::table('firmwares')->get();
        return view('admin.firmware', compact('user', 'firmwares'));
    }

    /* SIMs */
    public function admin_sims() {
        $user = Auth::user();
        $sims = DB::table('sims')
            //->where(['user_id' => $user_id, 'camera_id' => $camera_id])
            //->where(['camera_id' => $camera_id])
            //->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.sim', compact('user', 'sims'));
    }

    public function admin_clear_search_sims() {
        return 'admin_clear_search_sims';
    }

    /* RMA */
    public function admin_rmas() {
        $user = Auth::user();
        return view('admin.rma', compact('user'));
    }

    /* Activity Monitor */
    public function admin_siteactivity() {
        $user = Auth::user();
        return view('admin.siteactivity', compact('user'));
    }

    /* API Log */
    public function admin_filter_api($imei, $iccid) {
        $user = Auth::user();
        if ($imei && $iccid) {
            $log_apis = DB::table('log_apis')
                ->where(['imei' => $imei, 'iccid' => $iccid])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else if ($imei) {
            $log_apis = DB::table('log_apis')
                ->where(['imei' => $imei])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else if ($iccid) {
            $log_apis = DB::table('log_apis')
                ->where(['iccid' => $iccid])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $log_apis = DB::table('log_apis')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        return view('admin.apilog', compact('user', 'log_apis', 'imei', 'iccid'));
    }

    public function admin_apilog() {
        return $this->admin_filter_api('', '');
    }

    public function admin_api_search(Request $request) {
        //{"_token":"inQgWyUI4oezCh8Mi1z9du16JF4U8PAbFWUnjAbS","moduleid":null,"iccid":null}
        //{"_token":"inQgWyUI4oezCh8Mi1z9du16JF4U8PAbFWUnjAbS","moduleid":"861107032685599","iccid":"89860117851014783481"}
        return $this->admin_filter_api($request->moduleid, $request->iccid);
    }

    public function admin_clear_search_apilog() {
        return $this->admin_filter_api('', '');
    }

    /* Application Log */
    public function admin_viewlog() {
        $user = Auth::user();
        return view('admin.viewlog', compact('user'));
    }

    public function download_log($camera_id, $filename) {
        /* /uploads/logs/camera_id/yyyymmdd_hhmm_LOG.TXT */
        $pathToFile = public_path().'/uploads/logs/'.$camera_id.'/'.$filename;
        return response()->download($pathToFile, $filename);
    }

    /*----------------------------------------------------------------------------------*/
    // public function email_Photo_Send($user_id, $camera, $filename) {
    //     if ($camera->noti_email == 'on') {
    //         $user = DB::table('users')->where('id', $user_id)->first();
    //         if ($user) {
    //             $to = $user->email;
    //             $subject = $camera->description;
    //             $imgPath = public_path().'/uploads/'.$camera->id.'/'.$filename;
    //             $param = array(
    //                 'user_name' => $user->name,
    //                 'camera_name' => $camera->description,
    //                 'imgPath' => $imgPath,
    //             );
    //             Mail::send('emails.photo', $param, function($message) use($to, $subject) {
    //                 $message ->to($to)->subject($subject);
    //             });
    //         }
    //     }
    // }

    // public function email_Photo_Send($user_id, $camera, $filename) {
    //    $user = DB::table('users')->where('id', $user_id)->first();
    //    if ($user) {
    //        $email = new MailController;
    //        $email->photo_Send($user, $camera, $filename);
    //    }
    // }

    public function email_Photo_Send($user_id, $camera, $filename) {
        if ($camera->noti_email == 'on') {
            $user = DB::table('users')->where('id', $user_id)->first();
            if ($user) {
                if (env('S3_ENABLE')) {
                    $imgPath = $this->s3_file_url('media/'.$filename.'_thumb.JPG');
                } else {
                    $imgPath = public_path().'/uploads/'.$camera->id.'/'.$filename;
                }

                // Mail::to($user->email)
                //     ->send(new PhotoSend($user->name, $camera->description, $imgPath));

                Mail::to($user->email) // Kevin<kevin@10ware.com>
                    ->queue(new PhotoSend($user->name, $camera->description, $imgPath));
            }
        }
    }

    /*----------------------------------------------------------------------------------*/
    public function kk_test() {
        $ret1 = Browser::isMobile();
        $ret2 = Browser::isTablet();
        $ret3 = Browser::isDesktop();
        if ($ret1) {echo 'TRUE';} else {echo 'FALSE';} echo '<br/>';
        if ($ret2) {echo 'TRUE';} else {echo 'FALSE';} echo '<br/>';
        if ($ret3) {echo 'TRUE';} else {echo 'FALSE';} echo '<br/>';
return;
        $now = Carbon::now();
        $now->addMonth(1);

$db = DB::table('orders')->find(1);
$carbon = new Carbon($db->pay_at); //
// return $db->pay_at; // 2018-12-18 11:10:50
// return $carbon; // {"date":"2018-12-18 11:10:50.000000","timezone_type":3,"timezone":"PRC"}
// return $carbon->addMonth(1); // {"date":"2019-01-18 11:10:50.000000","timezone_type":3,"timezone":"PRC"}
return $carbon->addMonth(1)->timestamp; // 1547781050
// $ret = new Carbon($db->pay_at)->addMonth(1)->timestamp; // NG
// return $ret;

// $carbon = new Carbon('first day of January 2008', 'America/Vancouver');
// $carbon = new Carbon('first day of January 2008', 'America/Vancouver');
// return $now->timestamp;

        $plan = Plan::first();
        return var_dump(Carbon::now()->lte($plan->sub_end));

        $dt = Carbon::create(2018, 12, 31, 20, 26, 11, 'America/Vancouver');
        return var_dump($now->gt($dt));

        // https://blog.csdn.net/gengfu_php/article/details/78307950
        // {"date":"2018-12-16 02:05:35.018006","timezone_type":3,"timezone":"PRC"}
        // echo Carbon::now(); // 2018-12-16 02:06:37
        // echo Carbon::now()->toDateString(); // 2018-12-16
        // echo Carbon::today()->toDateTimeString(); // 2018-12-16 00:00:00
        // echo Carbon::yesterday()->toDateTimeString(); // 2018-12-15 00:00:00
        // echo Carbon::tomorrow()->toDateTimeString(); // 2018-12-17 00:00:00
        // echo Carbon::parse('+1 months')->toDateTimeString(); //2019-01-16 02:11:20
        // echo Carbon::now()->addDays(10); //2018-12-26 02:12:21

        /*
            min –返回最小日期。
            max – 返回最大日期。
            eq – 判断两个日期是否相等。
            gt – 判断第一个日期是否比第二个日期大。
            lt – 判断第一个日期是否比第二个日期小。
            gte – 判断第一个日期是否大于等于第二个日期。
            lte – 判断第一个日期是否小于等于第二个日期。
        */
        // echo Carbon::now()->tzName; // PRC
        $now = Carbon::now();
        $dt = Carbon::create(2018, 12, 31, 20, 26, 11, 'America/Vancouver');
        return var_dump($now->gt($dt));

        // $first = Carbon::create(2012, 9, 5, 1);
        // $second = Carbon::create(2012, 9, 5, 5);
        // var_dump(Carbon::create(2012, 9, 5, 3)->between($first, $second));
        // var_dump(Carbon::create(2012, 9, 5, 5)->between($first, $second));
        // var_dump(Carbon::create(2012, 9, 5, 5)->between($first, $second, false)); // 第三个可选参数指定比较是否可以相等，默认为true
        // return var_dump($Carbon::now()->isFuture());
        // echo Carbon::now()->subDays(5)->diffForHumans(); // 5 days ago
    }

    /*----------------------------------------------------------------------------------*/
    // https://laravel-china.org/topics/2697/laravel-uses-aurora-push-basic-introduction
    // https://community.jiguang.cn/t/ios/17810/13 (iOS 自定义标题)
    /*
        // 光特亿
        appKey ="bbe4f8c3aa56d8e61d2fd2fd";
        masterSecret = "c37f1c5cc7a509af1033de9c";
    */
    public function pushMessageByPID($push_id, $title, $body, $url=null) {
        $app_key = 'bbe4f8c3aa56d8e61d2fd2fd'; // 光特亿
        $master_secret = 'c37f1c5cc7a509af1033de9c';

        $client = new JPush($app_key, $master_secret);
        $client->push()
            ->setPlatform(['ios', 'android'])
            ->options(['apns_production'=>true]) // IMPORTANT !! must for iOS
            ->addRegistrationId($push_id)
            ->setNotificationAlert($body)
            ->androidNotification($body, array(
                'title' => $title,
                'extras' => array(
                    'url' => $url,
                ),
            ))
            ->iosNotification(array(
                'title' => $title,
                'body' => $body
            ), array(
                'extras' => array(
                    'url' => $url,
                ),
            ))
            ->send();
    }
    // public function pushMessage($push_id, $title, $body, $url=null) {
    public function pushMessage($device_id, $title, $body, $url=null) {
        $app_key = 'bbe4f8c3aa56d8e61d2fd2fd'; // 光特亿
        $master_secret = 'c37f1c5cc7a509af1033de9c';

        $mobile = DB::table('mobiles')->where('device_id', $device_id)->first();
        if ($mobile) {
            $push_id = $mobile->push_id;

            $client = new JPush($app_key, $master_secret);
            $client->push()
                ->setPlatform(['ios', 'android'])
                ->options(['apns_production'=>true]) // IMPORTANT !! must for iOS
                ->addRegistrationId($push_id)
                ->setNotificationAlert($body)
                ->androidNotification($body, array(
                    'title' => $title,
                    'extras' => array(
                        'url' => $url,
                    ),
                ))
                ->iosNotification(array(
                    'title' => $title,
                    'body' => $body
                ), array(
                    'extras' => array(
                        'url' => $url,
                    ),
                ))
                ->send();
        }
    }

    public function pushHeartbeat($user_id, $camera) {
        if ($camera->noti_mobile == 'on') {
            $devices = DB::table('devices')->where('user_id', $user_id)->get();
            foreach ($devices as $device) {
                if ($device->push_hb == 'on') {
                    // $this->pushMessage($device->push_id, $camera->description, 'Heartbeat');
                    $this->pushMessage($device->device_id, $camera->description, 'Heartbeat');
                }
            }
        }
    }

    public function pushDownloadSettings($user_id, $camera) {
        if ($camera->noti_mobile == 'on') {
            $devices = DB::table('devices')->where('user_id', $user_id)->get();
            foreach ($devices as $device) {
                // if ($device->push_notify == 'on') {
                    // $this->pushMessage($device->push_id, $camera->description, 'Download Settings');
                    $this->pushMessage($device->device_id, $camera->description, 'Download Settings');
                // }
            }
        }
    }

    public function pushNewFile($user_id, $camera, $body) {
        if ($camera->noti_mobile == 'on') {
            $devices = DB::table('devices')->where('user_id', $user_id)->get();
            foreach ($devices as $device) {
                if ($device->push_upload == 'on') {
                    // $this->pushMessage($device->push_id, $camera->description, $body);
                    $this->pushMessage($device->device_id, $camera->description, $body);
                }
            }
        }
    }

    public function push_test() {
        $app_key = 'bbe4f8c3aa56d8e61d2fd2fd'; // 光特亿
        $master_secret = 'c37f1c5cc7a509af1033de9c';
        $url = 'http://portal.kmcampro.com/uploads/7/1547295213_xLuPXhn5fe.JPG';
        // $url = 'http://www.caperplus.com';

        $client = new JPush($app_key, $master_secret);

        $ret =
        $client->push()
            // ->setPlatform('all')
            ->setPlatform(['ios', 'android'])
            ->options(['apns_production'=>true]) // IMPORTANT !! must for iOS
            // ->addAllAudience()
            // ->addAlias('alias')
            // ->addTag(array('tag1', 'tag2'))
            ->addRegistrationId('190e35f7e005b796d3b') // Android
            ->addRegistrationId('13165ffa4e282202377') // iOS
            ->setNotificationAlert('Hello')
            ->androidNotification('body', array(
                'title' => 'title',
                'extras' => array(
                    'url' => $url,
                ),
            ))
            ->iosNotification(array(
                'title' => 'title',
                // 'subtitle' => 'subtitle',
                'body' => 'body'
            ), array(
                // 'sound' => 'sound.caf',
                // // 'badge' => '+1',
                // // 'content-available' => true,
                // // 'mutable-content' => true,
                // 'category' => 'jiguang',
                // 'title' => 'Cam #1', // NG
                'extras' => array(
                    // 'title' => 'Cam #1',
                    'url' => $url,
                ),
            ))
            ->send();
        return dd($ret);
    }

    public function push_test2() {
        $this->pushMessageByPID('190e35f7e005b796d3b', 'Cam#1', 'Heartbeat');
        $this->pushMessageByPID('13165ffa4e282202377', 'Cam#1', 'Heartbeat');
return 'OK';

        // Github: https://github.com/jpush/jpush-api-php-client
        // 极光文档：http://docs.jiguang.cn/server/server_overview/
        $app_key = 'bbe4f8c3aa56d8e61d2fd2fd'; // 光特亿
        $master_secret = 'c37f1c5cc7a509af1033de9c';

        // $client = new JPush($app_key, $master_secret);
        $client = new JPush($app_key, $master_secret, null);
        $push = $client->push();
        $push->options(['apns_production'=>true]); // IMPORTANT !! must for iOS (true 表示推送生产环境, false 表示要推送开发环境)
        // $push->setPlatform('all');
        // $push->setPlatform('ios', 'android');
        $push->setPlatform(['ios', 'android']);
        $push->addRegistrationId('190e35f7e005b796d3b'); // Android
        $push->addRegistrationId('13165ffa4e282202377'); // iOS
        $push->setNotificationAlert('ALERT'); // 细分可以为 iOS Notification 、 Android Notification
        $push->addAndroidNotification('alert', 'title');
        $push->message('Hello JPush');

        $ret = $push->send();
        return dd($ret);
    }
}