@extends('layouts.baseframe')

@section('title', '晋升等级福利设置')

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>晋升等级福利设置</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> 刷新
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-toolbar clearfix">
                <div class="toolbar-btn-action">
                    <button class="btn btn-primary m-r-5 add-btn" ><i
                                class="mdi mdi-plus"></i>
                        新增</button>

                </div>
            </div>
            <div class="card-body">

                <div class="row p-15">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <td width="10%">晋升标准等级</td>
                            <td width="12%">累计打码</td>
                            <td width="12%">等级礼金</td>
                            <td width="12%">周俸禄</td>
                            <td width="12%">月俸禄</td>
                            <td width="12%">借呗额度</td>
                            <td width="12%">累计礼金</td>
                            <td width="15%">操作</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_level_money = 0; ?>
                        @foreach($levels as $item)
                            <tr>
                                <td>{{ $item }}级</td>
                                <?php
                                $level_money = $data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_LEVEL)->first()->award_content['money'];
                                $total_level_money = $total_level_money + $level_money;
                                ?>
                                <td>
                                    <input name="ml_money" class="form-control" value="{{ $data->where('level',$item)->where('condition_money','>',0)->first()->condition_money }}" />
                                </td>
                                <td>
                                    <input name="level_award" value="{{ $level_money }}" type="number" class="form-control"/>
                                </td>
                                <td>
                                    <input name="week_award" value="{{ $data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_WEEK)->first()->award_content['money'] ?? '' }}" type="number" class="form-control"/>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="month_award"
                                           value="{{ $data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_MONTH)->first()->award_content['money'] ?? '' }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="borrow_award"
                                           value="{{ $data->where('level',$item)->where('level_award_type',\App\Models\Task::LEVEL_TYPE_BORROW)->first()->award_content['money'] ?? '' }}">
                                </td>
                                <td>{{ $total_level_money }}</td>
                                <td>
                                    <a href="javascript:;" class="save-btn btn btn-xs btn-warning"
                                       data-url="{{ route('admin.task.post_level_setting',['level' => $item]) }}">
                                        保存
                                    </a>
                                    <a href="javascript:;" class="delete-btn btn btn-danger btn-xs"
                                       data-url="{{ route('admin.task.delete_level_setting',['level' => $item]) }}">
                                        删除
                                    </a>
                                    <input type="hidden" name="level" value="{{ $item }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("footer-js")
    <script>
        $(function(){

            $(document).on('click','.save-btn',function () {
                var _this = $(this);
                _this.attr("disabled", true);

                if(!_this.data('url')) return;

                // 获取数据
                var tr = $(this).parents('tr');
                var ml_money = tr.find('input[name="ml_money"]').val();
                var level_award = tr.find('input[name="level_award"]').val();
                var week_award = tr.find('input[name="week_award"]').val();
                var month_award = tr.find('input[name="month_award"]').val();
                var borrow_award = tr.find('input[name="borrow_award"]').val();

                $.ajax({
                    url: _this.data('url'),
                    data:{
                        ml_money:ml_money,
                        level_award:level_award,
                        week_award:week_award,
                        month_award:month_award,
                        borrow_award:borrow_award
                    },
                    method:'post',
                    success:function(res){
                        _this.attr("disabled", false);

                        if(res.code == 200) $.utils.dealWithResponse(res);
                        else $.utils.layerError(res.message);
                    },
                    error:function(err){
                        _this.attr("disabled", false);
                    }
                });
            });

            $(document).on('click','.delete-btn',function(){
                var _this = $(this);
                _this.attr("disabled", true);

                if(!_this.data('url')) return;

                $.ajax({
                    url: _this.data('url'),
                    type:'DELETE',
                    success:function(res){
                        _this.attr("disabled", false);

                        if(res.code == 200) $.utils.dealWithResponse(res);
                        else $.utils.layerError(res.message);


                    },
                    error:function(err){
                        _this.attr("disabled", false);
                    }
                });
            });

            $('.add-btn').click(function(){
                // table 中的最后一个
                var last_tr = $('.table tbody tr:last-child');
                var tbody = $('.table tbody');
                var level = 0;

                if(last_tr.length) level = last_tr.find('input[name="level"]').val();
                level = parseInt(level) + 1;

                var html = '<tr>\n' +
                    '                                    <td>'+ level +'级</td>\n' +
                    '                                                                        <td>\n' +
                    '                                        <input name="ml_money" class="form-control" value="">\n' +
                    '                                    </td>\n' +
                    '                                    <td>\n' +
                    '                                        <input name="level_award" value="" type="number" class="form-control">\n' +
                    '                                    </td>\n' +
                    '                                    <td>\n' +
                    '                                        <input name="week_award" value="" type="number" class="form-control">\n' +
                    '                                    </td>\n' +
                    '                                    <td>\n' +
                    '                                        <input type="number" class="form-control" name="month_award" value="">\n' +
                    '                                    </td>\n' +
                    '                                    <td>\n' +
                    '                                        <input type="number" class="form-control" name="borrow_award" value="">\n' +
                    '                                    </td>\n' +
                    '                                    <td></td>\n' +
                    '                                    <td>\n' +
                    '                                        <a href="javascript:;" class="save-btn btn btn-xs btn-warning" data-url="/admin/task/level_setting/' + level + '">\n' +
                    '                                            保存\n' +
                    '                                        </a>\n' +
                    '                                    </td>\n' +
                    '                                </tr>';

                tbody.append(html);
            });
        });
    </script>
@endsection