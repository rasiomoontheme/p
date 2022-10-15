@extends('web.layouts.activity_base')

@section('content')

<div class="activity-det">
    <div class="bigtit">
        <a href="{{ route('web.activity.list') }}"><img src="{{asset('/web/images/activity/but1.png')}}"></a>
        {{ $activity->title }}
    </div>
    <div class="box_2 box_2-s">
        <p>
            <span style="color:#FFFF00;font-size:18px;">
                活动详情
            </span>
        </p>

        {!! $activity->content !!}

    </div>
    <div class="box_2">
        <form enctype="multipart/form-data" id="form1" onsubmit="return false" action="#" method="post">

            @csrf

            <div id="vote_form">
                <div class="form_item">
                    <div class="form_label">申请主题</div>

                    <div class="form_html title">{{ $activity->title }}</div>
                </div>

                {{--@foreach($activity->apply_field_array as $item)--}}
                @foreach($activity->hall_field_array as $item)
                @if($item == 'game_type')
                <div class="form_item form_input">
                    <div class="form_label">游戏类型</div>
                    <div class="form_html">
                        <select name="game_type" id="game_type">
                            @foreach(config('platform.game_type') as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @elseif($item == 'api_game_type')
                <div class="form_item form_input">
                    <div class="form_label">子游戏类型</div>
                    <div class="form_html">
                        <select name="api_game_type" id="api_game_type">
                            @foreach(App\Models\ApiGame::where('is_open', 1)->get()->pluck('api_game_type_text', 'id') as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @elseif(in_array($item,['member_name','bill_no','recharge_money']))
                <div class="form_item form_input">
                    <div class="form_label">{{ config('platform.activity_apply_field')[$item] }}</div>
                    <div class="form_html">
                        <input @if($item=='recharge_money' ) type="number" @else type="text" @endif name="{{ $item }}"
                            value="" placeholder="请输入{{ config('platform.activity_apply_field')[$item] }}">
                    </div>
                </div>
                @endif

                @endforeach

                {{-- <input type="text" hidden="" name="promotion_id" value="59"> --}}

                <div class="form_item form_input">
                    <div class="form_label">验证码</div>
                    <div class="form_html">
                        <input type="text" type="text" name="captcha" style="width: 80px" placeholder="请输入验证码">
                        <img src="{{captcha_src('hall')}}" class="pull-right" id="captcha" style="cursor: pointer;"
                            onclick="this.src=this.src+'?d='+Math.random();" title="点击刷新" alt="captcha">
                    </div>
                </div>

                <div class="form_item">
                    <div class="form_label">&nbsp;</div>

                    <div class="form_html">
                        <button type="button" id="sub" class="btn-sub"></button>
                    </div>
                </div>
            </div>
            {{-- <input type="hidden" id="clicaptcha-submit-info" name="clicaptcha-submit-info"> --}}
        </form>

    </div>
    <p class="bottom_p2 public_div">温馨提示：请选择对应的活动类别申请，提交申请后专员将在2个小时内审核办理，提交申请后可以点击审核进度查询！</p>

</div>

<script>
    $(function () {
        $('#sub').click(function () {
            // $('#clicaptcha-submit-info').clicaptcha({
            //     src: "/api/clicaptcha",
            //     callback: function () {

            //         $('#form1').submit();
            //     }
            // });

            $.ajax({
                //几个参数需要注意一下
                type: "POST", //方法类型
                dataType: "json", //预期服务器返回的数据类型
                url: "/activity/apply/{{ $activity->id }}", //url
                data: $('#form1').serialize(),
                success: function (data) {
                    alert(data.message);
                    window.location.reload();
                },
                error: function (
                    xhr, textStatus, errorThrown
                ) {
                    var returnMsg = "错误：";
                    var obj = JSON.parse(xhr.responseText);
                    if (obj.message)
                        returnMsg += obj.message;
                    alert(returnMsg);
                }
            });
        });
    });

</script>
@endsection
