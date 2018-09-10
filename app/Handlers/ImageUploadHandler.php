<?php

namespace App\Handlers;

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
        $ret['clientName'] = $file->getClientOriginalName();     // PICT0001.JPG
        $ret['extension'] = $file->getClientOriginalExtension(); // JPG
        $ret['tmpName'] = $file->getFileName();                  // php5qf3fj
        $ret['realPath'] = $file->getRealPath();                 // /tmp/php5qf3fj
        $ret['mimeTye'] = $file->getMimeType();                  // image/jpeg

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        //$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $clientName = $file->getClientOriginalName();
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
        //$filename = md5(date('ymdhis').$clientName).".".$extension; // 0be0fa46c2062453c8e0a375fe68f5fd.JPG
        //$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        $filename = time() . '_' . str_random(10) . '.' . $extension;
        $ret['filename'] = $filename;

        // "path": "/home/vagrant/Code/htc/public/uploads/images/1536563485_lFE1T17eap.JPG",
        $path = $file->move($upload_path, $filename);
        $ret['path'] = "$path";

        $ret['result'] = 0;

        return $ret;
    }
}