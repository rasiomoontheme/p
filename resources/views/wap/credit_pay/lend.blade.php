@extends('wap.layouts.creditpay_base')

@section('content')

    <div class="box">
        <div class="title">
            <h4>活动详情</h4>
        </div>
        <div class="txt-box">
            <p><p>还款操作步骤：一、输入会员账号点击【查询欠款额度】查看需要还款的金额；二、点击<span style="color: rgb(255, 0, 0);"><a href="#" target="_blank" title="在线付款">【在线付款】</a></span>选择方便支付的通道进行付款；<span style="white-space: normal;">三</span>、付款成功后回到该页面填写相关信息点击【确认提交】；<span style="white-space: normal;">四</span>、提交成功2小时后，请到“信用额度查询”查询是否成功还款；五、成功还款1分钟后即可再次申请借款！</p></p>
        </div>
    </div>
    <div class="box">
        <div class="title">
            <h4>我要还款</h4>
        </div>
        <div class="hdxz-txt-box">
            <div class="kuan-box kuan-box2">
                <form id="myform">
                    <div class="shu-ru fix">
                        <label>会员账号：</label>
                        <input name="name" style="padding-left:10px;" placeholder="请填写会员账号" type="text" placeholder="" />
                    </div>
                    <div class="shu-ru fix">
                        <label>会员姓名：</label>
                        <input name="realname" style="padding-left:10px;"   placeholder="请填写会员姓名"  type="text" placeholder="" />
                    </div>
                    <div class="shu-ru fix">
                        <label>还款金额：</label>
                        <input  name="money" style="padding-left:10px;" placeholder="请填写还款金额" type="text" placeholder="" />
                    </div>

                    {{--
                    <div class="shu-ru fix">
                        <label>您的付款方式：</label>
                        <select name="method" id="method" >
                            <option value="0">请选择</option>
                            <option value="支付宝">支付宝</option>
                            <option value="微信">微信</option>
                            <option value="QQ">QQ</option>
                            <option value="银行转账">银行转账</option>
                        </select>
                    </div>

                    <div class="shu-ru fix">
                        <label>&nbsp;</label>
                        <a href="javascript:;" onclick="post2()" >在线付款</a>
                    </div>
                    --}}
                    <div class="shu-ru fix">
                        <label>&nbsp;</label>
                        <input class="sub" name="" type="button"   onclick="post()" value="确认提交" />
                    </div>
                </form>
            </div>
            <p class="zy">注意：请点击“在线付款”进行付款，付款完成再来提交！<br />提交成功5分钟，请到“信用额度查询”查询是否成功还款！</p>
        </div>
    </div>

    <script>
        {{--
        function post2(){
            var url = "https://www.jy1779.com/";
            window.open(url);
        }
        --}}
        function post(){
            if($('#method').val()==0){
                //alert("请选择还款方式");
                layer.msg('请选择还款方式');
                return;
            }
            var index = layer.load(1, {
                shade: [0.5,'#fff'] //0.1透明度的白色背景
            });



            var data = $('#myform').serialize();

            $.ajax({
                url:"{{ route('web.credit_pay.lend') }}",
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