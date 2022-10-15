@extends('layouts.baseframe')

@section('title', $_title)

@section('content')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.dailybonus.post_setting_desc') }}" method="post" id="searchForm" name="searchForm"
                      class="form-horizontal">
                    <div class="card-toolbar clearfix">
                        <div class="col-sm-3">
                            <div class="input-group form-group">
                                <span class="input-group-addon">@lang('res.common.lang')</span>
                                <select name="language" id="language" class="form-control">
                                    @foreach($lang_list as $k_lang => $v_lang_name)
                                        <option value="{{ $k_lang }}" @if($k_lang == $now_lang) selected @endif>{{ $v_lang_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="toolbar-btn-action">

                            {{--                            <a id="add-btn" class="btn btn-label btn-primary m-r-5" href="javascript:;">--}}
                            {{--                                <label><i class="mdi mdi-plus"></i></label> @lang('res.btn.add')--}}
                            {{--                            </a>--}}

                            <a class="btn btn-label btn-info" data-operate="ajax-submit" data-tinymce="content">
                                <label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> @lang('res.btn.save')
                            </a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">@lang('res.activity.field.content')</label>
                            <div class="col-sm-10">
                                <textarea class="tinymce-content" id="content" name="content">
                                    @if($data) {!! $data !!} @endif
                                </textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('footer-js')

    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="http://libs.itshubao.com/tinymce/tinymce.min.js"></script> --}}
    <script>

        var index_route = "{{ url('/admin/dailybonus/setting_desc') }}";
        $(function () {
            var upload_url = "{{ route('attachment.upload',['file_type' => 'pic','category' => 'editor']) }}";
            tinymce.init($.utils.getTinymceConfig('.tinymce-content', upload_url));

            $('#language').change(function(){
                var v = $(this).val();
                window.location.href=index_route+'?language='+v;
            });

            // 单图上传
            $('#upload-area').imageUpload({
                $callback_input: $('.form-control[name="cover_image"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            $('#upload-area2').imageUpload({
                $callback_input: $('.form-control[name="hall_image"]'),
                showErrorDialog: $.utils.layerError,
                showSuccessDialog: $.utils.layerSuccess
            });

            //日期时间范围

            laydate.render({
                elem: '[name="start_at"]',
                type: 'datetime',
                theme: "#33cabb",
                // range: "~"
            });

            laydate.render({
                elem: '[name="end_at"]',
                type: 'datetime',
                theme: "#33cabb",
                // range: "~"
            });


            // radio 选中事件
            /**
             $('[name=is_apply]').change(function(){
            console.log($(this).val())
            if($(this).val() == 1){
                $('#apply-field').show();
            }else{
                $('#apply-field').hide();
            }
        });

             if($("[name=id]")){
            $("#apply-field select").val({!! json_encode($model->apply_field_array ?? []) !!}).trigger('change');
        }
             **/

            if($("[name=id]")){
                $("#hall-field select").val({!! json_encode($model->hall_field_array ?? []) !!}).trigger('change');
            }

            initView();

            function initView(){
                $('#hall-image').hide().find('input[name]').attr("disabled", true);
                $('#hall-field').hide().find('select[name]').attr("disabled", true);
                $('#hall-image-upload').hide().find('input[name]').attr("disabled", true);

                $('#apply-url').hide().find('input[name]').attr("disabled", true);

                var applyTypeSelect = $("[name='apply_type']");
                var selectValue = applyTypeSelect.find("option:selected").attr("value");
                if(selectValue == {{ App\Models\Activity::APPLY_TYPE_HALL }}){
                    $('#hall-image').show().find('input[name]').attr("disabled", false);
                    $('#hall-field').show().find('select[name]').attr("disabled", false);
                    $('#hall-image-upload').show().find('input[name]').attr("disabled", false);
                }else if(selectValue == {{ App\Models\Activity::APPLY_TYPE_URL }}){
                    $('#apply-url').show().find('input[name]').attr("disabled", false);
                }
            }

            $('[name=apply_type]').change(function(){
                initView();
            });
        });

    </script>
@endsection
