@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <h1>
        供需信息管理
        <small>列表</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="btn-group">
                                <a href="{{ route('admin.demand.create') }}"  class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.demand.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="row">
                            <form name="searchForm" action="{{ route('admin.demand.index') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" name="id" placeholder="ID" value="{{ $filter['id'] or '' }}"/>
                                </div>
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" name="word" placeholder="供需信息标题" value="{{ $filter['word'] or '' }}"/>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                </div>
                                <div class="col-xs-1">
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box-body  no-padding">
                    <form name="itemForm" id="item_form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <table class="table table-striped">
                            <tr>
                                <th><input type="checkbox" class="checkbox-toggle" /></th>
                                <th>ID</th>
                                <th>需求信息标题</th>
                                <th>URL</th>
                                <th>排序数</th>
                                <th>分类</th>
                                <th>查看数</th>
                                <th>状态</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if($list->count()!==0)
                            @foreach($list as $item)
                            <tr>
                                <td><input type="checkbox" name="id[]" value="{{$item->id}}"/></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->url}}</td>
                                <td>{{$item->rank}}</td>
                                <td>{{$item->district->name}}</td>
                                <td>{{$item->views}}</td>
                                <td>@if($item->status!==0)<font style="color:#009999">已开启</font>@else<font style="color:#ff3366">已关闭</font>@endif</td>
                                <td>@if(empty($item->updated_at)){{$item->created_at}}@else {{$item->updated_at}}@endif</td>
                                <td>
                                    <div class="btn-group-xs" >
                                        <a class="btn btn-default" href="{{ route('admin.demand.edit',['id'=>$item->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td>暂无数据</td></tr>
                            @endif
                        </table>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="btn-group">
                                <a href="{{ route('admin.demand.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.demand.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="text-right">
                                <span class="total-num">共{{$list->total()}}条数据</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(function () {
    //激活菜单
    set_active_menu('demand', "{{ route('admin.demand.index') }}");
    });
</script>
@endsection