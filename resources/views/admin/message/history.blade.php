@extends('layouts.baseframe')
@php
    $title = trans('res.member_message.history.title');
@endphp
@section('title', $title ?? '')

<div class="col-sm-12 p-t-15">

    {{-- <div class="card">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-body">

        </div>
    </div> --}}
    @if($model->parent)
        @include('admin.message.message_item',['item' => $model->parent])
    @endif

    @include('admin.message.message_item',['item' => $model])

    @if($model->child)
        @foreach($model->child as $item)
            @include('admin.message.message_item',['item' => $item])
        @endforeach
    @endif
</div>

@section('content')
@endsection
