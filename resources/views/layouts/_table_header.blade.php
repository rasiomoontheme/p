@php
    $widths = [
        2 => 50,
        3 => 70,
        4 => 80,
        5 => 95,
        6 => 105
    ];
@endphp

@foreach ($data as $key => $item)

    @php
        if(isset($model) && trans('res.'.$model.'.field.'.$key))
            $item['name'] = trans('res.'.$model.'.field.'.$key);
    @endphp

@if(isset_and_not_empty($item,'is_show'))
    @switch($key)
        @case('member_id')
            <th style="min-width: 80px;">@lang('res.common.member_id')</th>
            @break
        @case('user_id')
            <th  style="min-width: 95px;">@lang('res.common.user_id')</th>
            @break
        {{--
        @case('api_id')
            <th  style="min-width: 80px;">@lang('res.common.api_id')</th>
            @break
        --}}
        @case('agent_id')
            <th  style="min-width: 80px;">@lang('res.common.api_id')</th>
            @break
        @default
        <th title="{{ $item['name'] }}"
            @if(array_key_exists('min-width',$item))
                style="min-width: {{ $item['min-width'] }}"
            @elseif(in_array(mb_strlen($item['name']),array_keys($widths)))
                style="min-width:{{ $widths[mb_strlen($item['name'])].'px' }}"
            @elseif(mb_strlen($item['name']) > 5)
                style="min-width: 100px;"
            @endif>{{ $item['name'] }}</th>
    @endswitch

@endif
@endforeach
