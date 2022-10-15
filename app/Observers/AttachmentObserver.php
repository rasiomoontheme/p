<?php

namespace App\Observers;

use App\Handlers\FileUploadHandler;
use App\Models\Attachment;

class AttachmentObserver
{
    // 在数据删除时，一起删除文件
    public function deleting(Attachment $attachment){
        app(FileUploadHandler::class)->deleteByStoragePath($attachment->storage_path);
    }
}
