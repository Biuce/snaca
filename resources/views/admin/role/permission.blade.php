@include('admin.header')

    <div class="col-md-10 col-lg-12">
        <div class="panel">
            <div class="panel-header">
                <h4 class="panel-title">{{trans('role.current')}}:{{ $role->name }}</h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('admin::role.permission.update', ['id' => $id]) }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="row row-15">
                        <div class="col-12">
                            <div class="group-10">
                                @foreach(App\Repository\Admin\MenuRepository::group() as $k => $v)
                                    <div class="layui-form-item" style="margin-top: 30px">
                                        <div class="d-inline-block">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="lmibpdpv{{ $loop->iteration }}" value="{{ $loop->iteration }}" lay-filter="group" lay-skin="primary" />
                                                <label class="custom-control-label" for="lmibpdpv{{ $loop->iteration }}">{{ $k ? $k : '未分组' }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="layui-form-item" style="margin-left: 50px" data-group="{{ $loop->iteration }}">
                                        @foreach($v as $menu)
                                            <div class="d-inline-block" style="margin-top: 30px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="child{{ $menu->id }}" name="permission[{{ $menu->id }}]" value="{{ $menu->name }}" @if($rolePermissions->pluck('id')->contains($menu->id)) checked @endif />
                                                    <label class="custom-control-label" for="child{{ $menu->id }}">{{ $menu->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                <div class="row row-10 align-items-center" style="margin-top: 40px;margin-bottom: -20px;">
                                    <div class="col-sm-12 text-sm-center">
                                        <button class="btn btn-primary" type="submit" lay-submit lay-filter="formAdminUser" id="submitBtn">{{trans('role.current')}}</button>
                                        <div style="display:inline;float:right;">
                                            <button type="button" class="btn btn-warning" onclick="history.go(-1);">{{trans('general.return')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    type : "PUT",
                    url: data.form.action,
                    data: data.field,
                    success: function (result) {
                        if (result.code !== 0) {
                            form_submit.prop('disabled', false);
                            layer.msg(result.msg, {shift: 6});
                            return false;
                        }
                        layer.msg(result.msg, {icon: 1}, function () {
                            if (result.reload) {
                                location.reload();
                            }
                            if (result.redirect) {
                                location.href = '{!! url()->previous() !!}';
                            }
                        });
                    }
                });

                return false;
            });

            form.on('checkbox(group)', function(data){
                console.log('aaa');
                var checked = data.elem.checked;
                $("div[data-group=" + data.value + "]").find('input[type=checkbox]').each(function (i, obj) {
                    obj.checked = checked;
                });
                form.render('checkbox');
            });

    </script>
@endsection
</div>
    </body>
    </html>