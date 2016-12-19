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
                        <div class="col-xs-9">
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
                                <th>反馈内容</th>
                                <th>反馈图片</th>
                                <th>处理意见</th>
                                <th>用户邮箱</th>
                                <th>创建时间</th>
                                <th>处理时间</th>
                                <th>操作</th>
                            </tr>
                            @if(0)
                            <tr>
                                <td>
                                    <div class="btn-group-xs" >
                                        <a class="btn btn-default" href="" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr><td>暂无数据</td></tr>
                            @endif

                        </table>
                    </form>
                </div>
                <div class="box-footer clearfix">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="text-right">
                                <span class="total-num">共 条数据</span>
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
    set_active_menu('feedback', "{{ route('admin.website.index') }}");
    });
</script>
@endsection