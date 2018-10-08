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

    public function save_file($file)
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

    public function save_file_ex($camera_id, $file)
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

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        //$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $OriginalName = $file->getClientOriginalName();
        $extension = strtoupper($file->getClientOriginalExtension()); // JPG

        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        //$folder_name = "uploads/images/$folder/" . date("Ym/d", time());
        // $folder_name = "uploads/images";
        $folder_name = "uploads/".$camera_id;
        //$folder_name = "storage/".$camera_id;

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        // 值如：/home/vagrant/Code/larabbs/public + / + uploads/images/
        $upload_path = public_path() . '/' . $folder_name;

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        //$filename = md5(date('ymdhis').$OriginalName).".".$extension; // 0be0fa46c2062453c8e0a375fe68f5fd.JPG
        //$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        $filename = time() . '_' . str_random(10) . '.' . $extension;

        /* /home/vagrant/Code/htc/public/uploads/1/1538422610_nHRsYCi1YG.JPG" */
        $path = $file->move($upload_path, $filename);

        $ret['OriginalName'] = $file->getClientOriginalName();  // "PICT0001.JPG"
        $ret['filename'] = $filename;                           // "1538422239_Cf7PQK04w4.JPG"
        $ret['filesize'] = $file->getClientSize();              // 7032
        //$ret['path'] = "$path";
        $ret['err'] = 0;
        return $ret;
    }

    public function save_buffer($camera_id, $file, $blockid, $blocknbr) {
        //$folder_name = public_path() . '/uploads/block/' . $camera_id .'/'. $blockid;
        $folder_name = public_path().'/uploads/block/'.$blockid;
        //$filename = $blocknbr . '.BIN';
        $filename = sprintf("%05u.BIN", $blocknbr);
        $path = $file->move($folder_name, $filename);

        //$ret['OriginalName'] = $file->getClientOriginalName();  // "PICT0001.JPG"
        //$ret['filename'] = $filename;
        //$ret['filesize'] = $file->getClientSize();
        //$ret['folder_name'] = "$folder_name";
        $ret['path'] = "$path";
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

        $folder_name = public_path().'/uploads/block/'.$blockid;
        if (!file_exists($folder_name)) {
            $ret['err'] = 1; //$err;
            return $ret;
        }

        $tagert_name =  $folder_name .'/'. $filename;
        if (file_exists($tagert_name)) {
            unlink($tagert_name);
        }

        $files = $this->dirTree($folder_name);
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
            $to_file = public_path().'/uploads/'.$camera_id.'/'.$filename;
            $ret = copy($tagert_name, $to_file);
            if($ret == true) {
                $err = 0;
            } else {
                $err = 3/*2*/;
            }
        } else {
            $err = 2/*1*/;
        }

        if ($err == 0) {
            foreach ($files as $file) {
                unlink($file);
            }
            unlink($tagert_name);
            rmdir($folder_name);
        }

        $ret = [];
        $ret['path'] = "$tagert_name";
        $ret['to_file'] = "$to_file";
        $ret['CRC32'] = $crc32_check;
        $ret['err'] = $err;
        return $ret;
    }

}