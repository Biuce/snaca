@include('admin.header')
    {{--@include('admin.breadcrumb')--}}

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between group-5">
                    <h4 class="panel-title">
                        <span class="panel-icon fa-tasks"></span>
                        <span>{{trans('config.configList')}}</span>
                    </h4>
                    <div class="form-group">
                        <a href="{{ route('admin::config.create') }}"><button class="btn btn-primary" type="button" id="submitBtn">{{trans('config.newConfig')}}</button></a>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <form name="admin_list_sea" class="form-search" method="get" action="{{ route('admin::config.index') }}">
                        {{ csrf_field() }}
                        <div class="row row-15">
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input class="form-control" id="text" type="text" placeholder="{{trans('config.name')}}" name="name">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input class="form-control" id="text" type="text" placeholder="{{trans('config.key')}}" name="key">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-success" type="submit" lay-submit lay-filter="formAdminUser" id="submitBtn">{{trans('general.search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" style="padding-bottom: 20px;">
                        <thead class="border-bottom">
                        <tr class="long-tr">
                            <th>{{trans('config.id')}}</th>
                            <th>{{trans('config.name')}}</th>
                            <th>{{trans('config.group')}}</th>
                            <th>{{trans('config.key')}}</th>
                            <th>{{trans('config.type')}}</th>
                            <th>{{trans('config.value')}}</th>
                            <th>{{trans('general.create')}}</th>
                            <th>{{trans('general.update')}}</th>
                            <th>{{trans('general.action')}}</th>
                        </tr>
                        </thead>
                        <tbody id="list-content">
                            @isset($lists)
                                @foreach($lists as $k => $v)
                                    <tr>
                                        <td>{{ $v['id'] }}</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td>{{ $v['group'] }}</td>
                                        <td>{{ $v['key'] }}</td>
                                        <td>{{ $v['type'] }}</td>
                                        <td>{{ $v['value'] }}</td>
                                        <td>{{ $v['created_at'] }}</td>
                                        <td>{{ $v['updated_at'] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle btn-info btn-sm" data-toggle="dropdown" aria-expanded="false">
                                                <span>Active</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin::config.edit', ['id' => $v['id']]) }}">{{trans('general.edit')}}</a>
                                                    <a class="dropdown-item" href="javascript:;" onclick="deleteConfig('{{ route('admin::config.delete', ['id' => $v['id']]) }}')">{{trans('general.delete')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div id="pages" style="margin-top: 30px;margin-bottom: -50px;">
                    {{ $lists->links() }}
                </div>
            </div>
        </div>
    </div>

@extends('admin.js')
@section('js')
    <script>
        var sure = "{{trans('general.deleteSure')}}";
        var token = $("input[name='_token']") .val();
        function deleteConfig (url) {
            layer.confirm(sure, function(index){
                $.ajax({
                    url: url,
                    type: "DELETE",   //请求方式
                    headers: {'X-CSRF-Token': token},
                    success: function (result) {
                        if (result.code !== 0) {
                            layer.msg(result.msg, {shift: 6});
                            return false;
                        }
                        layer.msg(result.msg, {icon: 1}, function () {
                            if (result.reload) {
                                location.reload();
                            }
                            if (result.redirect) {
                                location.href = '{!! url()->current() !!}';
                            }
                        });
                    }
                });

                layer.close(index);
            });
        }
    </script>
@endsection
</div>
    </body>
    </html>