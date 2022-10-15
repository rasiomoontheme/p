<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\FileUploadHandler;
use App\Models\Attachment;
use Exception;
use Illuminate\Support\Arr;

class UploadController extends BaseController
{
    public function __construct()
    {
        //if(!request()->user()) throw new InvalidRequestException("请先登录");
        $this->middleware(['auth:web','rbac.admin']);
    }

    public function commonUpload($file_type, $category, Request $request, FileUploadHandler $fileuploadHandler)
    {

        $this->validateRequest($request->all(), ['file' => 'required|file']);

        $file = $request->file('file');
        $data = $request->only("file", "file_type");

        // 文件必须带有文件类型
        $file_name = explode('.', $file->getClientOriginalName());
        if (count($file_name) < 2) return $this->failed(trans('res.upload.file_type_error'));

        $result = [];

        switch ($file_type) {
            case Attachment::FILE_TYPE_PIC:
                $result = $fileuploadHandler->uploadImage($file, $category, $request->get("max_width", false));
                break;

            case Attachment::FILE_TYPE_FILE:
                $result = $fileuploadHandler->uploadFile($file, $category);
                break;

            case Attachment::FILE_TYPE_VIDEO:
                break;

            default:
                return $this->failed(trans('res.upload.file_type_error'));
                break;
        }

        //writelog('result:'.json_encode($result));

        if ($result['status'] === true) {
            // 配合 tinymce 编辑器
            // $result['data']['location'] = $result['data']['file_url'];
            // return $this->success($result['data']);

            // 只返回 图片地址
            return $this->success(Arr::only($result['data'],['file_url']),trans('res.upload.file_upload_success'));
        } else {
            return $this->failed($result['message']);
        }
    }

    public function commonDelete(Request $request, FileUploadHandler $fileuploadHandler)
    {
        $file_url = $request->get('file_url');

        if(!\Str::startsWith($file_url,'http')) return $this->success([], trans('res.base.delete_success'));

        $this->validateRequest($request->all(), ['file_url' => 'required|url']);

        $file_name = basename($file_url);

        try {
            $attach = Attachment::query()->where('storage_name', $file_name)->first();
            if ($attach) {
                $fileuploadHandler->deleteByStoragePath($attach->storage_path);
                $attach->delete();
            }
        } catch (Exception $e) {
            return $this->failed($e->getMessage());
        }

        return $this->success([], trans('res.base.delete_success'));
    }
}
