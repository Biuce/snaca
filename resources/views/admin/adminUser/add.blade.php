@include('admin.header')

{{--@include('admin.breadcrumb')--}}
<div class="col-md-10 col-lg-12">
    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">
                @if(isset($id))
                    {{trans('adminUser.editAdministrator')}}
                @else
                    {{trans('adminUser.newAdministrator')}}
                @endif
            </h4>
        </div>


            <div class="panel-body">
                <form class="layui-form" method="post" action="@if(isset($id)){{ route('admin::adminUser.update', ['id' => $id]) }}@else{{ route('admin::adminUser.save') }}@endif">
                    @if(isset($id)) {{ method_field('PUT') }} @endif
                    {{ csrf_field() }}
                <div class="row form-group">
                <div class="col-sm-1 text-sm-right">
                  <label class="col-form-label" for="standardInput">{{trans('adminUser.name')}}</label>
                </div>
                <div class="col-sm-11">
                    <div class="input-group form-group">
                        <div class="input-group-prepend"><span class="input-group-text" id="icon-addon1"><span class="fa-user"></span></span></div>
                        <input class="form-control" type="text" name="name" aria-label="Username" aria-describedby="icon-addon1" value="{{ $user->name ?? ''  }}">
                    </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-1 text-sm-right">
                  <label class="col-form-label" for="standardInput">{{trans('adminUser.password')}}</label>
                </div>
                <div class="col-sm-11">
                    <div class="input-group form-group">
                        <div class="input-group-prepend"><span class="input-group-text fa-lock"></span></div>
                        <input class="form-control" type="password" name="password" placeholder="{{trans('adminUser.passRemark')}}" aria-label="Password" aria-describedby="icon-addon1">
                    </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-1 text-sm-right">
                  <label class="col-form-label" for="standardInput">{{trans('general.isEnabled')}}</label>
                </div>
                <div class="col-sm-11">
                    <div style="padding-top:10px;" class="custom-control custom-switch custom-switch-info">
                        <input class="custom-control-input" type="checkbox" id="gbflvjkj" name="status" value="1" @if(isset($user) && $user->status == App\Model\Admin\AdminUser::STATUS_ENABLE) checked @endif />
                        <label class="custom-control-label" for="gbflvjkj"></label>
                    </div>
                </div>
            </div>
            <div class="row row-10 align-items-center">
                @if(isset($id))
                    <div class="col-sm-12 text-sm-center">
                        <button class="btn btn-primary" type="submit" lay-submit lay-filter="formAdminUser" id="submitBtn">{{trans('adminUser.editAdministrator')}}</button>
                        <div style="display:inline;float:right;">
                            <button type="button" class="btn btn-warning" onclick="history.go(-1);">{{trans('general.return')}}</button>
                        </div>
                    </div>
                @else
                    <div class="col-sm-12 text-sm-center">
                        <button class="btn btn-primary" type="submit" lay-submit lay-filter="formAdminUser" id="submitBtn">{{trans('adminUser.newAdministrator')}}</button>
                        <div style="display:inline;float:right;">
                            <button type="reset" class="btn btn-secondary">{{trans('general.reset')}}</button>
                            <button type="button" class="btn btn-warning" onclick="history.go(-1);">{{trans('general.return')}}</button>
                        </div>
                    </div>
                @endif
            </div>
                </form>
            </div>

    </div>
</div>

@extends('admin.js')
@section('js')
    <script>
        var form = layui.form;

        //监听提交
        form.on('submit(formAdminUser)', function(data){
            window.form_submit = $('#submitBtn');
            form_submit.prop('disabled', true);
            $.ajax({
                type : data.form.method,
                url: data.form.action,
                data: data.field,
                success: function (result) {
                    console.log(result);
                    if (result.code !== 0) {
                        form_submit.prop('disabled', false);
                        layer.msg(result.msg, {shift: 6});
                        return false;
                    }
                    layer.msg(result.msg, {shift: 1}, function () {
                        if (result.reload) {
                            location.reload();
                        }
                        if (result.redirect) {
                            location.href = '{!! url()->previous() !!}';
                        }
                    });
                },
                error: function (resp, stat, text) {
                    if (window.form_submit) {
                        form_submit.prop('disabled', false);
                    }
                    if (resp.status === 422) {
                        var parse = $.parseJSON(resp.responseText);
                        if (parse) {
                            layer.msg(parse.msg, {shift: 6, skin:'alert-secondary alert-lighter'});
                        }
                        return false;
                    } else if (resp.status === 404) {
                        layer.msg('资源不存在', {icon: 5, skin:'alert-secondary alert-lighter'});
                        return false;
                    } else if (resp.status === 401) {
                        layer.msg('请先登录', {shift: 6, skin:'alert-secondary alert-lighter'});
                        return false;
                    } else if (resp.status === 429) {
                        layer.msg('访问过于频繁，请稍后再试', {shift: 6, skin:'alert-secondary alert-lighter'});
                        return false;
                    } else if (resp.status === 419) {
                        layer.msg('非法请求。请刷新页面后重试。', {shift: 6, skin:'alert-secondary alert-lighter'});
                        return false;
                    } else if (resp.status === 500) {
                        layer.msg('内部错误，请联系管理员', {shift: 6, skin:'alert-secondary alert-lighter'});
                        return false;
                    } else {
                        var parse = $.parseJSON(resp.responseText);
                        // if (parse && parse.err) {
                        if (parse) {
                            layer.alert(parse.msg);
                        }
                        return false;
                    }
                },
            });

            return false;
        });
    </script>
@endsection
</div>
    </body>
    </html>