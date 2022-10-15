@foreach ($data as $key => $value)
@if(isset_and_not_empty($value,'is_show'))
@switch(\Illuminate\Support\Arr::get($value,'type','text'))

@case('picture')
<td>@include("layouts._table_image",['url' => $item->$key])</td>
@break

@case('radio')
@case('select')
<td>

    @if(array_key_exists('style',$value))
    <span class="label {{ \Arr::get(config($value['style']),$item->$key) }}">{{ \Arr::get(trans('res.option')[substr($value['data'],strlen('platform.'))] ?? config($value['data']),$item->$key) }}</span>
    @else
    <span class="label {{ config('platform.style_label')[current(array_keys(array_keys(config($value['data'])),$item->$key))%13] }}">{{ !is_null($item->$key) ? (\Illuminate\Support\Arr::get(trans('res.option')[substr($value['data'],strlen('platform.'))] ?? config($value['data']),$item->$key,'-')) : '-' }}
    {{-- <span class="label {{ config('platform.style_label')[$item->$key%10] }}">{{ config($value['data'])[$item->$key] }} - --}}
       {{--- {{ $item->$key }}--}}
    </span>
    @endif
</td>
@break

@default
@switch($key)
    @case('member_id')
        @if(\Illuminate\Support\Str::startsWith(\Route::currentRouteName(),'admin.'))
        <td title="{{ $item->member->name ?? '' }}">
            {{-- string_limit($item->member->name ?? '已删除',20) --}}
            @include("layouts._member_dropmenus",['member' => $item->member])
        </td>
        @else
            <td title="{{ $item->member->name ?? '' }}">
                {{ $item->member->name ?? '已删除' }}
            </td>
        @endif
    @break
    @case('user_id')
    <td title="{{ $item->user->name ?? '-' }}">{{ string_limit($item->user->name ?? '-',20) }}</td>
    @break
    {{--
    @case('api_id')
    <td title="{{ $item->api->api_name ?? '-' }}">{{ string_limit($item->api->api_name ?? '接口不存在',20) }}</td>
    @break
    --}}
    @case('agent_id')
    <td title="{{ $item->member->name ?? '' }}">{{ string_limit($item->member->name ?? '已删除',20) }}</td>
    @break

    @default
    <td title="{{ $item->$key }}">{{ string_limit($item->$key,\Illuminate\Support\Str::contains($key,'url') ? 50 : 20) }}</td>
    @endswitch
@endswitch
@endif
@endforeach
