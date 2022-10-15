<?php

namespace App\Handlers;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Models\Attachment;
use App\Traits\ApiResponseTraits;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploadHandler{

    protected $status = true;
    protected $message = '附件上传成功';
    protected $data = [];

    // 上传文件的文件夹
    protected $base_upload_folder = 'uploads';
    protected $base_file_up_dir = 'files';
    protected $attachment;

    protected $img_allowed_ext = ['png','jpg','gif','jpeg'];
    protected $img_max_size = 10 * 1024 * 1024;

    protected $file_max_size = 10 * 1024 * 1024;
    protected $file_allowed_ext = ['mp3'];

    protected $model;

    protected $disk = "public";
    protected $disk_config = [];

    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
        $this->model = request()->user();
        $this->disk_config = config("filesystems.disks.".$this->disk);
    }

    public function getStorage(){
        return Storage::disk($this->disk);
    }

    /**
     * 图片上传
     *
     * @param [type] $file  $request中的file
     * @param string $category 文件归类
     * @param boolean $max_width 是否设置图片的最大宽度
     * @return 统一返回指定格式的数组
     * @since
     * @date 2020-03-01
     */
    public function uploadImage($file,$category = "tmp",$max_width = false){

        if(!$file) throw new InvalidRequestException(trans('res.upload.image_file_required'));

        // getClientSize 弃用
        if($file->getSize() > $this->img_max_size){
            throw new InvalidRequestException(trans('res.upload.file_size_error'));
        }

        // 判断文件的后缀是否合法
        $extension = strtolower($file->getClientOriginalExtension())?:'png';

        //如果上传的不是图片，则终止
        if(! in_array($extension,$this->img_allowed_ext)){
            throw new InvalidRequestException(trans('res.upload.image_ext_required'));
        }

        // 类似:"uploads/temp/202003/01"
        $relative_folder_path = $this->getRelativeFolderPath($category);

        $filename = $this->generateFileName($category, $extension);

        try{
            // 先将图片进行保存,
            // putFileAs方法会返回文件路径，以便你可以将文件路径（包括生成的文件名）存储在数据库中
            // 注意，这里如果不加上 disk("public")，文件的存储路径是"storage\app\uploads\avatar\202003\02\avatar_1583123977_OAOw5iGp0p.png"
            // 加上以后，存储路径是"storage\app\public\uploads\avatar\202003\02\avatar_1583123977_OAOw5iGp0p.png"
            //$relative_file_path = Storage::disk("public")->putFileAs($relative_folder_path,$file,$filename);
            $relative_file_path = $this->getStorage()->putFileAs($relative_folder_path,$file,$filename);

            // 将attachment的数据保存
            $insert_data = $this->getAttachmentInsertData($file,"pic",$category,$relative_file_path);

            //writelog("insert_data:".json_encode($insert_data));

            // 判断是否需要剪裁图片
            $model_data = Attachment::create($insert_data);

            if($max_width && $extension != "gif"){
                $this->reduceSize($insert_data['storage_path'],$max_width);
            }

            $this->data = $model_data->toArray();
            return $this->formatReturn();
        }catch(Exception $e){
            throw new InvalidRequestException($e->getMessage());
        }
    }

    public function uploadFile($file,$category = "tmp"){
        if(!$file) throw new InvalidRequestException(trans('res.upload.file_required'));

        // getClientSize 弃用
        if($file->getSize() > $this->file_max_size){
            throw new InvalidRequestException(trans('res.upload.file_size_error'));
        }

        // 判断文件的后缀是否合法
        $extension = strtolower($file->getClientOriginalExtension());

        //如果上传的不是图片，则终止
        if(! in_array($extension,$this->file_allowed_ext)){
            throw new InvalidRequestException(trans('res.upload.file_ext_error'));
        }

        // 类似:"uploads/temp/202003/01"
        $relative_folder_path = $this->getRelativeFolderPath($category);

        $filename = $this->generateFileName($category, $extension);

        try{
            $relative_file_path = $this->getStorage()->putFileAs($relative_folder_path,$file,$filename);
            // 将attachment的数据保存
            $insert_data = $this->getAttachmentInsertData($file,"pic",$category,$relative_file_path);
            // 判断是否需要剪裁图片
            $model_data = Attachment::create($insert_data);

            $this->data = $model_data->toArray();

            return $this->formatReturn();
        }catch (Exception $e){
            throw new InvalidRequestException($e->getMessage());
        }
    }

    /**
     * 获取上传文件的相对目录
     *  
     * @param 文件归类 $category
     * @return 返回类似  "uploads/temp/202003/01"
     * app(App\Handlers\FileUploadHandler::class)->getRelativeFolderPath("temp")
     */
    public function getRelativeFolderPath($category){
        return $this->base_upload_folder.DIRECTORY_SEPARATOR.$category.DIRECTORY_SEPARATOR.date('Ym/d',time());
    }
    
    /** 
     * 根据文件归类和文件类型生成文件名
     *
     * @param string $category
     * @param string $extension 扩展名
     * @return 生成类似文件名："temp_1583065005_RjOgwp38Og.png"
     * @Description void
     * @exam app(App\Handlers\FileUploadHandler::class)->generateFileName("temp","png");
     */
    public function generateFileName($category,$extension){
        return $category.'_'.time().'_'.Str::random(10).'.'.$extension;
    }

    /**
     * Undocumented function
     *
     * @param [type] $file $request 中的原始文件，用来获取mime和原始名称
     * @param [type] $file_type 文件类型，数据库中字段，枚举
     * @param [type] $category 文件归类
     * @param [type] $relative_file_path  Storage::putFileAs返回的文件路径（包括文件名）
     * @return void
     */
    public function getAttachmentInsertData($file,$file_type,$category,$relative_file_path){
        // $public_disk = config("filesystems.disks.public");
        
        return [
            "model_type" => \get_class($this->model),
            "model_id" => $this->model->id,
            "ip" => get_client_ip(),
            "file_type" => $file_type,
            "original_name" => $file->getClientOriginalName(),
            "mime_type" => $file->getClientMimeType(),
            "size" => round($file->getSize() / 1000, 2),
            'category' => $category,
            'domain' => config('app.url'),

            // domain+link_path = 资源URL
            // 类似：/storage/log.txt
            'link_path' => pathinfo(Storage::url($relative_file_path),PATHINFO_DIRNAME),
            'storage_name' => basename($relative_file_path),
            
            // 这里的storage_path 是文件的绝对地址
            //"storage_path" => $public_disk['root'].DIRECTORY_SEPARATOR.$relative_file_path,
            "storage_path" => $this->disk_config['root'].DIRECTORY_SEPARATOR.$relative_file_path,
            //"url" => config('app.url'). Storage::url($relative_file_path)
        ];
    }

    /**
     * 图片剪裁
     *
     * @param [type] $file_path 文件的绝对地址
     * @param [type] $max_width 图片的最大宽度
     * @return void
     */
    public function reduceSize($file_path,$max_width){
        //先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小的调整
        $image->resize($max_width,null,function($constraint){

            // 设定的宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            //防止截图时尺寸变大
            $constraint->upsize();
        });

        // 对修改的后的图片进行保存
        $image->save();
    }

    /***
     * 统一Handler的数据返回格式
     */
    public function formatReturn(){
        return ['status' => $this->status, 'data' => $this->data, 'message' => $this->message];
    }

    // 根据 storage_path 删除文件
    public function deleteByStoragePath($storage_path){
        return $this->deleteFile($this->getRelativeFilePath($storage_path));
    }

    public function getAttachmentByUrl($url){
        return Attachment::query()->where('storage_name', basename($url))->first();
    }

    // 获取图片尺寸
    public function getImageSize($absolutPath){
        $info = getimagesize($absolutPath);
        if($info) return "{$info[0]}*{$info[1]}";
        else return false;
    }

    public function getImageSizeByUrl($url){
        try{
            $attachment = $this->getAttachmentByUrl($url);
            if($attachment){
                return $this->getImageSize($attachment->storage_path);
            }
        }catch(Exception $e){
            throw new InternalException(trans('res.upload.image_size_get_error'));
        }
    }

    /**
     * 删除storage中的文件
     *
     * @param 文件相对路径 $file 相对于目录”storage\app\public“的路径
     * @return void
     */
    public function deleteFile($file){
        try{
            if($this->getStorage()->exists($file)){
                $result = $this->getStorage()->delete($file);
            }
        }catch(Exception $e){
            throw new InternalException($file.trans('res.upload.file_delete_error'));
        }
    }

    // 根据文件的绝对路径获取文件的相对路径，即Attachments表中的storage_path字段
    // app(App\Handlers\FileUploadHandler::class)->getRelativeFilePath("temp")
    public function getRelativeFilePath($absolutPath){      
        return Str::replaceFirst($this->disk_config['root'],"",$absolutPath);
    }
}