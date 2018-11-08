<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Storage;

/* reference vendor/symfony/http-foundation/File/UploadedFile.php */

class ImageUploadHandler
{
    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }

    public function save_file2($file)
    {
        $ret['OriginalName'] = $file->getClientOriginalName();     // PICT0001.JPG
        $ret['extension'] = $file->getClientOriginalExtension(); // JPG
        $ret['tmpName'] = $file->getFileName();                  // php5qf3fj
        $ret['realPath'] = $file->getRealPath();                 // /tmp/php5qf3fj
        $ret['mimeTye'] = $file->getMimeType();                  // image/jpeg

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        //$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $OriginalName = $file->getClientOriginalName();
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG

        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        //$folder_name = "uploads/images/$folder/" . date("Ym/d", time());
        $folder_name = "uploads/images";

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        // 值如：/home/vagrant/Code/larabbs/public + / + uploads/images/
        $upload_path = public_path() . '/' . $folder_name;

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        //$filename = md5(date('ymdhis').$OriginalName).".".$extension; // 0be0fa46c2062453c8e0a375fe68f5fd.JPG
        //$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        $filename = time() . '_' . str_random(10) . '.' . $extension;
        $ret['filename'] = $filename;

        // "path": "/home/vagrant/Code/htc/public/uploads/images/1536563485_lFE1T17eap.JPG",
        $path = $file->move($upload_path, $filename);
        $ret['path'] = "$path";

        $ret['result'] = 0;

        return $ret;
    }

    public function save_file($camera_id, $file)
    {
        //$ret['OriginalName'] = $file->getClientOriginalName();        // PICT0001.JPG
        //$ret['extension'] = $file->getClientOriginalExtension();    // JPG
        //$ret['tmpName'] = $file->getFileName();                   // php5qf3fj
        //$ret['realPath'] = $file->getRealPath();                  // /tmp/php5qf3fj
        //$ret['mimeTye'] = $file->getMimeType();                     // image/jpeg
        //$ret['client_ext'] = $file->guessClientExtension();       // jpeg

        //$ret['filesize'] = $file->getClientSize();                  // 7032
        //$ret['max_size'] = $file->getMaxFilesize();               // 104857600

        //$ret['err'] = $file->getError();
        //$ret['err_msg'] = $file->getErrorMessage();

        //$OriginalName = $file->getClientOriginalName();
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG,MP4

        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        //$path_upload = "uploads/images/$folder/".date("Ym/d", time());
        //$savename = md5(date('ymdhis').$OriginalName).".".$extension; // 0be0fa46c2062453c8e0a375fe68f5fd.JPG
        $path_upload = public_path().'/uploads/'.$camera_id;
        $savename = time() . '_' . str_random(10) . '.' . $extension;
        $savepath = $file->move($path_upload, $savename);

        $ret['imagename'] = $file->getClientOriginalName(); // PICT0001.JPG
        $ret['savename'] = $savename;                       // 1538422239_Cf7PQK04w4.JPG
        $ret['savepath'] = "$savepath";
        $ret['extension'] = "$extension";
        $ret['filesize'] = $file->getClientSize();          // 7032
        $ret['err'] = 0;
        return $ret;
    }

    public function save_buffer($camera_id, $file, $blockid, $blocknbr) {
        $ClientOriginalName = $file->getClientOriginalName();

        $path_upload = public_path().'/uploads/block/'.$blockid;
        $savename = sprintf("%05u.BIN", $blocknbr);
        $savepath = $file->move($path_upload, $savename);

        if ($blocknbr == 1) {
            $filename = $path_upload.'/filename.txt';
            file_put_contents($filename, $ClientOriginalName);
        }

        $ret['imagename'] = $ClientOriginalName;
        $ret['savename'] = $savename;
        $ret['savepath'] = $savepath;
        //$ret['filesize'] = $file->getClientSize();
        $ret['err'] = 0;
        return $ret;
    }

    public function dirTree($path) {
        if(!is_dir($path)) return [];

        $files = [];
        $dir = opendir($path);
        while($file = readdir($dir)) {
            if($file == '.' || $file == '..') continue;
            //$new_path = trim($path, '/').'/'.trim($file, '/');
            $new_path = $path.'/'.trim($file, '/');
            //$new_path = trim($file, '/');
            $files[] = $new_path;
            /*
            if (is_dir($new_path))  {
                $files = array_merge($files, $this->ergodicDir2($new_path));
            }
            */
        }
        closedir($dir);
        return $files;
    }

    public function merge($camera_id, $filename, $blockid, $crc32) {
        $err = 0;
        $to_file = '';
        //return storage_path();
        //return Storage::files('.');
        //return Storage::allFiles('.');

        $path_block = public_path().'/uploads/block/'.$blockid;
        if (!file_exists($path_block)) {
            $ret['err'] = 1;
            return $ret;
        }

        $temp = $path_block.'/filename.txt';
        $ClientOriginalName = file_get_contents($temp);
        unlink($temp);

        $tagert_name =  $path_block .'/'. $ClientOriginalName;
        if (file_exists($tagert_name)) {
            unlink($tagert_name);
        }

        $files = $this->dirTree($path_block);
        sort($files);

        $fp = fopen($tagert_name, 'w+b');
        foreach ($files as $file) {
            $handle = fopen($file, "rb");
            fwrite($fp, fread($handle, filesize($file)));
            fclose($handle);
            unset($handle);
            //unlink($file);
        }
        fclose($fp);

        /* https://www.cnblogs.com/mslagee/p/6223140.html */
        $crc32_check = hexdec(hash_file('crc32b', $tagert_name));
        if ($crc32_check == $crc32) {
            ////$extension = strtoupper($file->getClientOriginalExtension()); // JPG
            //$extension = 'JPG';
            //$savename = time() . '_' . str_random(10) . '.' . $extension;

            $savename = time().'_'.$ClientOriginalName;
            $to_file = public_path().'/uploads/'.$camera_id.'/'.$savename;
            $ret = copy($tagert_name, $to_file);
            if($ret == true) {
                $err = 0;
            } else {
                $err = 3/*2*/;
            }
        } else {
            $err = 2/*1*/;
        }

        $ret = [];
        $ret['err'] = $err;
        $ret['CRC32'] = $crc32_check;
        if ($err == 0) {
            foreach ($files as $file) {
                unlink($file);
            }
            unlink($tagert_name);
            rmdir($path_block);

            //$ret['path'] = "$tagert_name";
            //$ret['to_file'] = "$to_file";
//            $ret['filename'] = $filename;   // 1538422239_Cf7PQK04w4.JPG

            $ret['imagename'] = $ClientOriginalName;
            $ret['savename'] = $savename;
            //$ret['savepath'] = $savepath;
            $ret['filesize'] = filesize($to_file);
        }
        return $ret;
    }

    public function save_log($camera_id, $file)
    //public function save_log($camera, $file)
    {
        $OriginalName = $file->getClientOriginalName();
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG,MP4

        $camera_id = $camera->id;
        $path_upload = public_path().'/uploads/logs/'.$camera_id;
        //$savename = time() . '_' . str_random(10) . '.' . $extension;
        $savename = date('ymdhis').'_'.$OriginalName;

/*
        $tz = date_default_timezone_get();
        date_default_timezone_set($camera->timezone);
        $ret = date('Y-m-d H:i:s');
        $savename = date('Ymd').'_'.date('hi').'_'.$OriginalName;
        date_default_timezone_set($tz);
*/

        $savepath = $file->move($path_upload, $savename);

        $ret['imagename'] = $file->getClientOriginalName();
        $ret['savename'] = $savename;
        $ret['savepath'] = "$savepath";
        $ret['extension'] = "$extension";
        $ret['filesize'] = $file->getClientSize();
        $ret['err'] = 0;
        return $ret;
    }

}