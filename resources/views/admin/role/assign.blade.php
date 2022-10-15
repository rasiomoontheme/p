@extends('layouts.baseframe')

@section('title', $_title)

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $_title }}</h4>
                <ul class="card-actions">
                    <li>
                        <button type="button" onclick="javascript:window.history.go(-1);">
                            <i class="mdi mdi-skip-backward"></i> @lang('res.btn.back')
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <form method="post" class="form-horizontal"
                      action="{{ route('admin.roles.post_assign',['role' => $role->id]) }}" id="form">

                    @csrf

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.role.field.name')</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="name"
                                   value="{{ $role->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('res.role.assign.permission')</label>
                        <div class="col-sm-8">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        <label class="lyear-checkbox checkbox-primary">
                                            <input name="checkbox" type="checkbox" id="check-all">
                                            <span> @lang('res.role.assign.check_all')</span>
                                        </label>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input name="permissions[]" type="checkbox" class="checkbox-parent"
                                                       dataid="id{{ $permission->path.$permission->id }}"
                                                       value="{{ $permission->id }}"
                                                       @if(in_array($permission->id,$permission_ids)) checked="checked" @endif
                                                >
                                                <span>{{ $permission->name }}</span>
                                            </label>
                                        </td>
                                    </tr>

                                    @foreach ($permission->children as $permi)
                                        <tr>
                                            <td class="p-l-20">
                                                <label class="lyear-checkbox checkbox-primary">
                                                    <input name="permissions[]" type="checkbox"
                                                           class="checkbox-parent checkbox-child"
                                                           dataid="id{{ $permi->path.$permi->id }}" value="{{ $permi->id }}"
                                                           @if(in_array($permi->id,$permission_ids)) checked="checked" @endif>
                                                    {{--.'-'.$permi->id--}}
                                                    <span>{{ $permi->name }}</span>
                                                </label>
                                            </td>
                                        </tr>

                                        @if(count($permi->children))

                                            <tr>
                                                <td class="p-l-40">
                                                    @foreach ($permi->children as $per)
                                                        <label class="lyear-checkbox checkbox-primary checkbox-inline">
                                                            <input name="permissions[]" type="checkbox" class="checkbox-child"
                                                                   dataid="id{{ $per->path.$per->id }}" value="{{ $per->id }}"
                                                                   @if(in_array($per->id,$permission_ids)) checked="checked" @endif>
                                                            <span>{{ $per->name.'-'.$per->id }}</span>
                                                        </label>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach

                                @endforeach


                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" data-operate="ajax-submit" type="button">@lang('res.btn.save')</button>
                                <button class="btn btn-default" type="reset">@lang('res.btn.reset')</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-js')
    <script type="text/javascript">
        $(function () {
            //动态选择框，上下级选中状态变化
            $('input.checkbox-parent').on('change', function () {
                var dataid = $(this).attr("dataid");
                $('input[dataid^=' + dataid + '-]').prop('checked', $(this).is(':checked'));
            });
            $('input.checkbox-child').on('change', function () {
                var dataid = $(this).attr("dataid");
                dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                var parent = $('input[dataid=' + dataid + ']');
                if ($(this).is(':checked')) {
                    parent.prop('checked', true);
                    //循环到顶级
                    while (dataid.lastIndexOf("-") != 2) {
                        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                        parent = $('input[dataid=' + dataid + ']');
                        parent.prop('checked', true);
                    }
                } else {
                    //父级
                    if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                        parent.prop('checked', false);
                        //循环到顶级
                        while (dataid.lastIndexOf("-") != 2) {
                            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                            parent = $('input[dataid=' + dataid + ']');
                            if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                                parent.prop('checked', false);
                            }
                        }
                    }
                }
            });
        });

    </script>
@endsection
