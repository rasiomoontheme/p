@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <div class="col-sm-12">

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            @lang('res.api_game.mobile_category.top_notice')
        </div>

        <div class="card">
            <div class="card-header">
                <h4>@lang('res.api_game.mobile_category.web_title')</h4>

                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#webContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> @lang('res.btn.collapse')
                        </button>
                    </li>
                    <li>
                        <button type="button" onclick="javascript:window.location.reload()">
                            <i class="mdi mdi-refresh"></i> @lang('res.btn.refresh')
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body collapse in" id="webContent" aria-expanded="true">
                <form action="{{ route('admin.apigames.web_category_save') }}" method="post" id="webForm" name="webForm" class="form-horizontal">

                    <div class="card-toolbar clearfix">
                        <div class="toolbar-btn-action">
                            <a class="btn btn-label btn-info" data-operate="ajax-submit">
                                <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> @lang('res.btn.save')
                            </a>

                        </div>
                    </div>

                    <div class="row p-15">
                        <table id="table" class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <td width="40%">@lang('res.api_game.mobile_category.key')</td>
                                <td width="40%">@lang('res.api_game.mobile_category.name')</td>
                                <td width="20%">@lang('res.api_game.mobile_category.weight')</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($web as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ \Illuminate\Support\Arr::get(trans('res.option.web_nav'),$item['name']) }}</td>

                                    <td class="text-center">
                                        <input type="text" class="form-control" name="weight[]"
                                               value="{{ \Illuminate\Support\Arr::get($item,'weight',0) }}" />
                                    </td>
                                    <input type="hidden" name="name[]" value="{{ $item['name'] }}">
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Biểu tượng danh mục trò chơi di động</h4>

                <ul class="card-actions">
                    <li>
                        <button type="button" data-toggle="collapse" href="#mobileContent" aria-expanded="false"
                                aria-controls="searchContent">
                            <i class="mdi mdi-chevron-double-down"></i> @lang('res.btn.collapse')
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body collapse in" id="mobileContent" aria-expanded="true">
                <form action="{{ route('admin.apigames.mobile_category') }}" method="post" id="searchForm" name="searchForm"
                      class="form-horizontal">
                    <div class="card-toolbar clearfix">
                        <div class="toolbar-btn-action">
                            <a id="add-btn" class="btn btn-label btn-primary m-r-5" href="javascript:;">
                                <label><i class="mdi mdi-plus"></i></label>Tạo mới
                            </a>

                            <a class="btn btn-label btn-info" data-operate="ajax-submit">
                                <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> Lưu
                            </a>

                        </div>
                    </div>

                    <div class="card-body collapse in" id="searchContent" aria-expanded="true">
                        <div class="row p-15">
                            <table id="table-icon" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr>
                                    <td width="10%">Tiêu đề</td>
                                    <td width="15%">Thể loại trò chơi</td>
                                    <td width="15%">Biểu tượng (phía trước) địa chỉ</td>
                                    <td width="10%">Xem trước hình ảnh</td>
                                    <td width="15%">Biểu tượng (quay lại) địa chỉ</td>
                                    <td width="10%">Xem trước hình ảnh</td>
                                    <td width="15%">Trọng lượng</td>
                                    <td width="10%">Trạng thái</td>
                                    <td width="10%">Vận hành</td>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="title[]" placeholder="Vui lòng nhập tên danh mục"
                                                   value="{{ $item['title'] ?? '' }}" />
                                        </td>

                                        <td>
                                            <select name="game_type[]" class="form-control js_select2" data-value="{{ $item['game_type'] ?? '' }}">
                                            </select>
                                        </td>


                                        <td>
                                            <input type="text" class="form-control icon-url-before" name="icon_before[]"
                                                   placeholder="Vui lòng nhập địa chỉ của biểu tượng trước khi nhấp vào" value="{{ $item['icon_before'] ?? '' }}" />
                                        </td>
                                        <td>
                                            <img src="{{ $item['icon_before'] ?? ''}}" data-src="{{ $item['icon_before'] ?? ''}}"
                                                 data-operate="show-image" style="max-width:60px;cursor: pointer;">
                                        </td>


                                        <td>
                                            <input type="text" class="form-control icon-url-after" name="icon_after[]"
                                                   placeholder="Vui lòng nhập địa chỉ biểu tượng đã nhấp" value="{{ $item['icon_after'] ?? '' }}" />
                                        </td>
                                        <td>
                                            <img src="{{ $item['icon_after'] ?? ''}}" data-src="{{ $item['icon_after'] ?? ''}}"
                                                 data-operate="show-image" style="max-width:60px;cursor: pointer;">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control" name="weight[]" placeholder="Vui lòng nhập trọng lượng"
                                                   value="{{ $item['weight'] ?? '' }}" />
                                        </td>
                                        <td>
                                            {{-- <label class="lyear-checkbox checkbox-primary">
                                                <input type="checkbox" @if($item['is_open']=='true' ) checked
                                                    @endif><span></span>
                                                <input type="hidden" name="is_open[]" value="{{ $item['is_open'] }}">
                                            </label> --}}

                                            <label class="lyear-switch switch-solid switch-primary switch-col">
                                                <input type="checkbox" name="is_open[]" value="{{ $item['is_open'] }}" data-true="true" data-false="false" @if($item['is_open']) checked
                                                        @endif>
                                                {{--<input type="hidden" value="{{ $item['is_open'] }}">--}}
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="delete-btn btn btn-danger btn-xs">
                                                Xóa
                                            </a>

                                            <a href="javascript:;" data-operate="show-uploader"
                                               data-url="/admin/picture/upload"
                                               class="btn btn-warning btn-xs btn-uploader-before">
                                                Biểu tượng (phía trước) tải lên
                                            </a>

                                            <a href="javascript:;" data-operate="show-uploader"
                                               data-url="/admin/picture/upload"
                                               class="btn btn-warning btn-xs btn-uploader-after">
                                                Biểu tượng (bài đăng) tải lên
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
        $config = [];
        foreach(config('platform.game_type') as $k => $v){
            array_push($config, ['id' => $k,'text' => $v]);
        }
    @endphp

@endsection



@section("footer-js")
    <script>
        //日期时间范围
        $(function () {

            $(document).on('click', '.delete-btn', function () {
                $(this).parents('tr').remove();
            });

            // 修改为点击前图标 和 点击后图标
            /**
             $(document).on('click', '.btn-uploader', function () {
            // 标记需要赋值的input，将id设置为picture-url,在图片上传完之后，设置图片的url
            $('.icon-url').removeAttr('id');
            $(this).parents('tr').find('.icon-url').attr('id', 'picture-url');
		});
             **/

            $(document).on('click', '.btn-uploader-before', function(){
                $('.icon-url-before').removeAttr('id');
                $(this).parents('tr').find('.icon-url-before').attr('id', 'picture-url');
            });

            $(document).on('click', '.btn-uploader-after', function(){
                $('.icon-url-after').removeAttr('id');
                $(this).parents('tr').find('.icon-url-after').attr('id', 'picture-url');
            });

            initSelect();

            $('#add-btn').click(function () {
                // 获取 table 中最后一个td
                var tbody = $('#table-icon').find('tbody');
                tbody.append(
                    '<tr><td><input type="text" class="form-control" name="title[]" placeholder="请输入分类名称" value="" /></td>' +
                    '<td><select name="game_type[]" class="form-control js_select2"></select></td>'+
                    '<td><input type="text" class="form-control icon-url-before" name="icon_before[]" placeholder="请输入点击前图标地址" value=""></td>' +
                    '<td> - </td>' +
                    '<td><input type="text" class="form-control icon-url-after" name="icon_after[]" placeholder="请输入点击后图标地址" value=""></td>' +
                    '<td> - </td>' +
                    '<td><input type="text" class="form-control" name="weight[]" placeholder="请输入权重" value="" /></td>' +
                    '<td><label class="lyear-switch switch-solid switch-primary"><input type="checkbox" name="is_open[]" value="0"><input type="hidden" value="0"><span></span></label></td>' +
                    '<td><a href="javascript:;" class="delete-btn btn btn-danger btn-xs">删除</a>' +
                    '<a href="javascript:;" class="btn btn-warning btn-xs btn-uploader" data-title="图片上传" data-operate="show-uploader" data-url="/admin/picture/upload" >图片上传</a>' +
                    '</td></tr>');

                initSelect();

            });

            $('.lyear-checkbox input[type=checkbox]').change(function () {
                // alert($(this).attr("checked"));
                console.log($(this).is(":checked"))
                $(this).siblings('input[type=hidden]').val($(this).is(":checked"));
            });

            function initSelect(){
                var data = {!! json_encode($config) !!};

                data.unshift({id:'-1',text:'热门'});

                // 渲染select
                $('[name="game_type[]"]').select2({
                    data: data
                }).each(function(index,ele){
                    var value = $(this).data('value');

                    if(!value) return;

                    $(this).val([value]).trigger('change');

                });
            }


        });

    </script>
@endsection
