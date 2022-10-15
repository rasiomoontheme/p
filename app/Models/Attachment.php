<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = ['id'];

    const FILE_TYPE_PIC = "pic";
    const FILE_TYPE_FILE = "file";
    const FILE_TYPE_VIDEO = "video";

    public static $fileTypeMap = [
        self::FILE_TYPE_PIC => '图片',
        self::FILE_TYPE_FILE => '文件',
        self::FILE_TYPE_VIDEO => '视频',
    ];

    public $appends = ["file_url","relative_url"];

    public function getFileUrlAttribute()
    {
        $url = "{$this->domain}{$this->link_path}" . DIRECTORY_SEPARATOR . "{$this->storage_name}";
        return str_replace('\\', "/", $url);
    }

    public function getRelativeUrlAttribute(){
        return "{$this->link_path}" . DIRECTORY_SEPARATOR . "{$this->storage_name}";
    }

    public function getFileTypeTextAttribute()
    {
        return isset_and_not_empty(self::$fileTypeMap, $this->attributes['file_type'], $this->attributes['file_type']);
    }

    public function owner()
    {
        return $this->belongsTo($this->model_type, 'model_id');
    }

    public static $list_field = [
        'owner' => 'Được tải lên bởi',
        'ip' => 'IP của người tải lên',
        'original_name' => 'Tên khai sinh',
        'mime_type' => 'Loại MIME',
        'file_type' => 'loại tệp',
        'size' => 'Kích thước / kb',
        'category' => 'Phân loại tệp',
        'domain' => 'Tải lên tên miền',
        'storage_path' => 'Địa chỉ thư mục lưu trữ tương đối của tệp đính kèm',
        'link_path' => 'Tệp đính kèm địa chỉ thư mục gốc của trang web',
        'storage_name' => 'Tên lưu trữ',
        'remark' => 'Nhận xét',
        'created_at' => 'Tạo mới lúc',
        'updated_at' => 'Cập nhật lúc'
    ];
}
