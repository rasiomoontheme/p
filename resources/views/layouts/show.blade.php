@extends('layouts.baseframe')
@section('content')

    <style>
        td{word-break:break-all;}
    </style>
    <div class="row m-15">

        <table class="table table-striped">
            <thead>
            <tr>
                <th width="20%">@lang('res.btn.title')</th>
                <th>@lang('res.btn.content')</th>
            </tr>
            </thead>
            <tbody>


            @php
                $arr = request('model') ? trans('res.'.request('model').'.field') : [];
                $arr = (is_string($arr) || !$arr) ? trans('res.'.\Illuminate\Support\Str::snake(getClassBaseName($model)).'.field') :$arr;
                $arr = (is_string($arr) || !$arr) ? $model::$list_field : $arr;
            @endphp

            @foreach ($model::$list_field as $key => $value)
                @if(is_array($value))
                    <tr>
                        <td>{{ \Illuminate\Support\Arr::get($arr,$key) }}</td>
                        <td>
                            @if(array_key_exists('data',$value))
                                {{ \Illuminate\Support\Arr::get(trans('res.option.'.substr($value['data'],9) ?? []), $model->$key, "") }}
                            @else
                                {{ $model->$key }}
                            @endif
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ \Illuminate\Support\Arr::get($arr,$key) }}</td>
                        <td>{{ is_array($model->$key)?json_encode($model->$key):$model->$key }}</td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>

    </div>

@endsection