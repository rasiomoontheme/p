@foreach($list as $k => $v)

    @switch($v['type'])

        {{--使用格式 ['remark' => ['name' => '备注说明','type' => 'text']]--}}
        @case('text')
        <div class="col-sm-3">
            <div class="input-group form-group">
                <span class="input-group-addon">{{ $v['name'] }}</span>
                <input type="text" class="form-control" name="{{ $k }}" value="{{ $params[$k] ?? ''}}">
            </div>
        </div>
        @break

        {{--使用格式 ['type' => ['name' => '操作类型','type' => 'select','data' => \App\Models\Log::$logTypeMap]]--}}
        @case('select')

        @if(is_array($v['data']))
        <div class="col-sm-3">
            <div class="input-group form-group">
                <span class="input-group-addon">{{ $v['name'] }}</span>
                <select name="{{ $k }}" id="{{ $k }}" class="form-control js_select2">
                    <option value="">@lang('res.common.select_default')</option>
                    @foreach($v['data'] as $key =>$value)
                        <option value="{{ $key }}" @if(isset($params[$k]) && $params[$k] == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        @break

        {{-- 使用格式 'created' => ['name' => '创建时间','type' => 'datetime'] --}}
        @case('datetime')
        @case('datetime-single')
        <div class="col-sm-3">
            <div class="input-group form-group">
                <span class="input-group-addon">{{ $v['name'] }}</span>
                <input type="text" data-laydate-component="{{ $v['type'] }}" class="form-control" id="{{ $k }}" name="{{ $k }}" value="{{ $params[$k] ?? ''}}" readonly>
            </div>
        </div>
        @break
        
        @default
            未定义
    @endswitch
@endforeach