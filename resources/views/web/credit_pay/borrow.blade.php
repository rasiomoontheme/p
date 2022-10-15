@extends('web.layouts.creditpay_base')

@section('content')
    <div class="box2">
        <div class="title">
            <h5>温馨提示</h5>
        </div>
        <div class="txt-box">
            <p><p>提交成功2小时后请到<span style="color: rgb(255, 0, 0);">“信用额度查询”</span>是否借款成功！若提示借款成功，请到澳门巴黎人登入会员账号是否成功加入，如果没有成功加款到会员账号上，请联系借呗在线客服处理！</p></p>
        </div>
    </div>

    <div class=" se8-top2 sr7-top2">
        <div class="top-h2">
            <h2>我要借款</h2>
        </div>
        <div class="top2">
            <form id="myform">
                <div class="top2-form">
                    <label>会员账号：</label>
                    <input type="text" name="name" style="padding-left:10px;"  placeholder="请填写会员账号" />
                </div>
                <div class="top2-form">
                    <label>会员姓名：</label>
                    <input type="text" name="realname" style="padding-left:10px;"   placeholder="请填写会员姓名"/>
                </div>

                <div class="top2-form ">
                    <label>借款金额：</label>
                    <input type="text" name="money" style="padding-left:10px;"  placeholder="请填写借款金额"/>
                </div>
                <div class="top2-form">
                    <label class="label2">借款天数：</label>
                    <input type="text" name="days" style="padding-left:10px;"  placeholder="请填写借款天数" />
                </div>

                <div class="top2-bom">
                    <input type="button" value="确认提交" onclick="post()" />
                </div>
                <div class="top2-p">
                    <p>注意：提交成功5分钟后请到“信用额度查询”是否借款成功！</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function post(){
            var index = layer.load(1, {
                shade: [0.5,'#fff'] //0.1透明度的白色背景
            });

            var data = $('#myform').serialize();

            $.ajax({
                url:"{{ route('web.credit_pay.borrow.post') }}",
                type:'post',
                data:data,
                dataType:'json',
                success:function(result) {
                    layer.close(index);
                    console.log(result);
                    layer.msg(''+result.message);
                    if(result.code==200){
                        setTimeout("window.location.reload();",1000);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    layer.close(index);
                    var returnMsg = "错误：";
                    console.log(JSON.parse(XMLHttpRequest.responseText))
                    if (XMLHttpRequest.responseText){
                        returnMsg += JSON.parse(XMLHttpRequest.responseText).message;
                        layer.msg(returnMsg);
                    }
                }
            });
        }
    </script>
@endsection