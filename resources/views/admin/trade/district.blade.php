@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <h1>
        分类管理
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
                                <a href="{{ route('admin.trade.create') }}"  class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.trade.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
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
                                <th>分类名称</th>
                                <th>分类图片</th>
                                <th>状态</th>
                                <th>分类排序</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if($list->count()!==0)
                            @foreach($list as $item)
                            <tr>
                                <td><input type="checkbox" name="id[]" value="{{$item->id}}"/></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>@if($item->pic)<img src="{{asset('static/upload/' . str_replace("-", "/",$item->pic))}}" width="20px" height="20px">@endif</td>
                                <td>@if($item->web_status!==0)<font style="color:#009999">已开启</font>@else<font style="color:#ff3366">已关闭</font>@endif</td>
                                <td>{{$item->rank}}</td>
                                <td>@if(empty($item->updated_at)){{$item->created_at}}@else {{$item->updated_at}}@endif</td>
                                <td>
                                    <div class="btn-group-xs" >
                                        <a class="btn btn-default" href="{{ route('admin.trade.edit',['id'=>$item->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
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
                                <a href="{{ route('admin.trade.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.trade.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
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
    set_active_menu('trade_sort', "{{ route('admin.trade.district') }}");
    });
</script>
@endsection