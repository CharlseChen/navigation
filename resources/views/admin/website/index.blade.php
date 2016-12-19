@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <h1>
        网站管理
        <small>网站列表</small>
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
                                <a href="{{ route('admin.website.create') }}"  class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.website.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="row">
                                <form name="searchForm" action="{{ route('admin.website.index') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="id" placeholder="网站ID" value="{{ $filter['id'] or '' }}"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="word" placeholder="网站名称" value="{{ $filter['word'] or '' }}"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="sort" placeholder="网站分类名" value="{{ $filter['sort'] or '' }}"/>
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
                </div>
                <div class="box-body  no-padding">
                    <form name="itemForm" id="item_form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <table class="table table-striped">
                            <tr>
                                <th><input type="checkbox" class="checkbox-toggle" /></th>
                                <th>ID</th>
                                <th>网站名称</th>
                                <th>网站url</th>
                                <th>网站图标</th>
                                <th>网站简介</th>
                                <th>网站分类</th>
                                <th>点击次数</th>
                                <th>推荐状态</th>
                                <th>状态</th>
                                <th>链接样式类型</th>
                                <th>网站分类排序</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if($list->count()!==0)
                            @foreach($list as $item)
                            <tr>
                                <td><input type="checkbox" name="id[]" value="{{$item->web_id}}"/></td>
                                <td>{{$item->web_id}}</td>
                                <td>{{$item->web_name}}</td>
                                <td>{{$item->web_url}}</td>
                                <td>@if($item->web_pic)<img src="{{asset('static/upload/' . str_replace("-", "/",$item->web_pic))}}" width="20px" height="20px">@endif</td>
                                <td>{!!$item->web_intro!!}</td>
                                <td>@if(!empty($item->websort->cate_name)){{$item->websort->cate_name}} @else 分类可能已被删除@endif</td>
                                <td>{{$item->web_views}}</td>
                                <td>@if($item->web_isbest)<font style="color:#009999">已推荐</font>@else<font style="color:#ff3366">未推荐</font>@endif</td>
                                <td>@if($item->web_status!==0)<font style="color:#009999">已开启</font>@else<font style="color:#ff3366">已关闭</font>@endif</td>
                                <td><span class="@if(!empty($item->mark->class_name)){{$item->mark->class_name}} @endif">@if(empty($item->mark->class_name))<span style="color: red">*链接样式已删除</span>@else {{$item->mark->class_name}} @endif</span></td>
                                <td>{{$item->web_rank}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="btn-group-xs" >
                                        <a class="btn btn-default" href="{{ route('admin.website.edit',['id'=>$item->web_id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-default" href="{{ route('admin.web_recomment.index',['id'=>$item->web_id,'type'=>'web','status'=>$item->web_isbest]) }}" data-toggle="tooltip" title="推荐">@if($item->web_isbest)<i class="glyphicon glyphicon-star"></i>@else<i class="glyphicon glyphicon-star-empty"></i>@endif</a>
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
                                <a href="{{ route('admin.website.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="新增网站"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.website.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="text-right">
                                <span class="total-num">共{{$list->total()}} 条数据</span>
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
    set_active_menu('website', "{{ route('admin.website.index') }}");
    });
</script>
@endsection