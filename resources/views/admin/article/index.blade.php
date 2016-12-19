@extends("admin.public.layout")
@section('content')
@include('admin/public/error')
<section class="content-header">
    <h1>
        文章管理
        <small>文章列表</small>
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
                                <a href="{{ route('admin.article.create') }}"  class="btn btn-default btn-sm" data-toggle="tooltip" title="新增文章"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="row">
                                <form name="searchForm" action="{{ route('admin.article.index') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="id" placeholder="文章ID" value="{{ $filter['id'] or '' }}"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="word" placeholder="文章标题名" value="{{ $filter['word'] or '' }}"/>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control" name="sort" placeholder="文章分类名" value="{{ $filter['sort'] or '' }}"/>
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
                                <th>文章名称</th>
                                <th>文章来源</th>
                                <th>文章简介</th>
                                <th>文章分类</th>
                                <th>点击次数</th>
                                <th>推荐状态</th>
                                <th>状态</th>
                                <th>链接样式</th>
                                <th>文章分类排序</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @if($list->count()!==0)
                            @foreach($list as $item)
                            <tr>
                                <td><input type="checkbox" name="id[]" value="{{$item->art_id}}"/></td>
                                <td>{{$item->art_id}}</td>
                                <td>{!!$item->art_title!!}</td>
                                <td>@if($item->author==null)<a href="{{$item->copy_url}}" style="cursor: pointer">{{$item->copy_name}}</a>@else{{$item->author}}@endif</td>
                                <td>{!!htmlspecialchars_decode($item->art_intro)!!}</td>
                                <td>@if(!empty($item->websort->cate_name)){{$item->websort->cate_name}} @else 分类可能已被删除@endif</td>
                                <td>{{$item->art_views}}</td>
                                <td>@if($item->art_isbest)<font style="color:#009999">已推荐</font>@else<font style="color:#ff3366">未推荐</font>@endif</td>
                                <td>@if($item->art_status!==0)<font style="color:#009999">已开启</font>@else<font style="color:#ff3366">已关闭</font>@endif</td>
                                <td><span class="@if(!empty($item->mark->class_name)){{$item->mark->class_name}} @endif">@if(empty($item->mark->class_name))<span style="color: red">*链接样式已删除</span>@else {{$item->mark->class_name}} @endif</span></td>
                                <td>{{$item->art_rank}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <div class="btn-group-xs" >
                                        <a class="btn btn-default" href="{{ route('admin.article.edit',['id'=>$item->art_id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-default" href="{{ route('admin.web_recomment.index',['id'=>$item->art_id,'type'=>'article','status'=>$item->art_isbest]) }}" data-toggle="tooltip" title="推荐">@if($item->art_isbest)<i class="glyphicon glyphicon-star"></i>@else<i class="glyphicon glyphicon-star-empty"></i>@endif</a>
                                        <a class="btn btn-default"  data-toggle="tooltip" art_id='{{$item->art_id}}' art_top="{{!$item->art_top}}">@if(!$item->art_top)<i class="glyphicon glyphicon-hand-up" title="置顶"></i>@else<i class="glyphicon glyphicon-hand-down"  title="取消置顶"></i>@endif</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else 
                            <tr><td>暂时无数据</td></tr>
                            @endif
                        </table>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="btn-group">
                                <a href="{{ route('admin.article.create') }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="新增文章"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.article.destroy') }}', '确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">节点名称修改</h4>
            </div>
            <form role="form" name="update" method="POST" action="{{ route('admin.article.top') }}"   enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name='art_id'  id='art_id' value=''>
                    <input type="hidden" name='art_top' id="art_top" value="">
                    <input type="file" name="art_top_pic"value="">
                </div>
            </form> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="document.forms[2].submit();">保存</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function () {
    //激活菜单
    set_active_menu('article_sort', "{{ route('admin.article.index') }}");
    $(document).ready(function(){
    $('.glyphicon-hand-up').click(function(){
    var art_id = $(this).parent().attr('art_id');
    var art_top = $(this).parent().attr('art_top');
    $('#art_id').val(art_id);
    $('#art_top').val(art_top);
    $('#myModal').modal('show');
    });
    
    $('.glyphicon-hand-down').click(function(){
    var art_id = $(this).parent().attr('art_id');
    var art_top = $(this).parent().attr('art_top');
    if(art_top==null){art_top=0}
    $.ajax({
    url: "{{route('admin.article.top')}}",
            data: {
            art_id: art_id,
            art_top: art_top,
                    _token:"{{csrf_token()}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                if(data.status=='success'){
                    window.location.href="{{route('admin.article.index')}}";
                }
            }
    });
    });
    })
    });
</script>
@endsection