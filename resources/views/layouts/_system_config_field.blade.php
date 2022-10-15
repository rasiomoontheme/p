<form class="form-horizontal" action="{{ route('admin.systemconfigs.post_config_groups',['group_name' => $group_name]) }}" method="post">
    @csrf

    @php
    $groups = \App\Models\SystemConfig::forMember()->getConfigGroups($group_name);
    @endphp

    @foreach($groups as $item)

    @if($item->type != \App\Models\SystemConfig::CONFIG_TYPE_PICTURE)
    <div class="form-group">
        <label class="col-sm-2 control-label">{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }} {{ $item->lang == \App\Models\Base::LANG_COMMON ? "" : '【'.config('platform.language_type_cn')[$item->lang].'】' }}</label>
        @if($item->type == \App\Models\SystemConfig::CONFIG_TYPE_BOOLEAN)
        <div class="col-sm-4 switch-col">
            <label class="lyear-switch switch-solid switch-primary">
                <input type="checkbox" name="{{ $item->getUniqueKey() }}" value="{{ $item->value }}" @if($item->value) checked
                @endif>

                @if(!$item->value)
                <input type="hidden" name="{{ $item->getUniqueKey() }}" value="{{ $item->value }}">
                @endif
                <span></span>
            </label>
        </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_EDITOR)
            <div class="col-sm-10">
                <textarea class="tinymce-content" id="{{ $item->getUniqueKey() }}">
                    {!! $item->value !!}
                </textarea>
            </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_TEXT)
        <div class="col-sm-4">
            <input type="text" class="form-control" name="{{ $item->getUniqueKey() }}" placeholder="{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }}"
                value="{{ $item->value }}">
        </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_TEXTAREA)
        <div class="col-sm-6">
            <textarea class="form-control" name="{{ $item->getUniqueKey() }}" placeholder="{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }}" cols="30" rows="3">{{ $item->value }}</textarea>
        </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_NUMBER)
        <div class="col-sm-4">
            <input type="number" class="form-control" name="{{ $item->getUniqueKey() }}" placeholder="{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }}"
                value="{{ $item->value }}">
        </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_TIME)
        <div class="col-sm-4">
            <input type="text" class="form-control" name="{{ $item->getUniqueKey() }}" placeholder="{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }}"
                value="{{ $item->value }}" data-laydate-component="time" readonly>
        </div>

        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_SELECT)
            <div class="col-sm-4">
                <select name="{{ $item->getUniqueKey() }}" class="form-control js_select2">
                    <option value="">@lang('res.common.select_default')</option>
                    {{--@foreach(config($item->data_config) as $key => $value)--}}
                    @foreach(trans('res.option.'.substr($item->data_config,9)) as $key => $value)
                        <option value="{{ $key }}" @if($item->value == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($item->type == \App\Models\SystemConfig::CONFIG_TYPE_FILE)
            <div class="col-sm-4 mp3-area">
                <input type="text" class="form-control mp3-path"
                           value="{{ $item->value }}" readonly name="{{ $item->getUniqueKey() }}">
                <input type="file" class="mp3-uploader" accept="mp3" style="display: none">
            </div>
            <div class="col-sm-3 btn-operates">
                <button class="btn btn-info btn-sm mp3-btn" type="button">@lang('res.system_config.config_groups.btn_choose')</button>
                @if($item->value)
                    <a class='btn btn-default btn-sm' href='{{ $item->value }}' target='_blank'>@lang('res.system_config.config_groups.btn_preview')</a>
                @endif
            </div>
        @endif

        @if($item->type !== \App\Models\SystemConfig::CONFIG_TYPE_EDITOR)
        <div class="col-sm-4">
            <span class="help-block">
                {{ $item->description }}
                @if($item->link_html)
                    {!! $item->link_html !!}
                @endif
            </span>
        </div>
        @endif
    </div>

    @else
    <div class="form-group">
        <label class="col-sm-2 control-label">{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }} {{ $item->lang == \App\Models\Base::LANG_COMMON ? '' : '【'.config('platform.language_type_cn')[$item->lang].'】' }}</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="{{ $item->getUniqueKey() }}" placeholder="{{ \Illuminate\Support\Arr::get(trans('res.configs'),$item->name) }}"
                value="{{ $item->value }}">
        </div>
        <div class="col-sm-4">
            <span class="help-block">
                {{ $item->description }}
                @if($item->link_html)
                    {!! $item->link_html !!}
                @endif
            </span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">@lang('res.common.upload_image')</label>
        <div class="col-sm-8">
            <ul class="list-inline clearfix lyear-uploads-pic" id="{{ $item->name }}"
                data-field-name="{{ $item->getUniqueKey() }}" data-component="imageUpload"
                data-upload-url="{{ route('attachment.upload',['file_type' => 'pic','category' => 'config']) }}"
                data-delete-url="{{ route('attachment.delete') }}"
                data-image-url="{{ $item->value }}">
            </ul>
        </div>
    </div>
    @endif
    @endforeach

    @php
        $keys = $groups->where('type',\App\Models\SystemConfig::CONFIG_TYPE_EDITOR);
        $keydesc = '';
        foreach ($keys as $item){
            $keydesc .= $item->getUniqueKey().',';
        }
        if(strlen($keydesc)) $keydesc = substr($keydesc,0,strlen($keydesc) - 1);
    @endphp

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-primary" data-operate="ajax-submit"
                    type="button" @if(strlen($keydesc)) data-tinymce="{{ $keydesc }}" @endif>@lang('res.btn.save')</button>
            <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
        </div>
    </div>

</form>
