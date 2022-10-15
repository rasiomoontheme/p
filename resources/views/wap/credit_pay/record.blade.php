@extends('wap.layouts.creditpay_base')

@section('content')

    <div class="box">
        <div class="title">
            <h4>借还款记录</h4>
        </div>
        <div class="txt-box">

            <p><p>在澳门巴黎人免息借呗每一笔借还款记录将永久记录且永久累计，电子、棋牌、捕鱼等级和真人等级越高，可借款总额度就越高。</p></p>
            <div class="box-biaoge" style="margin-top:15px;">
                <table class="jhk-table" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th scope="col">会员账号</th>
                        <th scope="col">VIP等级</th>
                        {{--<th scope="col">电子等级</th>--}}
                        {{--<th scope="col">真人等级</th>--}}
                        <th scope="col">借还款金额</th>
                        <th scope="col">操作</th>
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


        function sendAjax(page,size){
            var size=size?size:10;
            //var url = '';
            //view(data.data[page-1].con);
            var index = layer.load(1, {
                shade: [0.5,'#fff'] //0.1透明度的白色背景
            });
            $.ajax( {
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
                }
            });
        }


    </script>

@endsection