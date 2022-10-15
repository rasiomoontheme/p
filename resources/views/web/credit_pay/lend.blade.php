@extends('web.layouts.creditpay_base')

@section('content')

    <div class="box2">
        <div class="title">
            <h5>温馨提示</h5>
        </div>
        <div class="txt-box">
            <p><p>还款操作步骤：一、输入会员账号点击【查询欠款额度】查看需要还款的金额；二、点击<span style="color: rgb(255, 0, 0);"><a href="#" target="_blank" title="在线付款">【在线付款】</a></span>选择方便支付的通道进行付款；<span style="white-space: normal;">三</span>、付款成功后回到该页面填写相关信息点击【确认提交】；<span style="white-space: normal;">四</span>、提交成功2小时后，请到“信用额度查询”查询是否成功还款；五、成功还款1分钟后即可再次申请借款！</p></p>
        </div>
    </div>

    <div class=" se8-top2 sr7-top2">
        <div class="top-h2">
            <h2>我要还款</h2>
        </div>
        <div class="top2" style="height:450px;">
            <form id="myform">
                <div class="top2-form" style=" margin-left:100px;" >
                    <label>会员账号：</label>
                    <input type="text" name="name" id="_username1" style="padding-left:10px;" placeholder="请填写会员账号"  />

                    <input type="button" class="btn" value="查询欠款额度" onclick="findm()"  style="width:85px;margin-left:10px;" >

                </div>
                <div class="top2-form">
                    <label>会员姓名：</label>
                    <input type="text" name="realname"  style="padding-left:10px;"   placeholder="请填写会员姓名" />
                </div>
                <div class="top2-form ">
                    <label>还款金额：</label>
                    <input type="text" name="money" style="padding-left:10px;" placeholder="请填写还款金额"  />
                </div>

                {{--
                <div class="top2-form ">
                    <label>还款方式：</label>
                    <select name="method" id="method" style="width:252px;height:40px;border-radius:3px;line-height:40px;border:1px solid #dcdcdc;">
                        <option value="0">请选择</option>
                        <option value="支付宝">支付宝</option>
                        <option value="微信">微信</option>
                        <option value="QQ">QQ</option>
                        <option value="银行转账">银行转账</option>
                    </select>
                </div>
                --}}

                <div class="top2-bom">
                    {{--<input type="button" value="在线付款" onclick="post2()" style="background:#f59c25;cursor:pointer;" />--}}
                    <input type="button" value="确认提交" onclick="post()" style="margin-left:10px;cursor:pointer;"/>
                </div>

                <div class="top2-p">
                    <p>注意：请点击“在线付款”进行付款，付款完成再来提交！</p><br/><p>提交成功5分钟，请到“信用额度查询”查询是否成功还款！</p>
                </div>

            </form>
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
                    var returnMsg = "错误：";
                    console.log(JSON.parse(XMLHttpRequest.responseText))
                    if (XMLHttpRequest.responseText){
                        returnMsg += JSON.parse(XMLHttpRequest.responseText).message;
                        layer.msg(returnMsg);
                    }
                }

            });


        }
        function findm(){
            if($('#_username1').val()==''){
                //alert("请选择还款方式");
                console.log($('#_username1').val());
                layer.msg('请输入会员账户');
                return;


            }
            var index = layer.load(1, {
                shade: [0.5,'#fff'] //0.1透明度的白色背景
            });

            var data = $('#myform').serialize();

            $.ajax({
                url:"{{ route('web.credit_pay.check') }}",
                type:'post',
                data:data,
                dataType:'json',
                success:function(result) {
                    layer.close(index);
                    console.log(result);

                    if(result.code==200){
                        alert('当前欠款:'+result.data);
                    }else{
                        layer.msg(''+result.message);
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