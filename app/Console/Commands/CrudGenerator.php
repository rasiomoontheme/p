<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

use Illuminate\Console\Command;

/**
 * 替换变量说明
 *
 * $model               模型名称                user
 * $model_plural        模型名称复数              users
 * $model_uc_first      模型名称首字母大写       User
 * $model_plural_uc_first 模型名称复数首字母大写    Users
 * $model_chinese_name  模型中文名               用户
 */
class CrudGenerator extends Command
{
    /**
     * 调用方式:php artisan crud:generator activity 活动 --type=controller
     * The name and signature of the console command.
     *  model 是小写单数
     * @var string
     */
    protected $signature = 'crud:generator {model : model name} {chineseName?} {--type=model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate model related files, such as model controller, view and so on';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $model, $modelChineseName, $modelPlural, $modelUCFirst, $modelPluralUCFirst, $modelPluralLower, $modelLower;

    protected $Model, $list_field;

    protected $stubArray = [
        '{{-$model-}}',
        '{{-$model_chinese_name-}}',
        '{{-$model_plural-}}',
        '{{-$model_uc_first-}}',
        '{{-$model_plural_uc_first-}}',
        '{{-$model_plural_lower-}}',
        '{{-$model_lower-}}'
    ];

    protected $replaceArray;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->model = trim($this->argument('model'));
        $this->model = Str::camel($this->model);
        $this->modelChineseName = \mb_convert_encoding(trim($this->argument('chineseName')), 'utf-8', ['utf-8', 'gbk']);
        $this->modelPlural = Str::plural($this->model);
        $this->modelUCFirst = Str::ucfirst($this->model);
        $this->modelPluralUCFirst = Str::ucfirst($this->modelPlural);

        // 用于路由
        $this->modelPluralLower = Str::lower($this->modelPlural);
        // 用于路由参数
        $this->modelLower = Str::lower($this->model);

        // 获取 resources 文件夹目录下面的 stud文件夹
        //$template = file_get_contents(resource_path() . '/stub/');
        $this->replaceArray = [
            $this->model,
            $this->modelChineseName,
            $this->modelPlural,
            $this->modelUCFirst,
            $this->modelPluralUCFirst,
            $this->modelPluralLower,
            $this->modelLower
        ];
        // 获取目录下的文件

        // 使用时，先创建Model

        switch ($this->option('type')) {
            case "model":
                $this->model($this->modelUCFirst);
                break;
            case "controller":
                $this->Model = $this->getExistModelName();
                $this->list_field = $this->Model::$list_field;
                $this->controller($this->modelPluralUCFirst);
                break;
            case "view":
                $this->Model = $this->getExistModelName();
                $this->list_field = $this->Model::$list_field;
                $this->generateViewFile();
                break;
        }

        /*
        if ($this->option('view')) {
            $this->generateViewFile();
            //$this->info(json_encode($this->Model::$list_field,JSON_UNESCAPED_UNICODE));
        } else {
            // 创建脚手架之前，判断是否存在文件
            // $this->model($this->modelUCFirst);
            $this->controller($this->modelPluralUCFirst);
        }
        */


        $this->info('success');
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function index()
    {
        $modelTemplate = str_replace(
            $this->stubArray,
            $this->replaceArray,
            $this->getStub('Index')
        );

        // 文件名后面加上1，表示需要用户进行确认
        $path = resource_path("/views/admin/{$this->model}/index.blade.php");
        $this->generateFileTemplate($path, $modelTemplate);
    }

    protected function create_and_edit()
    {
        array_push($this->stubArray, '{{-$code-}}', '{{-$editor-}}', '{{-$script-}}');
        array_push($this->replaceArray, $this->getFormCode($this->list_field), $this->getEditorCode($this->list_field), $this->getScriptCode($this->list_field));

        $modelTemplate = str_replace(
            $this->stubArray,
            $this->replaceArray,
            $this->getStub('create_and_edit')
        );

        $path = resource_path("/views/admin/{$this->model}/create_and_edit.blade.php");
        $this->generateFileTemplate($path, $modelTemplate);
    }

    protected function getFormCode($list_field)
    {
        $code = "";

        foreach ($list_field as $key => $value) {
            switch ($value['type']) {
                case "datetime":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "<input type=\"text\" class=\"form-control\" name=\"{$key}\" placeholder=\"请输入{$value['name']}\" value=\"{{ \$isUpdated?\$model->{$key}:\"\" }}\" @if(!\$isUpdated) required @endif>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
                    break;

                case "select":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "<select name=\"{$key}\" class=\"form-control js_select2\">" . PHP_EOL .
                        "<option value=\"\">--请选择--</option>" . PHP_EOL .
                        "@foreach(config('{$value["data"]}') as \$key =>\$value)" . PHP_EOL .
                        "<option value=\"{{ \$key }}\" @if(\$isUpdated && \$model->{$key} == \$key) selected" . PHP_EOL .
                        "@endif>{{ \$value }}</option>" . PHP_EOL .
                        "@endforeach" . PHP_EOL .
                        "</select>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
                    break;

                case "radio":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "@foreach(config('{$value['data']}') as \$k => \$v)" . PHP_EOL .
                        "<label class=\"lyear-radio radio-inline radio-primary\"><input type=\"radio\" value=\"{{ \$k }}\" name=\"{$key}\" @if(\$isUpdated && \$model->{$key} === \$k) checked @endif >" . PHP_EOL .
                        "<span>{{ \$v }}</span></label>" . PHP_EOL .
                        "@endforeach" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;;
                    break;

                case "picture":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "<input type=\"text\" class=\"form-control\" name=\"{$key}\" placeholder=\"请输入{$value["name"]}\" value=\"{{ \$isUpdated?\$model->{$key}:\"\" }}\" @if(!\$isUpdated) required @endif readonly>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL .

                        "<div class=\"form-group\" id=\"upload-area\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label\">上传图片</label>" . PHP_EOL .
                        "<div class=\"col-sm-8\">" . PHP_EOL .
                        "<ul class=\"list-inline clearfix lyear-uploads-pic\" data-upload-url=\"{{ route('attachment.upload',['file_type' => 'pic','category' => '{$this->model}']) }}\" data-delete-url=\"{{ route('attachment.delete') }}\" @if(\$isUpdated) data-image-url=\"{{ \$model->{$key} }}\" @endif>" . PHP_EOL .
                        "</ul>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
                    break;

                case "number":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "<input type=\"number\" class=\"form-control\" name=\"{$key}\" placeholder=\"请输入{$value["name"]}\" value=\"{{ \$isUpdated?\$model->{$key}:\"\" }}\" @if(!\$isUpdated) required @endif>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
                    break;

                case "editor":
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-10\">" . PHP_EOL .
                        "<textarea class=\"tinymce-content\" id=\".$key.\">" . PHP_EOL .
                        "@if(\$isUpdated) {!! \$model->{$key} !!} @endif" . PHP_EOL .
                        "</textarea>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
                    break;
                default:
                    $code
                        .= "<div class=\"form-group\">" . PHP_EOL .
                        "<label class=\"col-sm-2 control-label " . isset_and_not_empty($value, 'validate', '') . "\">{$value["name"]}</label>" . PHP_EOL .
                        "<div class=\"col-sm-4\">" . PHP_EOL .
                        "<input type=\"text\" class=\"form-control\" name=\"{$key}\" placeholder=\"请输入{$value["name"]}\" value=\"{{ \$isUpdated?\$model->{$key}:\"\" }}\" @if(!\$isUpdated) required @endif>" . PHP_EOL .
                        "</div>" . PHP_EOL .
                        "</div>" . PHP_EOL;
            }
        }

        return $code;
    }

    protected function getEditorCode($list_field)
    {
        $editorString = "";

        foreach ($list_field as $key => $value) {
            if ($value['type'] == 'editor') {
                $editorString .= $key . ",";
            }
        }

        $editorString = $editorString ? substr($editorString, 0, strlen($editorString) - 1) : "";
        $editor = $editorString ? " data-tinymce=\"{$editorString}\"" : " ";
        return $editor;
    }

    protected function getScriptCode($list_field)
    {
        // 如果有 datetime 属性则加上script代码
        $code = "";
        $editorCount = 0;

        foreach ($list_field as $key => $value) {
            if ($value['type'] == 'datetime') {
                $code .= "//日期时间范围" . PHP_EOL .
                    "laydate.render({" . PHP_EOL .
                    "elem: '[name=\"{$key}\"]'," . PHP_EOL .
                    "type: 'datetime'," . PHP_EOL .
                    "theme: \"#33cabb\"," . PHP_EOL .
                    "});" . PHP_EOL;
            }

            if ($value['type'] == 'picture') {
                $code .= "// 单图上传" . PHP_EOL .
                    "$('.lyear-uploads-pic').imageUpload({" . PHP_EOL .
                    "\$callback_input: $('.form-control[name=\"{$key}\"]')," . PHP_EOL .
                    "showErrorDialog: $.utils.layerError," . PHP_EOL .
                    "showSuccessDialog: $.utils.layerSuccess" . PHP_EOL .
                    "});" . PHP_EOL;
            }

            if ($value['type'] == 'editor') $editorCount++;
        }

        if ($editorCount) {
            $code .= "var upload_url = \"{{ route('attachment.upload',['file_type' => 'pic','category' => 'editor']) }}\";" . PHP_EOL .
                "tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));";
        }

        return $code;
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            $this->stubArray,
            $this->replaceArray,
            $this->getStub('Model')
        );

        $path  = app_path("/Models/{$name}.php");

        $this->generateFileTemplate($path, $modelTemplate);
    }

    protected function controller($name)
    {
        array_push($this->stubArray, '{{--$code--}}', '{{--$fields--}}');
        array_push($this->replaceArray, $this->getValidateRule($this->list_field), $this->getModelAllFields());

        $modelTemplate = str_replace(
            $this->stubArray,
            $this->replaceArray,
            $this->getStub('Controller')
        );

        $path = app_path("/Http/Controllers/Admin/{$name}Controller1.php");

        // dd($modelTemplate);
        $this->generateFileTemplate($path, $modelTemplate);
    }

    protected function getModelAllFields()
    {
        return "'" . implode("','", array_keys($this->list_field)) . "'";
    }

    protected function generateFileTemplate($path, $modelTemplate)
    {
        if (file_exists($path)) {
            return $this->info($path . " 已存在");
        }

        return file_put_contents($path, $modelTemplate);
    }

    protected function getExistModelName()
    {
        return "App\Models\\" . $this->modelUCFirst;
    }

    protected function generateViewFile()
    {
        // 根据Model中的list_field 生成视图
        // 生成 index文件
        $this->index();

        // 生成 create_and_edit 文件
        //dd($this->getEditorCode($this->list_field));
        $this->create_and_edit();
    }


    // 生成 controller 中的rule验证代码
    protected function getValidateRule($list_field)
    {
        $code = 'return [' . PHP_EOL;
        foreach ($list_field as $key => $value) {
            if (isset_and_not_empty($value, 'data') && isset_and_not_empty($value, 'validate')) {
                $code .= "\t\t\t\"{$key}\" => [\"required\",Rule::in(array_keys(config('{$value["data"]}')))]," . PHP_EOL;
            } else if (isset_and_not_empty($value, 'validate')) {
                $code .= "\t\t\t\"{$key}\" => \"required\"," . PHP_EOL;
            } else if (isset_and_not_empty($value, 'data')) {
                $code .= "\t\t\t\"{$key}\" => Rule::in(array_keys(config('{$value["data"]}')))," . PHP_EOL;
            }
        }
        $code .= "\t\t];";
        return $code;
    }
}
