@extends('wap.layouts.creditpay_base')

@section('content')

    <div class="box">
        <div class="title">
            <h4>活动详情</h4>
        </div>
        <div class="txt-box">
            <p><p>提交成功2小时后请到<span style="color: rgb(255, 0, 0);">“信用额度查询”</span>是否借款成功！若提示借款成功，请到澳门巴黎人登入会员账号是否成功加入，如果没有成功加款到会员账号上，请联系借呗在线客服处理！</p></p>
        </div>
    </div>
    <div class="box">
        <div class="title">
            <h4>我要借款</h4>
        </div>
        <div class="hdxz-txt-box">
            <div class="kuan-box">
                <form id="myform" >
                    <div class="shu-ru fix">
                        <label>会员账号：</label>
                        <input name="name" style="padding-left:10px;"  placeholder="请填写会员账号" type="text"   />
                    </div>
                    <div class="shu-ru fix">
                        <label>会员姓名：</label>
                        <input  name="realname" style="padding-left:10px;"   placeholder="请填写会员姓名" type="text"   />
                    </div>

                    <div class="shu-ru fix">
                        <label>借款金额：</label>
                        <input name="money" style="padding-left:10px;"  placeholder="请填写借款金额" type="text"   />
                    </div>
                    <div class="shu-ru fix">
                        <label>借款天数：</label>
                        <input name="days" style="padding-left:10px;"  placeholder="请填写借款天数" type="text"   />
                    </div>


                    <div class="shu-ru fix">
                        <label>&nbsp;</label>
                        <input class="sub" name="" type="button" value="确认提交" onclick="post()" />
                    </div>
                </form>
            </div>
            <p class="zy">注意：提交成功5分钟后请到“信用额度查询”是否借款成功！</p>
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
                    //alert("异常！"+XMLHttpRequest.status);
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