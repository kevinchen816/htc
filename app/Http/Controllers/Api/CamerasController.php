<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Camera;
use App\Models\Photo;
use App\Handlers\ImageUploadHandler;

class CamerasController extends Controller
{
    public function show() {
        //return 'Hello';

        // //$camera = DB::table('cameras')->first();
        // $camera = DB::table('cameras')->find(1);
        // //return $camera; // NG
        // return compact('camera'); //OK

        // (2)
        $id = 1;
        $camera = Camera::findOrFail($id);

        $photos = $camera->photos()
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        //return $camera; // OK
        //return compact('photos'); // OK
        return view('camera.show3', compact('camera', 'photos')); // OK

        // $camera = DB::table('cameras')
        //                 ->where('module_id', $request->module_id)
        //                 ->first();
        // return $camera;

           // $camera = DB::table('cameras')
           //                 ->first();
         // return $camera->id;

//$photos = $camera->photos();

//$photos = $camera->photos()->first();
        // $photos = $camera->photos()
        //                  ->orderBy('created_at', 'desc')
        //                  ->paginate(30);
        //return $photos->filename;
  //      return view('camera.show', compact('camera', 'photos'));
        //return view('camera.show', compact('photos'));
        return view('camera.show', compact('camera'));
    }

    public function show2(Camera $camera) {
        return $camera; // OK
        //return $camera->id; // OK
        //return $camera->first()->id; // OK
    }

    //public function report(Request $request) {
    public function report(Request $request, Camera $camera) {
        //return $request;

//         $cameras = DB::table('cameras')->where('module_id', '861107032685597')->get();
//         //$cameras = DB::table('cameras')->where('model_id', 'lookout-na')->get();
//         return $cameras->all();

// //        return $camera->count();
//         return $camera->all();

// //        $cameras = DB::table('cameras')->get();
//         return $cameras;


        //return $this->response->array(['ResultCode' => 0]); // NG
        //return $this->response()->array(['ResultCode' => 0]); // NG
        //return response('hello');
        //return response()->array(['ResultCode' => 0]);

        $camera->fill($request->all());
        $camera->save();

        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = 0;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;
    }

    /*
    $request =
    {
        "iccid": "89860117851014783481",
        "module_id": "861107032685597",
        "model_id": "lookout-na",
        "FileName": "PICT0001.JPG",
        "upload_resolution": "1",
        "Source": "setup",
        "DateTime": "20180910123456",
        "Image": []
    }
    */
    //public function uploadthumb(Request $request, ImageUploadHandler $uploader) {
    public function uploadthumb(Request $request, Photo $photo, ImageUploadHandler $uploader) {
    //public function uploadthumb(Request $request, Camera $camera, Photo $photo, ImageUploadHandler $uploader) {

        //return $request;
        //$camera = $camera->find(1);
        //return $camera;

        //$cameras = $camera->where('module_id', '861107032685597')->get();
        //$camera = DB::table('cameras')->where('model_id', 'lookout-na')->get();
        //$cameras = DB::table('cameras')->where('module_id', '861107032685597')->get();
        //$camera = DB::table('cameras')->where('module_id', $request->module_id)->get();
        $camera = DB::table('cameras')
                        ->where('module_id', $request->module_id)
                        ->first();
        if ($camera) {
            $file = $request->Image;
            if ($file && $file->isValid()) {
                $ret = $uploader->save_file($file);
                /*
                $ret =
                {
                "clientName": "PICT0001.JPG",
                "extension": "JPG",
                "tmpName": "phpYfxl7a",
                "realPath": "/tmp/phpYfxl7a",
                "mimeTye": "image/jpeg",
                "filename": "1536576315_VWraupBCZT.JPG",
                "result": 0
                }
                */
                $result_code = $ret['result'];
                if ($result_code == 0) {
                    //$photo = DB::table('photos')->get(); // NG
                    $photo->camera_id = $camera->id; // TODO
                    $photo->filename = $request->FileName;
                    $photo->upload_resolution = $request->upload_resolution;
                    $photo->source = $request->Source;
                    $photo->datetime = $request->DateTime;
                    $photo->filepath = $ret['filename']; //$request->FileName;
                    $photo->save();
                    //return $photo;
                }

            } else {
                $result_code = 901;
            }

        } else {
            $result_code = 900;
        }
        date_default_timezone_set("Asia/Shanghai");
        $result['ResultCode'] = $result_code;
        $result['DateTimeStamp'] = date('Y-m-d H:i:s');
        return $result;
    }
}
