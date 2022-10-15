@extends('web.layouts.creditpay_base')

@section('content')
    <div class="content">
        <div class="se8-top2 sr4-top3">
            <div class="top-h2 title">
                <h2>借还款记录</h2>
            </div>

            <div class="top2 top3 " style="height:auto;padding-bottom:20px;">
                <div class="top3-p">
                    <p><p>在{{ systemconfig('site_name') }}免息借呗每一笔借还款记录将永久记录且永久累计，电子、棋牌、捕鱼等级和真人等级越高，可借款总额度就越高。</p></p>
                </div>
                <div class="jhk-table">
                    <table border="1" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <th>会员帐号</th>
                            <th>VIP等级</th>
                            {{--<th>电子棋牌等级</th>--}}
                            {{--<th>真人等级</th>--}}
                            <th class="jhk1">借还款金额</th>
                            <th>操作</th>
                        </tr>
                        <tbody  id="deals">


                        </tbody>
                    </table>
                    <div class="paging" id="page_record"   >

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>

        /* 初始化页面 */
        var initTotalPageNum = {{ $page_count }};
        var rowNum = {{ $row_count }};
        var pageSizeAjax = {{ $page_size }};
        $("#page_record").paging({pageSize:5,totalPage:initTotalPageNum,totalRowNum:rowNum,pageSizeAjax:pageSizeAjax});

        sendAjax(1,pageSizeAjax);

        /* ajax 请求更新数据 */
        function sendAjax(page,size=10){
            //var url = '';
            //view(data.data[page-1].con);
            var index = layer.load(1, {
                shade: [0.5,'#fff'] //0.1透明度的白色背景
            });

            $.ajax({
                url:"{{ route('web.credit_pay.list') }}",
                type:'post',
                data:{page:page,size:size},
                dataType:'json',
                success:function(result) {
                    layer.close(index);
                    $('#deals').html('');
                    //alert(result);return;
                    if(pageSizeAjax!=size){
                        console.log(1111);
                        $("#page_record").paging({pageSize:5,totalPage:result.page_count,totalRowNum:result.row_count,pageSizeAjax:size,cp:page});
                    }
                    console.log(result);
                    $('#i1').html(result.row_count);
                    $('#i2').html(result.page_count);
                    $('#deals').append(result.list);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    // view("异常！");
                    //  alert("异常！"+XMLHttpRequest.status);
                    layer.close(index);
                    console.log(XMLHttpRequest);
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